@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 md:p-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Stats Cards - Improved Responsive Layout -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-4 md:mb-6">
            <!-- Total Siswa Card -->
            <div class="bg-white p-3 md:p-4 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm font-bold">TOTAL SISWA</p>
                        <h3 class="text-xl md:text-2xl font-extrabold mt-1 text-blue-600">{{ $totalSiswa }}</h3>
                        <p class="text-gray-500 text-xs mt-1">{{ count($kelasList) }} Kelas</p>
                    </div>
                    <div class="bg-blue-100 p-1 md:p-2 rounded-md border-2 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-6 w-5 md:w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Presensi Hari Ini Card -->
            <div class="bg-white p-3 md:p-4 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm font-bold">PRESENSI HARI INI</p>
                        <h3 class="text-xl md:text-2xl font-extrabold mt-1 text-green-600">
                            @if ($totalSiswa > 0)
                                {{ round(($totalHadir / $totalSiswa) * 100, 1) }}%
                            @else
                                0%
                            @endif
                        </h3>
                        <p class="text-gray-500 text-xs mt-1">{{ $totalHadir }} dari
                            {{ $totalSiswa }}</p>
                    </div>
                    <div class="bg-green-100 p-1 md:p-2 rounded-md border-2 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-6 w-5 md:w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Izin/Sakit Card -->
            <div class="bg-white p-3 md:p-4 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm font-bold">IZIN/SAKIT</p>
                        <h3 class="text-xl md:text-2xl font-extrabold mt-1 text-yellow-600">{{ $totalIzin }}
                        </h3>
                        <p class="text-gray-500 text-xs mt-1">
                            @if ($totalSiswa > 0)
                                {{ round(($totalIzin / $totalSiswa) * 100, 1) }}% dari total
                            @else
                                0%
                            @endif
                        </p>
                    </div>
                    <div class="bg-yellow-100 p-1 md:p-2 rounded-md border-2 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-6 w-5 md:w-6 text-yellow-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Alpha Card -->
            <div class="bg-white p-3 md:p-4 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm font-bold">TANPA KETERANGAN</p>
                        <h3 class="text-xl md:text-2xl font-extrabold mt-1 text-red-600">{{ $totalAlpha }}</h3>
                        <p class="text-gray-500 text-xs mt-1">
                            @if ($totalSiswa > 0)
                                {{ round(($totalAlpha / $totalSiswa) * 100, 1) }}% dari total
                            @else
                                0%
                            @endif
                        </p>
                    </div>
                    <div class="bg-red-100 p-1 md:p-2 rounded-md border-2 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-6 w-5 md:w-6 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Presensi Section - Responsive Adjustments -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 md:gap-4 mb-4 md:mb-6">
            <div class="bg-white p-3 md:p-4 neobrutal-card lg:col-span-2">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 md:mb-4 gap-2">
                    <h3 class="font-extrabold text-sm md:text-base">STATUS PRESENSI HARI INI</h3>
                    <a href="{{ route('presensi.index') }}"
                        class="neobrutal-btn bg-sekolah text-white px-2 py-1 md:px-3 md:py-1 text-xs md:text-sm font-bold">
                        LIHAT DETAIL
                    </a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
                    <div class="bg-green-100 p-2 text-center border-2 border-black">
                        <p class="text-lg md:text-xl font-extrabold text-green-800">{{ $totalHadir }}</p>
                        <p class="text-xs font-bold">HADIR</p>
                    </div>
                    <div class="bg-yellow-100 p-2 text-center border-2 border-black">
                        <p class="text-lg md:text-xl font-extrabold text-yellow-800">{{ $totalIzin }}</p>
                        <p class="text-xs font-bold">IZIN</p>
                    </div>
                    <div class="bg-blue-100 p-2 text-center border-2 border-black">
                        <p class="text-lg md:text-xl font-extrabold text-blue-800">0</p>
                        <p class="text-xs font-bold">SAKIT</p>
                    </div>
                    <div class="bg-red-100 p-2 text-center border-2 border-black">
                        <p class="text-lg md:text-xl font-extrabold text-red-800">{{ $totalAlpha }}</p>
                        <p class="text-xs font-bold">ALPA</p>
                    </div>
                </div>
                <div class="h-32 md:h-48 bg-gray-100 border-2 border-black flex items-center justify-center">
                    <!-- Chart placeholder -->
                    <p class="text-gray-500 font-bold text-xs md:text-sm">GRAFIK PRESENSI PER KELAS</p>
                </div>
            </div>

            <div class="bg-white p-3 md:p-4 neobrutal-card">
                <h3 class="font-extrabold text-sm md:text-base mb-3 md:mb-4">KELAS DENGAN ABSENSI TERENDAH</h3>
                <div class="space-y-2 md:space-y-3">
                    @foreach ($kelasTerendah as $index => $kelas)
                        <div
                            class="flex items-center p-2 {{ $index % 2 == 0 ? 'bg-red-50' : 'bg-yellow-50' }} border-2 border-black">
                            <div
                                class="w-6 h-6 md:w-8 md:h-8 {{ $index % 2 == 0 ? 'bg-red-100' : 'bg-yellow-100' }} rounded-md border-2 border-black mr-2 flex items-center justify-center font-bold text-xs {{ $index % 2 == 0 ? 'text-red-800' : 'text-yellow-800' }}">
                                {{ substr($kelas->nama_kelas, 0, 2) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-extrabold text-xs md:text-sm truncate">{{ $kelas->nama_kelas }}</p>
                                <p class="text-xs font-bold text-gray-600 truncate">{{ $kelas->persen_absen }}%
                                    tidak hadir
                                    ({{ $kelas->total_absen }} siswa)
                                </p>
                            </div>
                            <span
                                class="{{ $index % 2 == 0 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }} text-xs font-bold px-1 py-0.5 rounded border border-black">!</span>
                        </div>
                    @endforeach

                    <div class="text-center mt-2">
                        <a href="{{ route('presensi.rekap') }}"
                            class="neobrutal-btn bg-sekolah text-white px-2 py-1 md:px-3 md:py-1 text-xs md:text-sm font-bold">
                            LIHAT SEMUA KELAS
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Presensi - Responsive Table -->
        <div class="bg-white p-3 md:p-4 neobrutal-card">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 md:mb-4 gap-2">
                <h3 class="font-extrabold text-sm md:text-base">REKAP PRESENSI TERBARU</h3>
                <button onclick="openExportModal()"
                    class="neobrutal-btn bg-sekolah text-white px-2 py-1 md:px-3 md:py-1 text-xs md:text-sm font-bold">
                    EKSPOR DATA
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b-2 border-black">
                            <th class="text-left py-2 px-2 font-extrabold text-xs md:text-sm">NAMA SISWA
                            </th>
                            <th class="text-left py-2 px-2 font-extrabold text-xs md:text-sm hidden sm:table-cell">KELAS
                            </th>
                            <th class="text-left py-2 px-2 font-extrabold text-xs md:text-sm">TANGGAL</th>
                            <th class="text-left py-2 px-2 font-extrabold text-xs md:text-sm">JAM</th>
                            <th class="text-left py-2 px-2 font-extrabold text-xs md:text-sm">STATUS</th>
                            <th class="text-left py-2 px-2 font-extrabold text-xs md:text-sm hidden md:table-cell">
                                KETERANGAN
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPresensi as $presensi)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 px-2 font-bold text-xs md:text-sm">
                                    {{ $presensi->siswa->nama }}</td>
                                <td class="py-2 px-2 font-bold text-xs md:text-sm hidden sm:table-cell">
                                    {{ $presensi->siswa->kelas->tingkat_kelas }} {{ $presensi->siswa->kelas->jurusan }}
                                    {{ $presensi->siswa->kelas->rombel }}
                                </td>
                                <td class="py-2 px-2 font-bold text-xs md:text-sm">
                                    {{ $presensi->tanggal }}</td>
                                <td class="py-2 px-2 font-bold text-xs md:text-sm">
                                    @if ($presensi->waktu_masuk)
                                        {{ $presensi->waktu_masuk }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-2 px-2">
                                    @php
                                        $statusColors = [
                                            'hadir' => 'bg-green-100 text-green-800',
                                            'izin' => 'bg-yellow-100 text-yellow-800',
                                            'sakit' => 'bg-blue-100 text-blue-800',
                                            'alpha' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span
                                        class="text-xs font-bold px-2 py-0.5 rounded border border-black {{ $statusColors[$presensi->status] }}">
                                        {{ strtoupper($presensi->status) }}
                                    </span>
                                </td>
                                <td class="py-2 px-2 font-bold text-xs md:text-sm hidden md:table-cell">
                                    {{ $presensi->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-3 px-3 text-center font-bold text-xs md:text-sm">Tidak ada
                                    data presensi terbaru
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Export Modal -->
    <div id="exportModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-3 md:p-4 neobrutal-card w-full max-w-md mx-3">
            <h3 class="font-extrabold text-sm md:text-base mb-2 md:mb-3">EKSPOR DATA PRESENSI</h3>
            <form method="POST" action="{{ route('presensi.export') }}">
                @csrf
                <div class="mb-2 md:mb-3">
                    <label class="block font-bold mb-1 text-xs md:text-sm">Dari Tanggal</label>
                    <input type="date" name="start_date"
                        class="w-full px-2 py-1 md:px-3 md:py-1.5 border-2 border-black rounded-md font-bold text-xs md:text-sm">
                </div>
                <div class="mb-2 md:mb-3">
                    <label class="block font-bold mb-1 text-xs md:text-sm">Sampai Tanggal</label>
                    <input type="date" name="end_date"
                        class="w-full px-2 py-1 md:px-3 md:py-1.5 border-2 border-black rounded-md font-bold text-xs md:text-sm">
                </div>
                <div class="mb-2 md:mb-3">
                    <label class="block font-bold mb-1 text-xs md:text-sm">Format</label>
                    <select name="format"
                        class="w-full px-2 py-1 md:px-3 md:py-1.5 border-2 border-black rounded-md font-bold text-xs md:text-sm">
                        <option value="excel">Excel</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeExportModal()"
                        class="neobrutal-btn bg-gray-200 px-2 py-1 md:px-3 md:py-1 text-xs md:text-sm font-bold">
                        BATAL
                    </button>
                    <button type="submit"
                        class="neobrutal-btn bg-sekolah text-white px-2 py-1 md:px-3 md:py-1 text-xs md:text-sm font-bold">
                        EKSPOR
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        }
    </script>
@endsection
