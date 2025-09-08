{{-- resources/views/errors/404.blade.php --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <main class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white p-6 md:p-10 neobrutal-card text-center max-w-lg w-full rounded-2xl shadow-md">
            <h1 class="text-6xl sm:text-8xl md:text-9xl font-extrabold text-red-600">404</h1>
            <p class="mt-4 text-sm sm:text-base md:text-lg font-bold text-gray-700 leading-relaxed">
                Oops! Halaman yang kamu cari tidak ditemukan.
            </p>
            <p class="mt-2 text-xs sm:text-sm text-gray-500 leading-relaxed">
                Coba periksa kembali URL atau kembali ke dashboard.
            </p>
            <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ url()->previous() }}"
                    class="neobrutal-btn bg-gray-200 px-4 py-2 text-sm md:text-base font-bold w-full sm:w-auto text-center">
                    ⬅ Kembali
                </a>
                <a href="{{ route('dashboard') }}"
                    class="neobrutal-btn bg-sekolah text-white px-4 py-2 text-sm md:text-base font-bold w-full sm:w-auto text-center">
                    🏠 Dashboard
                </a>
            </div>
        </div>
    </main>
</body>
