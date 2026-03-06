<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matkul_basic_sciences', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mata_kuliah');
            $table->string('semester'); // Tipe string agar bisa diisi angka "1" atau teks "I (Ganjil)"
            $table->integer('jumlah_sks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matkul_basic_sciences');
    }
};