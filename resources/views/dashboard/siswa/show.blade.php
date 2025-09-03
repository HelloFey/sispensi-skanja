@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 sm:p-6">
        <div class="bg-white neobrutal-card p-4 sm:p-6">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <h3 class="font-extrabold text-base sm:text-lg">DETAIL DATA SISWA</h3>
                <a href="{{ route('siswa.index') }}"
                    class="neobrutal-btn bg-gray-200 text-black px-3 py-1.5 sm:px-4 sm:py-1.5 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black flex items-center self-start sm:self-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 mr-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    KEMBALI
                </a>
            </div>

            <!-- Student Profile Section -->
            <div class="flex flex-col lg:flex-row gap-4 sm:gap-6 mb-6 sm:mb-8">
                <!-- Photo and Basic Info -->
                <div class="lg:w-1/3">
                    <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md">
                        <div class="flex flex-col items-center">
                            @if ($siswa->foto)
                                <div
                                    class="w-28 h-28 sm:w-36 sm:h-36 md:w-40 md:h-40 rounded-full overflow-hidden border-2 sm:border-3 border-black mb-3 sm:mb-4">
                                    <img src="{{ asset('storage/siswa/' . $siswa->foto) }}" alt="Foto Siswa"
                                        class="w-full h-full object-cover">
                                </div>
                            @else
                                <div
                                    class="w-28 h-28 sm:w-36 sm:h-36 md:w-40 md:h-40 rounded-full bg-gray-200 border-2 sm:border-3 border-black mb-3 sm:mb-4 flex items-center justify-center">
                                    <span
                                        class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-500">{{ substr($siswa->nama, 0, 1) }}</span>
                                </div>
                            @endif

                            <h4 class="font-extrabold text-lg sm:text-xl text-center">{{ $siswa->nama }}</h4>
                            <p class="text-gray-600 text-center text-sm sm:text-base mb-2">
                                {{ $siswa->kelas->tingkat_kelas }} {{ $siswa->kelas->jurusan }} {{ $siswa->kelas->rombel }}
                            </p>

                            <!-- Status Badge -->
                            <div
                                class="mt-2 px-3 py-0.5 sm:px-4 sm:py-1 rounded-full border border-black sm:border-2 font-bold text-xs sm:text-sm
                                @if ($siswa->status == 'aktif') bg-green-100 text-green-800
                                @elseif($siswa->status == 'pindah') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ strtoupper($siswa->status) }}
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
                                <span class="text-xs sm:text-sm">{{ $siswa->email ?? '-' }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-xs sm:text-sm">{{ $siswa->no_hp ?? '-' }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-xs sm:text-sm">{{ $siswa->alamat ?? '-' }}</span>
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
                                <p class="text-xs sm:text-sm text-gray-600">NIS</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->nis }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">NISN</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->nisn }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Jenis Kelamin</p>
                                <p class="font-bold text-sm sm:text-base">
                                    {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Tempat, Tanggal Lahir</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->tempat_lahir }},
                                    {{ date('d F Y', strtotime($siswa->tanggal_lahir)) }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Agama</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->agama }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Poin</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->poin }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md mb-4 sm:mb-6">
                        <h4
                            class="font-extrabold text-sm sm:text-md mb-3 sm:mb-4 border-b-2 sm:border-b-3 border-black pb-2">
                            INFORMASI AKADEMIK</h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Tahun Ajar</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->kelas->tahun_ajar }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Tingkat Kelas</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->kelas->tingkat_kelas }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Jurusan</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->kelas->jurusan }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Kelas</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->kelas->nama_kelas }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Rombel</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->kelas->rombel }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Wali Kelas</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->kelas->wali_kelas ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Parent Information -->
                    <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md">
                        <h4
                            class="font-extrabold text-sm sm:text-md mb-3 sm:mb-4 border-b-2 sm:border-b-3 border-black pb-2">
                            INFORMASI ORANG TUA</h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Nama Ayah</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->nama_ayah ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Nama Ibu</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->nama_ibu ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">Pekerjaan Orang Tua</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->pekerjaan_ortu ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">No. HP Orang Tua</p>
                                <p class="font-bold text-sm sm:text-base">{{ $siswa->no_hp_ortu ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-4 pt-4 border-t-2 sm:border-t-3 border-black">
                <a href="{{ route('siswa.edit', $siswa->id) }}"
                    class="neobrutal-btn bg-yellow-400 text-black px-4 py-1.5 sm:px-6 sm:py-2 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black text-center">
                    EDIT DATA
                </a>
                <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="neobrutal-btn bg-red-500 text-white px-4 py-1.5 sm:px-6 sm:py-2 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black w-full"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                        HAPUS DATA
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection
