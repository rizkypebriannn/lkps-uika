<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kinerja_dtps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_dtps');
            $table->integer('jumlah_ts2')->default(0);
            $table->integer('jumlah_ts1')->default(0);
            $table->integer('jumlah_ts')->default(0);
            $table->string('keterangan')->nullable();
            $table->integer('jumlah_publikasi')->default(0); // Auto-kalkulasi
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kinerja_dtps');
    }
};