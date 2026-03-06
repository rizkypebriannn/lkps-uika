<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beban_kerja_dosens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_dosen');
            $table->enum('is_dtps', ['Ya', 'Tidak'])->default('Ya');
            
            // SKS Pendidikan
            $table->float('sks_ps_diakreditasi')->default(0);
            $table->float('sks_ps_lain_dalam_pt')->default(0);
            $table->float('sks_ps_lain_luar_pt')->default(0);
            
            // SKS Lainnya
            $table->float('sks_penelitian')->default(0);
            $table->float('sks_pkm')->default(0);
            $table->float('sks_tugas_tambahan')->default(0);
            
            // Kolom Kalkulasi Otomatis
            $table->float('sks_jumlah')->default(0);
            $table->float('sks_rata_rata')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beban_kerja_dosens');
    }
};