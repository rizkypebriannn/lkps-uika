<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('integrasi_pembelajarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id');
            $table->string('nama_dosen');
            $table->string('judul_kegiatan'); // Judul Penelitian/PkM
            $table->string('mata_kuliah');
            $table->string('bentuk_integrasi'); // Contoh: Studi Kasus, Modul Praktikum
            
            // Tahun Pelaksanaan (Disimpan sebagai teks agar bisa diisi tahun, misal "2023" atau tanda "V")
            $table->string('tahun_ts2')->nullable();
            $table->string('tahun_ts1')->nullable();
            $table->string('tahun_ts')->nullable();
            
            $table->enum('kesesuaian_peta_jalan', ['Sesuai', 'Tidak Sesuai']);
            $table->string('bukti_sahih')->nullable(); // Link Bukti
            $table->enum('kesesuaian_rps', ['Sesuai', 'Tidak Sesuai']);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('integrasi_pembelajarans');
    }
};