@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 md:p-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Filter and Actions -->
        <div class="bg-white neobrutal-card p-4 md:p-6 mb-4 md:mb-6">
            <form action="{{ route('guru.index') }}" method="GET">
                <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari guru (Nama/NIP/Mapel)..."
                                value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 md:h-5 md:w-5 absolute left-3 top-2.5 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="w-full md:w-40">
                        <select name="status"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="cuti" {{ request('status') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                            <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                            </option>
                        </select>
                    </div>

                    <!-- Role Filter -->
                    <div class="w-full md:w-40">
                        <select name="role"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="staf" {{ request('role') == 'staf' ? 'selected' : '' }}>Staf</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <button type="submit"
                            class="neobrutal-btn bg-sekolah text-white px-3 py-2 md:px-4 md:py-2 font-bold text-sm md:text-base">
                            Filter
                        </button>
                        <a href="{{ route('guru.index') }}"
                            class="neobrutal-btn bg-gray-200 text-black px-3 py-2 md:px-4 md:py-2 font-bold border-2 md:border-3 border-black text-sm md:text-base">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-4 md:mb-6">
            <div class="bg-white p-3 md:p-4 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm font-bold">TOTAL GURU</p>
                        <h3 class="text-2xl md:text-3xl font-extrabold mt-1 md:mt-2 text-blue-600">{{ $totalGuru }}</h3>
                        @if (request()->anyFilled(['search', 'status', 'role']))
                            <p class="text-xs text-gray-500">({{ $filteredCount }} hasil filter)</p>
                        @endif
                    </div>
                    <div class="bg-blue-100 p-2 md:p-3 rounded-md border-2 md:border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-3 md:p-4 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm font-bold">GURU AKTIF</p>
                        <h3 class="text-2xl md:text-3xl font-extrabold mt-1 md:mt-2 text-green-600">{{ $totalAktif }}
                        </h3>
                        <p class="text-xs text-gray-500">
                            {{ $totalGuru > 0 ? round(($totalAktif / $totalGuru) * 100, 1) : 0 }}%
                            dari total</p>
                    </div>
                    <div class="bg-green-100 p-2 md:p-3 rounded-md border-2 md:border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-3 md:p-4 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm font-bold">MAPEL DIAJAR</p>
                        <h3 class="text-2xl md:text-3xl font-extrabold mt-1 md:mt-2 text-yellow-600">{{ $totalMapel }}
                        </h3>
                    </div>
                    <div class="bg-yellow-100 p-2 md:p-3 rounded-md border-2 md:border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8 text-yellow-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers Table -->
        <div class="bg-white neobrutal-card p-4 md:p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 md:mb-6 gap-3">
                <h3 class="font-extrabold text-base md:text-lg">DAFTAR GURU</h3>
                <div class="flex gap-2">
                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'staf')
                        <a href="{{ route('guru.create') }}"
                            class="neobrutal-btn bg-sekolah text-white px-3 py-1.5 md:px-4 md:py-1.5 text-xs md:text-sm font-bold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah
                        </a>
                    @else
                        <div></div>
                    @endif
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b-2 md:border-b-3 border-black">
                            <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold text-sm md:text-base">NO</th>
                            <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold text-sm md:text-base">NAMA GURU
                            </th>
                            <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold text-sm md:text-base">NIP</th>
                            <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold text-sm md:text-base">MAPEL</th>
                            <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold text-sm md:text-base">STATUS</th>
                            <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold text-sm md:text-base">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gurus as $guru)
                            <tr class="border-b-2 border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-3 md:py-4 md:px-4 font-bold text-sm md:text-base">
                                    {{ ($gurus->currentPage() - 1) * $gurus->perPage() + $loop->iteration }}</td>
                                <td class="py-3 px-3 md:py-4 md:px-4 font-bold text-sm md:text-base">{{ $guru->nama }}
                                </td>
                                <td class="py-3 px-3 md:py-4 md:px-4 font-bold text-sm md:text-base">{{ $guru->nip }}
                                </td>
                                <td class="py-3 px-3 md:py-4 md:px-4 font-bold text-sm md:text-base">
                                    {{ $guru->mapel ?? '-' }}</td>
                                <td class="py-3 px-3 md:py-4 md:px-4">
                                    <span
                                        class="px-2 py-1 md:px-3 md:py-1 rounded-full border-2 border-black font-bold text-xs md:text-sm
                                        @if ($guru->status == 'aktif') bg-green-100 text-green-800
                                        @elseif($guru->status == 'cuti') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ strtoupper($guru->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 md:py-4 md:px-4">
                                    @if (auth()->user()->role === 'admin')
                                        <!-- Hanya admin yang bisa edit dan hapus -->
                                        <div class="flex gap-1 md:gap-2">
                                            <a href="{{ route('guru.edit', $guru->id) }}"
                                                class="p-1 border-2 border-black rounded-md bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('guru.destroy', $guru->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Hapus data guru ini?')"
                                                    class="p-1 border-2 border-black rounded-md bg-red-100 text-red-800 hover:bg-red-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @elseif(auth()->user()->role === 'staf')
                                        <!-- Staf hanya bisa edit -->
                                        <div class="flex gap-1 md:gap-2">
                                            <a href="{{ route('guru.edit', $guru->id) }}"
                                                class="p-1 border-2 border-black rounded-md bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        </div>
                                    @else
                                        <!-- Guru tidak bisa apa-apa -->
                                        <div class="text-xs md:text-sm">-</div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center font-bold text-sm md:text-base">Tidak ada
                                    data guru ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $gurus->appends(request()->query())->links() }}
            </div>
        </div>
    </main>
@endsection
