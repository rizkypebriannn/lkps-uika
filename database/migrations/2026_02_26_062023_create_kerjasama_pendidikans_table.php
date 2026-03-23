<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kerjasama_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id');
            $table->string('lembaga_mitra');
            $table->enum('tingkat', ['Internasional', 'Nasional', 'Lokal/Wilayah']);
            $table->string('judul_kegiatan');
            $table->text('manfaat');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->integer('durasi'); // Durasi dalam hitungan tahun
            $table->string('status_kerjasama'); // Contoh: SPK, Surat Penugasan
            $table->string('bukti_kerjasama')->nullable(); // Link Google Drive
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kerjasama_pendidikans');
    }
};