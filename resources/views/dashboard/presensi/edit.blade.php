@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 md:p-6">
        <div class="bg-white neobrutal-card p-4 md:p-6">
            <form action="{{ route('presensi.update', $presensi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Filter Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6">
                    <!-- Kelas Filter -->
                    <div>
                        <label class="block font-bold mb-2">Kelas</label>
                        <select id="filter-kelas"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold bg-gray-100"
                            disabled>
                            <option value="{{ $presensi->siswa->kelas->tingkat_kelas }}" selected>
                                {{ $presensi->siswa->kelas->tingkat_kelas }}
                            </option>
                        </select>
                    </div>

                    <!-- Jurusan Filter -->
                    <div>
                        <label class="block font-bold mb-2">Jurusan</label>
                        <select id="filter-jurusan"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold bg-gray-100"
                            disabled>
                            <option value="{{ $presensi->siswa->kelas->jurusan }}" selected>
                                {{ $presensi->siswa->kelas->jurusan }}
                            </option>
                        </select>
                    </div>

                    <!-- Siswa Select -->
                    <div>
                        <label class="block font-bold mb-2">Nama Siswa</label>
                        <input type="text" value="{{ $presensi->siswa->nama }} ({{ $presensi->siswa->nis }})" readonly
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold bg-gray-100">
                        <input type="hidden" name="siswa_id" value="{{ $presensi->siswa_id }}">
                    </div>
                </div>

                <!-- Attendance Data -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
                    <!-- Date Input -->
                    <div>
                        <label class="block font-bold mb-2">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $presensi->tanggal }}" readonly
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold bg-gray-100">
                    </div>

                    <!-- Status Select -->
                    <div>
                        <label class="block font-bold mb-2">Status <span class="text-red-500">*</span></label>
                        <select name="status" required
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                            @foreach (App\Models\Presensi::$statuses as $key => $status)
                                <option value="{{ $key }}" {{ $presensi->status == $key ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Time In -->
                    <div>
                        <label class="block font-bold mb-2">Waktu Masuk</label>
                        <input type="time" name="waktu_masuk" value="{{ $presensi->waktu_masuk }}"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                    </div>

                    <!-- Time Out -->
                    <div>
                        <label class="block font-bold mb-2">Waktu Keluar</label>
                        <input type="time" name="waktu_keluar" value="{{ $presensi->waktu_keluar }}"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                    </div>

                    <!-- Note -->
                    <div class="md:col-span-2">
                        <label class="block font-bold mb-2">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">{{ $presensi->keterangan }}</textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col-reverse md:flex-row justify-end gap-3 md:gap-4">
                    <a href="{{ route('presensi.index') }}"
                        class="neobrutal-btn bg-gray-200 px-4 py-2 md:px-6 md:py-2 font-bold text-center">
                        Batal
                    </a>
                    <button type="submit" class="neobrutal-btn bg-sekolah text-white px-4 py-2 md:px-6 md:py-2 font-bold">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
