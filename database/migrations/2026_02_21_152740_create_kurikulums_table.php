<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()

{
    Schema::create('kurikulums', function (Blueprint $table) {
        $table->id();
        $table->integer('semester');
        $table->string('kode_mk');
        $table->string('nama_mk');
        $table->boolean('is_mk_kompetensi')->default(0); // 1 = Ya (V), 0 = Tidak
        $table->integer('sks_kuliah')->default(0);
        $table->integer('sks_seminar')->default(0);
        $table->integer('sks_praktikum')->default(0);
        $table->string('konversi_kredit_jam')->nullable(); // Khusus Vokasi
        $table->string('dokumen_rps')->nullable(); // Link Dokumen
        $table->string('unit_penyelenggara')->nullable(); // Prodi / Fakultas
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurikulums');
    }
};
