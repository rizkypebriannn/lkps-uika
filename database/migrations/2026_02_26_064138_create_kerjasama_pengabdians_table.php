<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kerjasama_pengabdians', function (Blueprint $table) {
            $table->id();
            $table->string('lembaga_mitra');
            $table->enum('tingkat', ['Internasional', 'Nasional', 'Lokal/Wilayah']);
            $table->string('judul_kegiatan');
            $table->text('manfaat');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->integer('durasi');
            $table->string('status_kerjasama');
            $table->string('bukti_kerjasama')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kerjasama_pengabdians');
    }
};