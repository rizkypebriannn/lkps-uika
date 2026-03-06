<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visi_misis', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_vmts', ['VMTS PT', 'VMTS UPPS', 'Visi Keilmuan PS']);
            $table->text('pernyataan');
            $table->string('no_sk')->nullable();
            $table->string('link_dokumen')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visi_misis');
    }
};