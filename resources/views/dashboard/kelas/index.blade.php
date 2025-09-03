@extends('dashboard.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="p-4 sm:p-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6 mb-6">
            <div class="bg-white p-3 sm:p-4 neobrutal-card text-center">
                <p class="text-xs sm:text-sm font-bold text-gray-600">TOTAL KELAS</p>
                <p class="text-xl sm:text-2xl md:text-3xl font-extrabold text-blue-600">{{ $totalKelas }}</p>
            </div>
            <div class="bg-white p-3 sm:p-4 neobrutal-card text-center">
                <p class="text-xs sm:text-sm font-bold text-gray-600">KELAS X</p>
                <p class="text-xl sm:text-2xl md:text-3xl font-extrabold text-green-600">{{ $kelasX }}</p>
            </div>
            <div class="bg-white p-3 sm:p-4 neobrutal-card text-center">
                <p class="text-xs sm:text-sm font-bold text-gray-600">KELAS XI</p>
                <p class="text-xl sm:text-2xl md:text-3xl font-extrabold text-yellow-600">{{ $kelasXI }}</p>
            </div>
            <div class="bg-white p-3 sm:p-4 neobrutal-card text-center">
                <p class="text-xs sm:text-sm font-bold text-gray-600">KELAS XII</p>
                <p class="text-xl sm:text-2xl md:text-3xl font-extrabold text-red-600">{{ $kelasXII }}</p>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white neobrutal-card p-4 sm:p-6 mb-6">
            <form action="{{ route('kelas.index') }}" method="GET">
                <div class="flex flex-col gap-3 sm:gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari kelas..." value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">
                            <div class="absolute left-3 top-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-gray-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 sm:flex sm:gap-4">
                        <div class="col-span-1">
                            <select name="tingkat" onchange="this.form.submit()"
                                class="w-full px-3 py-2 sm:px-4 sm:py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">
                                <option value="">Semua Tingkat</option>
                                <option value="X" {{ request('tingkat') == 'X' ? 'selected' : '' }}>Kelas X</option>
                                <option value="XI" {{ request('tingkat') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                                <option value="XII" {{ request('tingkat') == 'XII' ? 'selected' : '' }}>Kelas XII
                                </option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <select name="jurusan" onchange="this.form.submit()"
                                class="w-full px-3 py-2 sm:px-4 sm:py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">
                                <option value="">Semua Jurusan</option>
                                <option value="Rekayasa Perangkat Lunak"
                                    {{ request('jurusan') == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>RPL</option>
                                <option value="Teknik Kendaraan Ringan"
                                    {{ request('jurusan') == 'Teknik Kendaraan Ringan' ? 'selected' : '' }}>TKR</option>
                                <option value="Bisnis Daring Pemasaran"
                                    {{ request('jurusan') == 'Bisnis Daring Pemasaran' ? 'selected' : '' }}>BDP</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Classes Table -->
        <div class="bg-white neobrutal-card p-3 sm:p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                <h3 class="font-extrabold text-base sm:text-lg whitespace-nowrap">DAFTAR KELAS</h3>
                <div class="flex space-x-2 w-full sm:w-auto justify-end">
                    @if (auth()->user()->role !== 'guru')
                        <a href="{{ route('kelas.create') }}"
                            class="neobrutal-btn bg-sekolah text-white px-3 py-1.5 text-xs sm:text-sm font-bold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 inline mr-1"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b-3 border-black">
                            <th
                                class="text-left py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4 font-extrabold text-xs sm:text-sm md:text-base">
                                NO</th>
                            <th
                                class="text-left py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4 font-extrabold text-xs sm:text-sm md:text-base">
                                KELAS</th>
                            <th
                                class="text-left py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4 font-extrabold text-xs sm:text-sm md:text-base hidden sm:table-cell">
                                WALI KELAS</th>
                            <th
                                class="text-left py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4 font-extrabold text-xs sm:text-sm md:text-base">
                                JURUSAN</th>
                            <th
                                class="text-left py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4 font-extrabold text-xs sm:text-sm md:text-base">
                                SISWA</th>
                            <th
                                class="text-left py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4 font-extrabold text-xs sm:text-sm md:text-base">
                                AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($kelas as $k)
                            <tr class="border-b-2 border-gray-200 hover:bg-gray-50">
                                <td
                                    class="py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4 font-bold text-xs sm:text-sm md:text-base">
                                    {{ $no++ }}</td>
                                <td
                                    class="py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4 font-bold text-xs sm:text-sm md:text-base">
                                    <div>{{ $k->tingkat_kelas }} {{ $k->jurusan }} {{$k->rombel}}</div>
                                    <div class="text-xs text-gray-500 sm:hidden">{{ $k->wali_kelas ?? '-' }}</div>
                                </td>
                                <td
                                    class="py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4 font-bold text-xs sm:text-sm md:text-base whitespace-nowrap hidden sm:table-cell">
                                    {{ $k->wali_kelas ?? '-' }}
                                </td>
                                <td class="py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4">
                                    <span
                                        class="inline-block px-2 py-1 text-xs rounded-full border border-black md:border-2 font-bold whitespace-nowrap overflow-hidden text-ellipsis max-w-[80px] sm:max-w-[100px] md:max-w-[150px]
                                @if ($k->jurusan == 'Rekayasa Perangkat Lunak') bg-purple-100 text-purple-800
                                @elseif($k->jurusan == 'Teknik Kendaraan Ringan') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800 @endif">
                                        {{ $k->jurusan }}
                                    </span>
                                </td>
                                <td
                                    class="py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4 font-bold text-xs sm:text-sm md:text-base whitespace-nowrap">
                                    {{ $k->siswas_count }} Siswa
                                </td>
                                <td class="py-2 px-2 sm:py-3 sm:px-3 md:py-4 md:px-4">
                                    <div class="flex gap-1 sm:gap-2">
                                        <a href="{{ route('kelas.show', [$k->id]) }}"
                                            class="p-1 sm:p-1.5 border-2 border-black rounded-md bg-blue-100 text-blue-800 hover:bg-blue-200">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-3.5 w-3.5 sm:h-4 sm:w-4 md:h-5 md:w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        @if (auth()->user()->role !== 'guru')
                                            <a href="{{ route('kelas.edit', [$k->id]) }}"
                                                class="p-1 sm:p-1.5 border-2 border-black rounded-md bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-3.5 w-3.5 sm:h-4 sm:w-4 md:h-5 md:w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('kelas.destroy', [$k->id]) }}" method="POST"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-1 sm:p-1.5 border-2 border-black rounded-md bg-red-100 text-red-800 hover:bg-red-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-3.5 w-3.5 sm:h-4 sm:w-4 md:h-5 md:w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $kelas->links() }}
            </div>
        </div>
    </main>
@endsection
