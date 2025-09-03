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
                <h3 class="font-extrabold text-lg">FORM TAMBAH GURU</h3>
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

            <form action="{{ route('guru.store') }}" method="POST">
                @csrf
                <!-- Teacher Information Section -->
                <div class="mb-8">
                    <h4 class="font-extrabold text-md mb-4 border-b-3 border-black pb-2">INFORMASI GURU</h4>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6">
                        <!-- NIP -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">NIP <span class="text-red-500">*</span></label>
                            <input name="nip" type="text" maxlength="20" value="{{ old('nip') }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                placeholder="Masukkan NIP" required>
                            @error('nip')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Name -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">NAMA LENGKAP <span
                                    class="text-red-500">*</span></label>
                            <input name="nama" type="text" maxlength="30" value="{{ old('nama') }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                placeholder="Masukkan nama lengkap" required>
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">PASSWORD <span class="text-red-500">*</span></label>
                            <input name="password" type="password"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                placeholder="Masukkan password" required>
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
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="staf" {{ old('role') == 'staf' ? 'selected' : '' }}>Staf</option>
                            </select>
                            @error('role')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">JENIS KELAMIN <span
                                    class="text-red-500">*</span></label>
                            <div class="flex flex-col sm:flex-row sm:space-x-4 gap-2 sm:gap-0">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="L"
                                        {{ old('jenis_kelamin', 'L') == 'L' ? 'checked' : '' }}
                                        class="h-5 w-5 border-3 border-black text-sekolah focus:ring-sekolah">
                                    <span class="ml-2 font-bold">Laki-laki</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="P"
                                        {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}
                                        class="h-5 w-5 border-3 border-black text-sekolah focus:ring-sekolah">
                                    <span class="ml-2 font-bold">Perempuan</span>
                                </label>
                            </div>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Birth Place -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">TEMPAT LAHIR <span
                                    class="text-red-500">*</span></label>
                            <input name="tempat_lahir" type="text" maxlength="30" value="{{ old('tempat_lahir') }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                placeholder="Kota kelahiran" required>
                            @error('tempat_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Birth Date -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">TANGGAL LAHIR <span
                                    class="text-red-500">*</span></label>
                            <input name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir') }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                required>
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Religion -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">AGAMA <span class="text-red-500">*</span></label>
                            <select name="agama"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                </option>
                            </select>
                            @error('agama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">MATA PELAJARAN</label>
                            <input name="mapel" type="text" maxlength="50" value="{{ old('mapel') }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                placeholder="Mata pelajaran yang diajar">
                            @error('mapel')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="mb-8">
                    <h4 class="font-extrabold text-md mb-4 border-b-3 border-black pb-2">INFORMASI KONTAK</h4>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6">
                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">ALAMAT LENGKAP</label>
                            <textarea name="alamat" rows="3" maxlength="255"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">NO. HP</label>
                            <input name="no_hp" type="tel" maxlength="15" value="{{ old('no_hp') }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                placeholder="081234567890">
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">EMAIL</label>
                            <input name="email" type="email" maxlength="100" value="{{ old('email') }}"
                                class="w-full px-4 py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah"
                                placeholder="guru@email.com">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
                        SIMPAN DATA
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
