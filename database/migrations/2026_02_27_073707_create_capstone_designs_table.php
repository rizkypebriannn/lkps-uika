<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('capstone_designs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id');
            
            // Data Administratif
            $table->string('mk_pendukung');
            $table->integer('sks_pendukung');
            $table->string('mk_capstone');
            $table->integer('sks_capstone');
            $table->string('semester');
            $table->string('cakupan_bahasan');
            
            // Data Indikator Penilaian Kualitatif (Matriks Hal. 13)
            $table->boolean('has_panduan')->default(false);
            $table->boolean('has_cpl_rumusan')->default(false);
            $table->boolean('has_standar_keteknikan')->default(false);
            $table->boolean('has_bukti_sahih')->default(false);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('capstone_designs');
    }
};