<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PelanggaranController extends Controller
{
    public function index(Request $request)
    {
        // Set default date to today
        $today = Carbon::today()->toDateString();
        $tanggal = $request->tanggal ?? $today;

        // Base query with relationships
        $query = Pelanggaran::with([
            'siswa' => function ($q) {
                $q->with('kelas');
            },
            'pencatat'
        ])
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc');

        // Apply date filter
        $query->whereDate('tanggal', $tanggal);

        // Apply class filter if specified
        if ($request->filled('kelas')) {
            $query->whereHas('siswa.kelas', function ($q) use ($request) {
                $q->where('tingkat_kelas', $request->kelas);
            });
        }

        // Apply major filter if specified
        if ($request->filled('jurusan')) {
            $query->whereHas('siswa.kelas', function ($q) use ($request) {
                $q->where('jurusan', $request->jurusan);
            });
        }

        // Apply category filter if specified
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Get paginated results
        $pelanggarans = $query->paginate(20);

        // Get distinct values for filters
        $kelasList = Kelas::orderBy('tingkat_kelas')
            ->distinct('tingkat_kelas')
            ->pluck('tingkat_kelas');

        $jurusanList = Kelas::orderBy('jurusan')
            ->distinct('jurusan')
            ->pluck('jurusan');

        // Daily statistics for the selected date
        $dailyStats = [
            'total' => Pelanggaran::whereDate('tanggal', $tanggal)->count(),
            'ringan' => Pelanggaran::whereDate('tanggal', $tanggal)
                ->where('kategori', 'ringan')->count(),
            'sedang' => Pelanggaran::whereDate('tanggal', $tanggal)
                ->where('kategori', 'sedang')->count(),
            'berat' => Pelanggaran::whereDate('tanggal', $tanggal)
                ->where('kategori', 'berat')->count(),
            'total_poin' => Pelanggaran::whereDate('tanggal', $tanggal)
                ->sum('poin')
        ];

        // Global statistics
        $globalStats = [
            'total_pelanggaran' => Pelanggaran::count(),
            'bulan_ini' => Pelanggaran::whereMonth('tanggal', now()->month)->count(),
            'rata_poin' => number_format(Pelanggaran::avg('poin') ?? 0, 2),

            // Distribution by category
            'distribusi_kategori' => Pelanggaran::select('kategori')
                ->selectRaw('count(*) as jumlah')
                ->groupBy('kategori')
                ->pluck('jumlah', 'kategori'),

            // Most frequent violations
            'pelanggaran_terbanyak' => Pelanggaran::select('nama_pelanggaran')
                ->selectRaw('count(*) as total')
                ->groupBy('nama_pelanggaran')
                ->orderByDesc('total')
                ->limit(5)
                ->get(),

            // Top students by points
            'top_siswa_poin' => Siswa::select([
                'siswas.id',
                'siswas.nama',
                'siswas.nis',
                'kelas.tingkat_kelas',
                'kelas.jurusan',
                'kelas.rombel'
            ])
                ->selectRaw('COALESCE(SUM(pelanggarans.poin), 0) as total_poin')
                ->leftJoin('pelanggarans', 'pelanggarans.siswa_id', '=', 'siswas.id')
                ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
                ->groupBy([
                    'siswas.id',
                    'siswas.nama',
                    'siswas.nis',
                    'kelas.tingkat_kelas',
                    'kelas.jurusan',
                    'kelas.rombel'
                ])
                ->orderByDesc('total_poin')
                ->limit(5)
                ->get(),

            // Student with most violations
            'siswa_terbanyak' => Siswa::select([
                'siswas.id',
                'siswas.nama',
                'siswas.nis',
                'kelas.tingkat_kelas',
                'kelas.jurusan',
                'kelas.rombel'
            ])
                ->selectRaw('COUNT(pelanggarans.id) as jumlah_pelanggaran')
                ->join('pelanggarans', 'pelanggarans.siswa_id', '=', 'siswas.id')
                ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
                ->groupBy([
                    'siswas.id',
                    'siswas.nama',
                    'siswas.nis',
                    'kelas.tingkat_kelas',
                    'kelas.jurusan',
                    'kelas.rombel'
                ])
                ->orderByDesc('jumlah_pelanggaran')
                ->first()
        ];

        return view('dashboard.pelanggaran.index', [
            'pelanggarans' => $pelanggarans,
            'kelasList' => $kelasList,
            'jurusanList' => $jurusanList,
            'tanggal' => $tanggal,
            'dailyStats' => $dailyStats,
            'globalStats' => $globalStats,
            'request' => $request
        ]);
    }

    protected function getPelanggaranStats()
    {
        return [
            'total' => Pelanggaran::count(),
            'bulan_ini' => Pelanggaran::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count(),
            'rata_poin' => round(Pelanggaran::avg('poin') ?? 0, 1),
            'siswa_terbanyak' => Siswa::with('kelas')->orderByDesc('poin')->first(),
            'top_siswa' => Siswa::with('kelas')->orderByDesc('poin')->limit(3)->get(),
            'distribusi' => Pelanggaran::select('kategori', DB::raw('count(*) as total'))
                ->groupBy('kategori')
                ->get()
                ->pluck('total', 'kategori'),
            'pelanggaran_terbanyak' => Pelanggaran::select('nama_pelanggaran', DB::raw('count(*) as total'))
                ->groupBy('nama_pelanggaran')
                ->orderByDesc('total')
                ->limit(4)
                ->get()
        ];
    }

    public function create()
    {
        // Get active students grouped by class
        $kelasList = Kelas::with(['siswas' => function ($query) {
            $query->where('status', 'aktif')->orderBy('nama');
        }])->orderBy('tingkat_kelas')
            ->orderBy('jurusan')
            ->orderBy('rombel')
            ->get();

        $jurusanList = Kelas::select('jurusan')->distinct()->pluck('jurusan');

        return view('dashboard.pelanggaran.add', compact('kelasList', 'jurusanList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'nama_pelanggaran' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:ringan,sedang,berat',
            'poin' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::transaction(function () use ($validated, $request) {
            // Format the date and time
            $validated['tanggal'] = Carbon::parse($validated['tanggal'])->format('Y-m-d');
            $validated['pencatat_id'] = auth()->id();

            // Convert waktu to proper format if exists
            if (!empty($validated['waktu'])) {
                $validated['waktu'] = Carbon::parse($validated['waktu'])->format('H:i:s');
            } else {
                $validated['waktu'] = null;
            }

            // Handle file upload if exists
            if ($request->hasFile('bukti_foto')) {
                $validated['bukti_foto'] = $this->storeImage($request->file('bukti_foto'));
            }

            // Create the violation record
            $pelanggaran = Pelanggaran::create($validated);

            // Update student points
            $this->updatePoinSiswa($pelanggaran->siswa, $validated['poin']);
        });

        return redirect()->route('pelanggaran.index')
            ->with('success', 'Pelanggaran berhasil dicatat!');
    }

    public function show(Pelanggaran $pelanggaran)
    {
        return view('dashboard.pelanggaran.show', compact('pelanggaran'));
    }

    public function edit(Pelanggaran $pelanggaran)
    {
        // Get active students grouped by class
        $kelasList = Kelas::with(['siswas' => function ($query) {
            $query->where('status', 'aktif')->orderBy('nama');
        }])->orderBy('tingkat_kelas')
            ->orderBy('jurusan')
            ->orderBy('rombel')
            ->get();

        $jurusanList = Kelas::select('jurusan')->distinct()->pluck('jurusan');

        return view('dashboard.pelanggaran.edit', compact('pelanggaran', 'kelasList', 'jurusanList'));
    }

    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'nama_pelanggaran' => 'required|string|max:255',
            'kategori' => 'required|in:ringan,sedang,berat',
            'poin' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string|max:255',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::transaction(function () use ($validated, $request, $pelanggaran) {
            // Handle perubahan siswa atau poin
            $this->handleSiswaPoinChanges($pelanggaran, $validated);

            // Format the date
            $validated['tanggal'] = Carbon::parse($validated['tanggal'])->format('Y-m-d');

            // Handle upload foto baru
            if ($request->hasFile('bukti_foto')) {
                $this->deleteImage($pelanggaran->bukti_foto);
                $validated['bukti_foto'] = $this->storeImage($request->file('bukti_foto'));
            }

            $pelanggaran->update($validated);
        });

        return redirect()->route('pelanggaran.index')
            ->with('success', 'Pelanggaran berhasil diperbarui!');
    }

    public function destroy(Pelanggaran $pelanggaran)
    {
        DB::transaction(function () use ($pelanggaran) {
            $this->deleteImage($pelanggaran->bukti_foto);
            $pelanggaran->siswa->decrement('poin', $pelanggaran->poin);
            $pelanggaran->delete();
        });

        return redirect()->route('pelanggaran.index')
            ->with('success', 'Pelanggaran berhasil dihapus!');
    }

    protected function validateRequest(Request $request, $pelanggaran = null)
    {
        return $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'nama_pelanggaran' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:ringan,sedang,berat',
            'poin' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    protected function handleSiswaPoinChanges($pelanggaran, $validated)
    {
        $siswaChanged = $pelanggaran->siswa_id != $validated['siswa_id'];
        $poinChanged = $pelanggaran->poin != $validated['poin'];

        if ($siswaChanged) {
            // Kurangi poin dari siswa lama
            $pelanggaran->siswa->decrement('poin', $pelanggaran->poin);
            // Tambahkan poin ke siswa baru
            Siswa::find($validated['siswa_id'])->increment('poin', $validated['poin']);
        } elseif ($poinChanged) {
            // Sesuaikan selisih poin
            $selisih = $validated['poin'] - $pelanggaran->poin;
            $pelanggaran->siswa->increment('poin', $selisih);
        }
    }

    protected function storeImage($image)
    {
        return $image->store('bukti-pelanggaran', 'public');
    }

    protected function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function updatePoinSiswa($siswa, $poin)
    {
        $siswa->increment('poin', $poin);
    }
}
