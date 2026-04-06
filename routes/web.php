<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



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
use App\Http\Controllers\TempatKerjaLulusanController;
use App\Http\Controllers\KepuasanPenggunaLulusanController;
use App\Http\Controllers\PenelitianDtpsMahasiswaController;
use App\Http\Controllers\PenelitianDtpsRujukanController;
use App\Http\Controllers\PkmDtpsMahasiswaController;
use App\Http\Controllers\DokumenSpmiController;
use App\Http\Controllers\PelaksanaanSpmiController;


// Rute untuk mengunduh file Excel


Route::middleware(['auth'])->group(function () {

Route::get('/lkps/export-excel', [ExportController::class, 'export'])->name('export.excel');

// Rute Tabel Visi Misi (1.a)
// Tambahkan 3 baris ini untuk melengkapi fitur Edit, Update, dan Delete
Route::get('/lkps/visi-misi', [App\Http\Controllers\VisiMisiController::class, 'index'])->name('visi_misi.index');
Route::post('/lkps/visi-misi', [App\Http\Controllers\VisiMisiController::class, 'store'])->name('visi_misi.store');
Route::get('/lkps/visi-misi/{id}/edit', [App\Http\Controllers\VisiMisiController::class, 'edit'])->name('visi_misi.edit');
Route::put('/lkps/visi-misi/{id}', [App\Http\Controllers\VisiMisiController::class, 'update'])->name('visi_misi.update');
Route::delete('/lkps/visi-misi/{id}', [App\Http\Controllers\VisiMisiController::class, 'destroy'])->name('visi_misi.destroy');

// Rute Tabel Kerjasama (2.a.1 - 2.a.3)
// Contoh untuk Tabel Kerjasama Pendidikan
Route::get('/lkps/kerjasama-pendidikan', [KerjasamaPendidikanController::class, 'index'])->name('kerjasama_pendidikan.index');
Route::post('/lkps/kerjasama-pendidikan', [KerjasamaPendidikanController::class, 'store'])->name('kerjasama_pendidikan.store');
Route::get('/lkps/kerjasama-pendidikan/{id}/edit', [KerjasamaPendidikanController::class, 'edit'])->name('kerjasama_pendidikan.edit');
Route::put('/lkps/kerjasama-pendidikan/{id}', [KerjasamaPendidikanController::class, 'update'])->name('kerjasama_pendidikan.update');
Route::delete('/lkps/kerjasama-pendidikan/{id}', [KerjasamaPendidikanController::class, 'destroy'])->name('kerjasama_pendidikan.destroy');

Route::get('/lkps/kerjasama-penelitian', [KerjasamaPenelitianController::class, 'index'])->name('kerjasama_penelitian.index');
Route::post('/lkps/kerjasama-penelitian', [KerjasamaPenelitianController::class, 'store'])->name('kerjasama_penelitian.store');
Route::delete('/lkps/kerjasama-penelitian/{id}', [KerjasamaPenelitianController::class, 'destroy'])->name('kerjasama_penelitian.destroy');
Route::get('/lkps/kerjasama-penelitian/{id}/edit', [KerjasamaPenelitianController::class, 'edit'])->name('kerjasama_penelitian.edit');
Route::put('/lkps/kerjasama-penelitian/{id}', [KerjasamaPenelitianController::class, 'update'])->name('kerjasama_penelitian.update');

// Tabel 2.a.3 Kerjasama Pengabdian (PkM)
Route::get('/lkps/kerjasama-pengabdian', [KerjasamaPengabdianController::class, 'index'])->name('kerjasama_pengabdian.index');
Route::post('/lkps/kerjasama-pengabdian', [KerjasamaPengabdianController::class, 'store'])->name('kerjasama_pengabdian.store');
Route::get('/lkps/kerjasama-pengabdian/{id}/edit', [KerjasamaPengabdianController::class, 'edit'])->name('kerjasama_pengabdian.edit');
Route::put('/lkps/kerjasama-pengabdian/{id}', [KerjasamaPengabdianController::class, 'update'])->name('kerjasama_pengabdian.update');
Route::delete('/lkps/kerjasama-pengabdian/{id}', [KerjasamaPengabdianController::class, 'destroy'])->name('kerjasama_pengabdian.destroy');

// Tabel 2.b Penggunaan Dana
Route::get('/lkps/penggunaan-dana', [PenggunaanDanaController::class, 'index'])->name('penggunaan_dana.index');
Route::post('/lkps/penggunaan-dana', [PenggunaanDanaController::class, 'store'])->name('penggunaan_dana.store');
Route::get('/lkps/penggunaan-dana/{id}/edit', [PenggunaanDanaController::class, 'edit'])->name('penggunaan_dana.edit');
Route::put('/lkps/penggunaan-dana/{id}', [PenggunaanDanaController::class, 'update'])->name('penggunaan_dana.update');
Route::delete('/lkps/penggunaan-dana/{id}', [PenggunaanDanaController::class, 'destroy'])->name('penggunaan_dana.destroy');

// Tabel 3.a.1 Kurikulum
Route::get('/lkps/kurikulum', [KurikulumController::class, 'index'])->name('kurikulum.index');
Route::post('/lkps/kurikulum', [KurikulumController::class, 'store'])->name('kurikulum.store');
Route::get('/lkps/kurikulum/{id}/edit', [KurikulumController::class, 'edit'])->name('kurikulum.edit');
Route::put('/lkps/kurikulum/{id}', [KurikulumController::class, 'update'])->name('kurikulum.update');
Route::delete('/lkps/kurikulum/{id}', [KurikulumController::class, 'destroy'])->name('kurikulum.destroy');

// Tabel 3.a.2 Dokumen Pembelajaran
Route::get('/lkps/dokumen-pembelajaran', [DokumenPembelajaranController::class, 'index'])->name('dokumen_pembelajaran.index');
Route::post('/lkps/dokumen-pembelajaran', [DokumenPembelajaranController::class, 'store'])->name('dokumen_pembelajaran.store');
Route::get('/lkps/dokumen-pembelajaran/{id}/edit', [DokumenPembelajaranController::class, 'edit'])->name('dokumen_pembelajaran.edit');
Route::put('/lkps/dokumen-pembelajaran/{id}', [DokumenPembelajaranController::class, 'update'])->name('dokumen_pembelajaran.update');
Route::delete('/lkps/dokumen-pembelajaran/{id}', [DokumenPembelajaranController::class, 'destroy'])->name('dokumen_pembelajaran.destroy');

// Tabel 3.a.3 Integrasi Pembelajaran
Route::get('/lkps/integrasi-pembelajaran', [IntegrasiPembelajaranController::class, 'index'])->name('integrasi_pembelajaran.index');
Route::post('/lkps/integrasi-pembelajaran', [IntegrasiPembelajaranController::class, 'store'])->name('integrasi_pembelajaran.store');
Route::get('/lkps/integrasi-pembelajaran/{id}/edit', [IntegrasiPembelajaranController::class, 'edit'])->name('integrasi_pembelajaran.edit');
Route::put('/lkps/integrasi-pembelajaran/{id}', [IntegrasiPembelajaranController::class, 'update'])->name('integrasi_pembelajaran.update');
Route::delete('/lkps/integrasi-pembelajaran/{id}', [IntegrasiPembelajaranController::class, 'destroy'])->name('integrasi_pembelajaran.destroy');

// Tabel 3.a.4 Matkul Basic Science
Route::get('/lkps/matkul-basic-science', [MatkulBasicScienceController::class, 'index'])->name('matkul_basic_science.index');
Route::post('/lkps/matkul-basic-science', [MatkulBasicScienceController::class, 'store'])->name('matkul_basic_science.store');
Route::get('/lkps/matkul-basic-science/{id}/edit', [MatkulBasicScienceController::class, 'edit'])->name('matkul_basic_science.edit');
Route::put('/lkps/matkul-basic-science/{id}', [MatkulBasicScienceController::class, 'update'])->name('matkul_basic_science.update');
Route::delete('/lkps/matkul-basic-science/{id}', [MatkulBasicScienceController::class, 'destroy'])->name('matkul_basic_science.destroy');

// Tabel 3.a.5 Capstone Design
Route::get('/lkps/capstone-design', [CapstoneDesignController::class, 'index'])->name('capstone_design.index');
Route::post('/lkps/capstone-design', [CapstoneDesignController::class, 'store'])->name('capstone_design.store');
Route::get('/lkps/capstone-design/{id}/edit', [CapstoneDesignController::class, 'edit'])->name('capstone_design.edit');
Route::put('/lkps/capstone-design/{id}', [CapstoneDesignController::class, 'update'])->name('capstone_design.update');
Route::delete('/lkps/capstone-design/{id}', [CapstoneDesignController::class, 'destroy'])->name('capstone_design.destroy');

// Tabel 3.b Penelitian DTPS
Route::get('/lkps/penelitian-dtps', [PenelitianDtpsController::class, 'index'])->name('penelitian_dtps.index');
Route::post('/lkps/penelitian-dtps', [PenelitianDtpsController::class, 'store'])->name('penelitian_dtps.store');
Route::get('/lkps/penelitian-dtps/{id}/edit', [PenelitianDtpsController::class, 'edit'])->name('penelitian_dtps.edit');
Route::put('/lkps/penelitian-dtps/{id}', [PenelitianDtpsController::class, 'update'])->name('penelitian_dtps.update');
Route::delete('/lkps/penelitian-dtps/{id}', [PenelitianDtpsController::class, 'destroy'])->name('penelitian_dtps.destroy');

// Tabel 3.c PkM DTPS
Route::get('/lkps/pkm-dtps', [PkmDtpsController::class, 'index'])->name('pkm_dtps.index');
Route::post('/lkps/pkm-dtps', [PkmDtpsController::class, 'store'])->name('pkm_dtps.store');
Route::get('/lkps/pkm-dtps/{id}/edit', [PkmDtpsController::class, 'edit'])->name('pkm_dtps.edit');
Route::put('/lkps/pkm-dtps/{id}', [PkmDtpsController::class, 'update'])->name('pkm_dtps.update');
Route::delete('/lkps/pkm-dtps/{id}', [PkmDtpsController::class, 'destroy'])->name('pkm_dtps.destroy');

// Tabel 4.a Profil Dosen
Route::get('/lkps/profil-dosen', [ProfilDosenController::class, 'index'])->name('profil_dosen.index');
Route::post('/lkps/profil-dosen', [ProfilDosenController::class, 'store'])->name('profil_dosen.store');
Route::get('/lkps/profil-dosen/{id}/edit', [ProfilDosenController::class, 'edit'])->name('profil_dosen.edit');
Route::put('/lkps/profil-dosen/{id}', [ProfilDosenController::class, 'update'])->name('profil_dosen.update');
Route::delete('/lkps/profil-dosen/{id}', [ProfilDosenController::class, 'destroy'])->name('profil_dosen.destroy');

// Tabel 4.b Tenaga Kependidikan
Route::get('/lkps/tenaga-kependidikan', [TenagaKependidikanController::class, 'index'])->name('tenaga_kependidikan.index');
Route::post('/lkps/tenaga-kependidikan', [TenagaKependidikanController::class, 'store'])->name('tenaga_kependidikan.store');
Route::get('/lkps/tenaga-kependidikan/{id}/edit', [TenagaKependidikanController::class, 'edit'])->name('tenaga_kependidikan.edit');
Route::put('/lkps/tenaga-kependidikan/{id}', [TenagaKependidikanController::class, 'update'])->name('tenaga_kependidikan.update');
Route::delete('/lkps/tenaga-kependidikan/{id}', [TenagaKependidikanController::class, 'destroy'])->name('tenaga_kependidikan.destroy');

// Tabel 4.c Beban Kerja Dosen
Route::get('/lkps/beban-kerja-dosen', [BebanKerjaDosenController::class, 'index'])->name('beban_kerja_dosen.index');
Route::post('/lkps/beban-kerja-dosen', [BebanKerjaDosenController::class, 'store'])->name('beban_kerja_dosen.store');
Route::get('/lkps/beban-kerja-dosen/{id}/edit', [BebanKerjaDosenController::class, 'edit'])->name('beban_kerja_dosen.edit');
Route::put('/lkps/beban-kerja-dosen/{id}', [BebanKerjaDosenController::class, 'update'])->name('beban_kerja_dosen.update');
Route::delete('/lkps/beban-kerja-dosen/{id}', [BebanKerjaDosenController::class, 'destroy'])->name('beban_kerja_dosen.destroy');

// Tabel 4.d Publikasi Ilmiah DTPS
Route::get('/lkps/publikasi-ilmiah-dtps', [PublikasiIlmiahDtpsController::class, 'index'])->name('publikasi_ilmiah_dtps.index');
Route::post('/lkps/publikasi-ilmiah-dtps', [PublikasiIlmiahDtpsController::class, 'store'])->name('publikasi_ilmiah_dtps.store');
Route::get('/lkps/publikasi-ilmiah-dtps/{id}/edit', [PublikasiIlmiahDtpsController::class, 'edit'])->name('publikasi_ilmiah_dtps.edit');
Route::put('/lkps/publikasi-ilmiah-dtps/{id}', [PublikasiIlmiahDtpsController::class, 'update'])->name('publikasi_ilmiah_dtps.update');
Route::delete('/lkps/publikasi-ilmiah-dtps/{id}', [PublikasiIlmiahDtpsController::class, 'destroy'])->name('publikasi_ilmiah_dtps.destroy');

// Tabel 4.e Karya Ilmiah DTPS
Route::get('/lkps/karya-ilmiah-dtps', [KaryaIlmiahDtpsController::class, 'index'])->name('karya_ilmiah_dtps.index');
Route::post('/lkps/karya-ilmiah-dtps', [KaryaIlmiahDtpsController::class, 'store'])->name('karya_ilmiah_dtps.store');
Route::get('/lkps/karya-ilmiah-dtps/{id}/edit', [KaryaIlmiahDtpsController::class, 'edit'])->name('karya_ilmiah_dtps.edit');
Route::put('/lkps/karya-ilmiah-dtps/{id}', [KaryaIlmiahDtpsController::class, 'update'])->name('karya_ilmiah_dtps.update');
Route::delete('/lkps/karya-ilmiah-dtps/{id}', [KaryaIlmiahDtpsController::class, 'destroy'])->name('karya_ilmiah_dtps.destroy');

// Tabel 4.f.1 Luaran HKI Paten
Route::get('/lkps/luaran-hki-paten', [LuaranHkiPatenController::class, 'index'])->name('luaran_hki_paten.index');
Route::post('/lkps/luaran-hki-paten', [LuaranHkiPatenController::class, 'store'])->name('luaran_hki_paten.store');
Route::get('/lkps/luaran-hki-paten/{id}/edit', [LuaranHkiPatenController::class, 'edit'])->name('luaran_hki_paten.edit');
Route::put('/lkps/luaran-hki-paten/{id}', [LuaranHkiPatenController::class, 'update'])->name('luaran_hki_paten.update');
Route::delete('/lkps/luaran-hki-paten/{id}', [LuaranHkiPatenController::class, 'destroy'])->name('luaran_hki_paten.destroy');

// Tabel 4.f.2 Luaran HKI Hak Cipta
Route::get('/lkps/luaran-hki-hak-cipta', [LuaranHkiHakCiptaController::class, 'index'])->name('luaran_hki_hak_cipta.index');
Route::post('/lkps/luaran-hki-hak-cipta', [LuaranHkiHakCiptaController::class, 'store'])->name('luaran_hki_hak_cipta.store');
Route::get('/lkps/luaran-hki-hak-cipta/{id}/edit', [LuaranHkiHakCiptaController::class, 'edit'])->name('luaran_hki_hak_cipta.edit');
Route::put('/lkps/luaran-hki-hak-cipta/{id}', [LuaranHkiHakCiptaController::class, 'update'])->name('luaran_hki_hak_cipta.update');
Route::delete('/lkps/luaran-hki-hak-cipta/{id}', [LuaranHkiHakCiptaController::class, 'destroy'])->name('luaran_hki_hak_cipta.destroy');

// Tabel 4.f.3 Luaran Teknologi Produk
Route::get('/lkps/luaran-teknologi-produk', [LuaranTeknologiProdukController::class, 'index'])->name('luaran_teknologi_produk.index');
Route::post('/lkps/luaran-teknologi-produk', [LuaranTeknologiProdukController::class, 'store'])->name('luaran_teknologi_produk.store');
Route::get('/lkps/luaran-teknologi-produk/{id}/edit', [LuaranTeknologiProdukController::class, 'edit'])->name('luaran_teknologi_produk.edit');
Route::put('/lkps/luaran-teknologi-produk/{id}', [LuaranTeknologiProdukController::class, 'update'])->name('luaran_teknologi_produk.update');
Route::delete('/lkps/luaran-teknologi-produk/{id}', [LuaranTeknologiProdukController::class, 'destroy'])->name('luaran_teknologi_produk.destroy');

// Tabel 4.f.4 Luaran Buku ISBN
Route::get('/lkps/luaran-buku-isbn', [LuaranBukuIsbnController::class, 'index'])->name('luaran_buku_isbn.index');
Route::post('/lkps/luaran-buku-isbn', [LuaranBukuIsbnController::class, 'store'])->name('luaran_buku_isbn.store');
Route::get('/lkps/luaran-buku-isbn/{id}/edit', [LuaranBukuIsbnController::class, 'edit'])->name('luaran_buku_isbn.edit');
Route::put('/lkps/luaran-buku-isbn/{id}', [LuaranBukuIsbnController::class, 'update'])->name('luaran_buku_isbn.update');
Route::delete('/lkps/luaran-buku-isbn/{id}', [LuaranBukuIsbnController::class, 'destroy'])->name('luaran_buku_isbn.destroy');

// Tabel 4.g Produk/Jasa DTPS
Route::get('/lkps/produk-jasa-dtps', [ProdukJasaDtpsController::class, 'index'])->name('produk_jasa_dtps.index');
Route::post('/lkps/produk-jasa-dtps', [ProdukJasaDtpsController::class, 'store'])->name('produk_jasa_dtps.store');
Route::get('/lkps/produk-jasa-dtps/{id}/edit', [ProdukJasaDtpsController::class, 'edit'])->name('produk_jasa_dtps.edit');
Route::put('/lkps/produk-jasa-dtps/{id}', [ProdukJasaDtpsController::class, 'update'])->name('produk_jasa_dtps.update');
Route::delete('/lkps/produk-jasa-dtps/{id}', [ProdukJasaDtpsController::class, 'destroy'])->name('produk_jasa_dtps.destroy');

// Tabel 4.h Kinerja DTPS
Route::get('/lkps/kinerja-dtps', [KinerjaDtpsController::class, 'index'])->name('kinerja_dtps.index');
Route::post('/lkps/kinerja-dtps', [KinerjaDtpsController::class, 'store'])->name('kinerja_dtps.store');
Route::get('/lkps/kinerja-dtps/{id}/edit', [KinerjaDtpsController::class, 'edit'])->name('kinerja_dtps.edit');
Route::put('/lkps/kinerja-dtps/{id}', [KinerjaDtpsController::class, 'update'])->name('kinerja_dtps.update');
Route::delete('/lkps/kinerja-dtps/{id}', [KinerjaDtpsController::class, 'destroy'])->name('kinerja_dtps.destroy');

// Tabel 4.i Sitasi Karya Ilmiah DTPS
Route::get('/lkps/karya-ilmiah-sitasi', [KaryaIlmiahSitasiController::class, 'index'])->name('karya_ilmiah_sitasi.index');
Route::post('/lkps/karya-ilmiah-sitasi', [KaryaIlmiahSitasiController::class, 'store'])->name('karya_ilmiah_sitasi.store');
Route::get('/lkps/karya-ilmiah-sitasi/{id}/edit', [KaryaIlmiahSitasiController::class, 'edit'])->name('karya_ilmiah_sitasi.edit');
Route::put('/lkps/karya-ilmiah-sitasi/{id}', [KaryaIlmiahSitasiController::class, 'update'])->name('karya_ilmiah_sitasi.update');
Route::delete('/lkps/karya-ilmiah-sitasi/{id}', [KaryaIlmiahSitasiController::class, 'destroy'])->name('karya_ilmiah_sitasi.destroy');

// Tabel 4.j Pengakuan/Rekognisi DTPS
Route::get('/lkps/pengakuan-dtps', [PengakuanDtpsController::class, 'index'])->name('pengakuan_dtps.index');
Route::post('/lkps/pengakuan-dtps', [PengakuanDtpsController::class, 'store'])->name('pengakuan_dtps.store');
Route::get('/lkps/pengakuan-dtps/{id}/edit', [PengakuanDtpsController::class, 'edit'])->name('pengakuan_dtps.edit');
Route::put('/lkps/pengakuan-dtps/{id}', [PengakuanDtpsController::class, 'update'])->name('pengakuan_dtps.update');
Route::delete('/lkps/pengakuan-dtps/{id}', [PengakuanDtpsController::class, 'destroy'])->name('pengakuan_dtps.destroy');

// Tabel 4.k Pembimbing Lapangan
Route::get('/lkps/pembimbing-lapangan', [PembimbingLapanganController::class, 'index'])->name('pembimbing_lapangan.index');
Route::post('/lkps/pembimbing-lapangan', [PembimbingLapanganController::class, 'store'])->name('pembimbing_lapangan.store');
Route::get('/lkps/pembimbing-lapangan/{id}/edit', [PembimbingLapanganController::class, 'edit'])->name('pembimbing_lapangan.edit');
Route::put('/lkps/pembimbing-lapangan/{id}', [PembimbingLapanganController::class, 'update'])->name('pembimbing_lapangan.update');
Route::delete('/lkps/pembimbing-lapangan/{id}', [PembimbingLapanganController::class, 'destroy'])->name('pembimbing_lapangan.destroy');

// Tabel 5.a Prasarana & Peralatan
Route::get('/lkps/prasarana-peralatan', [PrasaranaPeralatanController::class, 'index'])->name('prasarana_peralatan.index');
Route::post('/lkps/prasarana-peralatan', [PrasaranaPeralatanController::class, 'store'])->name('prasarana_peralatan.store');
Route::get('/lkps/prasarana-peralatan/{id}/edit', [PrasaranaPeralatanController::class, 'edit'])->name('prasarana_peralatan.edit');
Route::put('/lkps/prasarana-peralatan/{id}', [PrasaranaPeralatanController::class, 'update'])->name('prasarana_peralatan.update');
Route::delete('/lkps/prasarana-peralatan/{id}', [PrasaranaPeralatanController::class, 'destroy'])->name('prasarana_peralatan.destroy');

// Tabel 5.b Dokumen K3L
Route::get('/lkps/dokumen-k3l', [DokumenK3lController::class, 'index'])->name('dokumen_k3l.index');
Route::post('/lkps/dokumen-k3l', [DokumenK3lController::class, 'store'])->name('dokumen_k3l.store');
Route::get('/lkps/dokumen-k3l/{id}/edit', [DokumenK3lController::class, 'edit'])->name('dokumen_k3l.edit');
Route::put('/lkps/dokumen-k3l/{id}', [DokumenK3lController::class, 'update'])->name('dokumen_k3l.update');
Route::delete('/lkps/dokumen-k3l/{id}', [DokumenK3lController::class, 'destroy'])->name('dokumen_k3l.destroy');

// Tabel 5.c Fasilitas K3L
Route::get('/lkps/fasilitas-k3l', [FasilitasK3lController::class, 'index'])->name('fasilitas_k3l.index');
Route::post('/lkps/fasilitas-k3l', [FasilitasK3lController::class, 'store'])->name('fasilitas_k3l.store');
Route::get('/lkps/fasilitas-k3l/{id}/edit', [FasilitasK3lController::class, 'edit'])->name('fasilitas_k3l.edit');
Route::put('/lkps/fasilitas-k3l/{id}', [FasilitasK3lController::class, 'update'])->name('fasilitas_k3l.update');
Route::delete('/lkps/fasilitas-k3l/{id}', [FasilitasK3lController::class, 'destroy'])->name('fasilitas_k3l.destroy');

// Tabel 6.a Jumlah Mahasiswa
Route::get('/lkps/jumlah-mahasiswa', [JumlahMahasiswaController::class, 'index'])->name('jumlah_mahasiswa.index');
Route::post('/lkps/jumlah-mahasiswa', [JumlahMahasiswaController::class, 'store'])->name('jumlah_mahasiswa.store');
Route::get('/lkps/jumlah-mahasiswa/{id}/edit', [JumlahMahasiswaController::class, 'edit'])->name('jumlah_mahasiswa.edit');
Route::put('/lkps/jumlah-mahasiswa/{id}', [JumlahMahasiswaController::class, 'update'])->name('jumlah_mahasiswa.update');
Route::delete('/lkps/jumlah-mahasiswa/{id}', [JumlahMahasiswaController::class, 'destroy'])->name('jumlah_mahasiswa.destroy');

// Tabel 6.b IPK Lulusan
Route::get('/lkps/ipk-lulusan', [IpkLulusanController::class, 'index'])->name('ipk_lulusan.index');
Route::post('/lkps/ipk-lulusan', [IpkLulusanController::class, 'store'])->name('ipk_lulusan.store');
Route::get('/lkps/ipk-lulusan/{id}/edit', [IpkLulusanController::class, 'edit'])->name('ipk_lulusan.edit');
Route::put('/lkps/ipk-lulusan/{id}', [IpkLulusanController::class, 'update'])->name('ipk_lulusan.update');
Route::delete('/lkps/ipk-lulusan/{id}', [IpkLulusanController::class, 'destroy'])->name('ipk_lulusan.destroy');

// Tabel 6.c.1 Prestasi Akademik
Route::get('/lkps/prestasi-akademik', [PrestasiAkademikController::class, 'index'])->name('prestasi_akademik.index');
Route::post('/lkps/prestasi-akademik', [PrestasiAkademikController::class, 'store'])->name('prestasi_akademik.store');
Route::get('/lkps/prestasi-akademik/{id}/edit', [PrestasiAkademikController::class, 'edit'])->name('prestasi_akademik.edit');
Route::put('/lkps/prestasi-akademik/{id}', [PrestasiAkademikController::class, 'update'])->name('prestasi_akademik.update');
Route::delete('/lkps/prestasi-akademik/{id}', [PrestasiAkademikController::class, 'destroy'])->name('prestasi_akademik.destroy');

// Tabel 6.c.2 Prestasi Non-akademik
Route::get('/lkps/prestasi-non-akademik', [PrestasiNonAkademikController::class, 'index'])->name('prestasi_non_akademik.index');
Route::post('/lkps/prestasi-non-akademik', [PrestasiNonAkademikController::class, 'store'])->name('prestasi_non_akademik.store');
Route::get('/lkps/prestasi-non-akademik/{id}/edit', [PrestasiNonAkademikController::class, 'edit'])->name('prestasi_non_akademik.edit');
Route::put('/lkps/prestasi-non-akademik/{id}', [PrestasiNonAkademikController::class, 'update'])->name('prestasi_non_akademik.update');
Route::delete('/lkps/prestasi-non-akademik/{id}', [PrestasiNonAkademikController::class, 'destroy'])->name('prestasi_non_akademik.destroy');

// Tabel 6.d Masa Studi Lulusan
Route::get('/lkps/masa-studi-lulusan', [MasaStudiLulusanController::class, 'index'])->name('masa_studi_lulusan.index');
Route::post('/lkps/masa-studi-lulusan', [MasaStudiLulusanController::class, 'store'])->name('masa_studi_lulusan.store');
Route::get('/lkps/masa-studi-lulusan/{id}/edit', [MasaStudiLulusanController::class, 'edit'])->name('masa_studi_lulusan.edit');
Route::put('/lkps/masa-studi-lulusan/{id}', [MasaStudiLulusanController::class, 'update'])->name('masa_studi_lulusan.update');
Route::delete('/lkps/masa-studi-lulusan/{id}', [MasaStudiLulusanController::class, 'destroy'])->name('masa_studi_lulusan.destroy');

// Tabel 6.e.1 Publikasi Ilmiah Mahasiswa
Route::get('/lkps/publikasi-ilmiah-mahasiswa', [PublikasiIlmiahMahasiswaController::class, 'index'])->name('publikasi_ilmiah_mahasiswa.index');
Route::post('/lkps/publikasi-ilmiah-mahasiswa', [PublikasiIlmiahMahasiswaController::class, 'store'])->name('publikasi_ilmiah_mahasiswa.store');
Route::get('/lkps/publikasi-ilmiah-mahasiswa/{id}/edit', [PublikasiIlmiahMahasiswaController::class, 'edit'])->name('publikasi_ilmiah_mahasiswa.edit');
Route::put('/lkps/publikasi-ilmiah-mahasiswa/{id}', [PublikasiIlmiahMahasiswaController::class, 'update'])->name('publikasi_ilmiah_mahasiswa.update');
Route::delete('/lkps/publikasi-ilmiah-mahasiswa/{id}', [PublikasiIlmiahMahasiswaController::class, 'destroy'])->name('publikasi_ilmiah_mahasiswa.destroy');

// Tabel 6.e.2 Publikasi Mahasiswa Terapan
Route::get('/lkps/publikasi-mahasiswa-terapan', [PublikasiMahasiswaTerapanController::class, 'index'])->name('publikasi_mahasiswa_terapan.index');
Route::post('/lkps/publikasi-mahasiswa-terapan', [PublikasiMahasiswaTerapanController::class, 'store'])->name('publikasi_mahasiswa_terapan.store');
Route::get('/lkps/publikasi-mahasiswa-terapan/{id}/edit', [PublikasiMahasiswaTerapanController::class, 'edit'])->name('publikasi_mahasiswa_terapan.edit');
Route::put('/lkps/publikasi-mahasiswa-terapan/{id}', [PublikasiMahasiswaTerapanController::class, 'update'])->name('publikasi_mahasiswa_terapan.update');
Route::delete('/lkps/publikasi-mahasiswa-terapan/{id}', [PublikasiMahasiswaTerapanController::class, 'destroy'])->name('publikasi_mahasiswa_terapan.destroy');

// Tabel 6.e.3 HKI Mahasiswa Paten
Route::get('/lkps/luaran-hki-mahasiswa', [LuaranHkiMahasiswaController::class, 'index'])->name('luaran_hki_mahasiswa.index');
Route::post('/lkps/luaran-hki-mahasiswa', [LuaranHkiMahasiswaController::class, 'store'])->name('luaran_hki_mahasiswa.store');
Route::get('/lkps/luaran-hki-mahasiswa/{id}/edit', [LuaranHkiMahasiswaController::class, 'edit'])->name('luaran_hki_mahasiswa.edit');
Route::put('/lkps/luaran-hki-mahasiswa/{id}', [LuaranHkiMahasiswaController::class, 'update'])->name('luaran_hki_mahasiswa.update');
Route::delete('/lkps/luaran-hki-mahasiswa/{id}', [LuaranHkiMahasiswaController::class, 'destroy'])->name('luaran_hki_mahasiswa.destroy');

// Tabel 6.e.3 HKI Bagian 2
Route::get('/lkps/luaran-hki-bagian2', [LuaranHkiBagian2Controller::class, 'index'])->name('luaran_hki_bagian2.index');
Route::post('/lkps/luaran-hki-bagian2', [LuaranHkiBagian2Controller::class, 'store'])->name('luaran_hki_bagian2.store');
Route::get('/lkps/luaran-hki-bagian2/{id}/edit', [LuaranHkiBagian2Controller::class, 'edit'])->name('luaran_hki_bagian2.edit');
Route::put('/lkps/luaran-hki-bagian2/{id}', [LuaranHkiBagian2Controller::class, 'update'])->name('luaran_hki_bagian2.update');
Route::delete('/lkps/luaran-hki-bagian2/{id}', [LuaranHkiBagian2Controller::class, 'destroy'])->name('luaran_hki_bagian2.destroy');

// Tabel 6.e.3 HKI Bagian 3
Route::get('/lkps/luaran-hki-bagian3', [LuaranHkiBagian3Controller::class, 'index'])->name('luaran_hki_bagian3.index');
Route::post('/lkps/luaran-hki-bagian3', [LuaranHkiBagian3Controller::class, 'store'])->name('luaran_hki_bagian3.store');
Route::get('/lkps/luaran-hki-bagian3/{id}/edit', [LuaranHkiBagian3Controller::class, 'edit'])->name('luaran_hki_bagian3.edit');
Route::put('/lkps/luaran-hki-bagian3/{id}', [LuaranHkiBagian3Controller::class, 'update'])->name('luaran_hki_bagian3.update');
Route::delete('/lkps/luaran-hki-bagian3/{id}', [LuaranHkiBagian3Controller::class, 'destroy'])->name('luaran_hki_bagian3.destroy');

// Tabel 6.e.3 HKI Bagian 4
Route::get('/lkps/luaran-hki-bagian4', [LuaranHkiBagian4Controller::class, 'index'])->name('luaran_hki_bagian4.index');
Route::post('/lkps/luaran-hki-bagian4', [LuaranHkiBagian4Controller::class, 'store'])->name('luaran_hki_bagian4.store');
Route::get('/lkps/luaran-hki-bagian4/{id}/edit', [LuaranHkiBagian4Controller::class, 'edit'])->name('luaran_hki_bagian4.edit');
Route::put('/lkps/luaran-hki-bagian4/{id}', [LuaranHkiBagian4Controller::class, 'update'])->name('luaran_hki_bagian4.update');
Route::delete('/lkps/luaran-hki-bagian4/{id}', [LuaranHkiBagian4Controller::class, 'destroy'])->name('luaran_hki_bagian4.destroy');

// Tabel 6.e.4 Produk/Jasa Mahasiswa
Route::get('/lkps/produk-jasa-mahasiswa', [ProdukJasaMahasiswaController::class, 'index'])->name('produk_jasa_mahasiswa.index');
Route::post('/lkps/produk-jasa-mahasiswa', [ProdukJasaMahasiswaController::class, 'store'])->name('produk_jasa_mahasiswa.store');
Route::get('/lkps/produk-jasa-mahasiswa/{id}/edit', [ProdukJasaMahasiswaController::class, 'edit'])->name('produk_jasa_mahasiswa.edit');
Route::put('/lkps/produk-jasa-mahasiswa/{id}', [ProdukJasaMahasiswaController::class, 'update'])->name('produk_jasa_mahasiswa.update');
Route::delete('/lkps/produk-jasa-mahasiswa/{id}', [ProdukJasaMahasiswaController::class, 'destroy'])->name('produk_jasa_mahasiswa.destroy');

// Tabel 6.f.1 Waktu Tunggu Lulusan
Route::get('/lkps/waktu-tunggu-lulusan', [WaktuTungguLulusanController::class, 'index'])->name('waktu_tunggu_lulusan.index');
Route::post('/lkps/waktu-tunggu-lulusan', [WaktuTungguLulusanController::class, 'store'])->name('waktu_tunggu_lulusan.store');
Route::get('/lkps/waktu-tunggu-lulusan/{id}/edit', [WaktuTungguLulusanController::class, 'edit'])->name('waktu_tunggu_lulusan.edit');
Route::put('/lkps/waktu-tunggu-lulusan/{id}', [WaktuTungguLulusanController::class, 'update'])->name('waktu_tunggu_lulusan.update');
Route::delete('/lkps/waktu-tunggu-lulusan/{id}', [WaktuTungguLulusanController::class, 'destroy'])->name('waktu_tunggu_lulusan.destroy');

// Tabel 6.f.2 Kesesuaian Bidang Kerja
Route::get('/lkps/kesesuaian-bidang-kerja', [KesesuaianBidangKerjaController::class, 'index'])->name('kesesuaian_bidang_kerja.index');
Route::post('/lkps/kesesuaian-bidang-kerja', [KesesuaianBidangKerjaController::class, 'store'])->name('kesesuaian_bidang_kerja.store');
Route::get('/lkps/kesesuaian-bidang-kerja/{id}/edit', [KesesuaianBidangKerjaController::class, 'edit'])->name('kesesuaian_bidang_kerja.edit');
Route::put('/lkps/kesesuaian-bidang-kerja/{id}', [KesesuaianBidangKerjaController::class, 'update'])->name('kesesuaian_bidang_kerja.update');
Route::delete('/lkps/kesesuaian-bidang-kerja/{id}', [KesesuaianBidangKerjaController::class, 'destroy'])->name('kesesuaian_bidang_kerja.destroy');

// Tabel 6.g.1 Tempat Kerja Lulusan
Route::get('/lkps/tempat-kerja-lulusan', [TempatKerjaLulusanController::class, 'index'])->name('tempat_kerja_lulusan.index');
Route::post('/lkps/tempat-kerja-lulusan', [TempatKerjaLulusanController::class, 'store'])->name('tempat_kerja_lulusan.store');
Route::get('/lkps/tempat-kerja-lulusan/{id}/edit', [TempatKerjaLulusanController::class, 'edit'])->name('tempat_kerja_lulusan.edit');
Route::put('/lkps/tempat-kerja-lulusan/{id}', [TempatKerjaLulusanController::class, 'update'])->name('tempat_kerja_lulusan.update');
Route::delete('/lkps/tempat-kerja-lulusan/{id}', [TempatKerjaLulusanController::class, 'destroy'])->name('tempat_kerja_lulusan.destroy');

// Tabel 6.g.2 Kepuasan Pengguna Lulusan
Route::get('/lkps/kepuasan_pengguna_lulusan', [KepuasanPenggunaLulusanController::class, 'index'])->name('kepuasan_pengguna_lulusan.index');
Route::post('/lkps/kepuasan_pengguna_lulusan', [KepuasanPenggunaLulusanController::class, 'store'])->name('kepuasan_pengguna_lulusan.store');
Route::get('/lkps/kepuasan_pengguna_lulusan/{id}/edit', [KepuasanPenggunaLulusanController::class, 'edit'])->name('kepuasan_pengguna_lulusan.edit');
Route::put('/lkps/kepuasan_pengguna_lulusan/{id}', [KepuasanPenggunaLulusanController::class, 'update'])->name('kepuasan_pengguna_lulusan.update');
Route::delete('/lkps/kepuasan_pengguna_lulusan/{id}', [KepuasanPenggunaLulusanController::class, 'destroy'])->name('kepuasan_pengguna_lulusan.destroy');

// Tabel 6.h.1 Penelitian DTPS Mahasiswa
Route::get('/lkps/penelitian-dtps-mahasiswa', [PenelitianDtpsMahasiswaController::class, 'index'])->name('penelitian_dtps_mahasiswa.index');
Route::post('/lkps/penelitian-dtps-mahasiswa', [PenelitianDtpsMahasiswaController::class, 'store'])->name('penelitian_dtps_mahasiswa.store');
Route::get('/lkps/penelitian-dtps-mahasiswa/{id}/edit', [PenelitianDtpsMahasiswaController::class, 'edit'])->name('penelitian_dtps_mahasiswa.edit');
Route::put('/lkps/penelitian-dtps-mahasiswa/{id}', [PenelitianDtpsMahasiswaController::class, 'update'])->name('penelitian_dtps_mahasiswa.update');
Route::delete('/lkps/penelitian-dtps-mahasiswa/{id}', [PenelitianDtpsMahasiswaController::class, 'destroy'])->name('penelitian_dtps_mahasiswa.destroy');

// Tabel 6.h.2 Penelitian DTPS Rujukan
Route::get('/lkps/penelitian-dtps-rujukan', [PenelitianDtpsRujukanController::class, 'index'])->name('penelitian_dtps_rujukan.index');
Route::post('/lkps/penelitian-dtps-rujukan', [PenelitianDtpsRujukanController::class, 'store'])->name('penelitian_dtps_rujukan.store');
Route::get('/lkps/penelitian-dtps-rujukan/{id}/edit', [PenelitianDtpsRujukanController::class, 'edit'])->name('penelitian_dtps_rujukan.edit');
Route::put('/lkps/penelitian-dtps-rujukan/{id}', [PenelitianDtpsRujukanController::class, 'update'])->name('penelitian_dtps_rujukan.update');
Route::delete('/lkps/penelitian-dtps-rujukan/{id}', [PenelitianDtpsRujukanController::class, 'destroy'])->name('penelitian_dtps_rujukan.destroy');

// Tabel 6.i PkM DTPS Mahasiswa
Route::get('/lkps/pkm-dtps-mahasiswa', [PkmDtpsMahasiswaController::class, 'index'])->name('pkm_dtps_mahasiswa.index');
Route::post('/lkps/pkm-dtps-mahasiswa', [PkmDtpsMahasiswaController::class, 'store'])->name('pkm_dtps_mahasiswa.store');
Route::get('/lkps/pkm-dtps-mahasiswa/{id}/edit', [PkmDtpsMahasiswaController::class, 'edit'])->name('pkm_dtps_mahasiswa.edit');
Route::put('/lkps/pkm-dtps-mahasiswa/{id}', [PkmDtpsMahasiswaController::class, 'update'])->name('pkm_dtps_mahasiswa.update');
Route::delete('/lkps/pkm-dtps-mahasiswa/{id}', [PkmDtpsMahasiswaController::class, 'destroy'])->name('pkm_dtps_mahasiswa.destroy');

// Tabel 7.a Dokumen SPMI
Route::get('/lkps/dokumen-spmi', [DokumenSpmiController::class, 'index'])->name('dokumen_spmi.index');
Route::post('/lkps/dokumen-spmi', [DokumenSpmiController::class, 'store'])->name('dokumen_spmi.store');
Route::get('/lkps/dokumen-spmi/{id}/edit', [DokumenSpmiController::class, 'edit'])->name('dokumen_spmi.edit');
Route::put('/lkps/dokumen-spmi/{id}', [DokumenSpmiController::class, 'update'])->name('dokumen_spmi.update');
Route::delete('/lkps/dokumen-spmi/{id}', [DokumenSpmiController::class, 'destroy'])->name('dokumen_spmi.destroy');

// Tabel 7.b Pelaksanaan SPMI
Route::get('/lkps/pelaksanaan-spmi', [PelaksanaanSpmiController::class, 'index'])->name('pelaksanaan_spmi.index');
Route::post('/lkps/pelaksanaan-spmi', [PelaksanaanSpmiController::class, 'store'])->name('pelaksanaan_spmi.store');
Route::get('/lkps/pelaksanaan-spmi/{id}/edit', [PelaksanaanSpmiController::class, 'edit'])->name('pelaksanaan_spmi.edit');
Route::put('/lkps/pelaksanaan-spmi/{id}', [PelaksanaanSpmiController::class, 'update'])->name('pelaksanaan_spmi.update');
Route::delete('/lkps/pelaksanaan-spmi/{id}', [PelaksanaanSpmiController::class, 'destroy'])->name('pelaksanaan_spmi.destroy');

});