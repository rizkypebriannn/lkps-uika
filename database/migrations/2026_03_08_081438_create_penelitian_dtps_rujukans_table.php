<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penelitian_dtps_rujukans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_dosen');
            $table->string('tema_penelitian');
            $table->string('nama_mahasiswa');
            $table->string('judul_tesis'); // Judul Tesis/Disertasi
            $table->string('tahun'); // Format YYYY
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penelitian_dtps_rujukans');
    }
};