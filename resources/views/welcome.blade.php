<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPENSI - Sistem Presensi Digital SMKN 1 Pejawaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .neobrutal-card {
            border: 3px solid #000;
            box-shadow: 8px 8px 0px #000;
            transition: all 0.2s ease;
        }

        .neobrutal-card:hover {
            box-shadow: 4px 4px 0px #000;
            transform: translate(2px, 2px);
        }

        .neobrutal-btn {
            border: 3px solid #000;
            box-shadow: 4px 4px 0px #000;
            transition: all 0.2s ease;
        }

        .neobrutal-btn:hover {
            box-shadow: 2px 2px 0px #000;
            transform: translate(2px, 2px);
        }

        .text-siswa {
            color: #3b82f6;
        }

        .bg-siswa {
            background-color: #3b82f6;
        }

        .text-guru {
            color: #10b981;
        }

        .text-presensi {
            color: #f59e0b;
        }

        .text-absen {
            color: #ef4444;
        }

        .bg-sekolah {
            background-color: #1e40af;
        }

        /* Mobile menu styles */
        .mobile-menu {
            display: none;
        }

        .mobile-menu.active {
            display: block;
        }

        @media (max-width: 768px) {

            .neobrutal-card,
            .neobrutal-btn {
                box-shadow: 4px 4px 0px #000;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-b-3 border-black sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 border-3 border-black flex items-center justify-center text-white font-bold">
                    <img src="logo.png" alt="" class="w-10">
                </div>
                <div>
                    <span class="font-extrabold block leading-tight text-sm sm:text-base">SIPENSI</span>
                    <span class="text-xs block">SMKN 1 Pejawaran</span>
                </div>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#fitur" class="font-bold hover:text-blue-800">Fitur</a>
                <a href="#alur" class="font-bold hover:text-blue-800">Alur Presensi</a>
                <a href="#kontak" class="font-bold hover:text-blue-800">Kontak</a>
            </div>
            <div class="flex items-center">
                <!-- Mobile menu button -->
                <button class="md:hidden focus:outline-none mr-2" id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                @auth
                    <a href="/dashboard"
                        class="neobrutal-btn bg-sekolah text-white px-3 py-1 sm:px-4 sm:py-2 font-bold text-xs sm:text-sm">Dashboard</a>
                @else
                    <a href="/login"
                        class="neobrutal-btn bg-sekolah text-white px-3 py-1 sm:px-4 sm:py-2 font-bold text-xs sm:text-sm">Login
                        Siswa/Guru</a>
                @endauth
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden bg-white border-t-2 border-black" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#fitur" class="block px-3 py-2 font-medium">Fitur</a>
                <a href="#alur" class="block px-3 py-2 font-medium">Alur Presensi</a>
                <a href="#kontak" class="block px-3 py-2 font-medium">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="border-b-3 border-black bg-gradient-to-r from-blue-900 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-24 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div class="text-center md:text-left">
                <div class="bg-white text-blue-900 neobrutal-card px-4 py-2 w-max mb-4 mx-auto md:mx-0">
                    <span class="font-bold text-sm">SISTEM PRESENSI DIGITAL</span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight mb-4 sm:mb-6">
                    Presensi Online <br>
                    <span class="text-yellow-300">SMKN 1 Pejawaran</span>
                </h1>
                <p class="text-base sm:text-lg mb-6 sm:mb-8">
                    Solusi modern untuk mencatat kehadiran siswa dengan teknologi terkini. Pantau presensi secara
                    real-time dimana saja.
                </p>
                <div class="flex flex-wrap justify-center md:justify-start gap-3 sm:gap-4">
                    <a href="#demo"
                        class="neobrutal-btn bg-yellow-400 text-black px-4 py-2 sm:px-6 sm:py-3 font-bold text-sm sm:text-base">Lihat
                        Demo</a>
                    <a href="#alur"
                        class="neobrutal-btn bg-white text-black px-4 py-2 sm:px-6 sm:py-3 font-bold border-3 border-black text-sm sm:text-base">Cara
                        Presensi</a>
                </div>
            </div>
            <div class="relative mt-8 md:mt-0">
                <div class="bg-white neobrutal-card p-2 sm:p-3">
                    <img src="https://placehold.co/600x400/1e40af/white?text=Tampilan+SIPENSI+SMKN1+Pejawaran"
                        alt="SIPENSI SMKN 1 Pejawaran" class="border-3 border-black w-full">
                </div>
                <div
                    class="absolute -bottom-3 -right-3 sm:-bottom-4 sm:-right-4 bg-yellow-100 neobrutal-card p-2 sm:p-3 w-20 h-20 sm:w-28 sm:h-28 flex items-center justify-center border-3 border-black">
                    <p class="font-bold text-center text-xs">JUARA 1<br>LKS IT Nasional 2023</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Identitas Sekolah -->
    <section class="py-8 sm:py-12 bg-white border-b-3 border-black">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-2xl sm:text-3xl font-extrabold mb-2">SMKN 1 PEJAWARAN</h2>
            <p class="text-base sm:text-lg mb-4 sm:mb-6">"Sopan, Elok, Jujur, Kompeten"</p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                <div class="bg-blue-50 neobrutal-card p-3 sm:p-4">
                    <p class="text-lg sm:text-xl font-extrabold text-blue-800">12</p>
                    <p class="text-xs sm:text-sm font-bold">Jurusan</p>
                </div>
                <div class="bg-green-50 neobrutal-card p-3 sm:p-4">
                    <p class="text-lg sm:text-xl font-extrabold text-green-800">1.200+</p>
                    <p class="text-xs sm:text-sm font-bold">Siswa</p>
                </div>
                <div class="bg-yellow-50 neobrutal-card p-3 sm:p-4">
                    <p class="text-lg sm:text-xl font-extrabold text-yellow-800">85+</p>
                    <p class="text-xs sm:text-sm font-bold">Guru</p>
                </div>
                <div class="bg-red-50 neobrutal-card p-3 sm:p-4">
                    <p class="text-lg sm:text-xl font-extrabold text-red-800">96%</p>
                    <p class="text-xs sm:text-sm font-bold">Presensi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-12 sm:py-16 border-b-3 border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl font-extrabold mb-3 sm:mb-4">Fitur SIPENSI</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm sm:text-base">Teknologi presensi terkini khusus untuk
                    SMKN 1 Pejawaran</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                <!-- Fitur 1 -->
                <div class="bg-white neobrutal-card p-4 sm:p-6">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 border-3 border-black mb-3 sm:mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-800"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-extrabold mb-1 sm:mb-2">Presensi Real-time</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Catatan kehadiran langsung terupdate di sistem pusat
                        sekolah</p>
                </div>

                <!-- Fitur 2 -->
                <div class="bg-white neobrutal-card p-4 sm:p-6">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 border-3 border-black mb-3 sm:mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-800"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-extrabold mb-1 sm:mb-2">Laporan Harian</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Generate laporan presensi per kelas secara otomatis
                    </p>
                </div>

                <!-- Fitur 3 -->
                <div class="bg-white neobrutal-card p-4 sm:p-6">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-yellow-100 border-3 border-black mb-3 sm:mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-yellow-800"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-extrabold mb-1 sm:mb-2">Histori Lengkap</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Arsip data presensi siswa selama masa studi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Presensi -->
    <section id="alur" class="py-12 sm:py-16 bg-white border-b-3 border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl font-extrabold mb-3 sm:mb-4">Alur Presensi Online</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm sm:text-base">Cara melakukan presensi di SMKN 1
                    Pejawaran</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8">
                <!-- Langkah 1 -->
                <div class="text-center">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-800 border-3 border-black text-white font-extrabold text-lg sm:text-xl flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        1</div>
                    <h3 class="text-lg sm:text-xl font-extrabold mb-1 sm:mb-2">Login</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Masuk menggunakan NIS/NIP dan password</p>
                </div>

                <!-- Langkah 2 -->
                <div class="text-center">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-800 border-3 border-black text-white font-extrabold text-lg sm:text-xl flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        2</div>
                    <h3 class="text-lg sm:text-xl font-extrabold mb-1 sm:mb-2">Pilih Kelas</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Tentukan kelas dan mata pelajaran</p>
                </div>

                <!-- Langkah 3 -->
                <div class="text-center">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-800 border-3 border-black text-white font-extrabold text-lg sm:text-xl flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        3</div>
                    <h3 class="text-lg sm:text-xl font-extrabold mb-1 sm:mb-2">Konfirmasi</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Klik tombol hadir/izin/sakit</p>
                </div>
            </div>

            <div class="mt-8 sm:mt-12 bg-yellow-50 neobrutal-card p-4 sm:p-6 max-w-3xl mx-auto">
                <h3 class="font-extrabold text-base sm:text-lg mb-2 sm:mb-3 text-center">Jadwal Presensi</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 text-center">
                    <div class="bg-white p-2 sm:p-3 border-2 border-black">
                        <p class="font-bold text-sm sm:text-base">Senin-Jumat</p>
                        <p class="text-xs sm:text-sm">07.00-13.00 WIB</p>
                    </div>
                    <div class="bg-white p-2 sm:p-3 border-2 border-black">
                        <p class="font-bold text-sm sm:text-base">Batas Presensi</p>
                        <p class="text-xs sm:text-sm">30 menit pertama</p>
                    </div>
                    <div class="bg-white p-2 sm:p-3 border-2 border-black">
                        <p class="font-bold text-sm sm:text-base">Keterlambatan</p>
                        <p class="text-xs sm:text-sm">Maksimal 3x</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-12 sm:py-16 border-b-3 border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl font-extrabold mb-3 sm:mb-4">Butuh Bantuan?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm sm:text-base">Hubungi tim IT SMKN 1 Pejawaran</p>
            </div>

            <div class="bg-white neobrutal-card p-4 sm:p-8 max-w-3xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                    <div>
                        <h3 class="font-extrabold text-lg sm:text-xl mb-3 sm:mb-4">Kontak Kami</h3>
                        <div class="space-y-3 sm:space-y-4">
                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 border-3 border-black mr-3 sm:mr-4 flex-shrink-0 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 sm:h-5 sm:w-5 text-blue-800" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-sm sm:text-base">Telepon</h4>
                                    <p class="text-xs sm:text-sm">(0281) 1234567</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 border-3 border-black mr-3 sm:mr-4 flex-shrink-0 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 sm:h-5 sm:w-5 text-blue-800" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-sm sm:text-base">Email</h4>
                                    <p class="text-xs sm:text-sm">it.support@smkn1pejawaran.sch.id</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 border-3 border-black mr-3 sm:mr-4 flex-shrink-0 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 sm:h-5 sm:w-5 text-blue-800" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-sm sm:text-base">Lokasi</h4>
                                    <p class="text-xs sm:text-sm">Lab Komputer 1, SMKN 1 Pejawaran</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 sm:mt-0">
                        <h3 class="font-extrabold text-lg sm:text-xl mb-3 sm:mb-4">Jam Operasional</h3>
                        <div class="bg-blue-50 border-3 border-black p-3 sm:p-4">
                            <div class="flex justify-between py-1 sm:py-2 border-b-2 border-black">
                                <span class="font-bold text-sm sm:text-base">Senin-Kamis</span>
                                <span class="text-xs sm:text-sm">08.00 - 15.00 WIB</span>
                            </div>
                            <div class="flex justify-between py-1 sm:py-2 border-b-2 border-black">
                                <span class="font-bold text-sm sm:text-base">Jumat</span>
                                <span class="text-xs sm:text-sm">08.00 - 14.00 WIB</span>
                            </div>
                            <div class="flex justify-between py-1 sm:py-2">
                                <span class="font-bold text-sm sm:text-base">Sabtu-Minggu</span>
                                <span class="text-xs sm:text-sm">Tutup</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-3 sm:mb-4">
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 border-3 border-black flex items-center justify-center text-black font-bold">
                            <img src="logo.png" alt="" class="w-8 sm:w-10">
                        </div>
                        <div>
                            <span class="font-extrabold block text-sm sm:text-base">SIPENSI</span>
                            <span class="text-xs block">SMKN 1 Pejawaran</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-xs sm:text-sm">
                        Jl. Pendidikan No. 123, Pejawaran, Banjarnegara<br>
                        Jawa Tengah 53454
                    </p>
                </div>

                <div>
                    <h4 class="font-extrabold mb-3 sm:mb-4 text-sm sm:text-base">Tautan Cepat</h4>
                    <div class="grid grid-cols-2 gap-3 sm:gap-4">
                        <a href="#fitur" class="text-gray-400 hover:text-white text-xs sm:text-sm">Fitur</a>
                        <a href="#alur" class="text-gray-400 hover:text-white text-xs sm:text-sm">Alur Presensi</a>
                        <a href="#kontak" class="text-gray-400 hover:text-white text-xs sm:text-sm">Kontak</a>
                        <a href="/login" class="text-gray-400 hover:text-white text-xs sm:text-sm">Login</a>
                    </div>
                </div>
            </div>

            <div
                class="border-t-3 border-gray-800 mt-6 sm:mt-8 pt-6 sm:pt-8 text-center text-gray-400 text-xs sm:text-sm">
                <p>&copy; 2025 SIPENSI - SMKN 1 Pejawaran. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile menu script -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
        });
    </script>
</body>

</html>
