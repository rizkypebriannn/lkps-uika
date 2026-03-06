<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembimbing_lapangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama');
            $table->string('industri');
            $table->string('bidang_keinsinyuran');
            $table->integer('pengalaman_kerja'); // Dalam hitungan tahun
            $table->string('pendidikan_tinggi');
            $table->enum('kategori_sip', ['IPM', 'IPU']);
            $table->string('nomor_sip');
            $table->date('tanggal_berakhir_sip');
            $table->integer('jumlah_bimbingan');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembimbing_lapangans');
    }
};