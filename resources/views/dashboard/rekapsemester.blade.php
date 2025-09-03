@extends('dashboard.layouts.app')
@section('content')
    <!-- Main Content -->
    <main class="p-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold">REKAP PRESENSI PER SEMESTER</h1>
            <div class="flex space-x-4">
                <select class="neobrutal-select border-3 border-black px-4 py-2 font-bold">
                    <option>Semester 1</option>
                    <option>Semester 2</option>
                </select>
                <select class="neobrutal-select border-3 border-black px-4 py-2 font-bold">
                    <option>Tahun Ajaran 2023/2024</option>
                    <option>Tahun Ajaran 2022/2023</option>
                </select>
                <button class="neobrutal-btn bg-sekolah text-white px-6 py-2 text-sm font-bold">
                    FILTER
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-bold">TOTAL HADIR</p>
                        <h3 class="text-3xl font-extrabold mt-2 text-green-600">12,450</h3>
                        <p class="text-gray-500 text-sm mt-2">82% dari total</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-md border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-bold">TOTAL IZIN</p>
                        <h3 class="text-3xl font-extrabold mt-2 text-yellow-600">1,240</h3>
                        <p class="text-gray-500 text-sm mt-2">8% dari total</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-md border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-bold">TOTAL SAKIT</p>
                        <h3 class="text-3xl font-extrabold mt-2 text-blue-600">980</h3>
                        <p class="text-gray-500 text-sm mt-2">6% dari total</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-md border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 neobrutal-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-bold">TOTAL ALPA</p>
                        <h3 class="text-3xl font-extrabold mt-2 text-red-600">1,330</h3>
                        <p class="text-gray-500 text-sm mt-2">9% dari total</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-md border-3 border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 neobrutal-card lg:col-span-2">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-extrabold text-lg">GRAFIK PRESENSI PER BULAN</h3>
                    <button class="neobrutal-btn bg-sekolah text-white px-4 py-1.5 text-sm font-bold">
                        EKSPOR GRAFIK
                    </button>
                </div>
                <div class="h-80 bg-gray-100 border-3 border-black flex items-center justify-center">
                    <!-- Chart placeholder -->
                    <p class="text-gray-500 font-bold">GRAFIK PRESENSI PER BULAN</p>
                </div>
            </div>

            <div class="bg-white p-6 neobrutal-card">
                <h3 class="font-extrabold text-lg mb-6">KELAS DENGAN PRESENSI TERBAIK</h3>
                <div class="space-y-4">
                    <div class="flex items-center p-3 bg-green-50 border-2 border-black">
                        <div class="w-12 h-12 bg-green-100 rounded-md border-3 border-black mr-4 flex items-center justify-center font-bold text-green-800">
                            1
                        </div>
                        <div class="flex-1">
                            <p class="font-extrabold">XII RPL 1</p>
                            <p class="text-sm font-bold text-gray-600">95% kehadiran</p>
                        </div>
                        <span class="bg-green-100 text-green-800 text-sm font-bold px-2 py-1 rounded border-2 border-black">★</span>
                    </div>

                    <div class="flex items-center p-3 bg-blue-50 border-2 border-black">
                        <div class="w-12 h-12 bg-blue-100 rounded-md border-3 border-black mr-4 flex items-center justify-center font-bold text-blue-800">
                            2
                        </div>
                        <div class="flex-1">
                            <p class="font-extrabold">XI TKJ 3</p>
                            <p class="text-sm font-bold text-gray-600">93% kehadiran</p>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-sm font-bold px-2 py-1 rounded border-2 border-black">★</span>
                    </div>

                    <div class="flex items-center p-3 bg-yellow-50 border-2 border-black">
                        <div class="w-12 h-12 bg-yellow-100 rounded-md border-3 border-black mr-4 flex items-center justify-center font-bold text-yellow-800">
                            3
                        </div>
                        <div class="flex-1">
                            <p class="font-extrabold">X MM 2</p>
                            <p class="text-sm font-bold text-gray-600">91% kehadiran</p>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 text-sm font-bold px-2 py-1 rounded border-2 border-black">★</span>
                    </div>

                    <div class="text-center mt-4">
                        <button class="neobrutal-btn bg-sekolah text-white px-4 py-1.5 text-sm font-bold">
                            LIHAT SEMUA KELAS
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Table -->
        <div class="bg-white p-6 neobrutal-card mb-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-extrabold text-lg">DETAIL REKAP PER KELAS</h3>
                <button class="neobrutal-btn bg-sekolah text-white px-4 py-1.5 text-sm font-bold">
                    EKSPOR DATA
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b-3 border-black">
                            <th class="text-left py-4 px-4 font-extrabold">KELAS</th>
                            <th class="text-left py-4 px-4 font-extrabold">WALI KELAS</th>
                            <th class="text-left py-4 px-4 font-extrabold">HADIR</th>
                            <th class="text-left py-4 px-4 font-extrabold">IZIN</th>
                            <th class="text-left py-4 px-4 font-extrabold">SAKIT</th>
                            <th class="text-left py-4 px-4 font-extrabold">ALPA</th>
                            <th class="text-left py-4 px-4 font-extrabold">PERSENTASE</th>
                            <th class="text-left py-4 px-4 font-extrabold">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b-2 border-gray-200">
                            <td class="py-4 px-4 font-bold">XII RPL 1</td>
                            <td class="py-4 px-4 font-bold">Budi Santoso, S.Kom</td>
                            <td class="py-4 px-4 font-bold">1,140</td>
                            <td class="py-4 px-4 font-bold">45</td>
                            <td class="py-4 px-4 font-bold">32</td>
                            <td class="py-4 px-4 font-bold">23</td>
                            <td class="py-4 px-4">
                                <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded border-2 border-black">95%</span>
                            </td>
                            <td class="py-4 px-4">
                                <button class="neobrutal-btn-small bg-sekolah text-white px-3 py-0.5 text-xs font-bold">
                                    DETAIL
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b-2 border-gray-200">
                            <td class="py-4 px-4 font-bold">XI TKJ 3</td>
                            <td class="py-4 px-4 font-bold">Dewi Anggraeni, S.T</td>
                            <td class="py-4 px-4 font-bold">1,120</td>
                            <td class="py-4 px-4 font-bold">50</td>
                            <td class="py-4 px-4 font-bold">40</td>
                            <td class="py-4 px-4 font-bold">30</td>
                            <td class="py-4 px-4">
                                <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded border-2 border-black">93%</span>
                            </td>
                            <td class="py-4 px-4">
                                <button class="neobrutal-btn-small bg-sekolah text-white px-3 py-0.5 text-xs font-bold">
                                    DETAIL
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b-2 border-gray-200">
                            <td class="py-4 px-4 font-bold">X MM 2</td>
                            <td class="py-4 px-4 font-bold">Rina Wijayanti, S.Sn</td>
                            <td class="py-4 px-4 font-bold">1,080</td>
                            <td class="py-4 px-4 font-bold">60</td>
                            <td class="py-4 px-4 font-bold">45</td>
                            <td class="py-4 px-4 font-bold">45</td>
                            <td class="py-4 px-4">
                                <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded border-2 border-black">91%</span>
                            </td>
                            <td class="py-4 px-4">
                                <button class="neobrutal-btn-small bg-sekolah text-white px-3 py-0.5 text-xs font-bold">
                                    DETAIL
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4 px-4 font-bold">XII TKJ 2</td>
                            <td class="py-4 px-4 font-bold">Ahmad Fauzi, S.Kom</td>
                            <td class="py-4 px-4 font-bold">980</td>
                            <td class="py-4 px-4 font-bold">75</td>
                            <td class="py-4 px-4 font-bold">50</td>
                            <td class="py-4 px-4 font-bold">85</td>
                            <td class="py-4 px-4">
                                <span class="bg-yellow-100 text-yellow-800 text-sm font-bold px-3 py-1 rounded border-2 border-black">82%</span>
                            </td>
                            <td class="py-4 px-4">
                                <button class="neobrutal-btn-small bg-sekolah text-white px-3 py-0.5 text-xs font-bold">
                                    DETAIL
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Monthly Summary -->
        <div class="bg-white p-6 neobrutal-card">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-extrabold text-lg">REKAP BULANAN</h3>
                <button class="neobrutal-btn bg-sekolah text-white px-4 py-1.5 text-sm font-bold">
                    EKSPOR LAPORAN
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b-3 border-black">
                            <th class="text-left py-4 px-4 font-extrabold">BULAN</th>
                            <th class="text-left py-4 px-4 font-extrabold">HARI SEKOLAH</th>
                            <th class="text-left py-4 px-4 font-extrabold">HADIR</th>
                            <th class="text-left py-4 px-4 font-extrabold">IZIN</th>
                            <th class="text-left py-4 px-4 font-extrabold">SAKIT</th>
                            <th class="text-left py-4 px-4 font-extrabold">ALPA</th>
                            <th class="text-left py-4 px-4 font-extrabold">RATA-RATA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b-2 border-gray-200">
                            <td class="py-4 px-4 font-bold">Juli 2023</td>
                            <td class="py-4 px-4 font-bold">20</td>
                            <td class="py-4 px-4 font-bold">2,450</td>
                            <td class="py-4 px-4 font-bold">210</td>
                            <td class="py-4 px-4 font-bold">180</td>
                            <td class="py-4 px-4 font-bold">160</td>
                            <td class="py-4 px-4">
                                <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded border-2 border-black">85%</span>
                            </td>
                        </tr>
                        <tr class="border-b-2 border-gray-200">
                            <td class="py-4 px-4 font-bold">Agustus 2023</td>
                            <td class="py-4 px-4 font-bold">22</td>
                            <td class="py-4 px-4 font-bold">2,680</td>
                            <td class="py-4 px-4 font-bold">190</td>
                            <td class="py-4 px-4 font-bold">150</td>
                            <td class="py-4 px-4 font-bold">120</td>
                            <td class="py-4 px-4">
                                <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded border-2 border-black">88%</span>
                            </td>
                        </tr>
                        <tr class="border-b-2 border-gray-200">
                            <td class="py-4 px-4 font-bold">September 2023</td>
                            <td class="py-4 px-4 font-bold">21</td>
                            <td class="py-4 px-4 font-bold">2,520</td>
                            <td class="py-4 px-4 font-bold">200</td>
                            <td class="py-4 px-4 font-bold">170</td>
                            <td class="py-4 px-4 font-bold">110</td>
                            <td class="py-4 px-4">
                                <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded border-2 border-black">87%</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4 px-4 font-bold">Oktober 2023</td>
                            <td class="py-4 px-4 font-bold">23</td>
                            <td class="py-4 px-4 font-bold">2,750</td>
                            <td class="py-4 px-4 font-bold">220</td>
                            <td class="py-4 px-4 font-bold">180</td>
                            <td class="py-4 px-4 font-bold">150</td>
                            <td class="py-4 px-4">
                                <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded border-2 border-black">89%</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection