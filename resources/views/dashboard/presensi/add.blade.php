@extends('dashboard.layouts.app')

@section('content')
    <main class="p-4 md:p-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-center" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white neobrutal-card p-4 md:p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                <!-- Filter Kelas -->
                <div>
                    <label class="block font-bold mb-2">Kelas</label>
                    <select id="filter-kelas"
                        class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelasList as $kelas)
                            @if ($kelas->siswas->isNotEmpty())
                                <!-- Gunakan siswas bukan siswa -->
                                <option value="{{ $kelas->id }}" data-jurusan="{{ $kelas->jurusan }}"
                                    data-siswa="{{ $kelas->siswas->map(function ($s) {
                                            return ['id' => $s->id, 'nis' => $s->nis, 'nama' => $s->nama];
                                        })->toJson() }}">
                                    {{ $kelas->tingkat_kelas }} {{ $kelas->jurusan }} {{ $kelas->rombel }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Jurusan Info -->
                <div>
                    <label class="block font-bold mb-2">Jurusan</label>
                    <input type="text" id="jurusan-info" readonly
                        class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold bg-gray-100">
                </div>

                <!-- Tanggal Presensi -->
                <div>
                    <label class="block font-bold mb-2">Tanggal Presensi</label>
                    <input type="date" id="tanggal-presensi" value="{{ date('Y-m-d') }}"
                        class="w-full px-3 py-2 md:px-4 md:py-2 border-3 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                </div>
            </div>
        </div>

        <!-- Form Presensi -->
        <form action="{{ route('presensi.store') }}" method="POST" id="form-presensi">
            @csrf
            <input type="hidden" name="tanggal" id="input-tanggal">

            <div class="bg-white neobrutal-card p-4 md:p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full" id="tabel-siswa">
                        <thead class="hidden md:table-header-group">
                            <tr class="border-b-3 border-black">
                                <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold">NO</th>
                                <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold">NIS</th>
                                <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold">NAMA SISWA</th>
                                <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold">STATUS</th>
                                <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold">WAKTU MASUK</th>
                                <th class="text-left py-3 px-3 md:py-4 md:px-4 font-extrabold">KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody id="daftar-siswa">
                            <tr>
                                <td colspan="6" class="py-6 md:py-8 text-center text-gray-500">
                                    Pilih kelas terlebih dahulu
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end mt-4 md:mt-6">
                    <button type="submit" class="neobrutal-btn bg-sekolah text-white px-4 py-2 md:px-6 md:py-2 font-bold">
                        Simpan Presensi
                    </button>
                </div>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kelasSelect = document.getElementById('filter-kelas');
            const jurusanInfo = document.getElementById('jurusan-info');
            const tanggalPresensi = document.getElementById('tanggal-presensi');
            const inputTanggal = document.getElementById('input-tanggal');
            const daftarSiswa = document.getElementById('daftar-siswa');
            const formPresensi = document.getElementById('form-presensi');

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
                                <td colspan="6" class="py-6 md:py-8 text-center text-gray-500">
                                    Error memuat data siswa
                                </td>
                            </tr>
                        `;
                    }
                } else {
                    daftarSiswa.innerHTML = `
                        <tr>
                            <td colspan="6" class="py-6 md:py-8 text-center text-gray-500">
                                Pilih kelas terlebih dahulu
                            </td>
                        </tr>
                    `;
                }
            });

            tanggalPresensi.addEventListener('change', function() {
                inputTanggal.value = this.value;
            });

            function renderDaftarSiswa(siswaList) {
                daftarSiswa.innerHTML = '';

                if (siswaList.length === 0) {
                    daftarSiswa.innerHTML = `
                        <tr>
                            <td colspan="6" class="py-6 md:py-8 text-center text-gray-500">
                                Tidak ada siswa di kelas ini
                            </td>
                        </tr>
                    `;
                    return;
                }

                siswaList.forEach((siswa, index) => {
                    const row = document.createElement('tr');
                    row.className =
                        'border-b-2 border-gray-200 hover:bg-gray-50 flex flex-col md:table-row mb-4 md:mb-0';

                    // Untuk tampilan mobile
                    row.innerHTML = `
                        <!-- Tampilan Mobile -->
                        <td class="md:hidden p-3 bg-gray-100 font-bold" colspan="2">
                            <div class="flex justify-between">
                                <span>${index + 1}. ${siswa.nama}</span>
                                <span>NIS: ${siswa.nis}</span>
                            </div>
                            <input type="hidden" name="presensi[${index}][siswa_id]" value="${siswa.id}">
                        </td>
                        
                        <!-- Tampilan Desktop (Nomor) -->
                        <td class="hidden md:table-cell py-3 px-3 md:py-4 md:px-4 font-bold">${index + 1}</td>
                        
                        <!-- Tampilan Desktop (NIS) -->
                        <td class="hidden md:table-cell py-3 px-3 md:py-4 md:px-4 font-bold">${siswa.nis}</td>
                        
                        <!-- Tampilan Desktop (Nama) -->
                        <td class="hidden md:table-cell py-3 px-3 md:py-4 md:px-4 font-bold">
                            ${siswa.nama}
                            <input type="hidden" name="presensi[${index}][siswa_id]" value="${siswa.id}">
                        </td>
                        
                        <!-- Status (Mobile & Desktop) -->
                        <td class="p-3 md:py-3 md:px-3 md:py-4 md:px-4">
                            <div class="flex items-center mb-2 md:mb-0">
                                <span class="md:hidden font-bold mr-2">Status:</span>
                                <select name="presensi[${index}][status]" required
                                    class="w-full md:w-auto px-3 py-2 md:px-4 md:py-2 border-2 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                                    @foreach (App\Models\Presensi::$statuses as $key => $status)
                                        <option value="{{ $key }}" {{ $key === 'hadir' ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        
                        <!-- Waktu Masuk (Mobile & Desktop) -->
                        <td class="p-3 md:py-3 md:px-3 md:py-4 md:px-4">
                            <div class="flex items-center mb-2 md:mb-0">
                                <span class="md:hidden font-bold mr-2">Waktu:</span>
                                <input type="time" name="presensi[${index}][waktu_masuk]"
                                    class="w-full md:w-auto px-3 py-2 md:px-4 md:py-2 border-2 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                            </div>
                        </td>
                        
                        <!-- Keterangan (Mobile & Desktop) -->
                        <td class="p-3 md:py-3 md:px-3 md:py-4 md:px-4">
                            <div class="flex flex-col">
                                <span class="md:hidden font-bold mb-1">Keterangan:</span>
                                <input type="text" name="presensi[${index}][keterangan]"
                                    class="w-full px-3 py-2 md:px-4 md:py-2 border-2 border-black rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-sekolah">
                            </div>
                        </td>
                    `;
                    daftarSiswa.appendChild(row);
                });
            }

            // Set initial tanggal
            inputTanggal.value = tanggalPresensi.value;
        });
    </script>

    <style>
        @media (max-width: 768px) {
            #tabel-siswa tr {
                display: block;
                border: 2px solid #e5e7eb;
                border-radius: 0.5rem;
                margin-bottom: 1rem;
            }

            #tabel-siswa td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem;
                border-bottom: 1px solid #e5e7eb;
            }

            #tabel-siswa td:last-child {
                border-bottom: none;
            }
        }
    </style>
@endsection
