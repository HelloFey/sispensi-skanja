@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 md:p-6">
        <!-- Filter Section - Responsive -->
        <div class="bg-white neobrutal-card p-4 md:p-6 mb-4 md:mb-6">
            <form method="GET" action="{{ route('pelanggaran.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3 md:gap-4">
                    <!-- Date Filter -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $tanggal }}"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-xs md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                    </div>

                    <!-- Class Filter -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-1">Kelas</label>
                        <select name="kelas"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-xs md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Kelas</option>
                            @foreach ($kelasList as $kelas)
                                <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                                    Kelas {{ $kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Major Filter -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-1">Jurusan</label>
                        <select name="jurusan"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-xs md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Jurusan</option>
                            @foreach ($jurusanList as $jurusan)
                                <option value="{{ $jurusan }}" {{ request('jurusan') == $jurusan ? 'selected' : '' }}>
                                    {{ $jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-1">Kategori</label>
                        <select name="kategori"
                            class="w-full px-3 py-1 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-xs md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Kategori</option>
                            <option value="ringan" {{ request('kategori') == 'ringan' ? 'selected' : '' }}>Ringan</option>
                            <option value="sedang" {{ request('kategori') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="berat" {{ request('kategori') == 'berat' ? 'selected' : '' }}>Berat</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-end gap-3 mt-4">
                    <div class="flex gap-2 md:gap-3 w-full md:w-auto">
                        <button type="submit"
                            class="neobrutal-btn bg-sekolah text-white px-4 py-1.5 md:px-6 md:py-2 font-bold text-xs md:text-sm w-1/2 md:w-auto flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('pelanggaran.index') }}"
                            class="neobrutal-btn bg-gray-200 text-black px-4 py-1.5 md:px-4 md:py-2 font-bold text-xs md:text-sm w-1/2 md:w-auto flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset
                        </a>
                    </div>
                    <a href="{{ route('pelanggaran.create') }}"
                        class="neobrutal-btn bg-green-600 text-white px-4 py-1.5 md:px-4 md:py-2 font-bold text-xs md:text-sm mt-2 md:mt-0 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah
                    </a>
                </div>
            </form>
        </div>

        <!-- Stats Cards - Responsive -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 mb-4 md:mb-6">
            <!-- Daily Stats -->
            <div class="bg-white neobrutal-card p-3 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs md:text-sm font-bold text-gray-600">PELANGGARAN HARI INI</p>
                        <p class="text-xl md:text-2xl font-extrabold text-blue-600">{{ $dailyStats['total'] }}</p>
                    </div>
                    <div class="bg-blue-100 p-1 md:p-2 rounded-md border-2 md:border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white neobrutal-card p-3 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs md:text-sm font-bold text-gray-600">TOTAL POIN HARI INI</p>
                        <p class="text-xl md:text-2xl font-extrabold text-purple-600">{{ $dailyStats['total_poin'] }}</p>
                    </div>
                    <div class="bg-purple-100 p-1 md:p-2 rounded-md border-2 md:border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Global Stats -->
            <div class="bg-white neobrutal-card p-3 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs md:text-sm font-bold text-gray-600">TOTAL PELANGGARAN</p>
                        <p class="text-xl md:text-2xl font-extrabold text-red-600">{{ $globalStats['total_pelanggaran'] }}</p>
                    </div>
                    <div class="bg-red-100 p-1 md:p-2 rounded-md border-2 md:border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white neobrutal-card p-3 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs md:text-sm font-bold text-gray-600">RATA-RATA POIN</p>
                        <p class="text-xl md:text-2xl font-extrabold text-yellow-600">{{ $globalStats['rata_poin'] }}</p>
                    </div>
                    <div class="bg-yellow-100 p-1 md:p-2 rounded-md border-2 md:border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6 text-yellow-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Violations Table - Responsive -->
        <div class="bg-white neobrutal-card p-4 md:p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b-2 md:border-b-3 border-black">
                            <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">NO</th>
                            <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">SISWA</th>
                            <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm hidden md:table-cell">KELAS</th>
                            <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">PELANGGARAN</th>
                            <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">TANGGAL</th>
                            <th class="text-left py-2 md:py-4 px-2 md:px-4 font-extrabold text-xs md:text-sm">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggarans as $pelanggaran)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                    {{ $loop->iteration + ($pelanggarans->currentPage() - 1) * $pelanggarans->perPage() }}
                                </td>
                                <td class="py-3 md:py-4 px-2 md:px-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-6 h-6 md:w-8 md:h-8 bg-blue-100 rounded-full border-2 border-black mr-2 md:mr-3 flex items-center justify-center font-bold text-xs">
                                            {{ substr($pelanggaran->siswa->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="font-bold block text-xs md:text-sm">{{ $pelanggaran->siswa->nama }}</span>
                                            <span class="text-xs text-gray-600 block">NIS:
                                                {{ $pelanggaran->siswa->nis }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm hidden md:table-cell">
                                    {{ $pelanggaran->siswa->kelas->tingkat_kelas }}
                                    {{ $pelanggaran->siswa->kelas->jurusan }}
                                    {{ $pelanggaran->siswa->kelas->rombel }}
                                </td>
                                <td class="py-3 md:py-4 px-2 md:px-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-xs md:text-sm">{{ $pelanggaran->nama_pelanggaran }}</span>
                                        <span
                                            class="inline-block mt-1 @if ($pelanggaran->kategori == 'ringan') bg-blue-100 text-blue-800 border-blue-800
                                        @elseif($pelanggaran->kategori == 'sedang') bg-yellow-100 text-yellow-800 border-yellow-800
                                        @else bg-red-100 text-red-800 border-red-800 @endif text-xs font-bold px-2 py-0.5 md:py-1 rounded border-2 w-fit">
                                            {{ $pelanggaran->kategori }} ({{ $pelanggaran->poin }} Poin)
                                        </span>
                                    </div>
                                </td>
                                <td class="py-3 md:py-4 px-2 md:px-4 font-bold text-xs md:text-sm">
                                    {{ $pelanggaran->tanggal->format('d/m/Y') }}
                                    @if ($pelanggaran->waktu)
                                        <span class="text-xs text-gray-600 block">{{ $pelanggaran->waktu }}</span>
                                    @endif
                                </td>
                                <td class="py-3 md:py-4 px-2 md:px-4">
                                    <div class="flex space-x-1 md:space-x-2">
                                        <a href="{{ route('pelanggaran.show', [$pelanggaran->id]) }}"
                                                class="p-1 border border-black md:border-2 rounded-md bg-blue-100 text-blue-800 hover:bg-blue-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        <a href="{{ route('pelanggaran.edit', $pelanggaran->id) }}"
                                            class="p-1 border border-black md:border-2 rounded-md bg-yellow-100 text-yellow-800 hover:bg-yellow-200"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 text-yellow-800"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('pelanggaran.destroy', $pelanggaran->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggaran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1 border border-black md:border-2 rounded-md bg-red-100 text-red-800 hover:bg-red-200"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 text-red-800"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center text-gray-500 text-xs md:text-sm">Tidak ada data pelanggaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination - Responsive -->
            <div class="flex flex-col sm:flex-row justify-between items-center mt-4 md:mt-6 pt-3 md:pt-4 border-t-2 md:border-t-3 border-black">
                <div class="text-xs md:text-sm font-bold text-gray-600 mb-3 sm:mb-0">
                    Menampilkan {{ $pelanggarans->firstItem() }} hingga {{ $pelanggarans->lastItem() }} dari
                    {{ $pelanggarans->total() }} entri
                </div>
                <div class="flex space-x-1">
                    @if ($pelanggarans->onFirstPage())
                        <span
                            class="w-6 h-6 md:w-8 md:h-8 bg-gray-100 rounded border-2 border-black flex items-center justify-center opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $pelanggarans->previousPageUrl() }}"
                            class="w-6 h-6 md:w-8 md:h-8 bg-gray-100 rounded border-2 border-black flex items-center justify-center hover:bg-gray-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    @endif

                    @foreach (range(1, $pelanggarans->lastPage()) as $i)
                        @if ($i == $pelanggarans->currentPage())
                            <span
                                class="w-6 h-6 md:w-8 md:h-8 bg-sekolah text-white rounded border-2 border-black font-bold flex items-center justify-center text-xs md:text-sm">{{ $i }}</span>
                        @else
                            <a href="{{ $pelanggarans->url($i) }}"
                                class="w-6 h-6 md:w-8 md:h-8 bg-gray-100 rounded border-2 border-black font-bold flex items-center justify-center hover:bg-gray-200 transition text-xs md:text-sm">{{ $i }}</a>
                        @endif
                    @endforeach

                    @if ($pelanggarans->hasMorePages())
                        <a href="{{ $pelanggarans->nextPageUrl() }}"
                            class="w-6 h-6 md:w-8 md:h-8 bg-gray-100 rounded border-2 border-black flex items-center justify-center hover:bg-gray-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <span
                            class="w-6 h-6 md:w-8 md:h-8 bg-gray-100 rounded border-2 border-black flex items-center justify-center opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Top Students Section - Responsive -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 mt-4 md:mt-6">
            <!-- Top Students by Points -->
            <div class="bg-white neobrutal-card p-4 md:p-6">
                <h3 class="font-extrabold text-base md:text-lg mb-3 md:mb-4">SISWA DENGAN POIN TERTINGGI</h3>
                <div class="space-y-2 md:space-y-3">
                    @forelse($globalStats['top_siswa_poin'] as $index => $siswa)
                        <div
                            class="flex items-center p-2 md:p-3 @switch($index)
                        @case(0) bg-red-50 @break
                        @case(1) bg-yellow-50 @break
                        @case(2) bg-blue-50 @break
                        @default bg-gray-50 @endswitch border-2 border-black">
                            <div
                                class="w-6 h-6 md:w-8 md:h-8 @switch($index)
                            @case(0) bg-red-100 @break
                            @case(1) bg-yellow-100 @break
                            @case(2) bg-blue-100 @break
                            @default bg-gray-100 @endswitch rounded-full border-2 md:border-3 border-black mr-2 md:mr-3 flex items-center justify-center font-bold text-xs md:text-sm">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-extrabold truncate text-xs md:text-sm">{{ $siswa->nama }}</p>
                                <p class="text-xs font-bold text-gray-600 truncate">
                                    {{ $siswa->tingkat_kelas }} {{ $siswa->jurusan }} {{ $siswa->rombel }} •
                                    {{ $siswa->total_poin }} Poin
                                </p>
                            </div>
                            @if ($index == 0)
                                <span
                                    class="bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 md:px-2 md:py-1 rounded-full border-2 border-black">!</span>
                            @endif
                        </div>
                    @empty
                        <p class="text-center text-gray-500 text-xs md:text-sm">Tidak ada data siswa</p>
                    @endforelse
                </div>
            </div>

            <!-- Most Frequent Violations -->
            <div class="bg-white neobrutal-card p-4 md:p-6">
                <h3 class="font-extrabold text-base md:text-lg mb-3 md:mb-4">PELANGGARAN TERBANYAK</h3>
                <div class="space-y-2 md:space-y-3">
                    @forelse($globalStats['pelanggaran_terbanyak'] as $index => $item)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="font-bold text-xs md:text-sm">{{ $item->nama_pelanggaran }}</span>
                                <span class="font-extrabold text-xs md:text-sm">{{ $item->total }} kasus</span>
                            </div>
                            <div class="w-full bg-gray-200 h-3 md:h-4 border-2 border-black">
                                <div class="h-full @switch($index)
                                @case(0) bg-blue-500 @break
                                @case(1) bg-yellow-500 @break
                                @case(2) bg-red-500 @break
                                @default bg-purple-500 @endswitch"
                                    style="width: {{ ($item->total / ($globalStats['pelanggaran_terbanyak']->first()->total ?: 1)) * 100 }}%">
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 text-xs md:text-sm">Tidak ada data pelanggaran</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        // Auto submit form when filter changes
        document.querySelectorAll('select[name="kelas"], select[name="jurusan"], select[name="kategori"]').forEach(
        select => {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        });
    </script>
@endpush