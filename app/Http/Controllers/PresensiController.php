<?php

// app/Http/Controllers/PresensiController.php
namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    // Menampilkan daftar presensi
    public function index(Request $request)
    {
        $today = Carbon::today()->toDateString();

        $query = Presensi::with(['siswa.kelas', 'user'])
            ->orderBy('tanggal', 'desc');

        // Filter berdasarkan tanggal (default hari ini)
        $tanggal = $request->tanggal ?? $today;
        $query->whereDate('tanggal', $tanggal);

        // Filter kelas
        if ($request->kelas) {
            $query->whereHas('siswa.kelas', function ($q) use ($request) {
                $q->where('tingkat_kelas', $request->kelas);
            });
        }

        // Filter jurusan
        if ($request->jurusan) {
            $query->whereHas('siswa.kelas', function ($q) use ($request) {
                $q->where('jurusan', $request->jurusan);
            });
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $presensi = $query->paginate(20);

        $kelasList = Kelas::distinct('tingkat_kelas')->pluck('tingkat_kelas');
        $jurusanList = Kelas::distinct('jurusan')->pluck('jurusan');

        // Hitung statistik
        $totalSiswa = Siswa::where('status', 'aktif')->count();
        $totalHadir = Presensi::whereDate('tanggal', $tanggal)
            ->where('status', 'hadir')->count();
        $totalIzin = Presensi::whereDate('tanggal', $tanggal)
            ->where('status', 'izin')->count();
        $totalAlpha = $totalSiswa - ($totalHadir + $totalIzin);

        return view('dashboard.presensi.index', compact(
            'presensi',
            'kelasList',
            'jurusanList',
            'tanggal',
            'totalSiswa',
            'totalHadir',
            'totalIzin',
            'totalAlpha'
        ));
    }

    // Menampilkan form input manual
    // app/Http/Controllers/PresensiController.php
    public function create()
    {
        // Gunakan nama relasi yang benar ('siswas')
        $kelasList = Kelas::with(['siswas' => function ($query) {
            $query->where('status', 'aktif')->orderBy('nama');
        }])->get();

        $jurusanList = Kelas::select('jurusan')->distinct()->pluck('jurusan');

        return view('dashboard.presensi.add', compact('kelasList', 'jurusanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'presensi' => 'required|array',
            'presensi.*.siswa_id' => 'required|exists:siswas,id',
            'presensi.*.status' => 'required|in:hadir,izin,sakit,alpha',
            'presensi.*.waktu_masuk' => 'nullable|date_format:H:i',
            'presensi.*.keterangan' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->presensi as $data) {
                Presensi::updateOrCreate(
                    [
                        'siswa_id' => $data['siswa_id'],
                        'tanggal' => $request->tanggal
                    ],
                    [
                        'status' => $data['status'],
                        'waktu_masuk' => $data['waktu_masuk'] ?? null,
                        'keterangan' => $data['keterangan'] ?? null,
                        'user_id' => auth()->id()
                    ]
                );
            }
        });

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi berhasil disimpan');
    }
    public function show() {}

    // Menampilkan form edit presensi
    public function edit(Presensi $presensi)
    {
        return view('dashboard.presensi.edit', compact('presensi'));
    }

    // Update presensi
    public function update(Request $request, Presensi $presensi)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $presensi->update([
            'waktu_masuk' => $request->waktu_masuk,
            'waktu_keluar' => $request->waktu_keluar,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi berhasil diperbarui');
    }

    public function destroy() {}


    public function rekap(Request $request)
    {
        // Ambil parameter filter
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        // Query untuk rekap presensi
        $query = Presensi::with(['siswa.kelas', 'user'])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc');

        // Filter kelas
        if ($request->kelas) {
            $query->whereHas('siswa.kelas', function ($q) use ($request) {
                $q->where('tingkat_kelas', $request->kelas);
            });
        }

        // Filter jurusan
        if ($request->jurusan) {
            $query->whereHas('siswa.kelas', function ($q) use ($request) {
                $q->where('jurusan', $request->jurusan);
            });
        }

        $presensi = $query->paginate(20);

        // Hitung statistik
        $totalSiswa = Siswa::when($request->kelas, function ($q) use ($request) {
            $q->whereHas('kelas', function ($q) use ($request) {
                $q->where('tingkat_kelas', $request->kelas);
            });
        })
            ->when($request->jurusan, function ($q) use ($request) {
                $q->whereHas('kelas', function ($q) use ($request) {
                    $q->where('jurusan', $request->jurusan);
                });
            })
            ->where('status', 'aktif')
            ->count();

        $totalHadir = Presensi::whereBetween('tanggal', [$startDate, $endDate])
            ->where('status', 'hadir')
            ->when($request->kelas, function ($q) use ($request) {
                $q->whereHas('siswa.kelas', function ($q) use ($request) {
                    $q->where('tingkat_kelas', $request->kelas);
                });
            })
            ->when($request->jurusan, function ($q) use ($request) {
                $q->whereHas('siswa.kelas', function ($q) use ($request) {
                    $q->where('jurusan', $request->jurusan);
                });
            })
            ->count();

        $totalIzin = Presensi::whereBetween('tanggal', [$startDate, $endDate])
            ->whereIn('status', ['izin', 'sakit'])
            ->when($request->kelas, function ($q) use ($request) {
                $q->whereHas('siswa.kelas', function ($q) use ($request) {
                    $q->where('tingkat_kelas', $request->kelas);
                });
            })
            ->when($request->jurusan, function ($q) use ($request) {
                $q->whereHas('siswa.kelas', function ($q) use ($request) {
                    $q->where('jurusan', $request->jurusan);
                });
            })
            ->count();

        $totalAlpha = $totalSiswa - ($totalHadir + $totalIzin);

        $kelasList = Kelas::select('tingkat_kelas')->distinct()->pluck('tingkat_kelas');
        $jurusanList = Kelas::select('jurusan')->distinct()->pluck('jurusan');

        return view('dashboard.presensi.rekap', compact(
            'presensi',
            'totalSiswa',
            'totalHadir',
            'totalIzin',
            'totalAlpha',
            'kelasList',
            'jurusanList',
            'startDate',
            'endDate'
        ));
    }

    // Ekspor data presensi

}
