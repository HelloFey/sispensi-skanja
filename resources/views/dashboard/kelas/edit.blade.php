@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 md:p-6">
        <div class="bg-white neobrutal-card p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 md:mb-6 gap-3">
                <h3 class="font-extrabold text-base md:text-lg">EDIT DATA KELAS</h3>
                <a href="{{ route('kelas.index') }}"
                    class="neobrutal-btn bg-gray-200 text-black px-3 py-1 md:px-4 md:py-1.5 text-xs md:text-sm font-bold border-2 md:border-3 border-black flex items-center w-full sm:w-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 mr-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    KEMBALI
                </a>
            </div>

            <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
                    <!-- Tingkat Kelas -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-2">TINGKAT KELAS <span
                                class="text-red-500">*</span></label>
                        <select name="tingkat_kelas" required
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                            <option value="X" {{ $kelas->tingkat_kelas == 'X' ? 'selected' : '' }}>Kelas X</option>
                            <option value="XI" {{ $kelas->tingkat_kelas == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                            <option value="XII" {{ $kelas->tingkat_kelas == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                        </select>
                        @error('tingkat_kelas')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Kelas -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-2">NAMA KELAS <span
                                class="text-red-500">*</span></label>
                        <input name="nama_kelas" type="text" maxlength="50" required
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                            value="{{ old('nama_kelas', $kelas->nama_kelas) }}">
                        @error('nama_kelas')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rombel -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-2">ROMBEL <span
                                class="text-red-500">*</span></label>
                        <select name="rombel" required
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                            @for ($i = 1; $i <= 3; $i++)
                                <option value="{{ $i }}" {{ $kelas->rombel == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        @error('rombel')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jurusan -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-2">JURUSAN <span
                                class="text-red-500">*</span></label>
                        <select name="jurusan" required
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                            <option value="Rekayasa Perangkat Lunak"
                                {{ $kelas->jurusan == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat
                                Lunak</option>
                            <option value="Teknik Kendaraan Ringan"
                                {{ $kelas->jurusan == 'Teknik Kendaraan Ringan' ? 'selected' : '' }}>Teknik Kendaraan
                                Ringan</option>
                            <option value="Bisnis Daring Pemasaran"
                                {{ $kelas->jurusan == 'Bisnis Daring Pemasaran' ? 'selected' : '' }}>Bisnis Daring
                                Pemasaran</option>
                        </select>
                        @error('jurusan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tahun Ajar -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-2">TAHUN AJAR <span
                                class="text-red-500">*</span></label>
                        <select name="tahun_ajar" required
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                            <option value="{{ old('tahun_ajar', $kelas->tahun_ajar) }}">{{ old('tahun_ajar', $kelas->tahun_ajar)}}</option>
                            @php
                                $startYear = 2023;
                                $endYear = 2030; // Until 2030/2031

                                for ($year = $startYear; $year <= $endYear; $year++) {
                                    echo "<option value='$year/" . ($year + 1) . "'>$year/" . ($year + 1) . '</option>';
                                }
                            @endphp
                        </select>
                        @error('tahun_ajar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Wali Kelas -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-2">WALI KELAS<span
                                class="text-red-500">*</span></label>
                        <select name="wali_kelas"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                            <option value="">Pilih Guru</option>
                            @foreach ($guru as $g)
                                <option value="{{ $g->nama }}"
                                    {{ old('wali_kelas', $kelas->wali_kelas ?? '') == $g->nama ? 'selected' : '' }}>
                                    {{ $g->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('wali_kelas')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div
                    class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-4 border-t-2 md:border-t-3 border-black">
                    <button type="reset"
                        class="neobrutal-btn bg-gray-200 text-black px-4 py-2 md:px-6 md:py-2 font-bold border-2 md:border-3 border-black text-sm md:text-base order-2 sm:order-1">
                        RESET
                    </button>
                    <button type="submit"
                        class="neobrutal-btn bg-sekolah text-white px-4 py-2 md:px-6 md:py-2 font-bold text-sm md:text-base order-1 sm:order-2">
                        UPDATE DATA
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
