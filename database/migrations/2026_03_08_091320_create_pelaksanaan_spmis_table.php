<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelaksanaan_spmis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('dokumen'); // Penetapan, Pelaksanaan, dll
            $table->string('link_dokumen'); // Semua punya ini
            $table->string('link_laporan_audit')->nullable(); // Hanya untuk Evaluasi
            $table->string('link_laporan_rtm')->nullable(); // Hanya untuk Pengendalian
            $table->string('link_dokumen_peningkatan')->nullable(); // Hanya untuk Peningkatan
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelaksanaan_spmis');
    }
};