@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 md:p-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Stats Cards - Responsive -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 mb-4 md:mb-6">
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">TOTAL SISWA</p>
                <p class="text-xl md:text-3xl font-extrabold text-blue-600">{{ $totalSiswa }}</p>
            </div>
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">HADIR</p>
                <p class="text-xl md:text-3xl font-extrabold text-green-600">{{ $totalHadir }}</p>
            </div>
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">IZIN</p>
                <p class="text-xl md:text-3xl font-extrabold text-yellow-600">{{ $totalIzin }}</p>
            </div>
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">ALPA</p>
                <p class="text-xl md:text-3xl font-extrabold text-red-600">{{ $totalAlpha }}</p>
            </div>
        </div>

        <!-- Filter Section - Responsive -->
        <div class="bg-white neobrutal-card p-4 md:p-6 mb-4 md:mb-6">
            <form method="GET" action="{{ route('presensi.index') }}">
                <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4">
                    <!-- Date Filter -->
                    <div class="flex-1">
                        <input type="date" name="tanggal" value="{{ $tanggal }}"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                    </div>

                    <!-- Kelas Filter -->
                    <div class="flex-1">
                        <select name="kelas"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelasList as $kelas)
                                <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                                    Kelas {{ $kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jurusan Filter -->
                    <div class="flex-1 hidden md:block">
                        <select name="jurusan"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($jurusanList as $jurusan)
                                <option value="{{ $jurusan }}"
                                    {{ request('jurusan') == $jurusan ? 'selected' : '' }}>
                                    {{ $jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="flex-1 hidden md:block">
                        <select name="status"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Status</option>
                            @foreach (App\Models\Presensi::$statuses as $key => $status)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="md:hidden">
                        <button type="submit"
                            class="neobrutal-btn bg-sekolah text-white px-4 py-2 font-bold border-2 md:border-3 border-black w-full text-sm">
                            Filter
                        </button>
                    </div>
                </div>

                <!-- Additional filters for mobile -->
                <div class="grid grid-cols-2 gap-3 mt-3 md:hidden">
                    <div>
                        <select name="jurusan"
                            class="w-full px-3 py-1 border-2 border-black rounded-md font-bold text-sm focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($jurusanList as $jurusan)
                                <option value="{{ $jurusan }}"
                                    {{ request('jurusan') == $jurusan ? 'selected' : '' }}>
                                    {{ $jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="status"
                            class="w-full px-3 py-1 border-2 border-black rounded-md font-bold text-sm focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Status</option>
                            @foreach (App\Models\Presensi::$statuses as $key => $status)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Search Button for desktop -->
                <div class="hidden md:block md:ml-2">
                    <button type="submit"
                        class="neobrutal-btn bg-sekolah text-white px-4 md:px-6 py-2 font-bold border-2 md:border-3 border-black w-full md:w-auto">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Attendance Table - Responsive -->
        <div class="bg-white neobrutal-card p-4 md:p-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 md:mb-6 gap-3">
                <h3 class="font-extrabold text-base md:text-lg">REKAP PRESENSI</h3>
                <div class="flex flex-wrap gap-2 md:gap-3">
                    <button onclick="openExportModal()"
                        class="neobrutal-btn bg-gray-200 px-3 py-1 md:px-4 md:py-1.5 text-xs md:text-sm font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 inline mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Ekspor
                    </button>
                    <a href="{{ route('presensi.create') }}"
                        class="neobrutal-btn bg-sekolah text-white px-3 py-1 md:px-4 md:py-1.5 text-xs md:text-sm font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 inline mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Input Manual
                    </a>
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
                            <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">WAKTU</th>
                            <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">STATUS</th>
                            <th
                                class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm hidden md:table-cell">
                                KETERANGAN</th>
                            <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensi as $key => $p)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">{{ $key + 1 }}</td>
                                <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">{{ $p->siswa->nis }}
                                </td>
                                <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">{{ $p->siswa->nama }}
                                </td>
                                <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm hidden md:table-cell">
                                    {{ $p->siswa->kelas->tingkat_kelas }} {{ $p->siswa->kelas->jurusan }}
                                    {{ $p->siswa->kelas->rombel }}
                                </td>
                                <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                    @if ($p->waktu_masuk)
                                        {{ $p->waktu_masuk }}
                                    @else
                                        -
                                    @endif
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
                                <td class="py-3 md:py-4 px-2 md:px-4">
                                    <div class="flex gap-1 md:gap-2">
                                        <a href="{{ route('presensi.edit', $p->id) }}"
                                            class="p-1 border border-black md:border-2 rounded-md bg-blue-100 text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
                        {{ $presensi->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Export Modal -->
    <div id="exportModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-4 md:p-6 neobrutal-card w-full max-w-md mx-4">
            <h3 class="font-extrabold text-base md:text-lg mb-3 md:mb-4">EKSPOR DATA PRESENSI</h3>
            <form method="POST" action="{{ route('presensi.export') }}">
                @csrf
                <div class="mb-3 md:mb-4">
                    <label class="block font-bold mb-1 md:mb-2 text-sm md:text-base">Dari Tanggal</label>
                    <input type="date" name="start_date"
                        class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base">
                </div>
                <div class="mb-3 md:mb-4">
                    <label class="block font-bold mb-1 md:mb-2 text-sm md:text-base">Sampai Tanggal</label>
                    <input type="date" name="end_date"
                        class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base">
                </div>
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
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        }
    </script>
@endsection
