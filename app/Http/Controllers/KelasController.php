<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tingkat = $request->input('tingkat');
        $jurusan = $request->input('jurusan');

        $query = Kelas::withCount('siswas')->orderBy('tingkat_kelas')->orderBy('jurusan')->orderBy('rombel');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_kelas', 'like', "%{$search}%")
                    ->orWhere('wali_kelas', 'like', "%{$search}%");
            });
        }

        if ($tingkat) {
            $query->where('tingkat_kelas', $tingkat);
        }

        if ($jurusan) {
            $query->where('jurusan', $jurusan);
        }

        $kelas = $query->paginate(5);

        // Hitung statistik
        $totalKelas = Kelas::count();
        $kelasX = Kelas::where('tingkat_kelas', 'X')->count();
        $kelasXI = Kelas::where('tingkat_kelas', 'XI')->count();
        $kelasXII = Kelas::where('tingkat_kelas', 'XII')->count();

        return view('dashboard.kelas.index', compact(
            'kelas',
            'totalKelas',
            'kelasX',
            'kelasXI',
            'kelasXII'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = User::where('role', 'guru')->get();
        return view('dashboard.kelas.add', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tingkat_kelas' => 'required|in:X,XI,XII',
            'nama_kelas' => 'required|max:6',
            'rombel' => 'nullable|in:1,2,3',
            'jurusan' => 'required|max:30',
            'tahun_ajar' => 'required|max:9',
            'wali_kelas' => 'nullable'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Harap Isi Semua Data Dengan Benar');
        }
        Kelas::create($request->all());
        return redirect()->intended('/kelas')->with('success', 'Kelas Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('dashboard.kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guru = User::where('role', 'guru')->get();
        $kelas = Kelas::findOrFail($id);
        return view('dashboard.kelas.edit', compact('kelas', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $kelas = Kelas::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'tingkat_kelas' => 'required|in:X,XI,XII',
            'nama_kelas' => 'required|max:6',
            'rombel' => 'nullable|in:1,2,3',
            'jurusan' => 'required|max:30',
            'tahun_ajar' => 'required|max:9',
            'wali_kelas' => 'nullable'
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Harap Isi Semua Data Dengan Benar');
        }

        $kelas->update($request->all());
        return redirect()->intended('/kelas')->with('success', 'Berhasil Mengupdate Kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return back()->with('success', 'Kelas Berhasil Dihapus');
    }
}
