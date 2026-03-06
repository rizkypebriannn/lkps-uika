<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Daftar semua tabel yang KEMUNGKINAN sudah Anda buat
        $tables = [
            'users', 'visi_misis', 'tata_pamongs', 'kerjasama_pendidikans',
            'kerjasama_penelitians', 'kerjasama_pengabdians', 'penggunaan_danas',
            'dokumen_pembelajarans', 'integrasi_pembelajarans', 'matkul_basic_sciences'
        ];

        foreach ($tables as $nama_tabel) {
            // Cek apakah tabelnya ADA, dan kolom prodi_id BELUM ADA
            if (Schema::hasTable($nama_tabel) && !Schema::hasColumn($nama_tabel, 'prodi_id')) {
                Schema::table($nama_tabel, function (Blueprint $table) {
                    $table->unsignedBigInteger('prodi_id')->default(1)->after('id');
                });
            }
        }
    }

    public function down()
    {
        // Kosongkan saja untuk keamanan data
    }
};