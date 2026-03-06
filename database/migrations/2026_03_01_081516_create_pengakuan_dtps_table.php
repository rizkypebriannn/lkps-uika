<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengakuan_dtps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_dtps');
            $table->string('bidang_keahlian');
            $table->string('rekognisi');
            $table->string('bukti_pendukung');
            $table->enum('tingkat', ['Wilayah', 'Nasional', 'Internasional']);
            $table->string('tahun', 4);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengakuan_dtps');
    }
};