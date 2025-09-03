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
        Schema::create('pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->string('nama_pelanggaran', 100);
            $table->text('deskripsi')->nullable();
            $table->integer('poin');
            $table->enum('kategori', ['ringan', 'sedang', 'berat']);
            $table->date('tanggal');
            $table->time('waktu')->nullable();
            $table->foreignId('pencatat_id')->constrained('users')->onDelete('cascade');
            $table->text('keterangan')->nullable();
            $table->string('bukti_foto', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggarans');
    }
};
