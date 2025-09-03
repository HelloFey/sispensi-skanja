<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
    // Accessor untuk nama kelas lengkap
    // Accessor untuk nama kelas lengkap
    public function getNamaLengkapAttribute()
    {
        return $this->tingkat_kelas . ' ' . $this->jurusan . ($this->rombel ? ' ' . $this->rombel : '');
    }
    // / Relasi ke Presensi melalui Siswa
    public function presensi()
    {
        return $this->hasManyThrough(
            Presensi::class,
            Siswa::class,
            'id_kelas', // Foreign key di tabel siswa
            'id_siswa', // Foreign key di tabel presensi
            'id_kelas',  // Local key di tabel kelas
            'id_siswa'   // Local key di tabel siswa
        );
    }
}
