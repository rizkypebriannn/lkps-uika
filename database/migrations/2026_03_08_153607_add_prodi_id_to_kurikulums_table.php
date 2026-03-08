<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kurikulums', function (Blueprint $table) {
            // Kita suntikkan kolom prodi_id tepat setelah kolom id
            // Kita beri nullable() agar jika ada data lama, tidak terjadi error
            $table->unsignedBigInteger('prodi_id')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('kurikulums', function (Blueprint $table) {
            $table->dropColumn('prodi_id');
        });
    }
};