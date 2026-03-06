<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karya_ilmiah_sitasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_dtps');
            $table->text('judul_artikel'); // Jurnal/Buku/Prosiding, Vol, Tahun, dll
            $table->integer('jumlah_sitasi')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karya_ilmiah_sitasis');
    }
};