<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kesesuaian_bidang_kerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('tahun_lulus'); // Misal: TS-2, TS-1
            $table->integer('jumlah_lulusan')->default(0);
            $table->integer('jumlah_lulusan_terlacak')->default(0);
            $table->integer('kesesuaian_rendah')->default(0);
            $table->integer('kesesuaian_sedang')->default(0);
            $table->integer('kesesuaian_tinggi')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kesesuaian_bidang_kerjas');
    }
};