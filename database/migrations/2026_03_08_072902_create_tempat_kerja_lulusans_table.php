<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tempat_kerja_lulusans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            // Sesuai 7 Kolom di Excel Tabel 6.g.1
            $table->string('tahun_lulus'); 
            $table->integer('jumlah_lulusan')->default(0);
            $table->integer('jumlah_tanggapan')->default(0); // Kolom C
            $table->integer('jumlah_terlacak')->default(0); // Kolom D
            $table->integer('tingkat_lokal')->default(0); // Kolom E
            $table->integer('tingkat_nasional')->default(0); // Kolom F
            $table->integer('tingkat_multinasional')->default(0); // Kolom G
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tempat_kerja_lulusans');
    }
};