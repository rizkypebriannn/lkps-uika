<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('capstone_designs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // Kolom KTP Prodi langsung dipasang
            
            $table->string('mk_pendukung');
            $table->integer('sks_pendukung');
            $table->string('mk_capstone');
            $table->integer('sks_capstone');
            $table->string('semester');
            $table->string('cakupan_bahasan');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('capstone_designs');
    }
};