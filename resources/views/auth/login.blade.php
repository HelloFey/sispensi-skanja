<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login - SIPRESENSI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <style>
        .neobrutal-card {
            border: 3px solid #000;
            box-shadow: 5px 5px 0px #000;
        }

        .neobrutal-btn {
            border: 3px solid #000;
            box-shadow: 3px 3px 0px #000;
            transition: all 0.2s ease;
        }

        .neobrutal-btn:hover {
            transform: translate(2px, 2px);
            box-shadow: 1px 1px 0px #000;
        }

        .neobrutal-input {
            border: 3px solid #000;
            box-shadow: 3px 3px 0px #000;
        }

        .neobrutal-input:focus {
            outline: none;
            box-shadow: 1px 1px 0px #000;
            transform: translate(2px, 2px);
        }

        .bg-sekolah {
            background-color: #3b82f6;
        }

        .text-sekolah {
            color: #3b82f6;
        }

        .text-siswa {
            color: #10b981;
        }

        .bg-siswa {
            background-color: #10b981;
        }

        .text-guru {
            color: #f59e0b;
        }

        .bg-guru {
            background-color: #f59e0b;
        }

        .text-presensi {
            color: #6366f1;
        }

        .bg-presensi {
            background-color: #6366f1;
        }

        .text-absen {
            color: #ef4444;
        }

        .bg-absen {
            background-color: #ef4444;
        }

        /* Media Queries untuk Responsivitas */
        @media (max-width: 640px) {
            .neobrutal-card {
                border: 2px solid #000;
                box-shadow: 3px 3px 0px #000;
            }

            .neobrutal-input,
            .neobrutal-btn {
                border-width: 2px;
                box-shadow: 2px 2px 0px #000;
            }

            .container-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        @media (max-width: 400px) {
            .logo-container {
                flex-direction: column;
                text-align: center;
            }

            .logo-icon {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }

            .responsive-text {
                font-size: 1.5rem;
            }

            .responsive-subtext {
                font-size: 0.7rem;
            }
        }

        /* Memastikan tombol cukup besar untuk sentuhan */
        @media (min-width: 641px) {
            .neobrutal-btn {
                min-height: 48px;
            }

            .neobrutal-input {
                min-height: 44px;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center p-4 container-padding">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="mb-6 md:mb-8 flex items-center justify-center logo-container">
                <div
                    class="w-14 h-14 md:w-16 md:h-16 rounded-lg flex items-center justify-center mr-3 md:mr-3 border-3 border-black logo-icon">
                    <div class="w-10 h-10 border-3 border-black flex items-center justify-center text-white font-bold">
                        <img src="{{ asset('logo.png') }}" alt="" class="w-10">
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-extrabold responsive-text">SIS<span
                            class="text-sekolah">PENSI</span></h1>
                    <p class="text-xs font-bold text-gray-600 text-center responsive-subtext">SMKN 1 PEJAWARAN</p>
                </div>
            </div>

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 md:p-4 mb-4 text-center text-sm md:text-base"
                    role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            <!-- Login Card -->
            <div class="bg-white neobrutal-card p-6 md:p-8">
                <h2 class="text-lg md:text-xl font-extrabold mb-4 md:mb-6 text-center">MASUK KE SISTEM</h2>

                <form action="{{ route('autentikasi') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="nipd">
                            NIPD
                        </label>
                        <input class="neobrutal-input w-full px-3 py-2 md:px-4 md:py-2 font-bold" id="nisn"
                            type="text" placeholder="NISN" name="nip">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-2" for="password">
                            Kata Sandi
                        </label>
                        <input class="neobrutal-input w-full px-3 py-2 md:px-4 md:py-2 font-bold" id="password"
                            type="password" placeholder="Password" name="password">
                    </div>

                    <button
                        class="neobrutal-btn w-full bg-sekolah text-white font-bold py-3 px-4 mb-4 text-sm md:text-base"
                        type="submit">
                        MASUK
                    </button>

                    <div class="text-center">
                        <p class="text-xs md:text-sm font-bold">
                            Belum punya akun?
                            <a href="https://wa.me/6285183107396" class="text-sekolah hover:underline">Hubungi admin</a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="mt-4 md:mt-6 text-center">
                <p class="text-xs font-bold text-gray-600">
                    &copy; 2025 SISPENSI - SMKN 1 PEJAWARAN. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
