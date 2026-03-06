<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi_non_akademiks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_kegiatan');
            $table->date('waktu_perolehan');
            $table->enum('tingkat', ['Lokal/Wilayah', 'Nasional', 'Internasional']);
            $table->string('prestasi_dicapai');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi_non_akademiks');
    }
};