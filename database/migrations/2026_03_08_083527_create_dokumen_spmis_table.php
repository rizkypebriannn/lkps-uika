<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_spmis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('jenis_dokumen'); // Pilihan 4 jenis dokumen baku
            $table->string('nomor_dokumen');
            $table->date('tanggal_dokumen');
            $table->boolean('is_ppepp')->default(false); // Untuk menandai dokumen ini bukti siklus PPEPP
            $table->boolean('is_ami')->default(false);   // Untuk menandai ini adalah Laporan AMI
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_spmis');
    }
};