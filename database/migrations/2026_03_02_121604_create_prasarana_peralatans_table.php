<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prasarana_peralatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_prasarana');
            $table->integer('jumlah_prasarana');
            $table->string('nama_sarana');
            $table->integer('standar_minimal');
            $table->integer('dimiliki_upps');
            $table->enum('kepemilikan', ['Sendiri', 'Sewa']);
            $table->enum('kondisi', ['Terawat', 'Tidak Terawat']);
            $table->enum('logbook', ['Ada', 'Tidak Ada'])->nullable(); // Khusus vokasi / opsional
            $table->string('waktu_penggunaan')->nullable(); // Jam/Minggu
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prasarana_peralatans');
    }
};