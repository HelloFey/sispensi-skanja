<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tingkat = $request->input('tingkat');
        $rombel = $request->input('rombel');
        $jurusan = $request->input('jurusan');

        // Gunakan with() untuk eager loading relasi kelas dan urutkan
        $query = Siswa::with(['kelas' => function ($q) {
            $q->orderBy('jurusan', 'asc')
                ->orderBy('tingkat_kelas', 'asc');
        }])->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
            ->orderBy('kelas.jurusan', 'asc')
            ->orderBy('kelas.tingkat_kelas', 'asc')
            ->orderBy('siswas.nama', 'asc')
            ->select('siswas.*'); // Pastikan untuk select kolom dari tabel siswa

        // Filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('siswas.nama', 'LIKE', "%{$search}%")
                    ->orWhere('siswas.nisn', 'LIKE', "%{$search}%")
                    ->orWhereHas('kelas', function ($q) use ($search) {
                        $q->where('tingkat_kelas', 'LIKE', "%{$search}%")
                            ->orWhere('jurusan', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Filter tingkat kelas
        if ($tingkat) {
            $query->whereHas('kelas', function ($q) use ($tingkat) {
                $q->where('tingkat_kelas', $tingkat);
            });
        }

        // Filter rombel
        if ($rombel) {
            $query->whereHas('kelas', function ($q) use ($rombel) {
                $q->where('rombel', $rombel);
            });
        }

        // Filter jurusan
        if ($jurusan) {
            $query->whereHas('kelas', function ($q) use ($jurusan) {
                $q->where('jurusan', $jurusan);
            });
        }

        $siswa = $query->paginate(36)->appends($request->query());

        // Hitungan total
        $totalSiswa = Siswa::count();
        $totalAktif = Siswa::where('status', 'aktif')->count();
        $totalPindah = Siswa::where('status', 'pindah')->count();
        $totalKeluar = Siswa::where('status', 'keluar')->count();

        return view('dashboard.siswa.index', compact(
            'siswa',
            'totalSiswa',
            'totalAktif',
            'totalPindah',
            'totalKeluar'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::orderBy('tingkat_kelas')->orderBy('jurusan')->orderBy('rombel')->get();
        return view('dashboard.siswa.add', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // $table->text('alamat')->nullable();
    //         $table->string('email')->nullable();
    //         $table->integer('no_hp')->nullable();
    //         $table->string('nama_ayah')->nullable();
    //         $table->string('nama_ibu')->nullable();
    //         $table->string('pekerjaan_ortu')->nullable();
    //         $table->integer('no_hp_ortu')->nullable();
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'nullable|unique:siswas,nis|max:20',
            'nisn' => 'nullable|unique:siswas,nisn|max:20',
            'nama' => 'required|max:30',
            'jenis_kelamin' => 'required|in:L,P', // Asumsi L untuk Laki, P untuk Perempuan
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'nullable|max:255',
            'email' => 'nullable|email|max:100',
            'no_hp' => 'nullable|max:15',
            'nama_ayah' => 'nullable|max:30',
            'nama_ibu' => 'nullable|max:30',
            'pekerjaan_ortu' => 'nullable|max:30',
            'no_hp_ortu' => 'nullable|max:15',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Harap Isi Semua Data Dengan Benar');
        }
        Siswa::create($request->all());
        return back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $siswa = Siswa::findOrFail($siswa->id);
        return view('dashboard.siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $siswa = Siswa::findOrFail($siswa->id);
        $kelas = Kelas::orderBy('tingkat_kelas')->orderBy('jurusan')->orderBy('rombel')->get();
        return view('dashboard.siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'nullable|max:20|unique:siswas,nis,' . $siswa->id,
            'nisn' => 'nullable|max:20|unique:siswas,nisn,' . $siswa->id,
            'nama' => 'required|max:30',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|max:30',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'nullable|max:255',
            'email' => 'nullable|email|max:100',
            'no_hp' => 'nullable|max:15',
            'nama_ayah' => 'nullable|max:30',
            'nama_ibu' => 'nullable|max:30',
            'pekerjaan_ortu' => 'nullable|max:30',
            'no_hp_ortu' => 'nullable|max:15',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|in:aktif,pindah,keluar'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Harap isi semua data dengan benar!');
        }

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto && Storage::exists('public/siswa/' . $siswa->foto)) {
                Storage::delete('public/siswa/' . $siswa->foto);
            }

            // Simpan foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/siswa', $fotoName);
            $data['foto'] = $fotoName;
        }

        $siswa->update($data);

        // return redirect()->intended('kelas/11')->with('success', 'Data berhasil diperbarui');
        return back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return back()->with('success', 'data berhasil dihapus');
    }
}
