<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kepuasan_pengguna_lulusans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('jenis_kemampuan'); 
            $table->double('sangat_baik')->default(0); // Kolom C (%)
            $table->double('baik')->default(0); // Kolom D (%)
            $table->double('cukup')->default(0); // Kolom E (%)
            $table->double('kurang')->default(0); // Kolom F (%)
            $table->text('rencana_tindak_lanjut')->nullable(); // Kolom G
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kepuasan_pengguna_lulusans');
    }
};