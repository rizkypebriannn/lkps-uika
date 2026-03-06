<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('profil_dosens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id'); // KTP Prodi
            
            $table->string('nama_dosen');
            $table->string('nidn');
            $table->enum('kategori_dosen', ['Dosen Tetap', 'Dosen Tidak Tetap', 'Dosen Industri']);
            $table->string('pendidikan_s1')->nullable();
            $table->string('pendidikan_s2')->nullable();
            $table->string('pendidikan_s3')->nullable();
            $table->string('bidang_keahlian');
            $table->enum('kesesuaian_kompetensi', ['Sesuai', 'Tidak Sesuai']);
            $table->enum('jabatan_akademik', ['Tenaga Pengajar', 'Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar']);
            $table->string('sertifikat_pendidik')->nullable();
            $table->string('sertifikat_kompetensi_bidang')->nullable();
            $table->string('sertifikat_kompetensi_lembaga')->nullable();
            $table->string('sertifikat_keinsinyuran_skip')->nullable();
            $table->string('sertifikat_keinsinyuran_stri')->nullable();
            $table->text('matkul_ps_diakreditasi');
            $table->enum('kesesuaian_matkul', ['Sesuai', 'Tidak Sesuai']);
            $table->text('matkul_ps_lain')->nullable();
            
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('profil_dosens');
    }
};