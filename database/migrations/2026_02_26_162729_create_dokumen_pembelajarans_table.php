<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dokumen_pembelajarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id');
            $table->string('mata_kuliah'); // Sesuai Excel Kolom B
            $table->integer('bobot_sks'); // Sesuai Excel Kolom C
            $table->integer('konversi_teori')->default(0); // Sesuai Excel Kolom D
            $table->integer('konversi_praktik')->default(0); // Sesuai Excel Kolom E
            $table->string('dokumen_rps')->nullable(); // Sesuai Excel Kolom F (Nanti diisi Link)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumen_pembelajarans');
    }
};