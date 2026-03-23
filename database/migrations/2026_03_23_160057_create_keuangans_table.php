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
    Schema::create('keuangans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('prodi_id');
        $table->string('tahun'); // TS, TS-1, TS-2
        
        // Kolom Dana (Gunakan bigInteger atau decimal untuk akurasi uang)
        $table->bigInteger('dana_operasional_mhs')->default(0); // Untuk Indikator 9
        $table->bigInteger('dana_penelitian_dtps')->default(0); // Untuk Indikator 10
        $table->bigInteger('dana_pkm_dtps')->default(0);         // Untuk Indikator 11

        $table->timestamps();
    });
    }
/**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};