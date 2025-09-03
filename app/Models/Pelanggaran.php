<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function pencatat()
    {
        return $this->belongsTo(User::class, 'pencatat_id');
    }

    // Scope untuk filter
    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['kelas'] ?? false,
            fn($query, $kelas) =>
            $query->whereHas(
                'siswa',
                fn($query) =>
                $query->where('kelas_id', $kelas)
            )
        );

        $query->when(
            $filters['kategori'] ?? false,
            fn($query, $kategori) =>
            $query->where('kategori', $kategori)
        );

        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query->whereHas(
                'siswa',
                fn($query) =>
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nis', 'like', '%' . $search . '%')
            )
        );
    }
}
