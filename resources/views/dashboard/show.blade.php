@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 sm:p-6">
        <div class="bg-white neobrutal-card p-4 sm:p-6">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <h3 class="font-extrabold text-base sm:text-lg">DETAIL DATA GURU</h3>
                <a href="{{ route('guru.index') }}"
                    class="neobrutal-btn bg-gray-200 text-black px-3 py-1.5 sm:px-4 sm:py-1.5 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black flex items-center self-start sm:self-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 mr-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    KEMBALI
                </a>
            </div>

            <!-- Teacher Profile Section -->
            <div class="flex flex-col lg:flex-row gap-4 sm:gap-6 mb-6 sm:mb-8">
                <!-- Photo and Basic Info -->
                <div class="lg:w-1/3">
                    <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md">
                        <div class="flex flex-col items-center">
                            @if ($user->foto)
                                <div
                                    class="w-28 h-28 sm:w-36 sm:h-36 md:w-40 md:h-40 rounded-full overflow-hidden border-2 sm:border-3 border-black mb-3 sm:mb-4">
                                    <img src="{{ Storage::url($user->foto) }}" alt="Foto Guru"
                                        class="w-full h-full object-cover">
                                </div>
                            @else
                                <div
                                    class="w-28 h-28 sm:w-36 sm:h-36 md:w-40 md:h-40 rounded-full bg-gray-200 border-2 sm:border-3 border-black mb-3 sm:mb-4 flex items-center justify-center">
                                    <span
                                        class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-500">{{ substr($user->nama, 0, 1) }}</span>
                                </div>
                            @endif

                            <h4 class="font-extrabold text-lg sm:text-xl text-center">{{ $user->nama }}</h4>
                            <p class="text-gray-600 text-center text-sm sm:text-base mb-2">
                                {{ $user->mapel ?? 'Tidak ada mata pelajaran' }}
                            </p>

                            <!-- Role Badge -->
                            <div
                                class="mt-2 px-3 py-0.5 sm:px-4 sm:py-1 rounded-full border border-black sm:border-2 font-bold text-xs sm:text-sm
                                @if ($user->role == 'admin') bg-purple-100 text-purple-800
                                @elseif($user->role == 'guru') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ strtoupper($user->role) }}
                            </div>

                            <!-- Status Badge -->
                            <div
                                class="mt-2 px-3 py-0.5 sm:px-4 sm:py-1 rounded-full border border-black sm:border-2 font-bold text-xs sm:text-sm
                                @if ($user->status == 'aktif') bg-green-100 text-green-800
                                @elseif($user->status == 'cuti') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ strtoupper($user->status) }}
                            </div>
                        </div>

                        <!-- Quick Info -->
                        <div class="mt-4 sm:mt-6 space-y-2 sm:space-y-3">
                            <div class="flex items-center">
                                <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs sm:text-sm">{{ $user->email ?? '-' }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-xs sm:text-sm">{{ $user->no_hp ?? '-' }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-xs sm:text-sm">{{ $user->alamat ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Information -->
                <div class="lg:w-2/3">
                    <!-- Personal Information -->
                    <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md mb-4 sm:mb-6">
                        <h4
                            class="font-extrabold text-sm sm:text-md mb-3 sm:mb-4 border-b-2 sm:border-b-3 border-black pb-2">
                            INFORMASI PRIBADI</h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">NIP</p>
                                <p class="font-bold text-sm sm:text-base">{{ $user->nip }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Nama Lengkap</p>
                                <p class="font-bold text-sm sm:text-base">{{ $user->nama }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Jenis Kelamin</p>
                                <p class="font-bold text-sm sm:text-base">
                                    {{ $user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Tempat, Tanggal Lahir</p>
                                <p class="font-bold text-sm sm:text-base">{{ $user->tempat_lahir }},
                                    {{ date('d F Y', strtotime($user->tanggal_lahir)) }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Agama</p>
                                <p class="font-bold text-sm sm:text-base">{{ $user->agama }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Role</p>
                                <p class="font-bold text-sm sm:text-base">
                                    @if ($user->role == 'admin')
                                        Administrator
                                    @elseif($user->role == 'guru')
                                        Guru
                                    @else
                                        Staf
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md mb-4 sm:mb-6">
                        <h4
                            class="font-extrabold text-sm sm:text-md mb-3 sm:mb-4 border-b-2 sm:border-b-3 border-black pb-2">
                            INFORMASI PROFESIONAL</h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Mata Pelajaran</p>
                                <p class="font-bold text-sm sm:text-base">{{ $user->mapel ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Status</p>
                                <p class="font-bold text-sm sm:text-base">
                                    @if ($user->status == 'aktif')
                                        Aktif
                                    @elseif($user->status == 'cuti')
                                        Cuti
                                    @else
                                        Keluar
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Email</p>
                                <p class="font-bold text-sm sm:text-base">{{ $user->email ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">No. HP</p>
                                <p class="font-bold text-sm sm:text-base">{{ $user->no_hp ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md">
                        <h4
                            class="font-extrabold text-sm sm:text-md mb-3 sm:mb-4 border-b-2 sm:border-b-3 border-black pb-2">
                            INFORMASI TAMBAHAN</h4>

                        <div class="grid grid-cols-1 gap-3 sm:gap-4">
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Alamat</p>
                                <p class="font-bold text-sm sm:text-base">{{ $user->alamat ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Tanggal Dibuat</p>
                                <p class="font-bold text-sm sm:text-base">{{ $user->created_at->format('d F Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Terakhir Diupdate</p>
                                <p class="font-bold text-sm sm:text-base">{{ $user->updated_at->format('d F Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-4 pt-4 border-t-2 sm:border-t-3 border-black">
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('guru.edit', $user->id) }}"
                    class="neobrutal-btn bg-yellow-400 text-black px-4 py-1.5 sm:px-6 sm:py-2 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black text-center">
                    EDIT DATA
                </a>
                @elseif(auth()->user()->role === 'staf')
                <a href="{{ route('guru.edit', $user->id) }}"
                    class="neobrutal-btn bg-yellow-400 text-black px-4 py-1.5 sm:px-6 sm:py-2 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black text-center">
                    EDIT DATA
                </a>
                @endif
                <form action="{{ route('guru.destroy', $user->id) }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="neobrutal-btn bg-red-500 text-white px-4 py-1.5 sm:px-6 sm:py-2 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black w-full"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data guru ini?')">
                        HAPUS DATA
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection
