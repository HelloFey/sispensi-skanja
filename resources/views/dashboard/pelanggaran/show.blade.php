@extends('dashboard.layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detail Pelanggaran</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .neobrutal-card {
                border: 3px solid #000;
                border-radius: 0.5rem;
                box-shadow: 5px 5px 0px #000;
            }

            .neobrutal-btn {
                border: 3px solid #000;
                border-radius: 0.5rem;
                box-shadow: 3px 3px 0px #000;
                transition: all 0.2s ease;
            }

            .neobrutal-btn:hover {
                transform: translate(2px, 2px);
                box-shadow: 1px 1px 0px #000;
            }

            .bg-sekolah {
                background-color: #3b82f6;
            }

            .kategori-ringan {
                background-color: #FEF3C7;
                color: #92400E;
            }

            .kategori-sedang {
                background-color: #FDE68A;
                color: #B45309;
            }

            .kategori-berat {
                background-color: #FECACA;
                color: #B91C1C;
            }

            /* Mobile-first responsive adjustments */
            @media (max-width: 768px) {
                .neobrutal-card {
                    border-width: 2px;
                    box-shadow: 3px 3px 0px #000;
                }
                
                .neobrutal-btn {
                    border-width: 2px;
                    box-shadow: 2px 2px 0px #000;
                }
            }
        </style>
    </head>

    <body class="bg-gray-100 min-h-screen">
        <main class="p-3 sm:p-4 md:p-6">
            <div class="bg-white neobrutal-card p-3 sm:p-4 md:p-6">
                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4 sm:mb-6">
                    <h3 class="font-extrabold text-base sm:text-lg md:text-xl mb-3 sm:mb-0">DETAIL PELANGGARAN</h3>
                    <a href="{{ route('pelanggaran.index') }}"
                        class="neobrutal-btn bg-gray-200 text-black px-3 py-1.5 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black flex items-center justify-center w-full sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        KEMBALI
                    </a>
                </div>

                <!-- Student Profile Section -->
                <div class="flex flex-col lg:flex-row gap-4 sm:gap-5 md:gap-6 mb-5 sm:mb-6 md:mb-8">
                    <!-- Photo and Basic Info -->
                    <div class="w-full lg:w-1/3">
                        <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md">
                            <div class="flex flex-col items-center">
                                @if ($pelanggaran->siswa->foto ?? false)
                                    <div
                                        class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 rounded-full overflow-hidden border-2 sm:border-3 border-black mb-3 sm:mb-4">
                                        <img src="{{ asset('storage/siswa/' . $pelanggaran->siswa->foto) }}"
                                            alt="Foto Siswa" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 rounded-full bg-gray-200 border-2 sm:border-3 border-black mb-3 sm:mb-4 flex items-center justify-center">
                                        <span class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-500">
                                            {{ isset($pelanggaran->siswa->nama) ? substr($pelanggaran->siswa->nama, 0, 1) : 'P' }}
                                        </span>
                                    </div>
                                @endif

                                <h4 class="font-extrabold text-sm sm:text-base md:text-lg text-center">
                                    {{ $pelanggaran->siswa->nama ?? 'Data Siswa Tidak Ditemukan' }}</h4>
                                <p class="text-gray-600 text-center text-xs sm:text-sm md:text-base mb-2">
                                    @if (isset($pelanggaran->siswa->kelas))
                                        {{ $pelanggaran->siswa->kelas->tingkat_kelas }}
                                        {{ $pelanggaran->siswa->kelas->jurusan }} {{ $pelanggaran->siswa->kelas->rombel }}
                                    @else
                                        Kelas tidak ditemukan
                                    @endif
                                </p>

                                <!-- Status Badge -->
                                <div
                                    class="mt-2 px-2 py-0.5 sm:px-3 sm:py-1 md:px-4 md:py-1 rounded-full border border-black sm:border-2 font-bold text-xs sm:text-sm md:text-base kategori-{{ $pelanggaran->kategori ?? 'ringan' }}">
                                    {{ isset($pelanggaran->kategori) ? strtoupper($pelanggaran->kategori) : 'TIDAK DIKETAHUI' }}
                                </div>
                            </div>

                            <!-- Quick Info -->
                            <div class="mt-3 sm:mt-4 md:mt-6 space-y-1 sm:space-y-2 md:space-y-3">
                                <div class="flex items-center">
                                    <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4 md:h-5 md:w-5 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="text-xs sm:text-sm md:text-base">{{ $pelanggaran->nama_pelanggaran ?? 'Pelanggaran tidak diketahui' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4 md:h-5 md:w-5 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span class="text-xs sm:text-sm md:text-base">{{ $pelanggaran->poin ?? '0' }} Poin</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4 md:h-5 md:w-5 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-xs sm:text-sm md:text-base">{{ isset($pelanggaran->tanggal) ? \Carbon\Carbon::parse($pelanggaran->tanggal)->format('d/m/Y') : 'Tanggal tidak diketahui' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Information -->
                    <div class="w-full lg:w-2/3">
                        <!-- Pelanggaran Information -->
                        <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md mb-4 sm:mb-5 md:mb-6">
                            <h4 class="font-extrabold text-sm sm:text-base md:text-md mb-2 sm:mb-3 md:mb-4 border-b-2 sm:border-b-3 border-black pb-2">
                                INFORMASI PELANGGARAN</h4>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-3 md:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-600">Nama Pelanggaran</p>
                                    <p class="font-bold text-xs sm:text-sm md:text-base">
                                        {{ $pelanggaran->nama_pelanggaran ?? 'Tidak tersedia' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-600">Kategori</p>
                                    <p class="font-bold text-xs sm:text-sm md:text-base">
                                        {{ isset($pelanggaran->kategori) ? ucfirst($pelanggaran->kategori) : 'Tidak tersedia' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-600">Poin</p>
                                    <p class="font-bold text-xs sm:text-sm md:text-base">{{ $pelanggaran->poin ?? '0' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-600">Tanggal</p>
                                    <p class="font-bold text-xs sm:text-sm md:text-base">
                                        {{ isset($pelanggaran->tanggal) ? \Carbon\Carbon::parse($pelanggaran->tanggal)->format('d F Y') : 'Tidak tersedia' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-600">Waktu</p>
                                    <p class="font-bold text-xs sm:text-sm md:text-base">
                                        {{ $pelanggaran->waktu ? \Carbon\Carbon::parse($pelanggaran->waktu)->format('H:i') : 'Tidak dicatat' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-600">Dilaporkan Oleh</p>
                                    <p class="font-bold text-xs sm:text-sm md:text-base">
                                        {{ $pelanggaran->pencatat->name ?? 'Tidak diketahui' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi dan Keterangan -->
                        <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md mb-4 sm:mb-5 md:mb-6">
                            <h4 class="font-extrabold text-sm sm:text-base md:text-md mb-2 sm:mb-3 md:mb-4 border-b-2 sm:border-b-3 border-black pb-2">
                                DESKRIPSI & KETERANGAN</h4>

                            <div class="space-y-2 sm:space-y-3 md:space-y-4">
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-600">Deskripsi Pelanggaran</p>
                                    <p
                                        class="font-bold mt-1 p-2 sm:p-3 bg-gray-100 border border-black sm:border-2 rounded-md text-xs sm:text-sm md:text-base">
                                        {{ $pelanggaran->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-600">Keterangan Tambahan</p>
                                    <p
                                        class="font-bold mt-1 p-2 sm:p-3 bg-gray-100 border border-black sm:border-2 rounded-md text-xs sm:text-sm md:text-base">
                                        {{ $pelanggaran->keterangan ?? 'Tidak ada keterangan' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Bukti Foto -->
                        <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md">
                            <h4 class="font-extrabold text-sm sm:text-base md:text-md mb-2 sm:mb-3 md:mb-4 border-b-2 sm:border-b-3 border-black pb-2">BUKTI
                                FOTO</h4>

                            <div class="flex justify-center">
                                @if ($pelanggaran->bukti_foto)
                                    <img src="{{ asset('storage/' . $pelanggaran->bukti_foto) }}" alt="Bukti Pelanggaran"
                                        class="max-w-full sm:max-w-md border-2 sm:border-3 border-black rounded-md">
                                @else
                                    <div class="p-3 sm:p-4 md:p-6 bg-gray-100 border-2 sm:border-3 border-black rounded-md text-center w-full">
                                        <svg class="h-6 w-6 sm:h-8 sm:w-8 md:h-12 md:w-12 mx-auto text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mt-2 font-bold text-xs sm:text-sm md:text-base">Tidak ada bukti foto</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div
                    class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-3 md:gap-4 pt-3 sm:pt-4 border-t-2 sm:border-t-3 border-black mt-4 sm:mt-5 md:mt-6">
                    <a href="{{ route('pelanggaran.edit', $pelanggaran->id) }}"
                        class="neobrutal-btn bg-yellow-400 text-black px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black text-center">
                        EDIT DATA
                    </a>
                    <form action="{{ route('pelanggaran.destroy', $pelanggaran->id) }}" method="POST"
                        class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="neobrutal-btn bg-red-500 text-white px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black w-full"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data pelanggaran ini?')">
                            HAPUS DATA
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </body>

    </html>
@endsection