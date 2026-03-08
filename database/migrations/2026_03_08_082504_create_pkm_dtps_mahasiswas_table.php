<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pkm_dtps_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_dosen');
            $table->string('tema_pkm'); // Tema PkM sesuai Peta Jalan
            $table->string('nama_mahasiswa');
            $table->string('judul_kegiatan'); // Judul Kegiatan PkM
            $table->string('tahun'); // Format YYYY
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkm_dtps_mahasiswas');
    }
};