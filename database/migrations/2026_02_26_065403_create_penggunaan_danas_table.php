<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penggunaan_danas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_penggunaan'); // Contoh: Biaya Dosen, Biaya Penelitian, dll
            
            // Dana di Unit Pengelola Program Studi / Fakultas (dalam Juta Rupiah)
            $table->double('upps_ts2')->default(0);
            $table->double('upps_ts1')->default(0);
            $table->double('upps_ts')->default(0);
            
            // Dana di Program Studi (dalam Juta Rupiah)
            $table->double('ps_ts2')->default(0);
            $table->double('ps_ts1')->default(0);
            $table->double('ps_ts')->default(0);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penggunaan_danas');
    }
};