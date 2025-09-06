<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Presensi Digital</title>
    <script src="{{ asset('https://cdn.tailwindcss.com') }}"></script>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    {{-- <link rel="icon" type="image/x-icon" href="favicon.ico"> --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div id="sidebar"
            class="w-80 bg-white neobrutal-nav p-4 fixed md:relative transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 h-full">
            <div class="mb-8 flex items-center">
                <div class="w-12 h-12  rounded-lg flex items-center justify-center mr-3 border-3 border-black">
                    <a href="/">
                        <div
                            class="w-10 h-10 border-3 border-black flex items-center justify-center text-white font-bold">
                            <img src="{{asset("logo.png")}}" alt="" class="w-10">
                        </div>
                    </a>
                </div>
                <div>
                    <h1 class="text-xl font-extrabold">SIS<span class="text-sekolah">PENSI</span></h1>
                    <p class="text-xs font-bold text-gray-600">SMKN 1 PEJAWARAN</p>
                </div>
            </div>

            <nav>
                <div class="mb-6">
                    <p class="text-xs font-extrabold uppercase text-gray-500 mb-3">MENU UTAMA</p>
                    <a href="/dashboard" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </div>
                    </a>
                    <a href="/presensi" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Presensi
                        </div>
                    </a>

                    <a href="/rekap" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Rekap
                        </div>
                    </a>
                    <a href="/pelanggaran" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Pelanggaran Siswa
                        </div>
                    </a>
                </div>

                <div class="mb-6">
                    <p class="text-xs font-extrabold uppercase text-gray-500 mb-3">MANAJEMEN</p>
                    <a href="/kelas" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Data Kelas
                        </div>
                    </a>
                    <a href="{{ route('siswa.index') }}" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Data Siswa
                        </div>
                    </a>
                    <a href="/guru" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Data Guru
                        </div>
                    </a>

                </div>

                <div class="mb-6">
                    <p class="text-xs font-extrabold uppercase text-gray-500 mb-3">PENGATURAN</p>
                    <a href="{{route('guru.show', [Auth::user()])}}" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Tentang Saya
                        </div>
                    </a>
                </div>
            </nav>

        </div>
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white neobrutal-nav p-4 flex justify-between items-center">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="md:hidden mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h2 class="text-xl font-extrabold">{{ 'DASHBOARD' }}</h2>
                </div>

                <div class="flex items-center space-x-5">
                    <div class="relative">
                        <button id="userMenuButton" class="focus:outline-none">
                            <div
                                class="w-12 h-12 bg-sekolah rounded-full flex items-center justify-center font-bold text-white border-3 border-black cursor-pointer hover:bg-sekolah-dark transition">
                                {{ substr(Auth::user()->nama, 0, 2) }}
                            </div>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="userMenuDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white border-2 border-black rounded-md shadow-lg py-1 z-50">
                            <div class="px-4 py-2 text-sm border-b-2 border-black">
                                <div class="font-bold">{{ Auth::user()->nama }}</div>
                                <div class="text-gray-600">{{ Auth::user()->email }}</div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            @yield('content')
        </div>
    </div>
    {{-- <footer>
        <!-- Footer -->
        <div class="mt-6 text-center">
            <p class="text-xs font-bold text-gray-600">
                &copy; 2024 SIPRESENSI - SMKN 1 DIGITAL. All rights reserved.
            </p>
        </div>
    </footer> --}}

    <script>
        // Toggle sidebar for mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation(); // Mencegah event bubbling
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 768 &&
                !sidebar.contains(e.target) &&
                e.target !== sidebarToggle &&
                !sidebarToggle.contains(e.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Prevent sidebar from closing when clicking inside it
        sidebar.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        // Toggle dropdown menu
        document.getElementById('userMenuButton').addEventListener('click', function() {
            const dropdown = document.getElementById('userMenuDropdown');
            dropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userMenuDropdown');
            const button = document.getElementById('userMenuButton');

            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
