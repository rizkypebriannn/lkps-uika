<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_jasa_dtps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_dtps');
            $table->string('nama_produk');
            $table->text('deskripsi_produk');
            $table->string('bukti'); // Bisa diisi link atau keterangan dokumen
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_jasa_dtps');
    }
};