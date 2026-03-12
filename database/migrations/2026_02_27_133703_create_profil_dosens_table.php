<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('profil_dosens', function (Blueprint $table) {
        $table->id();
        $table->foreignId('prodi_id')->constrained('prodis')->onDelete('cascade');
        
        // 1. Identitas Dosen
        $table->string('nama_dosen');
        $table->string('nidn_nidk')->nullable(); // NIDN / NIDK / NUPTK
        $table->enum('kategori_dosen', ['Dosen Tetap', 'Dosen Tidak Tetap', 'Dosen Industri']);
        
        // 2. Riwayat Pendidikan & Keahlian
        $table->string('pendidikan_s1')->nullable(); // Nama PT & Bidang Ilmu S1
        $table->string('pendidikan_s2')->nullable(); // Nama PT & Bidang Ilmu S2
        $table->string('pendidikan_s3')->nullable(); // Nama PT & Bidang Ilmu S3
        $table->string('bidang_keahlian');
        $table->string('perusahaan_industri')->nullable(); // Khusus Dosen Industri
        
        // 3. Status & Jabatan
        $table->enum('kesesuaian_kompetensi', ['V', '-'])->default('V'); // Sesuai dengan PS
        $table->enum('jabatan_akademik', ['Tenaga Pengajar', 'Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar', '-'])->default('-');
        
        // 4. Sertifikasi
        $table->string('sertifikat_pendidik')->nullable(); // Nomor Sertifikat Pendidik
        $table->string('sertifikat_kompetensi')->nullable(); // Sertifikat Profesi / Industri
        $table->enum('sertifikat_keinsinyuran', ['IPM', 'IPU', '-'])->default('-');
        
        // 5. Beban Mengajar
        $table->text('matkul_ps_diakreditasi')->nullable();
        $table->enum('kesesuaian_matkul', ['V', '-'])->default('V');
        $table->text('matkul_ps_lain')->nullable();

        $table->timestamps();
    });
}
    public function down() {
        Schema::dropIfExists('profil_dosens');
    }
};