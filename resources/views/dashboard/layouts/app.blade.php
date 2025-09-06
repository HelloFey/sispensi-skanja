<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Presensi Digital</title>
    <script src="{{ asset('https://cdn.tailwindcss.com') }}"></script>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- Menambahkan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Overlay untuk mobile saat sidebar terbuka -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

        <!-- Sidebar -->
        <div id="sidebar"
            class="w-80 bg-white neobrutal-nav p-4 fixed md:relative transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 h-full overflow-y-auto">
            <div class="mb-8 flex items-center">
                <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-3 border-3 border-black">
                    <a href="/">
                        <div
                            class="w-10 h-10 border-3 border-black flex items-center justify-center text-white font-bold">
                            <img src="{{ asset('logo.png') }}" alt="" class="w-10">
                        </div>
                    </a>
                </div>
                <div>
                    <h1 class="text-xl font-extrabold">SIS<span class="text-sekolah">PENSI</span></h1>
                    <p class="text-xs font-bold text-gray-600">SMKN 1 PEJAWARAN</p>
                </div>
                <!-- Tombol tutup sidebar untuk mobile -->
                <button id="closeSidebar" class="ml-auto md:hidden">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav>
                <div class="mb-6">
                    <p class="text-xs font-extrabold uppercase text-gray-500 mb-3">MENU UTAMA</p>
                    <a href="/dashboard" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-home w-5 mr-2"></i>
                            Dashboard
                        </div>
                    </a>
                    <a href="/presensi" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-clipboard-check w-5 mr-2"></i>
                            Presensi
                        </div>
                    </a>

                    <a href="/rekap" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt w-5 mr-2"></i>
                            Rekap
                        </div>
                    </a>
                    <a href="/pelanggaran" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle w-5 mr-2"></i>
                            Pelanggaran Siswa
                        </div>
                    </a>
                </div>

                <div class="mb-6">
                    <p class="text-xs font-extrabold uppercase text-gray-500 mb-3">MANAJEMEN</p>
                    <a href="/kelas" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-chalkboard w-5 mr-2"></i>
                            Data Kelas
                        </div>
                    </a>
                    <a href="{{ route('siswa.index') }}"
                        class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-user-graduate w-5 mr-2"></i>
                            Data Siswa
                        </div>
                    </a>
                    <a href="/guru" class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-chalkboard-teacher w-5 mr-2"></i>
                            Data Guru
                        </div>
                    </a>
                </div>

                <div class="mb-6">
                    <p class="text-xs font-extrabold uppercase text-gray-500 mb-3">PENGATURAN</p>
                    <a href="{{ route('guru.show', [Auth::user()]) }}"
                        class="block py-3 px-4 hover:bg-gray-100 mb-3 font-bold rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-user-cog w-5 mr-2"></i>
                            Tentang Saya
                        </div>
                    </a>
                </div>
            </nav>

        </div>
        <div class="flex-1 overflow-auto flex flex-col">
            <!-- Header -->
            <header class="bg-white neobrutal-nav p-4 flex justify-between items-center sticky top-0 z-30">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="md:hidden mr-4">
                        <i class="fas fa-bars text-2xl"></i>
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
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 flex items-center">
                                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Konten utama -->
            <main class="flex-1 p-4 overflow-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Toggle sidebar untuk mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenuDropdown = document.getElementById('userMenuDropdown');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSidebar();
        });

        closeSidebar.addEventListener('click', function() {
            toggleSidebar();
        });

        overlay.addEventListener('click', function() {
            toggleSidebar();
        });

        // Tutup sidebar ketika mengklik di luar pada layar mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 768 &&
                !sidebar.contains(e.target) &&
                e.target !== sidebarToggle &&
                !sidebarToggle.contains(e.target)) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    toggleSidebar();
                }
            }
        });

        // Toggle dropdown menu
        userMenuButton.addEventListener('click', function() {
            userMenuDropdown.classList.toggle('hidden');
        });

        // Tutup dropdown ketika mengklik di luar
        document.addEventListener('click', function(event) {
            if (!userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
                userMenuDropdown.classList.add('hidden');
            }
        });

        // Responsif terhadap perubahan ukuran layar
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            } else {
                // Pada mobile, pastikan sidebar tersembunyi secara default
                if (!document.body.classList.contains('sidebar-open')) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            }
        });
    </script>
</body>

</html>
