<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('luaran_teknologi_produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->text('judul_luaran');
            $table->string('tahun', 4); // Cukup 4 digit angka tahun
            $table->string('keterangan')->nullable(); // Penjelasan singkat
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('luaran_teknologi_produks');
    }
};