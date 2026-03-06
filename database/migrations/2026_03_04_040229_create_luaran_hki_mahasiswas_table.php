<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('luaran_hki_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('luaran_penelitian');
            $table->date('tanggal');
            $table->enum('status', ['Registered', 'Granted', 'Komersial']);
            $table->string('nomor_registrasi');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('luaran_hki_mahasiswas');
    }
};