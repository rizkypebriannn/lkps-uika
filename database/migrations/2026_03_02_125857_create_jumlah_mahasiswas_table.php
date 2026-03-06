<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jumlah_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('program_studi');
            $table->enum('is_diakreditasi', ['Ya', 'Tidak']); // Untuk memunculkan V di kolom C
            
            // Mahasiswa Aktif
            $table->integer('aktif_ts2')->default(0);
            $table->integer('aktif_ts1')->default(0);
            $table->integer('aktif_ts')->default(0);
            
            // Mahasiswa Asing Full-time
            $table->integer('asing_ft_ts2')->default(0);
            $table->integer('asing_ft_ts1')->default(0);
            $table->integer('asing_ft_ts')->default(0);
            
            // Mahasiswa Asing Part-time
            $table->integer('asing_pt_ts2')->default(0);
            $table->integer('asing_pt_ts1')->default(0);
            $table->integer('asing_pt_ts')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jumlah_mahasiswas');
    }
};