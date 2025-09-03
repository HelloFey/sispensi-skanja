<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kelas;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        (new User([
            'nama' => 'ADMIN',
            'nip' => '123',
            'password' => Hash::make('bismillah'),
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Banjarnegara',
            'tanggal_lahir' => '1997-04-20',
            'agama' => 'Islam',
        ]))->save();


        // (new Presensi([
        //     'siswa_id' => 1,
        //     'tanggal' => '2023-02-20',
        //     'status' => 'hadir',
        //     'user_id' => 1,
        // ]))->save();
    }
}
