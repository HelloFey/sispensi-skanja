@extends('dashboard.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="p-4 md:p-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Filter and Actions - Responsive -->
        <div class="bg-white neobrutal-card p-4 md:p-6 mb-4 md:mb-6">
            <form action="{{ route('siswa.index') }}" method="GET" id="filterForm">
                <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari siswa..." value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <div class="absolute left-3 top-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-gray-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden search field for other filters -->
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <!-- Tingkat Kelas Filter -->
                    <div>
                        <select name="tingkat" onchange="this.form.submit()"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Tingkat</option>
                            <option value="X" {{ request('tingkat') == 'X' ? 'selected' : '' }}>Kelas X</option>
                            <option value="XI" {{ request('tingkat') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                            <option value="XII" {{ request('tingkat') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                        </select>
                    </div>

                    <!-- Rombel Filter -->
                    <div>
                        <select name="rombel" onchange="this.form.submit()"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Rombel</option>
                            <option value="1" {{ request('rombel') == '1' ? 'selected' : '' }}>Rombel 1</option>
                            <option value="2" {{ request('rombel') == '2' ? 'selected' : '' }}>Rombel 2</option>
                        </select>
                    </div>

                    <!-- Jurusan Filter -->
                    <div>
                        <select name="jurusan" onchange="this.form.submit()"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-sekolah">
                            <option value="">Semua Jurusan</option>
                            <option value="Bisnis Daring Pemasaran"
                                {{ request('jurusan') == 'Bisnis Daring Pemasaran' ? 'selected' : '' }}>BDP</option>
                            <option value="Teknik Kendaraan Ringan"
                                {{ request('jurusan') == 'Teknik Kendaraan Ringan' ? 'selected' : '' }}>TKR</option>
                            <option value="Rekayasa Perangkat Lunak"
                                {{ request('jurusan') == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>RPL</option>
                        </select>
                    </div>

                    <!-- Reset Button -->
                    <div>
                        <a href="/siswa"
                            class="w-full neobrutal-btn bg-gray-200 text-black px-3 py-2 md:px-4 md:py-2 font-bold text-sm md:text-base border-2 md:border-3 border-black">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Stats Cards - Responsive -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-4 md:mb-6">
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">TOTAL SISWA</p>
                <p class="text-xl md:text-2xl font-extrabold text-blue-600">{{ $totalSiswa }}</p>
            </div>
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">SISWA AKTIF</p>
                <p class="text-xl md:text-2xl font-extrabold text-green-600">{{ $totalAktif }}</p>
            </div>
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">SISWA KELUAR</p>
                <p class="text-xl md:text-2xl font-extrabold text-red-600">{{ $totalKeluar }}</p>
            </div>
            <div class="bg-white p-3 md:p-4 neobrutal-card text-center">
                <p class="text-xs md:text-sm font-bold text-gray-600">SISWA PINDAH</p>
                <p class="text-xl md:text-2xl font-extrabold text-yellow-600">{{ $totalPindah }}</p>
            </div>
        </div>

        <!-- Students Table - Responsive -->
        <div class="bg-white neobrutal-card p-3 md:p-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-3 md:mb-4 gap-2 md:gap-0">
                <h3 class="font-extrabold text-base md:text-lg whitespace-nowrap">DAFTAR SISWA</h3>
                <div class="flex space-x-2 w-full md:w-auto">
                    @if (auth()->user()->role === 'guru')
                        <a href=""> </a>
                    @else
                        <a href="{{ route('siswa.create') }}"
                            class="neobrutal-btn bg-sekolah text-white px-2 py-1 md:px-3 md:py-1.5 text-xs md:text-sm font-bold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 md:h-4 md:w-4 inline mr-1"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="hidden sm:inline">Tambah</span>
                        </a>
                    @endif
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b-2 md:border-b-3 border-black">
                            <th class="text-left py-2 px-2 md:py-3 md:px-3 font-extrabold text-xs md:text-sm">NO</th>
                            <th class="text-left py-2 px-2 md:py-3 md:px-3 font-extrabold text-xs md:text-sm">NIS</th>
                            <th class="text-left py-2 px-2 md:py-3 md:px-3 font-extrabold text-xs md:text-sm">NAMA</th>
                            <th
                                class="text-left py-2 px-2 md:py-3 md:px-3 font-extrabold text-xs md:text-sm hidden sm:table-cell">
                                KELAS</th>
                            <th
                                class="text-left py-2 px-2 md:py-3 md:px-3 font-extrabold text-xs md:text-sm hidden md:table-cell">
                                JURUSAN</th>
                            <th class="text-left py-2 px-2 md:py-3 md:px-3 font-extrabold text-xs md:text-sm">STATUS</th>
                            <th class="text-left py-2 px-2 md:py-3 md:px-3 font-extrabold text-xs md:text-sm">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($siswa as $s)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-2 px-2 md:py-3 md:px-3 font-bold text-xs md:text-sm">{{ $no++ }}
                                </td>
                                <td class="py-2 px-2 md:py-3 md:px-3 font-bold text-xs md:text-sm">{{ $s->nis }}
                                </td>
                                <td class="py-2 px-2 md:py-3 md:px-3 font-bold text-xs md:text-sm whitespace-nowrap">
                                    {{ $s->nama }}</td>
                                <td
                                    class="py-2 px-2 md:py-3 md:px-3 font-bold text-xs md:text-sm hidden sm:table-cell whitespace-nowrap">
                                    {{ $s->kelas->tingkat_kelas }} {{ $s->kelas->jurusan }} {{ $s->kelas->rombel }}
                                </td>
                                <td
                                    class="py-2 px-2 md:py-3 md:px-3 font-bold text-xs md:text-sm hidden md:table-cell whitespace-nowrap">
                                    {{ $s->kelas->jurusan }}</td>
                                <td class="py-2 px-2 md:py-3 md:px-3">
                                    <span
                                        class="inline-block px-2 py-0.5 md:px-3 md:py-1 text-xs rounded-full border border-black md:border-2 font-bold whitespace-nowrap
                                    @if ($s->status == 'aktif') bg-green-100 text-green-800
                                    @elseif($s->status == 'pindah') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                        {{ strtoupper($s->status) }}
                                    </span>
                                </td>
                                <td class="py-2 px-2 md:py-3 md:px-3">
                                    @if (auth()->user()->role === 'guru')
                                        <div class="flex gap-1 md:gap-2">
                                            <a href="{{ route('siswa.show', [$s->id]) }}"
                                                class="p-1 border border-black md:border-2 rounded-md bg-blue-100 text-blue-800 hover:bg-blue-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 md:h-4 md:w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </div>
                                    @else
                                        <div class="flex gap-1 md:gap-2">
                                            <a href="{{ route('siswa.show', [$s->id]) }}"
                                                class="p-1 border border-black md:border-2 rounded-md bg-blue-100 text-blue-800 hover:bg-blue-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 md:h-4 md:w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('siswa.edit', [$s->id]) }}"
                                                class="p-1 border border-black md:border-2 rounded-md bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 md:h-4 md:w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('siswa.destroy', [$s->id]) }}" method="POST"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-1 border border-black md:border-2 rounded-md bg-red-100 text-red-800 hover:bg-red-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-3.5 w-3.5 md:h-4 md:w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination - Responsive -->
            <div class="mt-3 md:mt-4">
                {{ $siswa->links() }}
            </div>
        </div>
    </main>
@endsection
