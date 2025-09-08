@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 md:p-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Filter Section - Responsive -->
        <div class="bg-white neobrutal-card p-4 md:p-6 mb-4 md:mb-6">
            <form method="GET" action="{{ route('presensi.rekap') }}">
                <div class="flex flex-col md:flex-row md:items-end gap-3 md:gap-4">
                    <!-- Semester Filter -->
                    <div class="flex-1">
                        <label class="block font-bold mb-1 md:mb-2 text-xs md:text-sm">Semester</label>
                        <select name="semester"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-xs md:text-sm focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="ganjil" {{ $semester == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="genap" {{ $semester == 'genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>

                    <!-- Tahun Ajaran Filter -->
                    <div class="flex-1">
                        <label class="block font-bold mb-1 md:mb-2 text-xs md:text-sm">Tahun Ajaran</label>
                        <select name="tahun_ajaran"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-xs md:text-sm focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Tahun Ajaran</option>
                            @foreach ($tahunAjarList as $tahunAjar)
                                <option value="{{ $tahunAjar }}" {{ $tahunAjaran == $tahunAjar ? 'selected' : '' }}>
                                    {{ $tahunAjar }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kelas Filter -->
                    <div class="flex-1">
                        <label class="block font-bold mb-1 md:mb-2 text-xs md:text-sm">Kelas</label>
                        <select name="kelas"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-xs md:text-sm focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Kelas</option>
                            @foreach ($kelasList as $kelas)
                                <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                                    Kelas {{ $kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jurusan Filter -->
                    <div class="flex-1">
                        <label class="block font-bold mb-1 md:mb-2 text-xs md:text-sm">Jurusan</label>
                        <select name="jurusan"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-xs md:text-sm focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Jurusan</option>
                            @foreach ($jurusanList as $jurusan)
                                <option value="{{ $jurusan }}"
                                    {{ request('jurusan') == $jurusan ? 'selected' : '' }}>
                                    {{ $jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div>
                        <button type="submit"
                            class="neobrutal-btn bg-sekolah text-white px-4 md:px-6 py-2 font-bold border-2 md:border-3 border-black w-full text-xs md:text-sm">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Stats Cards - Responsive -->
        <div class="grid grid-cols-2 md:grid-cols-6 gap-3 md:gap-6 mb-4 md:mb-6">
            <!-- Total Siswa Card -->
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">TOTAL SISWA</p>
                <p class="text-xl md:text-3xl font-extrabold text-blue-600">{{ $totalSiswa }}</p>
            </div>

            <!-- Hadir Card -->
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">HADIR</p>
                <p class="text-xl md:text-3xl font-extrabold text-green-600">{{ $totalHadir }}</p>
                <p class="text-xs md:text-sm font-bold text-gray-600">
                    @if ($totalSiswa > 0)
                        {{ round(($totalHadir / $totalSiswa) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </p>
            </div>

            <!-- Izin/Sakit Card -->
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">IZIN/SAKIT</p>
                <p class="text-xl md:text-3xl font-extrabold text-yellow-600">{{ $totalIzin }}</p>
                <p class="text-xs md:text-sm font-bold text-gray-600">
                    @if ($totalSiswa > 0)
                        {{ round(($totalIzin / $totalSiswa) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </p>
            </div>

            <!-- Alpha Card -->
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">TANPA KETERANGAN</p>
                <p class="text-xl md:text-3xl font-extrabold text-red-600">{{ $totalAlpha }}</p>
                <p class="text-xs md:text-sm font-bold text-gray-600">
                    @if ($totalSiswa > 0)
                        {{ round(($totalAlpha / $totalSiswa) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </p>
            </div>

            <!-- Siswa Masuk Card -->
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">SISWA MASUK</p>
                <p class="text-xl md:text-3xl font-extrabold text-purple-600">{{ $siswaMasuk }}</p>
            </div>

            <!-- Siswa Keluar Card -->
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">SISWA KELUAR</p>
                <p class="text-xl md:text-3xl font-extrabold text-orange-600">{{ $siswaKeluar }}</p>
            </div>
        </div>

        <!-- Tabs untuk Mutasi dan Presensi -->
        <div class="bg-white neobrutal-card p-4 md:p-6 mb-4 md:mb-6">
            <div class="flex border-b-2 border-black mb-4">
                <button id="tabPresensi"
                    class="tab-button active py-2 px-4 font-bold text-sm md:text-base border-b-4 border-sekolah">
                    DATA PRESENSI
                </button>
                <button id="tabMutasi" class="tab-button py-2 px-4 font-bold text-sm md:text-base">
                    DATA MUTASI
                </button>
            </div>

            <!-- Content Presensi -->
            <div id="contentPresensi" class="tab-content">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 md:mb-6 gap-3">
                    <h3 class="font-extrabold text-base md:text-lg">DETAIL PRESENSI</h3>
                    <div class="flex justify-end">
                        <button onclick="openExportModal()"
                            class="neobrutal-btn bg-gray-200 px-3 py-1 md:px-4 md:py-1.5 text-xs md:text-sm font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 inline mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Ekspor
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b-2 md:border-b-3 border-black">
                                <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">NO</th>
                                <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">NIS</th>
                                <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">NAMA</th>
                                <th
                                    class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm hidden md:table-cell">
                                    KELAS</th>
                                <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">TANGGAL
                                </th>
                                <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">STATUS
                                </th>
                                <th
                                    class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm hidden md:table-cell">
                                    KETERANGAN</th>
                                <th
                                    class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm hidden md:table-cell">
                                    OLEH</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($presensi as $key => $p)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                        {{ $presensi->firstItem() + $key }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">{{ $p->siswa->nis }}
                                    </td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                        {{ $p->siswa->nama }}
                                    </td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm hidden md:table-cell">
                                        {{ $p->siswa->kelas->tingkat_kelas }} {{ $p->siswa->kelas->jurusan }}
                                        {{ $p->siswa->kelas->rombel }}
                                    </td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">{{ $p->tanggal }}
                                    </td>
                                    <td class="py-3 md:py-4 px-2 md:px-4">
                                        @php
                                            $statusColors = [
                                                'hadir' => 'bg-green-100 text-green-800',
                                                'izin' => 'bg-yellow-100 text-yellow-800',
                                                'sakit' => 'bg-blue-100 text-blue-800',
                                                'alpha' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span
                                            class="px-2 py-0.5 md:px-4 md:py-1 rounded-full border border-black md:border-2 font-bold text-xs md:text-sm {{ $statusColors[$p->status] }}">
                                            {{ strtoupper($p->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm hidden md:table-cell">
                                        {{ $p->keterangan ?? '-' }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm hidden md:table-cell">
                                        {{ $p->user->nama ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-4 px-4 text-center font-bold text-sm md:text-base">Tidak
                                        ada
                                        data presensi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination - Responsive -->
                <div class="mt-3 md:mt-4">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-2">
                        <div class="text-xs md:text-sm text-gray-600">
                            Menampilkan {{ $presensi->firstItem() }} sampai {{ $presensi->lastItem() }} dari
                            {{ $presensi->total() }} entri
                        </div>
                        <div class="flex flex-wrap justify-center md:justify-end gap-1">
                            {{ $presensi->withQueryString()->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Mutasi -->
            <div id="contentMutasi" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <!-- Mutasi Masuk -->
                    <div>
                        <h3 class="font-extrabold text-base md:text-lg mb-3 md:mb-4 text-purple-600">SISWA MASUK
                            ({{ $siswaMasuk }})</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b-2 md:border-b-3 border-black">
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            NO</th>
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            NIS</th>
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            NAMA</th>
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            KELAS</th>
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            TANGGAL MASUK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($mutasiMasuk as $key => $siswa)
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                {{ $key + 1 }}</td>
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                {{ $siswa->nis }}</td>
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                {{ $siswa->nama }}</td>
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                {{ $siswa->kelas->tingkat_kelas }} {{ $siswa->kelas->jurusan }}
                                                {{ $siswa->kelas->rombel }}
                                            </td>
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                {{ $siswa->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"
                                                class="py-4 px-4 text-center font-bold text-sm md:text-base">Tidak ada data
                                                siswa masuk</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Mutasi Keluar -->
                    <div>
                        <h3 class="font-extrabold text-base md:text-lg mb-3 md:mb-4 text-orange-600">SISWA KELUAR
                            ({{ $siswaKeluar }})</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b-2 md:border-b-3 border-black">
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            NO</th>
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            NIS</th>
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            NAMA</th>
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            KELAS</th>
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            STATUS</th>
                                        <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">
                                            TANGGAL KELUAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($mutasiKeluar as $key => $siswa)
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                {{ $key + 1 }}</td>
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                {{ $siswa->nis }}</td>
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                {{ $siswa->nama }}</td>
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                {{ $siswa->kelas->tingkat_kelas }} {{ $siswa->kelas->jurusan }}
                                                {{ $siswa->kelas->rombel }}
                                            </td>
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                <span
                                                    class="px-2 py-0.5 md:px-4 md:py-1 rounded-full border border-black md:border-2 font-bold text-xs md:text-sm bg-red-100 text-red-800">
                                                    {{ strtoupper($siswa->status) }}
                                                </span>
                                            </td>
                                            <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                                {{ $siswa->updated_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6"
                                                class="py-4 px-4 text-center font-bold text-sm md:text-base">Tidak ada data
                                                siswa keluar</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Export Modal -->
    <div id="exportModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-4 md:p-6 neobrutal-card w-full max-w-md mx-4">
            {{-- <h3 class="font-extrabold text-base md:text-lg mb-3 md:mb-4">EKSPOR DATA PRESENSI</h3> --}}
            <form method="POST" action="{{ route('presensi.export') }}">
                @csrf
                <input type="hidden" name="semester" value="{{ $semester }}">
                <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
                <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
                <input type="hidden" name="angkatan" value="{{ request('angkatan') }}">

                <div class="mb-3 md:mb-4">
                    <label class="block font-bold mb-1 md:mb-2 text-sm md:text-base">Format</label>
                    <select name="format"
                        class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base">
                        <option value="excel">Excel</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2 md:space-x-3">
                    <button type="button" onclick="closeExportModal()"
                        class="neobrutal-btn bg-gray-200 px-3 py-1 md:px-4 md:py-1.5 text-xs md:text-sm font-bold">
                        BATAL
                    </button>
                    <button type="submit"
                        class="neobrutal-btn bg-sekolah text-white px-3 py-1 md:px-4 md:py-1.5 text-xs md:text-sm font-bold">
                        EKSPOR
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabPresensi = document.getElementById('tabPresensi');
            const tabMutasi = document.getElementById('tabMutasi');
            const contentPresensi = document.getElementById('contentPresensi');
            const contentMutasi = document.getElementById('contentMutasi');

            tabPresensi.addEventListener('click', function() {
                tabPresensi.classList.add('active', 'border-b-4', 'border-sekolah');
                tabMutasi.classList.remove('active', 'border-b-4', 'border-sekolah');
                contentPresensi.classList.remove('hidden');
                contentMutasi.classList.add('hidden');
            });

            tabMutasi.addEventListener('click', function() {
                tabMutasi.classList.add('active', 'border-b-4', 'border-sekolah');
                tabPresensi.classList.remove('active', 'border-b-4', 'border-sekolah');
                contentMutasi.classList.remove('hidden');
                contentPresensi.classList.add('hidden');
            });
        });
    </script>

    <style>
        .tab-button {
            transition: all 0.3s ease;
        }

        .tab-button.active {
            color: #3B82F6;
            border-bottom-color: #3B82F6;
        }

        .tab-content {
            transition: all 0.3s ease;
        }
    </style>
@endsection
