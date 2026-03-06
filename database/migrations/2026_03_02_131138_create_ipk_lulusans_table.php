<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ipk_lulusans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->enum('tahun_lulus', ['TS-2', 'TS-1', 'TS']);
            $table->integer('jumlah_lulusan')->default(0);
            $table->decimal('ipk_min', 3, 2)->default(0.00);  // Format desimal (misal 3.25)
            $table->decimal('ipk_rata', 3, 2)->default(0.00); // Format desimal
            $table->decimal('ipk_maks', 3, 2)->default(0.00); // Format desimal
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ipk_lulusans');
    }
};