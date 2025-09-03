@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 md:p-6">
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white neobrutal-card p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 md:mb-6 gap-3">
                <h3 class="font-extrabold text-base md:text-lg">FORM EDIT SISWA</h3>
                <a href="/siswa"
                    class="neobrutal-btn bg-gray-200 text-black px-3 py-1.5 md:px-4 md:py-1.5 text-xs md:text-sm font-bold border-2 md:border-3 border-black flex items-center w-full sm:w-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 mr-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    KEMBALI
                </a>
            </div>

            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Student Information Section -->
                <div class="mb-6 md:mb-8">
                    <h4 class="font-extrabold text-sm md:text-md mb-3 md:mb-4 border-b-2 md:border-b-3 border-black pb-2">
                        INFORMASI SISWA</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <!-- NISN -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">NISN <span
                                    class="text-red-500">*</span></label>
                            <input name="nisn" type="text" maxlength="20" value="{{ old('nisn', $siswa->nisn) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="Masukkan NISN">
                            @error('nisn')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- NIS -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">NIS <span
                                    class="text-red-500">*</span></label>
                            <input name="nis" type="text" maxlength="20" value="{{ old('nis', $siswa->nis) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="Masukkan NIS">
                            @error('nis')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Full Name -->
                        <div class="md:col-span-2">
                            <label class="block text-xs md:text-sm font-bold mb-2">NAMA LENGKAP <span
                                    class="text-red-500">*</span></label>
                            <input name="nama" type="text" maxlength="30" value="{{ old('nama', $siswa->nama) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="Masukkan nama lengkap" required>
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="md:col-span-2">
                            <label class="block text-xs md:text-sm font-bold mb-2">JENIS KELAMIN <span
                                    class="text-red-500">*</span></label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="L"
                                        class="h-4 w-4 md:h-5 md:w-5 border-2 md:border-3 border-black text-sekolah focus:ring-sekolah"
                                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                    <span class="ml-2 font-bold text-sm md:text-base">Laki-laki</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="P"
                                        class="h-4 w-4 md:h-5 md:w-5 border-2 md:border-3 border-black text-sekolah focus:ring-sekolah"
                                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                                    <span class="ml-2 font-bold text-sm md:text-base">Perempuan</span>
                                </label>
                            </div>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Birth Place -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">TEMPAT LAHIR <span
                                    class="text-red-500">*</span></label>
                            <input name="tempat_lahir" type="text" maxlength="30"
                                value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="Kota kelahiran">
                            @error('tempat_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Birth Date -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">TANGGAL LAHIR <span
                                    class="text-red-500">*</span></label>
                            <input name="tanggal_lahir" type="date"
                                value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Religion -->
                        <div class="md:col-span-2">
                            <label class="block text-xs md:text-sm font-bold mb-2">AGAMA <span
                                    class="text-red-500">*</span></label>
                            <select name="agama"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam" {{ old('agama', $siswa->agama) == 'Islam' ? 'selected' : '' }}>Islam
                                </option>
                                <option value="Kristen" {{ old('agama', $siswa->agama) == 'Kristen' ? 'selected' : '' }}>
                                    Kristen</option>
                                <option value="Katolik" {{ old('agama', $siswa->agama) == 'Katolik' ? 'selected' : '' }}>
                                    Katolik</option>
                                <option value="Hindu" {{ old('agama', $siswa->agama) == 'Hindu' ? 'selected' : '' }}>Hindu
                                </option>
                                <option value="Buddha" {{ old('agama', $siswa->agama) == 'Buddha' ? 'selected' : '' }}>
                                    Buddha</option>
                                <option value="Konghucu" {{ old('agama', $siswa->agama) == 'Konghucu' ? 'selected' : '' }}>
                                    Konghucu</option>
                            </select>
                            @error('agama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Class Information Section -->
                <div class="mb-6 md:mb-8">
                    <h4 class="font-extrabold text-sm md:text-md mb-3 md:mb-4 border-b-2 md:border-b-3 border-black pb-2">
                        INFORMASI KELAS</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <!-- Select Existing Class -->
                        <div class="md:col-span-2">
                            <label class="block text-xs md:text-sm font-bold mb-2">KELAS <span
                                    class="text-red-500">*</span></label>
                            <select name="kelas_id"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}"
                                        {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>
                                        {{ $k->tingkat_kelas }} {{ $k->jurusan }} {{ $k->rombel }}
                                        ({{ $k->tahun_ajar }})
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">STATUS <span
                                    class="text-red-500">*</span></label>
                            <select name="status"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                required>
                                <option value="aktif" {{ old('status', $siswa->status) == 'aktif' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="pindah" {{ old('status', $siswa->status) == 'pindah' ? 'selected' : '' }}>
                                    Pindah</option>
                                <option value="keluar" {{ old('status', $siswa->status) == 'keluar' ? 'selected' : '' }}>
                                    Keluar</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Poin -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">POIN</label>
                            <input name="poin" type="number" value="{{ old('poin', $siswa->poin) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                            @error('poin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="mb-6 md:mb-8">
                    <h4 class="font-extrabold text-sm md:text-md mb-3 md:mb-4 border-b-2 md:border-b-3 border-black pb-2">
                        INFORMASI KONTAK</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label class="block text-xs md:text-sm font-bold mb-2">ALAMAT LENGKAP</label>
                            <textarea name="alamat" rows="3" maxlength="255"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="Masukkan alamat lengkap">{{ old('alamat', $siswa->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">NO. HP</label>
                            <input name="no_hp" type="tel" maxlength="15"
                                value="{{ old('no_hp', $siswa->no_hp) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="081234567890">
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">EMAIL</label>
                            <input name="email" type="email" maxlength="100"
                                value="{{ old('email', $siswa->email) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="siswa@email.com">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Parent Information Section -->
                <div class="mb-6 md:mb-8">
                    <h4 class="font-extrabold text-sm md:text-md mb-3 md:mb-4 border-b-2 md:border-b-3 border-black pb-2">
                        INFORMASI ORANG TUA</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <!-- Father's Name -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">NAMA AYAH</label>
                            <input name="nama_ayah" type="text" maxlength="30"
                                value="{{ old('nama_ayah', $siswa->nama_ayah) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="Nama ayah">
                            @error('nama_ayah')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mother's Name -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">NAMA IBU</label>
                            <input name="nama_ibu" type="text" maxlength="30"
                                value="{{ old('nama_ibu', $siswa->nama_ibu) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="Nama ibu">
                            @error('nama_ibu')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Parent Phone -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">NO. HP ORANG TUA</label>
                            <input name="no_hp_ortu" type="tel" maxlength="15"
                                value="{{ old('no_hp_ortu', $siswa->no_hp_ortu) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="081234567890">
                            @error('no_hp_ortu')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Parent Job -->
                        <div>
                            <label class="block text-xs md:text-sm font-bold mb-2">PEKERJAAN ORANG TUA</label>
                            <input name="pekerjaan_ortu" type="text" maxlength="30"
                                value="{{ old('pekerjaan_ortu', $siswa->pekerjaan_ortu) }}"
                                class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base"
                                placeholder="Pekerjaan orang tua">
                            @error('pekerjaan_ortu')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Photo Upload Section -->
                <div class="mb-6 md:mb-8">
                    <h4 class="font-extrabold text-sm md:text-md mb-3 md:mb-4 border-b-2 md:border-b-3 border-black pb-2">
                        FOTO SISWA</h4>

                    <!-- Current Photo -->
                    @if ($siswa->foto)
                        <div class="mb-4">
                            <label class="block text-xs md:text-sm font-bold mb-2">FOTO SAAT INI</label>
                            <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa"
                                class="h-24 w-24 md:h-32 md:w-32 object-cover border-2 md:border-3 border-black">
                        </div>
                    @endif

                    <!-- Photo Upload -->
                    <div>
                        <label class="block text-xs md:text-sm font-bold mb-2">UPLOAD FOTO BARU</label>
                        <input name="foto" type="file"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-2 md:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm md:text-base">
                        @error('foto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG, Maks: 2MB</p>
                    </div>
                </div>

                <!-- Form Actions -->
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
