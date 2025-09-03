@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 md:p-6">
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif
        <div class="bg-white neobrutal-card p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <h3 class="font-extrabold text-lg">FORM EDIT GURU</h3>
                <a href="{{ route('guru.index') }}"
                    class="neobrutal-btn bg-gray-200 text-black px-4 py-1.5 text-sm font-bold border-3 border-black flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    KEMBALI
                </a>
            </div>

            <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Informasi Guru -->
                <div class="mb-8">
                    <h4 class="font-extrabold text-md mb-4 border-b-3 border-black pb-2">INFORMASI GURU</h4>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6">
                        <!-- NIP -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">NIP <span class="text-red-500">*</span></label>
                            <input name="nip" type="text" value="{{ old('nip', $guru->nip) }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                required>
                            @error('nip')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">NAMA LENGKAP <span
                                    class="text-red-500">*</span></label>
                            <input name="nama" type="text" value="{{ old('nama', $guru->nama) }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                required>
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">PASSWORD</label>
                            <input name="password" type="password"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">ROLE <span class="text-red-500">*</span></label>
                            <select name="role"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                required>
                                <option value="admin" {{ old('role', $guru->role) == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="guru" {{ old('role', $guru->role) == 'guru' ? 'selected' : '' }}>Guru
                                </option>
                                <option value="staf" {{ old('role', $guru->role) == 'staf' ? 'selected' : '' }}>Staf
                                </option>
                            </select>
                            @error('role')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">JENIS KELAMIN <span
                                    class="text-red-500">*</span></label>
                            <div class="flex flex-col sm:flex-row sm:space-x-4 gap-2 sm:gap-0">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="L"
                                        {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'checked' : '' }}
                                        class="h-5 w-5 border-3 border-black text-sekolah focus:ring-sekolah">
                                    <span class="ml-2 font-bold">Laki-laki</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="P"
                                        {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'checked' : '' }}
                                        class="h-5 w-5 border-3 border-black text-sekolah focus:ring-sekolah">
                                    <span class="ml-2 font-bold">Perempuan</span>
                                </label>
                            </div>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">STATUS <span class="text-red-500">*</span></label>
                            <select name="status"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                required>
                                <option value="aktif" {{ old('status', $guru->status) == 'aktif' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="cuti" {{ old('status', $guru->status) == 'cuti' ? 'selected' : '' }}>Cuti
                                </option>
                                <option value="keluar" {{ old('status', $guru->status) == 'keluar' ? 'selected' : '' }}>
                                    Keluar</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">TEMPAT LAHIR <span
                                    class="text-red-500">*</span></label>
                            <input name="tempat_lahir" type="text"
                                value="{{ old('tempat_lahir', $guru->tempat_lahir) }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                required>
                            @error('tempat_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">TANGGAL LAHIR <span
                                    class="text-red-500">*</span></label>
                            <input name="tanggal_lahir" type="date"
                                value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                required>
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Agama -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">AGAMA <span class="text-red-500">*</span></label>
                            <select name="agama"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                required>
                                <option value="Islam" {{ old('agama', $guru->agama) == 'Islam' ? 'selected' : '' }}>Islam
                                </option>
                                <option value="Kristen" {{ old('agama', $guru->agama) == 'Kristen' ? 'selected' : '' }}>
                                    Kristen</option>
                                <option value="Katolik" {{ old('agama', $guru->agama) == 'Katolik' ? 'selected' : '' }}>
                                    Katolik</option>
                                <option value="Hindu" {{ old('agama', $guru->agama) == 'Hindu' ? 'selected' : '' }}>Hindu
                                </option>
                                <option value="Buddha" {{ old('agama', $guru->agama) == 'Buddha' ? 'selected' : '' }}>
                                    Buddha</option>
                                <option value="Konghucu" {{ old('agama', $guru->agama) == 'Konghucu' ? 'selected' : '' }}>
                                    Konghucu</option>
                            </select>
                            @error('agama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mata Pelajaran -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">MATA PELAJARAN</label>
                            <input name="mapel" type="text" value="{{ old('mapel', $guru->mapel) }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                            @error('mapel')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Informasi Kontak -->
                <div class="mb-8">
                    <h4 class="font-extrabold text-md mb-4 border-b-3 border-black pb-2">INFORMASI KONTAK</h4>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6">
                        <!-- Alamat -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">ALAMAT</label>
                            <textarea name="alamat" rows="3"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">{{ old('alamat', $guru->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">NO. HP</label>
                            <input name="no_hp" type="text" value="{{ old('no_hp', $guru->no_hp) }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">EMAIL</label>
                            <input name="email" type="email" value="{{ old('email', $guru->email) }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Foto Guru -->
                <div class="mb-8">
                    <h4 class="font-extrabold text-md mb-4 border-b-3 border-black pb-2">FOTO GURU</h4>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">FOTO SAAT INI</label>
                            @if ($guru->foto)
                                <div class="mb-4 flex flex-col items-start">
                                    <img src="{{ Storage::url($guru->foto) }}" alt="Foto Guru"
                                        class="w-32 h-32 object-cover border-2 border-black mb-2">
                                    <p class="text-sm mt-2 font-bold">Nama file: {{ basename($guru->foto) }}</p>
                                </div>
                            @else
                                <p class="text-gray-500 font-bold">Tidak ada foto</p>
                            @endif
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">UPLOAD FOTO BARU</label>
                            <input name="foto" type="file"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                            @error('foto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1 font-bold">Format: JPG/PNG, Maks: 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 sm:space-x-4 pt-4 border-t-3 border-black">
                    <button type="reset"
                        class="neobrutal-btn bg-gray-200 text-black px-6 py-2 font-bold border-3 border-black order-2 sm:order-1">
                        RESET
                    </button>
                    <button type="submit"
                        class="neobrutal-btn bg-sekolah text-white px-6 py-2 font-bold order-1 sm:order-2">
                        UPDATE DATA
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
