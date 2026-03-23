<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('prodi_id');
            $table->string('program_studi'); // Kolom Program Studi
            
            // Kolom Mahasiswa Aktif
            $table->integer('aktif_ts2')->default(0);
            $table->integer('aktif_ts1')->default(0);
            $table->integer('aktif_ts')->default(0);
            
            // Kolom Mahasiswa Asing Penuh Waktu (Full Time)
            $table->integer('asing_ft_ts2')->default(0);
            $table->integer('asing_ft_ts1')->default(0);
            $table->integer('asing_ft_ts')->default(0);
            
            // Kolom Mahasiswa Asing Paruh Waktu (Part Time)
            $table->integer('asing_pt_ts2')->default(0);
            $table->integer('asing_pt_ts1')->default(0);
            $table->integer('asing_pt_ts')->default(0);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
};