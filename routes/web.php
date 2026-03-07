<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ==========================================
// RUTE TABEL-TABEL LKPS LAMTEKNIK
// ==========================================

// Panggil Controller yang dibutuhkan
use App\Http\Controllers\DokumenPembelajaranController;
use App\Http\Controllers\IntegrasiPembelajaranController;
use App\Http\Controllers\MatkulBasicScienceController;
use App\Http\Controllers\PenggunaanDanaController;
use App\Http\Controllers\CapstoneDesignController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\KurikulumController; // Sesuaikan dengan nama controller Anda
use App\Http\Controllers\KerjasamaPendidikanController;
use App\Http\Controllers\KerjasamaPenelitianController;
use App\Http\Controllers\KerjasamaPengabdianController;
use App\Http\Controllers\PenelitianDtpsController;
use App\Http\Controllers\PkmDtpsController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProfilDosenController;
use App\Http\Controllers\TenagaKependidikanController;
use App\Http\Controllers\BebanKerjaDosenController;
use App\Http\Controllers\PublikasiIlmiahDtpsController;
use App\Http\Controllers\KaryaIlmiahDtpsController;
use App\Http\Controllers\LuaranHkiPatenController;
use App\Http\Controllers\LuaranHkiHakCiptaController;
use App\Http\Controllers\LuaranTeknologiProdukController;
use App\Http\Controllers\LuaranBukuIsbnController;
use App\Http\Controllers\ProdukJasaDtpsController;
use App\Http\Controllers\KinerjaDtpsController;
use App\Http\Controllers\KaryaIlmiahSitasiController;
use App\Http\Controllers\PengakuanDtpsController;
use App\Http\Controllers\PembimbingLapanganController;
use App\Http\Controllers\PrasaranaPeralatanController;
use App\Http\Controllers\DokumenK3lController;
use App\Http\Controllers\FasilitasK3lController;
use App\Http\Controllers\JumlahMahasiswaController;
use App\Http\Controllers\IpkLulusanController;
use App\Http\Controllers\PrestasiAkademikController;
use App\Http\Controllers\PrestasiNonAkademikController;
use App\Http\Controllers\MasaStudiLulusanController;
use App\Http\Controllers\PublikasiIlmiahMahasiswaController;
use App\Http\Controllers\PublikasiMahasiswaTerapanController;
use App\Http\Controllers\LuaranHkiMahasiswaController;
use App\Http\Controllers\LuaranHkiBagian2Controller;
use App\Http\Controllers\LuaranHkiBagian3Controller;
use App\Http\Controllers\LuaranHkiBagian4Controller;
use App\Http\Controllers\ProdukJasaMahasiswaController;
use App\Http\Controllers\WaktuTungguLulusanController;
use App\Http\Controllers\KesesuaianBidangKerjaController;


// Rute untuk mengunduh file Excel
Route::get('/lkps/export-excel', [ExportController::class, 'export'])->name('export.excel');

// Rute Tabel Visi Misi (1.a)
Route::get('/lkps/visi-misi', [VisiMisiController::class, 'index'])->name('visi_misi.index');
Route::post('/lkps/visi-misi', [VisiMisiController::class, 'store'])->name('visi_misi.store');
Route::delete('/lkps/visi-misi/{id}', [VisiMisiController::class, 'destroy'])->name('visi_misi.destroy');

// Rute Tabel Kerjasama (2.a.1 - 2.a.3)
Route::get('/lkps/kerjasama-pendidikan', [KerjasamaPendidikanController::class, 'index'])->name('kerjasama_pendidikan.index');
Route::post('/lkps/kerjasama-pendidikan', [KerjasamaPendidikanController::class, 'store'])->name('kerjasama_pendidikan.store');
Route::delete('/lkps/kerjasama-pendidikan/{id}', [KerjasamaPendidikanController::class, 'destroy'])->name('kerjasama_pendidikan.destroy');

Route::get('/lkps/kerjasama-penelitian', [KerjasamaPenelitianController::class, 'index'])->name('kerjasama_penelitian.index');
Route::post('/lkps/kerjasama-penelitian', [KerjasamaPenelitianController::class, 'store'])->name('kerjasama_penelitian.store');
Route::delete('/lkps/kerjasama-penelitian/{id}', [KerjasamaPenelitianController::class, 'destroy'])->name('kerjasama_penelitian.destroy');

Route::get('/lkps/kerjasama-pengabdian', [KerjasamaPengabdianController::class, 'index'])->name('kerjasama_pengabdian.index');
Route::post('/lkps/kerjasama-pengabdian', [KerjasamaPengabdianController::class, 'store'])->name('kerjasama_pengabdian.store');
Route::delete('/lkps/kerjasama-pengabdian/{id}', [KerjasamaPengabdianController::class, 'destroy'])->name('kerjasama_pengabdian.destroy');

// Rute Tabel Penggunaan Dana (2.b)
Route::get('/lkps/penggunaan-dana', [PenggunaanDanaController::class, 'index'])->name('penggunaan_dana.index');
Route::post('/lkps/penggunaan-dana', [PenggunaanDanaController::class, 'store'])->name('penggunaan_dana.store');
Route::delete('/lkps/penggunaan-dana/{id}', [PenggunaanDanaController::class, 'destroy'])->name('penggunaan_dana.destroy');


Route::get('/lkps/kurikulum', [KurikulumController::class, 'index'])->name('kurikulum.index');
Route::post('/lkps/kurikulum', [KurikulumController::class, 'store'])->name('kurikulum.store');
Route::delete('/lkps/kurikulum/{id}', [KurikulumController::class, 'destroy'])->name('kurikulum.destroy');


// Rute Tabel Dokumen Pembelajaran (3.a.2)
Route::get('/lkps/dokumen-pembelajaran', [DokumenPembelajaranController::class, 'index'])->name('dokumen_pembelajaran.index');
Route::post('/lkps/dokumen-pembelajaran', [DokumenPembelajaranController::class, 'store'])->name('dokumen_pembelajaran.store');
Route::delete('/lkps/dokumen-pembelajaran/{id}', [DokumenPembelajaranController::class, 'destroy'])->name('dokumen_pembelajaran.destroy');

// Rute Tabel Integrasi Pembelajaran (3.a.3)
Route::get('/lkps/integrasi-pembelajaran', [IntegrasiPembelajaranController::class, 'index'])->name('integrasi_pembelajaran.index');
Route::post('/lkps/integrasi-pembelajaran', [IntegrasiPembelajaranController::class, 'store'])->name('integrasi_pembelajaran.store');
Route::delete('/lkps/integrasi-pembelajaran/{id}', [IntegrasiPembelajaranController::class, 'destroy'])->name('integrasi_pembelajaran.destroy');

// Rute Tabel Matkul Basic Science (3.a.4)
Route::get('/lkps/matkul-basic-science', [MatkulBasicScienceController::class, 'index'])->name('matkul_basic_science.index');
Route::post('/lkps/matkul-basic-science', [MatkulBasicScienceController::class, 'store'])->name('matkul_basic_science.store');
Route::delete('/lkps/matkul-basic-science/{id}', [MatkulBasicScienceController::class, 'destroy'])->name('matkul_basic_science.destroy');


// Rute Tabel Capstone Design (3.a.5)
Route::get('/lkps/capstone-design', [CapstoneDesignController::class, 'index'])->name('capstone_design.index');
Route::post('/lkps/capstone-design', [CapstoneDesignController::class, 'store'])->name('capstone_design.store');
Route::delete('/lkps/capstone-design/{id}', [CapstoneDesignController::class, 'destroy'])->name('capstone_design.destroy');


// Rute Tabel 3.b Penelitian DTPS
Route::get('/lkps/penelitian-dtps', [PenelitianDtpsController::class, 'index'])->name('penelitian_dtps.index');
Route::post('/lkps/penelitian-dtps', [PenelitianDtpsController::class, 'store'])->name('penelitian_dtps.store');
Route::delete('/lkps/penelitian-dtps/{id}', [PenelitianDtpsController::class, 'destroy'])->name('penelitian_dtps.destroy');


// Rute Tabel 3.c PkM DTPS
Route::get('/lkps/pkm-dtps', [PkmDtpsController::class, 'index'])->name('pkm_dtps.index');
Route::post('/lkps/pkm-dtps', [PkmDtpsController::class, 'store'])->name('pkm_dtps.store');
Route::delete('/lkps/pkm-dtps/{id}', [PkmDtpsController::class, 'destroy'])->name('pkm_dtps.destroy');


// Rute Tabel 4.a Profil Dosen
Route::get('/lkps/profil-dosen', [ProfilDosenController::class, 'index'])->name('profil_dosen.index');
Route::post('/lkps/profil-dosen', [ProfilDosenController::class, 'store'])->name('profil_dosen.store');
Route::delete('/lkps/profil-dosen/{id}', [ProfilDosenController::class, 'destroy'])->name('profil_dosen.destroy');


Route::get('/lkps/tenaga-kependidikan', [TenagaKependidikanController::class, 'index'])->name('tenaga_kependidikan.index');
Route::post('/lkps/tenaga-kependidikan', [TenagaKependidikanController::class, 'store'])->name('tenaga_kependidikan.store');
Route::delete('/lkps/tenaga-kependidikan/{id}', [TenagaKependidikanController::class, 'destroy'])->name('tenaga_kependidikan.destroy');

// Rute Tabel 4.c Beban Kerja Dosen
Route::get('/lkps/beban-kerja-dosen', [BebanKerjaDosenController::class, 'index'])->name('beban_kerja_dosen.index');
Route::post('/lkps/beban-kerja-dosen', [BebanKerjaDosenController::class, 'store'])->name('beban_kerja_dosen.store');
Route::delete('/lkps/beban-kerja-dosen/{id}', [BebanKerjaDosenController::class, 'destroy'])->name('beban_kerja_dosen.destroy');


// Rute Tabel 4.d Publikasi Ilmiah DTPS
Route::get('/lkps/publikasi-ilmiah-dtps', [PublikasiIlmiahDtpsController::class, 'index'])->name('publikasi_ilmiah_dtps.index');
Route::post('/lkps/publikasi-ilmiah-dtps', [PublikasiIlmiahDtpsController::class, 'store'])->name('publikasi_ilmiah_dtps.store');
Route::delete('/lkps/publikasi-ilmiah-dtps/{id}', [PublikasiIlmiahDtpsController::class, 'destroy'])->name('publikasi_ilmiah_dtps.destroy');


// Rute Tabel 4.e Karya Ilmiah DTPS (Pagelaran/Pameran)
Route::get('/lkps/karya-ilmiah-dtps', [KaryaIlmiahDtpsController::class, 'index'])->name('karya_ilmiah_dtps.index');
Route::post('/lkps/karya-ilmiah-dtps', [KaryaIlmiahDtpsController::class, 'store'])->name('karya_ilmiah_dtps.store');
Route::delete('/lkps/karya-ilmiah-dtps/{id}', [KaryaIlmiahDtpsController::class, 'destroy'])->name('karya_ilmiah_dtps.destroy');


// Rute Tabel 4.f Bagian 1 (HKI Paten)
Route::get('/lkps/luaran-hki-paten', [LuaranHkiPatenController::class, 'index'])->name('luaran_hki_paten.index');
Route::post('/lkps/luaran-hki-paten', [LuaranHkiPatenController::class, 'store'])->name('luaran_hki_paten.store');
Route::delete('/lkps/luaran-hki-paten/{id}', [LuaranHkiPatenController::class, 'destroy'])->name('luaran_hki_paten.destroy');


// Rute Tabel 4.f Bagian 2 (HKI Hak Cipta, Desain)
Route::get('/lkps/luaran-hki-hak-cipta', [LuaranHkiHakCiptaController::class, 'index'])->name('luaran_hki_hak_cipta.index');
Route::post('/lkps/luaran-hki-hak-cipta', [LuaranHkiHakCiptaController::class, 'store'])->name('luaran_hki_hak_cipta.store');
Route::delete('/lkps/luaran-hki-hak-cipta/{id}', [LuaranHkiHakCiptaController::class, 'destroy'])->name('luaran_hki_hak_cipta.destroy');


// Rute Tabel 4.f Bagian 3 (Teknologi Tepat Guna, Produk, dll)
Route::get('/lkps/luaran-teknologi-produk', [LuaranTeknologiProdukController::class, 'index'])->name('luaran_teknologi_produk.index');
Route::post('/lkps/luaran-teknologi-produk', [LuaranTeknologiProdukController::class, 'store'])->name('luaran_teknologi_produk.store');
Route::delete('/lkps/luaran-teknologi-produk/{id}', [LuaranTeknologiProdukController::class, 'destroy'])->name('luaran_teknologi_produk.destroy');


// Rute Tabel 4.f Bagian 4 (Buku Ber-ISBN, Book Chapter)
Route::get('/lkps/luaran-buku-isbn', [LuaranBukuIsbnController::class, 'index'])->name('luaran_buku_isbn.index');
Route::post('/lkps/luaran-buku-isbn', [LuaranBukuIsbnController::class, 'store'])->name('luaran_buku_isbn.store');
Route::delete('/lkps/luaran-buku-isbn/{id}', [LuaranBukuIsbnController::class, 'destroy'])->name('luaran_buku_isbn.destroy');


// Rute Tabel 4.g (Produk/Jasa DTPS)
Route::get('/lkps/produk-jasa-dtps', [ProdukJasaDtpsController::class, 'index'])->name('produk_jasa_dtps.index');
Route::post('/lkps/produk-jasa-dtps', [ProdukJasaDtpsController::class, 'store'])->name('produk_jasa_dtps.store');
Route::delete('/lkps/produk-jasa-dtps/{id}', [ProdukJasaDtpsController::class, 'destroy'])->name('produk_jasa_dtps.destroy');



// Rute Tabel 4.h (Kinerja DTPS)
Route::get('/lkps/kinerja-dtps', [KinerjaDtpsController::class, 'index'])->name('kinerja_dtps.index');
Route::post('/lkps/kinerja-dtps', [KinerjaDtpsController::class, 'store'])->name('kinerja_dtps.store');
Route::delete('/lkps/kinerja-dtps/{id}', [KinerjaDtpsController::class, 'destroy'])->name('kinerja_dtps.destroy');


// Rute Tabel 4.i (Sitasi Karya Ilmiah DTPS)
Route::get('/lkps/karya-ilmiah-sitasi', [KaryaIlmiahSitasiController::class, 'index'])->name('karya_ilmiah_sitasi.index');
Route::post('/lkps/karya-ilmiah-sitasi', [KaryaIlmiahSitasiController::class, 'store'])->name('karya_ilmiah_sitasi.store');
Route::delete('/lkps/karya-ilmiah-sitasi/{id}', [KaryaIlmiahSitasiController::class, 'destroy'])->name('karya_ilmiah_sitasi.destroy');


// Rute Tabel 4.j (Pengakuan/Rekognisi DTPS)
Route::get('/lkps/pengakuan-dtps', [PengakuanDtpsController::class, 'index'])->name('pengakuan_dtps.index');
Route::post('/lkps/pengakuan-dtps', [PengakuanDtpsController::class, 'store'])->name('pengakuan_dtps.store');
Route::delete('/lkps/pengakuan-dtps/{id}', [PengakuanDtpsController::class, 'destroy'])->name('pengakuan_dtps.destroy');


// Rute Tabel 4.k (Pembimbing Lapangan)
Route::get('/lkps/pembimbing-lapangan', [PembimbingLapanganController::class, 'index'])->name('pembimbing_lapangan.index');
Route::post('/lkps/pembimbing-lapangan', [PembimbingLapanganController::class, 'store'])->name('pembimbing_lapangan.store');
Route::delete('/lkps/pembimbing-lapangan/{id}', [PembimbingLapanganController::class, 'destroy'])->name('pembimbing_lapangan.destroy');


// Rute Tabel 5.a (Prasarana & Peralatan)
Route::get('/lkps/prasarana-peralatan', [PrasaranaPeralatanController::class, 'index'])->name('prasarana_peralatan.index');
Route::post('/lkps/prasarana-peralatan', [PrasaranaPeralatanController::class, 'store'])->name('prasarana_peralatan.store');
Route::delete('/lkps/prasarana-peralatan/{id}', [PrasaranaPeralatanController::class, 'destroy'])->name('prasarana_peralatan.destroy');


// Rute Tabel 5.b (Dokumen K3L)
Route::get('/lkps/dokumen-k3l', [DokumenK3lController::class, 'index'])->name('dokumen_k3l.index');
Route::post('/lkps/dokumen-k3l', [DokumenK3lController::class, 'store'])->name('dokumen_k3l.store');
Route::delete('/lkps/dokumen-k3l/{id}', [DokumenK3lController::class, 'destroy'])->name('dokumen_k3l.destroy');


// Rute Tabel 5.c (Fasilitas K3L)
Route::get('/lkps/fasilitas-k3l', [FasilitasK3lController::class, 'index'])->name('fasilitas_k3l.index');
Route::post('/lkps/fasilitas-k3l', [FasilitasK3lController::class, 'store'])->name('fasilitas_k3l.store');
Route::delete('/lkps/fasilitas-k3l/{id}', [FasilitasK3lController::class, 'destroy'])->name('fasilitas_k3l.destroy');


// Rute Tabel 6.a (Jumlah Mahasiswa)
Route::get('/lkps/jumlah-mahasiswa', [JumlahMahasiswaController::class, 'index'])->name('jumlah_mahasiswa.index');
Route::post('/lkps/jumlah-mahasiswa', [JumlahMahasiswaController::class, 'store'])->name('jumlah_mahasiswa.store');
Route::delete('/lkps/jumlah-mahasiswa/{id}', [JumlahMahasiswaController::class, 'destroy'])->name('jumlah_mahasiswa.destroy');


// Rute Tabel 6.b (IPK Lulusan)
Route::get('/lkps/ipk-lulusan', [IpkLulusanController::class, 'index'])->name('ipk_lulusan.index');
Route::post('/lkps/ipk-lulusan', [IpkLulusanController::class, 'store'])->name('ipk_lulusan.store');
Route::delete('/lkps/ipk-lulusan/{id}', [IpkLulusanController::class, 'destroy'])->name('ipk_lulusan.destroy');


// Rute Tabel 6.c.1 (Prestasi Akademik)
Route::get('/lkps/prestasi-akademik', [PrestasiAkademikController::class, 'index'])->name('prestasi_akademik.index');
Route::post('/lkps/prestasi-akademik', [PrestasiAkademikController::class, 'store'])->name('prestasi_akademik.store');
Route::delete('/lkps/prestasi-akademik/{id}', [PrestasiAkademikController::class, 'destroy'])->name('prestasi_akademik.destroy');


// Rute Tabel 6.c.2 (Prestasi Non-akademik)
Route::get('/lkps/prestasi-non-akademik', [PrestasiNonAkademikController::class, 'index'])->name('prestasi_non_akademik.index');
Route::post('/lkps/prestasi-non-akademik', [PrestasiNonAkademikController::class, 'store'])->name('prestasi_non_akademik.store');
Route::delete('/lkps/prestasi-non-akademik/{id}', [PrestasiNonAkademikController::class, 'destroy'])->name('prestasi_non_akademik.destroy');


// Rute Tabel 6.d (Masa Studi Lulusan)
Route::get('/lkps/masa-studi-lulusan', [MasaStudiLulusanController::class, 'index'])->name('masa_studi_lulusan.index');
Route::post('/lkps/masa-studi-lulusan', [MasaStudiLulusanController::class, 'store'])->name('masa_studi_lulusan.store');
Route::delete('/lkps/masa-studi-lulusan/{id}', [MasaStudiLulusanController::class, 'destroy'])->name('masa_studi_lulusan.destroy');


// Rute Tabel 6.e.1 (Publikasi Ilmiah Mahasiswa)
Route::get('/lkps/publikasi-ilmiah-mahasiswa', [PublikasiIlmiahMahasiswaController::class, 'index'])->name('publikasi_ilmiah_mahasiswa.index');
Route::post('/lkps/publikasi-ilmiah-mahasiswa', [PublikasiIlmiahMahasiswaController::class, 'store'])->name('publikasi_ilmiah_mahasiswa.store');
Route::delete('/lkps/publikasi-ilmiah-mahasiswa/{id}', [PublikasiIlmiahMahasiswaController::class, 'destroy'])->name('publikasi_ilmiah_mahasiswa.destroy');


// Rute Tabel 6.e.2 (Publikasi Mahasiswa Terapan)
Route::get('/lkps/publikasi-mahasiswa-terapan', [PublikasiMahasiswaTerapanController::class, 'index'])->name('publikasi_mahasiswa_terapan.index');
Route::post('/lkps/publikasi-mahasiswa-terapan', [PublikasiMahasiswaTerapanController::class, 'store'])->name('publikasi_mahasiswa_terapan.store');
Route::delete('/lkps/publikasi-mahasiswa-terapan/{id}', [PublikasiMahasiswaTerapanController::class, 'destroy'])->name('publikasi_mahasiswa_terapan.destroy');


// Rute Tabel 6.e.3 (HKI Mahasiswa - Paten)
Route::get('/lkps/luaran-hki-mahasiswa', [LuaranHkiMahasiswaController::class, 'index'])->name('luaran_hki_mahasiswa.index');
Route::post('/lkps/luaran-hki-mahasiswa', [LuaranHkiMahasiswaController::class, 'store'])->name('luaran_hki_mahasiswa.store');
Route::delete('/lkps/luaran-hki-mahasiswa/{id}', [LuaranHkiMahasiswaController::class, 'destroy'])->name('luaran_hki_mahasiswa.destroy');


// Rute Tabel 6.e.3 (Bagian-2 HKI)
Route::get('/lkps/luaran-hki-bagian2', [LuaranHkiBagian2Controller::class, 'index'])->name('luaran_hki_bagian2.index');
Route::post('/lkps/luaran-hki-bagian2', [LuaranHkiBagian2Controller::class, 'store'])->name('luaran_hki_bagian2.store');
Route::delete('/lkps/luaran-hki-bagian2/{id}', [LuaranHkiBagian2Controller::class, 'destroy'])->name('luaran_hki_bagian2.destroy');
Route::get('/lkps/luaran-hki-bagian2/export', [LuaranHkiBagian2Controller::class, 'export'])->name('luaran_hki_bagian2.export');

// Rute Tabel 6.e.3 Bagian 3 (Teknologi Tepat Guna)
Route::get('/lkps/luaran-hki-bagian3', [App\Http\Controllers\LuaranHkiBagian3Controller::class, 'index'])->name('luaran_hki_bagian3.index');
Route::post('/lkps/luaran-hki-bagian3', [App\Http\Controllers\LuaranHkiBagian3Controller::class, 'store'])->name('luaran_hki_bagian3.store');
Route::delete('/lkps/luaran-hki-bagian3/{id}', [App\Http\Controllers\LuaranHkiBagian3Controller::class, 'destroy'])->name('luaran_hki_bagian3.destroy');


// Rute Tabel 6.e.3 Bagian 4 (Buku Ber-ISBN, Book Chapter)
Route::get('/lkps/luaran-hki-bagian4', [LuaranHkiBagian4Controller::class, 'index'])->name('luaran_hki_bagian4.index');
Route::post('/lkps/luaran-hki-bagian4', [LuaranHkiBagian4Controller::class, 'store'])->name('luaran_hki_bagian4.store');
Route::delete('/lkps/luaran-hki-bagian4/{id}', [LuaranHkiBagian4Controller::class, 'destroy'])->name('luaran_hki_bagian4.destroy');


// Rute Tabel 6.e.4 (Produk/Jasa Mahasiswa)
Route::get('/lkps/produk-jasa-mahasiswa', [ProdukJasaMahasiswaController::class, 'index'])->name('produk_jasa_mahasiswa.index');
Route::post('/lkps/produk-jasa-mahasiswa', [ProdukJasaMahasiswaController::class, 'store'])->name('produk_jasa_mahasiswa.store');
Route::delete('/lkps/produk-jasa-mahasiswa/{id}', [ProdukJasaMahasiswaController::class, 'destroy'])->name('produk_jasa_mahasiswa.destroy');


// Rute Tabel 6.f.1 (Waktu Tunggu Lulusan)
Route::get('/lkps/waktu-tunggu-lulusan', [WaktuTungguLulusanController::class, 'index'])->name('waktu_tunggu_lulusan.index');
Route::post('/lkps/waktu-tunggu-lulusan', [WaktuTungguLulusanController::class, 'store'])->name('waktu_tunggu_lulusan.store');
Route::delete('/lkps/waktu-tunggu-lulusan/{id}', [WaktuTungguLulusanController::class, 'destroy'])->name('waktu_tunggu_lulusan.destroy');


// Rute Tabel 6.f.2 (Kesesuaian Bidang Kerja Lulusan)
Route::get('/lkps/kesesuaian-bidang-kerja', [KesesuaianBidangKerjaController::class, 'index'])->name('kesesuaian_bidang_kerja.index');
Route::post('/lkps/kesesuaian-bidang-kerja', [KesesuaianBidangKerjaController::class, 'store'])->name('kesesuaian_bidang_kerja.store');
Route::delete('/lkps/kesesuaian-bidang-kerja/{id}', [KesesuaianBidangKerjaController::class, 'destroy'])->name('kesesuaian_bidang_kerja.destroy');