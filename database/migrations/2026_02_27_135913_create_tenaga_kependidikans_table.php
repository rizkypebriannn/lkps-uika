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
        Schema::create('tenaga_kependidikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_tenaga_kependidikan');
            $table->enum('pendidikan_terakhir', ['S3', 'S2', 'S1', 'D4', 'D3', 'D2', 'D1', 'SMA/SMK']);
            $table->string('sertifikat_kompetensi')->nullable();
            $table->string('unit_kerja');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_kependidikans');
    }
};