<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masa_studi_lulusans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->enum('tahun_masuk', ['TS-7', 'TS-6', 'TS-5', 'TS-4', 'TS-3', 'TS-2', 'TS-1', 'TS']);
            $table->integer('jumlah_masuk')->default(0);
            
            // Kolom rentang kelulusan (Bisa kosong/null karena ada sel abu-abu di Excel)
            $table->integer('lulus_3_5')->nullable()->default(0); // 3,5 < MS <= 4,5
            $table->integer('lulus_4_5')->nullable()->default(0); // 4,5 < MS <= 5,5
            $table->integer('lulus_5_5')->nullable()->default(0); // 5,5 < MS <= 6,5
            $table->integer('lulus_6_5')->nullable()->default(0); // 6,5 < MS <= 8
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masa_studi_lulusans');
    }
};