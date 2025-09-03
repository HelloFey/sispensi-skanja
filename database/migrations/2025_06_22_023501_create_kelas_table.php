<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('tingkat_kelas', 10); // Contoh: "X", "XI", "XII"
            $table->string('nama_kelas', 50); // Contoh: "Teknik Kendaraan Ringan"
            $table->string('rombel', 2)->nullable(); // Contoh: "1", "2", "3", dst.
            $table->string('jurusan', 50); // Contoh: "Teknik Kendaraan Ringan"
            $table->string('tahun_ajar', 9); // Contoh: "2023/2024"
            $table->string('wali_kelas', 30)->nullable();
            $table->timestamps();

            // Membuat kombinasi unik untuk menghindari duplikasi kelas
            $table->unique(['nama_kelas', 'tingkat_kelas', 'rombel', 'tahun_ajar']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
