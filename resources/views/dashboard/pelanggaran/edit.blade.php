@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 sm:p-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white neobrutal-card p-4 sm:p-6 mb-4 sm:mb-6">
            <h2 class="text-xl sm:text-2xl font-extrabold mb-4 sm:mb-6">EDIT PELANGGARAN</h2>

            <!-- Form Pelanggaran -->
            <form action="{{ route('pelanggaran.update', $pelanggaran->id) }}" method="POST" id="form-pelanggaran"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-4 sm:mb-6">
                    <!-- Filter Kelas -->
                    <div class="sm:col-span-2 lg:col-span-1">
                        <label class="block font-bold mb-2 text-sm sm:text-base">Kelas</label>
                        <select id="filter-kelas"
                            class="w-full px-3 sm:px-4 py-2 border-2 sm:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelasList as $kelas)
                                @if ($kelas->siswas->isNotEmpty())
                                    <option value="{{ $kelas->id }}" data-jurusan="{{ $kelas->jurusan }}"
                                        data-siswa="{{ $kelas->siswas->map(function ($s) {
                                                return ['id' => $s->id, 'nis' => $s->nis, 'nama' => $s->nama];
                                            })->toJson() }}"
                                        {{ $pelanggaran->siswa->kelas_id == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->tingkat_kelas }} {{ $kelas->jurusan }} {{ $kelas->rombel }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Jurusan Info -->
                    <div>
                        <label class="block font-bold mb-2 text-sm sm:text-base">Jurusan</label>
                        <input type="text" id="jurusan-info" readonly
                            class="w-full px-3 sm:px-4 py-2 border-2 sm:border-3 border-black rounded-md font-bold bg-gray-100 text-sm sm:text-base"
                            value="{{ $pelanggaran->siswa->kelas->jurusan ?? '' }}">
                    </div>

                    <!-- Tanggal Pelanggaran -->
                    <div>
                        <label class="block font-bold mb-2 text-sm sm:text-base">Tanggal Pelanggaran</label>
                        <input type="date" name="tanggal" value="{{ $pelanggaran->tanggal->format('Y-m-d') }}" required
                            class="w-full px-3 sm:px-4 py-2 border-2 sm:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">
                    </div>
                </div>

                <div class="bg-white neobrutal-card p-4 sm:p-6 mb-4 sm:mb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">
                        <!-- Nama Pelanggaran -->
                        <div class="sm:col-span-2">
                            <label class="block font-bold mb-2 text-sm sm:text-base">Nama Pelanggaran</label>
                            <input type="text" name="nama_pelanggaran" value="{{ $pelanggaran->nama_pelanggaran }}"
                                required
                                class="w-full px-3 sm:px-4 py-2 border-2 sm:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label class="block font-bold mb-2 text-sm sm:text-base">Kategori</label>
                            <select name="kategori" required
                                class="w-full px-3 sm:px-4 py-2 border-2 sm:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">
                                <option value="ringan" {{ $pelanggaran->kategori == 'ringan' ? 'selected' : '' }}>Ringan
                                </option>
                                <option value="sedang" {{ $pelanggaran->kategori == 'sedang' ? 'selected' : '' }}>Sedang
                                </option>
                                <option value="berat" {{ $pelanggaran->kategori == 'berat' ? 'selected' : '' }}>Berat
                                </option>
                            </select>
                        </div>

                        <!-- Poin -->
                        <div>
                            <label class="block font-bold mb-2 text-sm sm:text-base">Poin</label>
                            <input type="number" name="poin" value="{{ $pelanggaran->poin }}" required min="1"
                                class="w-full px-3 sm:px-4 py-2 border-2 sm:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">
                        </div>

                        <!-- Waktu -->
                        <div>
                            <label class="block font-bold mb-2 text-sm sm:text-base">Waktu Kejadian</label>
                            <input type="time" name="waktu"
                                value="{{ $pelanggaran->waktu ? \Carbon\Carbon::parse($pelanggaran->waktu)->format('H:i') : '' }}"
                                class="w-full px-3 sm:px-4 py-2 border-2 sm:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">
                        </div>

                        <!-- Bukti Foto -->
                        <div class="sm:col-span-2">
                            <label class="block font-bold mb-2 text-sm sm:text-base">Bukti Foto</label>
                            @if ($pelanggaran->bukti_foto)
                                <div class="mb-3 sm:mb-4">
                                    <img src="{{ Storage::url($pelanggaran->bukti_foto) }}" alt="Bukti Pelanggaran"
                                        class="max-w-full sm:max-w-xs border border-black sm:border-2">
                                    <div class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="hapus_foto" class="border-2 border-black w-4 h-4">
                                            <span class="ml-2 font-bold text-xs sm:text-sm">Hapus foto saat disimpan</span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                            <input type="file" name="bukti_foto"
                                class="w-full px-3 sm:px-4 py-2 border-2 sm:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">
                        </div>
                    </div>

                    <div class="mb-4 sm:mb-6">
                        <label class="block font-bold mb-2 text-sm sm:text-base">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full px-3 sm:px-4 py-2 border-2 sm:border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah text-sm sm:text-base">{{ $pelanggaran->keterangan }}</textarea>
                    </div>
                </div>

                <!-- Daftar Siswa -->
                <div class="bg-white neobrutal-card p-4 sm:p-6">
                    <h3 class="text-lg sm:text-xl font-extrabold mb-3 sm:mb-4">DAFTAR SISWA</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full" id="tabel-siswa">
                            <thead>
                                <tr class="border-b-2 sm:border-b-3 border-black">
                                    <th class="text-left py-2 sm:py-3 px-2 sm:px-4 font-extrabold text-xs sm:text-sm">NO
                                    </th>
                                    <th class="text-left py-2 sm:py-3 px-2 sm:px-4 font-extrabold text-xs sm:text-sm">NIS
                                    </th>
                                    <th class="text-left py-2 sm:py-3 px-2 sm:px-4 font-extrabold text-xs sm:text-sm">NAMA
                                        SISWA</th>
                                    <th class="text-left py-2 sm:py-3 px-2 sm:px-4 font-extrabold text-xs sm:text-sm">PILIH
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="daftar-siswa">
                                @if ($pelanggaran->siswa->kelas)
                                    @foreach ($pelanggaran->siswa->kelas->siswas as $index => $siswa)
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-2 sm:py-3 px-2 sm:px-4 font-bold text-xs sm:text-sm">
                                                {{ $index + 1 }}</td>
                                            <td class="py-2 sm:py-3 px-2 sm:px-4 font-bold text-xs sm:text-sm">
                                                {{ $siswa->nis }}</td>
                                            <td class="py-2 sm:py-3 px-2 sm:px-4 font-bold text-xs sm:text-sm">
                                                {{ $siswa->nama }}</td>
                                            <td class="py-2 sm:py-3 px-2 sm:px-4">
                                                <input type="radio" name="siswa_id" value="{{ $siswa->id }}" required
                                                    class="w-4 h-4 sm:w-5 sm:h-5 border-2 border-black focus:ring-sekolah focus:ring-offset-0"
                                                    {{ $pelanggaran->siswa_id == $siswa->id ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4"
                                            class="py-6 sm:py-8 text-center text-gray-500 text-xs sm:text-sm">
                                            Pilih kelas terlebih dahulu
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-4 mt-4 sm:mt-6">
                        <button type="submit"
                            class="neobrutal-btn bg-sekolah text-white px-4 sm:px-6 py-2 text-sm sm:text-base font-bold w-full sm:w-auto text-center order-2 sm:order-1">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('pelanggaran.index') }}"
                            class="neobrutal-btn bg-gray-200 text-black px-4 sm:px-6 py-2 text-sm sm:text-base font-bold w-full sm:w-auto text-center order-1 sm:order-2">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kelasSelect = document.getElementById('filter-kelas');
            const jurusanInfo = document.getElementById('jurusan-info');
            const daftarSiswa = document.getElementById('daftar-siswa');
            const formPelanggaran = document.getElementById('form-pelanggaran');

            kelasSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const jurusan = selectedOption.getAttribute('data-jurusan');
                const siswaData = selectedOption.getAttribute('data-siswa');

                jurusanInfo.value = jurusan || '';

                if (siswaData) {
                    try {
                        const siswaList = JSON.parse(siswaData);
                        renderDaftarSiswa(siswaList);
                    } catch (e) {
                        console.error('Error parsing siswa data:', e);
                        daftarSiswa.innerHTML = `
                            <tr>
                                <td colspan="4" class="py-6 sm:py-8 text-center text-gray-500 text-xs sm:text-sm">
                                    Error memuat data siswa
                                </td>
                            </tr>
                        `;
                    }
                } else {
                    daftarSiswa.innerHTML = `
                        <tr>
                            <td colspan="4" class="py-6 sm:py-8 text-center text-gray-500 text-xs sm:text-sm">
                                Pilih kelas terlebih dahulu
                            </td>
                        </tr>
                    `;
                }
            });

            function renderDaftarSiswa(siswaList) {
                daftarSiswa.innerHTML = '';

                if (siswaList.length === 0) {
                    daftarSiswa.innerHTML = `
                        <tr>
                            <td colspan="4" class="py-6 sm:py-8 text-center text-gray-500 text-xs sm:text-sm">
                                Tidak ada siswa di kelas ini
                            </td>
                        </tr>
                    `;
                    return;
                }

                siswaList.forEach((siswa, index) => {
                    const row = document.createElement('tr');
                    row.className = 'border-b border-gray-200 hover:bg-gray-50';
                    row.innerHTML = `
                        <td class="py-2 sm:py-3 px-2 sm:px-4 font-bold text-xs sm:text-sm">${index + 1}</td>
                        <td class="py-2 sm:py-3 px-2 sm:px-4 font-bold text-xs sm:text-sm">${siswa.nis}</td>
                        <td class="py-2 sm:py-3 px-2 sm:px-4 font-bold text-xs sm:text-sm">${siswa.nama}</td>
                        <td class="py-2 sm:py-3 px-2 sm:px-4">
                            <input type="radio" name="siswa_id" value="${siswa.id}" required
                                class="w-4 h-4 sm:w-5 sm:h-5 border-2 border-black focus:ring-sekolah focus:ring-offset-0"
                                ${siswa.id == {{ $pelanggaran->siswa_id }} ? 'checked' : ''}>
                        </td>
                    `;
                    daftarSiswa.appendChild(row);
                });
            }

            // Handle form submission
            formPelanggaran.addEventListener('submit', function(e) {
                // Validate that a student is selected
                const selectedStudent = document.querySelector('input[name="siswa_id"]:checked');
                if (!selectedStudent) {
                    e.preventDefault();
                    alert('Silakan pilih siswa terlebih dahulu');
                }
            });
        });
    </script>
@endsection
