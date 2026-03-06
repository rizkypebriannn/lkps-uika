<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karya_ilmiah_dtps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('jenis_publikasi');
            $table->integer('jumlah_ts2')->default(0);
            $table->integer('jumlah_ts1')->default(0);
            $table->integer('jumlah_ts')->default(0);
            $table->integer('jumlah_total')->default(0); // Auto-kalkulasi
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karya_ilmiah_dtps');
    }
};