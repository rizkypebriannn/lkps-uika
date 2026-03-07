<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('waktu_tunggu_lulusans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('tahun_lulus'); // Misal: TS-2, TS-1
            $table->integer('jumlah_lulusan')->default(0);
            $table->integer('jumlah_lulusan_terlacak')->default(0);
            $table->integer('wt_kurang_3_bulan')->default(0);
            $table->integer('wt_antara_3_18_bulan')->default(0);
            $table->integer('wt_lebih_18_bulan')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waktu_tunggu_lulusans');
    }
};