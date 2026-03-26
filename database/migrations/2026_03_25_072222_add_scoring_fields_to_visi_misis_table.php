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
    Schema::table('visi_misis', function (Blueprint $table) {
        // Flags untuk Indikator 1 (Kekhasan)
        $table->boolean('is_linear_pt')->default(false);
        $table->boolean('is_sesuai_renstra')->default(false);
        $table->boolean('is_sesuai_kurikulum')->default(false);
        $table->boolean('is_tinjau_berkala')->default(false);

        // Flags untuk Indikator 2 (Mekanisme)
        $table->boolean('libatkan_internal')->default(false); // Dosen, Mhs, Tendik
        $table->boolean('libatkan_eksternal_lengkap')->default(false); // Lulusan, Pengguna, Pakar

        // Flags untuk Indikator 3 (Pemahaman & Dampak)
        $table->boolean('is_sosialisasi_menyeluruh')->default(false);
        $table->boolean('has_pencapaian_konkret')->default(false);
        $table->boolean('is_berkelanjutan')->default(false);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visi_misis', function (Blueprint $table) {
            //
        });
    }
};
