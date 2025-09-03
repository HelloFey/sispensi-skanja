@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 sm:p-6">
        <div class="bg-white neobrutal-card p-4 sm:p-6">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <h3 class="font-extrabold text-base sm:text-lg">DETAIL KELAS</h3>
                <a href="{{ route('kelas.index') }}"
                    class="neobrutal-btn bg-gray-200 text-black px-3 py-1.5 sm:px-4 sm:py-1.5 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black flex items-center self-start sm:self-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 mr-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    KEMBALI
                </a>
            </div>

            <!-- Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <!-- Informasi Utama -->
                <div>
                    <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md mb-4 sm:mb-6">
                        <h4
                            class="font-extrabold text-sm sm:text-md mb-3 sm:mb-4 border-b-2 sm:border-b-3 border-black pb-2">
                            INFORMASI KELAS</h4>
                        <div class="space-y-3 sm:space-y-4">
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">TINGKAT KELAS</p>
                                <p class="font-bold text-base sm:text-lg">{{ $kelas->tingkat_kelas }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">NAMA KELAS</p>
                                <p class="font-bold text-base sm:text-lg">{{ $kelas->nama_kelas }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">ROMBEL</p>
                                <p class="font-bold text-base sm:text-lg">{{ $kelas->rombel }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div>
                    <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md mb-4 sm:mb-6">
                        <h4
                            class="font-extrabold text-sm sm:text-md mb-3 sm:mb-4 border-b-2 sm:border-b-3 border-black pb-2">
                            INFORMASI LAINNYA</h4>
                        <div class="space-y-3 sm:space-y-4">
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">JURUSAN</p>
                                <p class="font-bold text-base sm:text-lg">{{ $kelas->jurusan }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">TAHUN AJARAN</p>
                                <p class="font-bold text-base sm:text-lg">{{ $kelas->tahun_ajar }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-600">WALI KELAS</p>
                                <p class="font-bold text-base sm:text-lg">{{ $kelas->wali_kelas ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Siswa -->
            <div class="border-2 sm:border-3 border-black p-3 sm:p-4 rounded-md mb-6">
                <h4 class="font-extrabold text-sm sm:text-md mb-3 sm:mb-4 border-b-2 sm:border-b-3 border-black pb-2">DAFTAR
                    SISWA</h4>
                @if ($kelas->siswas->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b-2 border-black">
                                    <th class="text-left py-2 px-2 sm:py-3 sm:px-4 font-extrabold text-xs sm:text-sm">NO
                                    </th>
                                    <th class="text-left py-2 px-2 sm:py-3 sm:px-4 font-extrabold text-xs sm:text-sm">NIS
                                    </th>
                                    <th class="text-left py-2 px-2 sm:py-3 sm:px-4 font-extrabold text-xs sm:text-sm">NAMA
                                        SISWA</th>
                                    <th class="text-left py-2 px-2 sm:py-3 sm:px-4 font-extrabold text-xs sm:text-sm">STATUS
                                    </th>
                                    <th class="text-left py-2 px-2 sm:py-3 sm:px-4 font-extrabold text-xs sm:text-sm">AKSI
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas->siswas as $index => $siswa)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="py-2 px-2 sm:py-3 sm:px-4 font-bold text-xs sm:text-sm">
                                            {{ $index + 1 }}</td>
                                        <td class="py-2 px-2 sm:py-3 sm:px-4 font-bold text-xs sm:text-sm">
                                            {{ $siswa->nis }}</td>
                                        <td class="py-2 px-2 sm:py-3 sm:px-4 font-bold text-xs sm:text-sm">
                                            {{ $siswa->nama }}</td>
                                        <td class="py-2 px-2 sm:py-3 sm:px-4">
                                            <span
                                                class="px-2 py-0.5 sm:px-3 sm:py-1 rounded-full border border-black sm:border-2 font-bold text-xs
                                                @if ($siswa->status == 'aktif') bg-green-100 text-green-800
                                                @elseif($siswa->status == 'pindah') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ strtoupper($siswa->status) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-2 sm:py-3 sm:px-4 font-bold text-xs sm:text-sm">
                                            <div class="flex gap-1 sm:gap-2">
                                                <a href="{{ route('siswa.show', [$siswa->id]) }}"
                                                    class="p-1 sm:p-1.5 border-2 border-black rounded-md bg-blue-100 text-blue-800 hover:bg-blue-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-3.5 w-3.5 sm:h-4 sm:w-4 md:h-5 md:w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>

                                                @if (auth()->user()->role !== 'guru')
                                                    <a href="{{ route('siswa.edit', [$siswa->id]) }}"
                                                        class="p-1 sm:p-1.5 border-2 border-black rounded-md bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-3.5 w-3.5 sm:h-4 sm:w-4 md:h-5 md:w-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    {{-- <form action="{{ route('siswa.destroy', [$siswa->id]) }}"
                                                        method="POST"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-1 sm:p-1.5 border-2 border-black rounded-md bg-red-100 text-red-800 hover:bg-red-200">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-3.5 w-3.5 sm:h-4 sm:w-4 md:h-5 md:w-5"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form> --}}
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center py-3 sm:py-4 font-bold text-sm sm:text-base">Belum ada siswa di kelas ini</p>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-4 pt-4 border-t-2 sm:border-t-3 border-black">
                <a href="{{ route('siswa.create') }}"
                    class="neobrutal-btn bg-blue-400 text-black px-4 py-1.5 sm:px-6 sm:py-2 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black text-center">
                    TAMBAH SISWA
                </a>
                <a href="{{ route('kelas.edit', $kelas->id) }}"
                    class="neobrutal-btn bg-yellow-400 text-black px-4 py-1.5 sm:px-6 sm:py-2 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black text-center">
                    EDIT DATA
                </a>
                <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="neobrutal-btn bg-red-500 text-white px-4 py-1.5 sm:px-6 sm:py-2 text-xs sm:text-sm font-bold border-2 sm:border-3 border-black w-full"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                        HAPUS KELAS
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection
