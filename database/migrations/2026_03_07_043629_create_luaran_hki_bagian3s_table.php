<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('luaran_hki_bagian3s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('luaran_penelitian');
            $table->date('tanggal');
            $table->string('status'); // Status (Tingkat Kesiapan Teknologi)
            $table->string('nomor_sertifikat');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('luaran_hki_bagian3s');
    }
};