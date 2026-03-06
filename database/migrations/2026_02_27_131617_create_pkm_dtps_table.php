<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pkm_dtps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('sumber_pembiayaan');
            $table->integer('jumlah_ts2')->default(0);
            $table->integer('jumlah_ts1')->default(0);
            $table->integer('jumlah_ts')->default(0);
            
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('pkm_dtps');
    }
};