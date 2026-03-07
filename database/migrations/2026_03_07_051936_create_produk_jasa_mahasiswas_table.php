<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_jasa_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id');
            
            $table->string('nama_mahasiswa');
            $table->string('nama_produk_jasa');
            $table->text('deskripsi');
            $table->string('bukti');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_jasa_mahasiswas');
    }
};