<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $role = $request->input('role');

        $query = User::query()->orderBy('nama', 'asc');

        // Search functionality
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('nip', 'LIKE', "%{$search}%")
                    ->orWhere('mapel', 'LIKE', "%{$search}%");
            });
        }

        // Status filter
        if ($status) {
            $query->where('status', $status);
        }

        // Role filter
        if ($role) {
            $query->where('role', $role);
        }

        $gurus = $query->paginate(10)->appends($request->query());

        // Counts - we'll calculate both filtered and total counts
        $totalGuru = User::count();
        $totalAktif = User::where('status', 'aktif')->count();
        $totalCuti = User::where('status', 'cuti')->count();
        $totalNonaktif = User::where('status', 'nonaktif')->count();
        $totalMapel = User::whereNotNull('mapel')->distinct('mapel')->count('mapel');

        // For filtered counts
        $filteredCount = $gurus->total();

        return view('dashboard.guru.index', compact(
            'gurus',
            'totalGuru',
            'totalAktif',
            'totalCuti',
            'totalNonaktif',
            'totalMapel',
            'filteredCount'
        ));
    }

    public function create()
    {
        return view('dashboard.guru.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|max:20|unique:users,nip',
            'nama' => 'required|max:30',
            'password' => 'required|min:8',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'alamat' => 'nullable|max:255',
            'email' => 'nullable|email|max:100|unique:users,email',
            'no_hp' => 'nullable|max:15',
            'mapel' => 'nullable|max:50',
            'role' => 'required|in:admin,guru,staf',
        ]);

        User::create([
            'nip' => $validated['nip'],
            'nama' => $validated['nama'],
            'password' => Hash::make($validated['password']),
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'agama' => $validated['agama'],
            'alamat' => $validated['alamat'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'mapel' => $validated['mapel'],
            'role' => $validated['role'],
        ]);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.show', compact('user'));
    }

    public function edit($id)
    {
        $guru = User::findOrFail($id);
        return view('dashboard.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = User::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|max:20|unique:users,nip,' . $id,
            'nama' => 'required|max:30',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'alamat' => 'nullable|max:255',
            'email' => 'nullable|email|max:100|unique:users,email,' . $id,
            'no_hp' => 'nullable|max:15',
            'mapel' => 'nullable|max:50',
            'role' => 'required|in:admin,guru,staf',
            'status' => 'required|in:aktif,cuti,keluar',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required']
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        // Handle photo upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($guru->foto && Storage::exists($guru->foto)) {
                Storage::delete($guru->foto);
            }

            $photoPath = $request->file('foto')->store('public/guru/foto');
            $validated['foto'] = $photoPath;
        } else {
            // Keep the old photo if no new photo uploaded
            $validated['foto'] = $guru->foto;
        }

        $guru->update($validated);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui');
    }

    public function destroy($id)
    {
        $guru = User::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus');
    }
}
