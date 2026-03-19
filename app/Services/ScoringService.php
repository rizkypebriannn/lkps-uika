<?php

namespace App\Services;

use App\Models\KerjasamaPendidikan;
use App\Models\KerjasamaPenelitian;
use App\Models\KerjasamaPengabdian;
use App\Models\ProfilDosen;
use App\Models\TenagaKependidikan;
use App\Models\BebanKerjaDosen;
use App\Models\PublikasiIlmiahDtps;
use App\Models\KaryaIlmiahDtps;
use App\Models\LuaranHkiPaten;
use App\Models\LuaranHkiHakCipta;
use App\Models\LuaranTeknologiProduk;
use App\Models\LuaranBukuIsbn;
use App\Models\Kurikulum;
use App\Models\PenelitianDtps; // 
use App\Models\PenelitianDtpsMahasiswa; // Model untuk Tabel 6.h.1 yang Anda kirim
use App\Models\PkmDtps; // Tabel 3.c
use App\Models\PkmDtpsMahasiswa; // Tabel 6.i
use App\Models\JumlahMahasiswa; 
use App\Models\IpkLulusan;
use App\Models\PrestasiAkademik;
use App\Models\PrestasiNonAkademik;
use App\Models\MasaStudiLulusan;
use App\Models\PublikasiIlmiahMahasiswa;
use App\Models\LuaranHkiMahasiswa;
use App\Models\WaktuTungguLulusan;

class ScoringService
{
    /**
     * Hitung Skor Indikator 6: Kerjasama (Tabel 2.a)
     */
    public static function hitungSkorKerjasama($prodi_id)
    {
        $n1 = KerjasamaPendidikan::where('prodi_id', $prodi_id)->count();
        $n2 = KerjasamaPenelitian::where('prodi_id', $prodi_id)->count();
        $n3 = KerjasamaPengabdian::where('prodi_id', $prodi_id)->count();

        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        if ($ndtps == 0) return 0;

        $rk = ($n1 + $n2 + $n3) / $ndtps;

        return ($rk >= 4) ? 4.00 : number_format($rk, 2);
    }

    /**
     * Hitung Skor Indikator 27: Kualifikasi S3 DTPS
     */
    public static function hitungSkorDosenS3($prodi_id)
    {
        // Hitung total Dosen Tetap (NDTPS)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        if ($ndtps == 0) return 0;

        // Hitung Dosen Tetap yang S3 (Syaratnya: kolom pendidikan_s3 tidak boleh kosong)
        $nds3 = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->whereNotNull('pendidikan_s3')
                    ->count();

        // Hitung Persentase (PDS3)
        $pds3 = $nds3 / $ndtps;

        // Logika Skor: Jika >= 50% skor 4. Jika < 50% skor = 2 + (4 x PDS3)
        if ($pds3 >= 0.5) {
            return 4.00;
        } else {
            return number_format(2 + (4 * $pds3), 2);
        }
    }

    /**
     * Hitung Skor Indikator 28: Jabatan Akademik
     */
    public static function hitungSkorJabatanDosen($prodi_id)
    {
        // Hitung total Dosen Tetap (NDTPS)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        if ($ndtps == 0) return 0;

        // Hitung Dosen Tetap dengan Jabatan Lektor, Lektor Kepala, atau Guru Besar
        $ndJafa = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->whereIn('jabatan_akademik', ['Lektor', 'Lektor Kepala', 'Guru Besar'])
                    ->count();

        // Hitung Persentase (PGBLKL)
        $pgblkl = $ndJafa / $ndtps;

        // Logika Skor: Jika >= 70% skor 4. Jika < 70% skor = 2 + ((20 x PGBLKL) / 7)
        if ($pgblkl >= 0.7) {
            return 4.00;
        } else {
            return number_format(2 + ((20 * $pgblkl) / 7), 2);
        }
    }

        /**
     * Hitung Skor Indikator 26: Kecukupan DTPS
     */
    public static function hitungSkorKecukupanDosen($prodi_id)
    {
        // 1. Hitung Dosen Tetap (NDT / NDTPS)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        // 2. Hitung Dosen Tidak Tetap (NDTT)
        $ndtt = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tidak Tetap')
                    ->count();

        $totalDosen = $ndtps + $ndtt;

        // Jika belum ada dosen sama sekali
        if ($totalDosen == 0) return number_format(0, 2);

        // 3. Hitung Persentase Dosen Tidak Tetap (PDTT)
        $pdtt = $ndtt / $totalDosen; 

        // 4. LOGIKA SKOR BERDASARKAN MATRIKS LAM TEKNIK 
        // Jika dosen tetap kurang dari 5 ATAU dosen tidak tetap lebih dari 40%, langsung skor 0
        if ($ndtps < 5 || $pdtt > 0.40) {
            return number_format(0, 2);
        }

        // Jika dosen tetap >= 12 dan dosen tidak tetap <= 10%, skor Sempurna (4)
        if ($ndtps >= 12 && $pdtt <= 0.10) {
            return number_format(4, 2);
        }

        // Jika dosen tetap >= 12 TAPI dosen tidak tetap antara 10% - 40%
        if ($ndtps >= 12 && $pdtt > 0.10 && $pdtt <= 0.40) {
            $b = (0.40 - $pdtt) / 0.30;
            return number_format(2 + (2 * $b), 2);
        }

        // Jika dosen tetap antara 5 sampai 11, dan dosen tidak tetap <= 40%
        if ($ndtps >= 5 && $ndtps < 12 && $pdtt <= 0.40) {
            $a = ($ndtps - 5) / 7;
            $b = (0.40 - $pdtt) / 0.40;
            return number_format(2 + 2 * ($a * $b), 2);
        }

        return number_format(0, 2);
    }
    /**
     * Hitung Skor Indikator 29: Kualifikasi Tenaga Kependidikan (Tabel 4.b)
     */
    public static function hitungSkorTendik($prodi_id)
    {
        // 1. Hitung total tenaga kependidikan (Laboran/Teknisi/Admin)
        $totalTendik = TenagaKependidikan::where('prodi_id', $prodi_id)->count();

        if ($totalTendik == 0) return number_format(0, 2);

        // 2. Hitung yang memiliki sertifikat kompetensi
        // PENTING: Sesuaikan 'sertifikat_kompetensi' dengan nama kolom asli di database Anda!
        $tendikBersertifikat = TenagaKependidikan::where('prodi_id', $prodi_id)
            ->whereNotNull('sertifikat_kompetensi') 
            ->count();

        // 3. Hitung persentase
        $persentase = $tendikBersertifikat / $totalTendik;

        // 4. Logika Skor Matriks LAM Teknik 
        if ($persentase > 0.70) return number_format(4, 2);
        if ($persentase >= 0.40 && $persentase <= 0.70) return number_format(3, 2);
        if ($persentase >= 0.10 && $persentase < 0.40) return number_format(2, 2);
        
        return number_format(1, 2); // Jika di bawah 10%
    }

    /**
     * Hitung Skor Indikator 30: Beban Kerja Dosen (Tabel 4.c)
     */
    public static function hitungSkorBebanKerja($prodi_id)
    {
        // 1. Tarik data khusus untuk DTPS
        $query = BebanKerjaDosen::where('prodi_id', $prodi_id)
                                ->where('is_dtps', 'Ya');
                                
        $count = $query->count();
        if ($count == 0) return number_format(0, 2);

        // 2. Hitung Rerata Beban Kerja (RBK) menggunakan kolom 'sks_jumlah'
        $rbk = $query->avg('sks_jumlah');

        // 3. Logika Skor Matriks LAM Teknik
        if ($rbk >= 12 && $rbk <= 16) {
            return number_format(4, 2);
        } elseif ($rbk > 16 && $rbk <= 20) {
            return number_format((64 - (3 * $rbk)) / 4, 2);
        } elseif ($rbk < 12 && $rbk > 0) {
            return number_format($rbk / 3, 2); // Proporsional jika di bawah 12
        }

        return number_format(0, 2); // Jika RBK > 20
    }
    
    /**
     * Hitung Skor Indikator 31: Publikasi Ilmiah DTPS (Tabel 4.d)
     */
    public static function hitungSkorPublikasiDTPS($prodi_id)
    {
        // 1. Ambil jumlah Dosen Tetap (NDTPS)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        if ($ndtps == 0) return number_format(0, 2);

        // 2. Fungsi bantu untuk mengambil jumlah publikasi berdasarkan "jenis_publikasi"
        $getTotalByKategori = function ($kategori) use ($prodi_id) {
            $data = PublikasiIlmiahDtps::where('prodi_id', $prodi_id)
                        ->where('jenis_publikasi', $kategori)
                        ->first();
            
            // Karena Anda sudah punya kolom 'jumlah_total', kita bisa langsung pakai itu!
            // Jika datanya tidak ada, kembalikan nilai 0.
            return $data ? $data->jumlah_total : 0;
        };

        // 3. Ambil total masing-masing kategori 
        // ⚠️ PENTING: Sesuaikan teks string di bawah ini dengan pilihan yang ada di form input Anda!
        $na = $getTotalByKategori('Jurnal Nasional Belum Terakreditasi'); 
        $nb = $getTotalByKategori('Jurnal Nasional Terakreditasi');       
        $nc = $getTotalByKategori('Jurnal Internasional');                
        $nd = $getTotalByKategori('Jurnal Internasional Bereputasi');     

        // 4. Hitung Rasio Publikasi (RI) dengan Bobot LAM Teknik
        $ri = (($na * 1) + ($nb * 2) + ($nc * 3) + ($nd * 4)) / $ndtps;

        // 5. Logika Skor Matriks LAM Teknik
        if ($ri >= 0.5) {
            return number_format(4, 2);
        } else {
            return number_format(2 + (4 * $ri), 2);
        }
    }
    /**
     * Hitung Skor Indikator 32: Karya Ilmiah / Pameran / Presentasi DTPS (Tabel 4.e)
     */
    public static function hitungSkorKaryaIlmiahDTPS($prodi_id)
    {
        // 1. Ambil jumlah Dosen Tetap (NDTPS)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        if ($ndtps == 0) return number_format(0, 2);

        // 2. Fungsi bantu ambil jumlah total berdasarkan "jenis_publikasi"
        $getTotalByKategori = function ($kategori) use ($prodi_id) {
            $data = KaryaIlmiahDtps::where('prodi_id', $prodi_id)
                        ->where('jenis_publikasi', $kategori)
                        ->first();
            
            return $data ? $data->jumlah_total : 0;
        };

        // 3. Ambil total masing-masing kategori 
        // ⚠️ PENTING: Sesuaikan teks string ini dengan pilihan dropdown di form 4.e Anda!
        $na = $getTotalByKategori('Wilayah/Lokal');
        $nb = $getTotalByKategori('Nasional');       
        $nc = $getTotalByKategori('Internasional');                

        // 4. Hitung Rasio Publikasi (RI) dengan Bobot LAM Teknik
        $ri = (($na * 1) + ($nb * 2) + ($nc * 3)) / $ndtps;

        // 5. Logika Skor Matriks LAM Teknik
        if ($ri >= 0.5) {
            return number_format(4, 2);
        } else {
            return number_format(2 + (4 * $ri), 2);
        }
    }
    /**
     * Hitung Skor Indikator 33: Luaran HKI (Paten) (Tabel 4.f.1)
     */
    public static function hitungSkorLuaranPaten($prodi_id)
    {
        // 1. Ambil jumlah Dosen Tetap (NDTPS)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        if ($ndtps == 0) return number_format(0, 2);

        // 2. Hitung jumlah luaran paten
        // Catatan: Jika Anda HANYA ingin menghitung paten yang sudah keluar nomornya (bukan yang masih proses), 
        // Anda bisa tambahkan ->whereNotNull('nomor_paten') sebelum ->count(). 
        // Di sini saya asumsikan semua data yang diinput ke tabel ini dihitung.
        $totalPaten = LuaranHkiPaten::where('prodi_id', $prodi_id)->count();

        // 3. Hitung Rasio (RI)
        $ri = $totalPaten / $ndtps;

        // 4. Logika Skor Matriks LAM Teknik
        if ($ri >= 0.1) {
            return number_format(4, 2);
        } else {
            return number_format(2 + (20 * $ri), 2);
        }
    }
    /**
     * Hitung Skor Indikator 34: Luaran HKI (Hak Cipta, Desain Industri, dll) (Tabel 4.f.2)
     */
    public static function hitungSkorLuaranHakCipta($prodi_id)
    {
        // 1. Ambil jumlah Dosen Tetap (NDTPS)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        if ($ndtps == 0) return number_format(0, 2);

        // 2. Hitung jumlah total luaran Hak Cipta
        $totalHakCipta = LuaranHkiHakCipta::where('prodi_id', $prodi_id)->count();

        // 3. Hitung Rasio (RI)
        $ri = $totalHakCipta / $ndtps;

        // 4. Logika Skor Matriks LAM Teknik
        if ($ri >= 0.5) {
            return number_format(4, 2);
        } else {
            return number_format(2 + (4 * $ri), 2);
        }
    }
    /**
     * Hitung Skor Indikator 35: Luaran Teknologi / Produk / Karya Seni (Tabel 4.f.3)
     */
    public static function hitungSkorLuaranTeknologi($prodi_id)
    {
        // 1. Ambil jumlah Dosen Tetap (NDTPS)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        if ($ndtps == 0) return number_format(0, 2);

        // 2. Hitung jumlah total luaran Teknologi/Produk
        $totalTeknologi = LuaranTeknologiProduk::where('prodi_id', $prodi_id)->count();

        // 3. Hitung Rasio (RI)
        $ri = $totalTeknologi / $ndtps;

        // 4. Logika Skor Matriks LAM Teknik
        if ($ri >= 0.5) {
            return number_format(4, 2);
        } else {
            return number_format(2 + (4 * $ri), 2);
        }
    }
    /**
     * Hitung Skor Indikator 36: Luaran Buku ber-ISBN / Book Chapter (Tabel 4.f.4)
     */
    public static function hitungSkorLuaranBuku($prodi_id)
    {
        // 1. Ambil jumlah Dosen Tetap (NDTPS)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        if ($ndtps == 0) return number_format(0, 2);

        // 2. Hitung jumlah total luaran Buku ISBN
        $totalBuku = LuaranBukuIsbn::where('prodi_id', $prodi_id)->count();

        // 3. Hitung Rasio (RI)
        $ri = $totalBuku / $ndtps;

        // 4. Logika Skor Matriks LAM Teknik
        if ($ri >= 0.5) {
            return number_format(4, 2);
        } else {
            return number_format(2 + (4 * $ri), 2);
        }
    }

    /**
     * Hitung Skor Indikator Kurikulum: Persentase MK Kompetensi (Tabel 3.a.1)
     */
    public static function hitungSkorKurikulum($prodi_id)
    {
        // 1. Ambil semua data mata kuliah untuk prodi ini
        $mataKuliah = Kurikulum::where('prodi_id', $prodi_id)->get();

        if ($mataKuliah->isEmpty()) return number_format(0, 2);

        $totalSksAll = 0;
        $totalSksKompetensi = 0;

        // 2. Looping untuk menghitung total SKS
        foreach ($mataKuliah as $mk) {
            // Hitung SKS per MK (gabungan kuliah, seminar, praktikum)
            $sksMk = $mk->sks_kuliah + $mk->sks_seminar + $mk->sks_praktikum;
            
            $totalSksAll += $sksMk;

            // Jika MK ini adalah MK Kompetensi (is_mk_kompetensi == 1)
            if ($mk->is_mk_kompetensi == 1) {
                $totalSksKompetensi += $sksMk;
            }
        }

        // Hindari pembagian dengan nol
        if ($totalSksAll == 0) return number_format(0, 2);

        // 3. Hitung Rasio / Persentase (P_MKK)
        $pMkk = $totalSksKompetensi / $totalSksAll;

        // 4. Logika Skor Matriks LAM Teknik 
        // ⚠️ CATATAN: Target rasio di sini diasumsikan 0.5 (50%). 
        // Silakan sesuaikan angka 0.5 ini dengan buku matriks PDF LAM Teknik Anda!
        if ($pMkk >= 0.5) {
            return number_format(4, 2);
        } else {
            // Contoh interpolasi linier jika target kurang dari 50%
            return number_format(1 + (6 * $pMkk), 2); 
        }
    }

    /**
     * Hitung Skor Indikator 23: Keterlibatan Mahasiswa dalam Penelitian DTPS
     * Menggabungkan data dari Tabel 3.b (NPD) dan Tabel 6.h.1 (NPMhs)
     */
    public static function hitungSkorPenelitianMhs($prodi_id)
    {
        // 1. Hitung NPD (Total Judul Penelitian dari Tabel 3.b)
        $dataPenelitian = PenelitianDtps::where('prodi_id', $prodi_id)->get();
        
        // Menjumlahkan seluruh kolom jumlah_ts, ts1, dan ts2 dari semua sumber pembiayaan
        $npd = $dataPenelitian->sum(function($item) {
            return $item->jumlah_ts2 + $item->jumlah_ts1 + $item->jumlah_ts;
        });

        if ($npd == 0) return number_format(0, 2);

        // 2. Hitung NPMhs (Penelitian yang melibatkan mahasiswa dari Tabel 6.h.1)
        // Menggunakan distinct pada judul_kegiatan agar judul yang sama tidak terhitung ganda
        $npmhs = \App\Models\PenelitianDtpsMahasiswa::where('prodi_id', $prodi_id)
                    ->distinct('judul_kegiatan')
                    ->count('judul_kegiatan');

        // 3. Hitung Rasio PPDMhs
        $ppdmhs = $npmhs / $npd;

        // 4. Logika Skor Matriks APS-AV 2025 1.0
        if ($ppdmhs >= 0.5) {
            $skor = 4;
        } else {
            $skor = 1 + (6 * $ppdmhs);
        }

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Indikator 25: PkM DTPS yang Melibatkan Mahasiswa (Tabel 6.i & 3.c)
     * Berdasarkan Matriks APS-AV 2025 Hal. 15
     */
    public static function hitungSkorPkmMhs($prodi_id)
    {
        // 1. NPKD: Jumlah total judul PkM DTPS (Tabel 3.c)
        $dataPkm = PkmDtps::where('prodi_id', $prodi_id)->get();
        $npkd = $dataPkm->sum(function($item) {
            return $item->jumlah_ts2 + $item->jumlah_ts1 + $item->jumlah_ts;
        });

        if ($npkd == 0) return number_format(0, 2);

        // 2. NPKMhs: Jumlah judul PkM yang melibatkan mahasiswa (Tabel 6.i)
        $npkmhs = PkmDtpsMahasiswa::where('prodi_id', $prodi_id)
                    ->distinct('judul_kegiatan')
                    ->count('judul_kegiatan');

        // 3. Hitung Rasio PKDMhs
        $pkdmhs = $npkmhs / $npkd;

        // 4. Logika Skor Matriks Hal. 15
        if ($pkdmhs >= 0.5) {
            $skor = 4; // Skor 4 jika PKDMhs >= 50% 
        } else {
            $skor = 1 + (6 * $pkdmhs); // Skor 1 + (6 x PKDMhs) jika < 50% 
        }

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Indikator 40: Rasio Mahasiswa terhadap DTPS (Tabel 6.a & 4.a)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 22
     */
    public static function hitungSkorRasioMahasiswa($prodi_id)
    {
        // 1. NDTPS: Jumlah Dosen Tetap (Tabel 4.a)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                    ->where('kategori_dosen', 'Dosen Tetap')
                    ->count();

        // 2. NM: Jumlah Mahasiswa Aktif pada saat TS (Tabel 6.a)
        $mhs = JumlahMahasiswa::where('prodi_id', $prodi_id)
                    ->where('is_diakreditasi', 'Ya')
                    ->first();
        $nm = $mhs ? $mhs->aktif_ts : 0;

        // Kondisi Gugur: Dosen < 5 atau Rasio > 35
        if ($ndtps < 5) return number_format(0, 2);
        
        $rmd = $nm / $ndtps;
        if ($rmd > 35) return number_format(0, 2);

        // 3. Hitung Faktor B (Kualitas Rasio)
        if ($rmd < 15) {
            $b = $rmd / 15;
        } elseif ($rmd <= 25) {
            $b = 1;
        } else { // 25 < RMD <= 35
            $b = (35 - $rmd) / 10;
        }

        // 4. Hitung Skor Akhir berdasarkan Jumlah Dosen (Faktor A)
        if ($ndtps >= 12) {
            // Jika dosen >= 12, langsung pakai 1 + 3B
            $skor = 1 + (3 * $b);
        } else {
            // Jika 5 <= dosen < 12, gunakan faktor A
            $a = ($ndtps - 5) / 7;
            $skor = 1 + (3 * $a * $b);
        }

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Indikator 41: Persentase Mahasiswa Asing (PMA)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 22
     */
    public static function hitungSkorMahasiswaAsing($prodi_id)
    {
        // 1. Ambil data mahasiswa dari Tabel 6.a (jumlah_mahasiswas)
        $mhs = JumlahMahasiswa::where('prodi_id', $prodi_id)
                    ->where('is_diakreditasi', 'Ya')
                    ->first();

        if (!$mhs || $mhs->aktif_ts == 0) return number_format(0, 2);

        // 2. Hitung Total Mahasiswa Asing (Full-time + Part-time) pada TS
        $nma = $mhs->asing_ft_ts + $mhs->asing_pt_ts;
        
        // 3. Hitung Persentase (PMA)
        $pma = $nma / $mhs->aktif_ts;

        // 4. Logika Skor Matriks Hal. 22
        if ($pma >= 0.01) { // 1%
            $skor = 4;
        } else {
            // Skor = 2 + (200 * PMA)
            $skor = 2 + (200 * $pma);
        }

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Indikator 42: IPK Lulusan (Tabel 6.b)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 23
     */
    public static function hitungSkorIpkLulusan($prodi_id)
    {
        // 1. Ambil data rata-rata IPK untuk 3 tahun terakhir (TS, TS-1, TS-2)
        $dataIpk = IpkLulusan::where('prodi_id', $prodi_id)
                    ->whereIn('tahun_lulus', ['TS', 'TS-1', 'TS-2'])
                    ->get();

        if ($dataIpk->isEmpty()) return number_format(0, 2);

        // 2. Hitung RIPK (Rata-rata dari rata-rata IPK 3 tahun)
        $ripk = $dataIpk->avg('ipk_rata');

        // 3. Logika Skor Matriks Hal. 23
        if ($ripk >= 3.25) {
            $skor = 4;
        } elseif ($ripk >= 2.00) {
            // Skor = ((8 * RIPK) - 6) / 5
            $skor = ((8 * $ripk) - 6) / 5;
        } else {
            // Berdasarkan matriks: Tidak ada skor kurang dari 2 jika RIPK >= 2.00. 
            // Namun jika di bawah 2.00, skor tetap diberikan sesuai proporsi atau nilai minimal penjaminan mutu.
            $skor = 0; 
        }

        // Pastikan skor minimal 2 jika ada data (sesuai catatan "Tidak ada skor kurang dari 2")
        if ($ripk >= 2.00 && $skor < 2) {
            $skor = 2;
        }

        return number_format($skor, 2);
    }
    /**
     * Hitung Skor Indikator 43: Prestasi Mahasiswa (Akademik & Non-Akademik)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 23-24
     */
    public static function hitungSkorPrestasiMahasiswa($prodi_id)
    {
        // 1. Ambil NM (Jumlah Mahasiswa Aktif saat TS)
        $mhs = \App\Models\JumlahMahasiswa::where('prodi_id', $prodi_id)
                    ->where('is_diakreditasi', 'Ya')
                    ->first();
        $nm = $mhs ? $mhs->aktif_ts : 0;

        if ($nm == 0) return number_format(0, 2);

        // 2. Hitung Bagian I (Akademik)
        $skorAkademik = self::kalkulasiSubSkorPrestasi(
            PrestasiAkademik::where('prodi_id', $prodi_id)->get(), $nm
        );

        // 3. Hitung Bagian II (Non-Akademik)
        $skorNonAkademik = self::kalkulasiSubSkorPrestasi(
            PrestasiNonAkademik::where('prodi_id', $prodi_id)->get(), $nm
        );

        // 4. Rumus Gabungan: ( (I * 3) + II ) / 4
        $skorAkhir = (($skorAkademik * 3) + $skorNonAkademik) / 4;

        return number_format($skorAkhir, 2);
    }

    /**
     * Fungsi Helper untuk menghitung sub-skor (I atau II)
     */
    private static function kalkulasiSubSkorPrestasi($data, $nm)
    {
        $ni = $data->where('tingkat', 'Internasional')->count();
        $nn = $data->where('tingkat', 'Nasional')->count();
        $nw = $data->where('tingkat', 'Lokal/Wilayah')->count();

        $ri = $ni / $nm;
        $rn = $nn / $nm;
        $rw = $nw / $nm;

        $a = 0.002; // 0.2%
        $b = 0.02;  // 2%
        $c = 0.04;  // 4%

        // Kondisi Skor Maksimal
        if ($ri > $a && $rn > $b) return 4;

        // Faktor Normalisasi (Caps)
        $ri_norm = min($ri, $a);
        $rn_norm = min($rn, $b);
        $rw_norm = min($rw, $c);

        $A = $ri_norm / $a;
        $B = $rn_norm / $b;
        $C = $rw_norm / $c;

        // Rumus Polinomial LAM Teknik
        $skor = 3.75 * (
            ($A + $B + ($C/2)) - 
            ($A * $B) - 
            (($A * $C) / 2) - 
            (($B * $C) / 2) + 
            (($A * $B * $C) / 2)
        );

        return $skor;
    }

    /**
     * Hitung Skor Indikator 44: Masa Studi (Tabel 6.d)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 24
     */
    public static function hitungSkorMasaStudi($prodi_id)
    {
        $data = MasaStudiLulusan::where('prodi_id', $prodi_id)->get();

        if ($data->isEmpty()) return number_format(0, 2);

        $totalLulusan = 0;
        $totalTahunProduk = 0;

        foreach ($data as $item) {
            // Kita gunakan nilai tengah rentang tahun untuk menghitung rata-rata (MS)
            // lulus_3_5 (Rentang 3.5 - 4.5) -> Nilai tengah 4.0
            // lulus_4_5 (Rentang 4.5 - 5.5) -> Nilai tengah 5.0
            // lulus_5_5 (Rentang 5.5 - 6.5) -> Nilai tengah 6.0
            // lulus_6_5 (Rentang 6.5 - 8.0) -> Nilai tengah 7.25
            
            $lulusanRow = $item->lulus_3_5 + $item->lulus_4_5 + $item->lulus_5_5 + $item->lulus_6_5;
            $totalLulusan += $lulusanRow;
            
            $totalTahunProduk += ($item->lulus_3_5 * 4.0) + 
                                 ($item->lulus_4_5 * 5.0) + 
                                 ($item->lulus_5_5 * 6.0) + 
                                 ($item->lulus_6_5 * 7.25);
        }

        if ($totalLulusan == 0) return number_format(0, 2);

        // 1. Hitung MS (Rata-rata Masa Studi)
        $ms = $totalTahunProduk / $totalLulusan;

        // 2. Logika Skor Matriks Hal. 24
        if ($ms > 3.5 && $ms <= 4.5) {
            $skor = 4;
        } elseif ($ms > 4.5 && $ms <= 8) {
            // Skor = (55 - (6 * MS)) / 7
            $skor = (55 - (6 * $ms)) / 7;
        } else {
            // MS <= 3 atau MS > 8
            $skor = 0;
        }

        return number_format(max(0, $skor), 2);
    }
    
    /**
     * Hitung Skor Indikator 45: Kelulusan Tepat Waktu (PTW)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 24
     */
    public static function hitungSkorLulusTepatWaktu($prodi_id)
    {
        // 1. Ambil data angkatan TS-4 (Angkatan yang harusnya lulus tepat waktu di tahun TS)
        $data = MasaStudiLulusan::where('prodi_id', $prodi_id)
                    ->where('tahun_masuk', 'TS-4')
                    ->first();

        if (!$data || $data->jumlah_masuk == 0) return number_format(0, 2);

        // 2. Variabel b = Lulus tepat waktu (3,5 < MS <= 4,5 tahun)
        $b = $data->lulus_3_5;
        $a = $data->jumlah_masuk;

        // 3. Hitung Rasio PTW
        $ptw = $b / $a;

        // 4. Logika Skor Matriks Hal. 24
        if ($ptw >= 0.5) {
            $skor = 4;
        } elseif ($ptw > 0) {
            // Skor = 1 + (6 * PTW)
            $skor = 1 + (6 * $ptw);
        } else {
            $skor = 0;
        }

        return number_format($skor, 2);
    }
    /**
     * Hitung Skor Indikator 46: Publikasi Ilmiah Mahasiswa
     * Presisi sesuai Matriks APS-AV 2025 Hal. 24-25
     */
    public static function hitungSkorPublikasiMahasiswa($prodi_id)
    {
        // 1. Ambil NM (Jumlah Mahasiswa saat TS) dari tabel jumlah_mahasiswas
        $mhs = \App\Models\JumlahMahasiswa::where('prodi_id', $prodi_id)->where('is_diakreditasi', 'Ya')->first();
        $nm = $mhs ? $mhs->aktif_ts : 0;
        if ($nm == 0) return number_format(0, 2);

        // 2. Ambil semua data publikasi mahasiswa
        $publikasi = PublikasiIlmiahMahasiswa::where('prodi_id', $prodi_id)->get();

        // Helper untuk menjumlahkan ts, ts_1, dan ts_2 per kategori
        $getSum = function($identifier) use ($publikasi) {
            $row = $publikasi->where('media_publikasi', $identifier)->first();
            return $row ? ($row->ts + $row->ts_1 + $row->ts_2) : 0;
        };

        // Pemetaan Kategori sesuai Matriks Hal. 25
        $na1 = $getSum('Jurnal nasional tidak terakreditasi');
        $na2 = $getSum('Jurnal nasional terakreditasi');
        $na3 = $getSum('Jurnal internasional');
        $na4 = $getSum('Jurnal internasional bereputasi');
        $nb1 = $getSum('Prosiding seminar nasional/wilayah');
        $nb2 = $getSum('Prosiding seminar internasional tidak terindeks');
        $nb3 = $getSum('Prosiding seminar internasional terindeks Scopus/WoS');

        // 3. Hitung Rasio RI, RN, RW
        $ri = ($na4 + $nb3) / $nm;
        $rn = ($na2 + $na3 + $nb2) / $nm;
        $rw = ($na1 + $nb1) / $nm;

        $a = 0.01; $b = 0.1; $c = 0.5;

        // Kondisi Skor 4 (Unggul)
        if ($ri > $a && $rn > $b) return number_format(4, 2);

        // 4. Hitung Faktor A, B, C untuk rumus polinomial
        $A = min($ri / $a, 1);
        $B = min($rn / $b, 1);
        $C = min($rw / $c, 1);

        // Rumus Skor sesuai Matriks Hal. 24
        $skor = 3.75 * (
            ($A + $B + ($C / 2)) - 
            ($A * $B) - 
            (($A * $C) / 2) - 
            (($B * $C) / 2) + 
            (($A * $B * $C) / 2)
        );

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Indikator 47: Luaran Penelitian/PkM Mahasiswa
     * Presisi sesuai Matriks APS-AV 2025 Hal. 25
     */
    public static function hitungSkorLuaranMhs($prodi_id)
    {
        $luaran = LuaranHkiMahasiswa::where('prodi_id', $prodi_id)->get();

        if ($luaran->isEmpty()) return number_format(2.00, 2); // Skor minimal adalah 2 jika data kosong tapi sudah akreditasi

        // Mapping bobot berdasarkan keyword di kolom 'luaran_penelitian'
        $nPaten = 0; // Bobot 3
        $nTTG_NBC = 0; // Bobot 2
        $nHKI = 0; // Bobot 1

        foreach ($luaran as $item) {
            $text = strtolower($item->luaran_penelitian);
            
            if (str_contains($text, 'paten')) {
                $nPaten++;
            } elseif (str_contains($text, 'teknologi') || str_contains($text, 'produk') || str_contains($text, 'buku') || str_contains($text, 'isbn')) {
                $nTTG_NBC++;
            } else {
                // Diasumsikan sebagai Hak Cipta/Pencatatan Ciptaan (NHKI)
                $nHKI++;
            }
        }

        // Rumus NLP: (3 * NPaten) + (2 * (NTTG + NBC)) + NHKI
        $nlp = (3 * $nPaten) + (2 * $nTTG_NBC) + $nHKI;

        // Logika Skor Matriks Hal. 25
        if ($nlp >= 10) {
            $skor = 4;
        } else {
            // Skor = 2 + (0.2 * NLP)
            $skor = 2 + (0.2 * $nlp);
        }

        return number_format($skor, 2);
    }
    /**
     * Hitung Skor Indikator 49: Waktu Tunggu Lulusan (Tabel 6.f.1)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 26
     */
    public static function hitungSkorWaktuTunggu($prodi_id)
    {
        // 1. Ambil data hanya untuk lulusan TS-2 dan TS-1
        $data = WaktuTungguLulusan::where('prodi_id', $prodi_id)
                    ->whereIn('tahun_lulus', ['TS-2', 'TS-1'])
                    ->get();

        if ($data->isEmpty()) return number_format(1.00, 2); // Skor minimal adalah 1

        $totalLulusan = $data->sum('jumlah_lulusan');
        $totalTerlacak = $data->sum('jumlah_lulusan_terlacak');

        if ($totalTerlacak == 0) return number_format(1.00, 2);

        // 2. Hitung Waktu Tunggu (WT) dengan metode nilai tengah (Midpoint)
        $wtKurang3 = $data->sum('wt_kurang_3_bulan');
        $wtAntara = $data->sum('wt_antara_3_18_bulan');
        $wtLebih = $data->sum('wt_lebih_18_bulan');

        $totalBulan = ($wtKurang3 * 1.5) + ($wtAntara * 10.5) + ($wtLebih * 24.0);
        $wt = $totalBulan / $totalTerlacak;

        // 3. Logika Skor Matriks Hal. 26
        if ($wt <= 3) {
            $skor = 4;
        } elseif ($wt <= 18) {
            $skor = (23 - $wt) / 5;
        } else {
            $skor = 1;
        }

        // Syarat Response Rate: Minimal 30% (0.30)
        // (Biasanya auditor menurunkan skor jika tidak memenuhi kuota responden)
        $responseRate = $totalTerlacak / $totalLulusan;
        if ($responseRate < 0.30) {
            $skor = $skor * ($responseRate / 0.30); // Penalti proporsional
        }

        return number_format(max(1, $skor), 2); // Pastikan skor tidak pernah < 1
    }
    }
