<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Presensi;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Tanggal hari ini
        $today = Carbon::today()->toDateString();

        // Total siswa aktif
        $totalSiswa = Siswa::where('status', 'aktif')->count();

        // Data presensi hari ini
        $todayPresensi = Presensi::with(['siswa'])
            ->whereDate('tanggal', $today)
            ->get();

        // Hitung statistik presensi
        $totalHadir = $todayPresensi->where('status', 'hadir')->count();
        $totalIzin = $todayPresensi->where('status', 'izin')->count();
        $totalSakit = $todayPresensi->where('status', 'sakit')->count();
        $totalAlpha = $totalSiswa - ($totalHadir + $totalIzin + $totalSakit);

        // Daftar kelas dan jurusan untuk filter
        $kelasList = Kelas::select('tingkat_kelas')
            ->distinct()
            ->orderBy('tingkat_kelas')
            ->pluck('tingkat_kelas');

        $jurusanList = Kelas::select('jurusan')
            ->distinct()
            ->orderBy('jurusan')
            ->pluck('jurusan');

        // Kelas dengan absensi terendah (alpha tertinggi)
        $kelasTerendah = Kelas::select(
            'kelas.id',
            'kelas.tingkat_kelas',
            'kelas.jurusan',
            'kelas.rombel',
            DB::raw('CONCAT(kelas.tingkat_kelas, " ", kelas.jurusan, " ", kelas.rombel) as nama_kelas'),
            DB::raw('COUNT(siswas.id) as total_siswa'),
            DB::raw('SUM(CASE WHEN presensi.status = "alpha" THEN 1 ELSE 0 END) as total_alpha')
        )
            ->leftJoin('siswas', 'kelas.id', '=', 'siswas.kelas_id')
            ->leftJoin('presensi', function ($join) use ($today) {
                $join->on('siswas.id', '=', 'presensi.siswa_id')
                    ->whereDate('presensi.tanggal', $today);
            })
            ->where('siswas.status', 'aktif')
            ->groupBy('kelas.id', 'kelas.tingkat_kelas', 'kelas.jurusan', 'kelas.rombel')
            ->having('total_siswa', '>', 0)
            ->orderByDesc('total_alpha')
            ->limit(3)
            ->get()
            ->map(function ($kelas) {
                $kelas->persen_absen = $kelas->total_siswa > 0
                    ? round(($kelas->total_alpha / $kelas->total_siswa) * 100)
                    : 0;
                return $kelas;
            });

        // Presensi terbaru
        $recentPresensi = Presensi::with(['siswa', 'siswa.kelas', 'user'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('waktu_masuk', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', [
            'totalSiswa' => $totalSiswa,
            'totalHadir' => $totalHadir,
            'totalIzin' => $totalIzin,
            'totalSakit' => $totalSakit,
            'totalAlpha' => $totalAlpha,
            'kelasList' => $kelasList,
            'jurusanList' => $jurusanList,
            'kelasTerendah' => $kelasTerendah,
            'recentPresensi' => $recentPresensi,
            'tanggal' => $today
        ]);
    }

    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format' => 'required|in:excel,pdf'
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $format = $request->format;

        // Query data presensi berdasarkan range tanggal
        $presensi = Presensi::with(['siswa', 'siswa.kelas', 'user'])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->orderBy('waktu_masuk', 'desc')
            ->get();

        if ($format === 'excel') {
            return $this->exportExcel($presensi, $startDate, $endDate);
        } else {
            return $this->exportPDF($presensi, $startDate, $endDate);
        }
    }

    private function exportExcel($data, $startDate, $endDate)
    {
        $fileName = 'presensi_' . $startDate . '_' . $endDate . '.xlsx';

        // Header untuk Excel
        $headers = [
            "NIS",
            "NISN",
            "Nama Siswa",
            "Kelas",
            "Tanggal",
            "Waktu Masuk",
            "Waktu Keluar",
            "Status",
            "Keterangan",
            "Diinput Oleh"
        ];

        // Data untuk Excel
        $exportData = [];
        foreach ($data as $item) {
            $exportData[] = [
                $item->siswa->nis,
                $item->siswa->nisn,
                $item->siswa->nama,
                $item->siswa->kelas->tingkat_kelas . ' ' .
                    $item->siswa->kelas->jurusan . ' ' .
                    $item->siswa->kelas->rombel,
                $item->tanggal,
                $item->waktu_masuk,
                $item->waktu_keluar,
                ucfirst($item->status),
                $item->keterangan ?? '-',
                $item->user->name ?? '-'
            ];
        }

        // Untuk implementasi nyata, gunakan package seperti Maatwebsite/Laravel-Excel
        // Ini hanya contoh sederhana
        return response()->streamDownload(function () use ($headers, $exportData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headers);

            foreach ($exportData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, $fileName);
    }

    private function exportPDF($data, $startDate, $endDate)
    {
        $fileName = 'presensi_' . $startDate . '_' . $endDate . '.pdf';

        $html = view('exports.presensi_pdf', [
            'presensi' => $data,
            'startDate' => $startDate,
            'endDate' => $endDate
        ])->render();

        // Untuk implementasi nyata, gunakan package seperti barryvdh/laravel-dompdf
        // return PDF::loadHTML($html)->download($fileName);

        return response($html)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}
