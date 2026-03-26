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
use App\Models\PrestasiAkademik;
use App\Models\PrestasiNonAkademik;
use App\Models\MasaStudiLulusan;
use App\Models\PublikasiIlmiahMahasiswa;
use App\Models\LuaranHkiMahasiswa;
use App\Models\WaktuTungguLulusan;
use App\Models\KesesuaianBidangKerja;
use App\Models\TempatKerjaLulusan;
use App\Models\KepuasanPenggunaLulusan;
use App\Models\IntegrasiPembelajaran;
use App\Models\MatkulBasicScience;
use App\Models\CapstoneDesign;
use App\Models\IpkLulusan;
use App\Models\DokumenSpmi;
use App\Models\Keuangan;
use App\Models\VisiMisi;
use App\Models\DokumenPembelajaran;
use App\Models\PengakuanDtps;


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
     * Hitung Skor Keuangan (Indikator 9, 10, 11)
     * Referensi: Matriks LAM Teknik Hal. 6-7
     */
    public static function hitungSkorKeuangan($prodi_id)
    {
        $data = Keuangan::where('prodi_id', $prodi_id)
            ->whereIn('tahun', ['TS-2', 'TS-1', 'TS'])
            ->get();

        if ($data->isEmpty()) return [
            'skorBop' => '0.00',
            'skorDpd' => '0.00',
            'skorDpkm' => '0.00'
        ];

        // Rata-rata 3 tahun
        $avgBop = $data->avg('dana_operasional_mhs');
        $avgDpd = $data->avg('dana_penelitian_dtps');
        $avgDpkm = $data->avg('dana_pkm_dtps');

        // Skor Indikator 9 (BOP)
        $skorBop = ($avgBop > 20000000) ? 4 : ($avgBop / 5000000);

        // Skor Indikator 10 (DPD)
        $skorDpd = ($avgDpd >= 10000000) ? 4 : ((2 * $avgDpd) / 5000000);

        // Skor Indikator 11 (DPkM)
        $skorDpkm = ($avgDpkm >= 5000000) ? 4 : ((4 * $avgDpkm) / 5000000);

        return [
            'skorBop' => number_format(max(0, min(4, $skorBop)), 2),
            'skorDpd' => number_format(max(0, min(4, $skorDpd)), 2),
            'skorDpkm' => number_format(max(0, min(4, $skorDpkm)), 2)
        ];
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
     * Hitung Skor Indikator 31: Penelitian DTPS (Tabel 3.b)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 16-17
     */
    public static function hitungSkorPenelitianDtps($prodi_id)
    {
        // 1. Ambil NDTPS (Dosen Tetap Inti)
        $ndtps = \App\Models\ProfilDosen::where('prodi_id', $prodi_id)
                ->where('kategori_dosen', 'Dosen Tetap')
                ->where('kesesuaian_kompetensi', 'V')
                ->count();

        if ($ndtps == 0) return number_format(0, 2);

        // 2. Ambil data penelitian dari Tabel 3.b
        $penelitian = \App\Models\PenelitianDtps::where('prodi_id', $prodi_id)->get();

        $ni = 0; // Luar Negeri
        $nn = 0; // Dalam Negeri
        $nw = 0; // PT / Mandiri

        foreach ($penelitian as $p) {
            $total = $p->jumlah_ts2 + $p->jumlah_ts1 + $p->jumlah_ts;
            $sumber = strtolower($p->sumber_pembiayaan);

            if (str_contains($sumber, 'luar negeri') || str_contains($sumber, 'internasional')) {
                $ni += $total;
            } elseif (str_contains($sumber, 'dalam negeri') || str_contains($sumber, 'nasional') || str_contains($sumber, 'kementerian')) {
                $nn += $total;
            } else {
                // Sisanya masuk ke kategori Perguruan Tinggi / Mandiri / Wilayah
                $nw += $total;
            }
        }

        // 3. Hitung Rasio per tahun per dosen
        $ri = $ni / 3 / $ndtps;
        $rn = $nn / 3 / $ndtps;
        $rw = $nw / 3 / $ndtps;

        // Faktor Ketetapan LAM Teknik
        $a = 0.05;
        $b = 0.30;
        $c = 1.00;

        // 4. Logika Skor
        if ($ri > $a && $rn > $b) {
            $skor = 4;
        } else {
            // Batasi nilai rasio maksimal (Caps) sesuai aturan matriks
            $ri_capped = min($ri, $a);
            $rn_capped = min($rn, $b);
            $rw_capped = min($rw, $c);

            $A_val = $ri_capped / $a;
            $B_val = $rn_capped / $b;
            $C_val = $rw_capped / $c;

            // Rumus Polinomial
            $skor = 3.75 * (
                ($A_val + $B_val + ($C_val / 2)) - 
                ($A_val * $B_val) - 
                (($A_val * $C_val) / 2) - 
                (($B_val * $C_val) / 2) + 
                (($A_val * $B_val * $C_val) / 2)
            );
        }

        return number_format(max(0, $skor), 2);
    }

       /**
     * Hitung Skor Indikator 26: Kecukupan DTPS (Tabel 4.a)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 15 (Dengan koreksi PDTT > 40%)
     */
    public static function hitungSkorKecukupanDosen($prodi_id)
    {
        // 1. Hitung NDT (Seluruh Dosen Tetap)
        $ndt = ProfilDosen::where('prodi_id', $prodi_id)
                ->where('kategori_dosen', 'Dosen Tetap')
                ->count();

        // 2. Hitung NDTPS (Dosen Tetap yang sesuai kompetensi inti)
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
                ->where('kategori_dosen', 'Dosen Tetap')
                ->where('kesesuaian_kompetensi', 'V')
                ->count();

        // 3. Hitung NDTT (Dosen Tidak Tetap & Dosen Industri)
        $ndtt = ProfilDosen::where('prodi_id', $prodi_id)
                ->whereIn('kategori_dosen', ['Dosen Tidak Tetap', 'Dosen Industri'])
                ->count();

        // Kondisi Gugur: Dosen Inti kurang dari 5
        if ($ndtps < 5) return number_format(0, 2);

        // 4. Hitung Persentase Dosen Tidak Tetap (PDTT) dalam format desimal (contoh 0.40 = 40%)
        $totalDosen = $ndt + $ndtt;
        $pdtt = ($totalDosen > 0) ? ($ndtt / $totalDosen) : 0;

        // 5. Logika Skor Matriks Indikator 26
        if ($ndtps >= 12 && $pdtt <= 0.10) {
            // Kondisi Unggul
            $skor = 4;
        } elseif ($ndtps >= 5 && $pdtt > 0.40) {
            // Koreksi dari Anda: Safetynet jika PDTT lebih dari 40%
            $skor = 2;
        } elseif ($ndtps >= 12 && $pdtt > 0.10 && $pdtt <= 0.40) {
            // NDTPS >= 12, tapi PDTT membengkak sedikit
            $b = (0.40 - $pdtt) / 0.30;
            $skor = 2 + (2 * $b);
        } else {
            // NDTPS antara 5 s.d 11, dan PDTT wajar (<= 40%)
            $a = ($ndtps - 5) / 7;
            $b = (0.40 - $pdtt) / 0.40;
            $skor = 2 + 2 * ($a * $b);
        }

        return number_format($skor, 2);
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
     * Hitung Skor Indikator 30: Beban Kerja DTPS (Tabel 4.c)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 17
     */
    public static function hitungSkorBebanKerja($prodi_id)
    {
        // 1. Ambil data beban kerja khusus DTPS
        $data = BebanKerjaDosen::where('prodi_id', $prodi_id)
                    ->where('is_dtps', 'Ya')
                    ->get();

        // Aturan matriks: Tidak ada skor kurang dari 1
        if ($data->isEmpty()) return number_format(1.00, 2); 

        // 2. Hitung RBK (Rata-rata dari kolom sks_rata_rata)
        $rbk = $data->avg('sks_rata_rata');

        // 3. Logika Skor Matriks Hal. 17
        if ($rbk >= 12 && $rbk <= 16) {
            $skor = 4;
        } elseif ($rbk > 16 && $rbk <= 20) {
            // Rumus: (64 - (3 x RBK)) / 4
            $skor = (64 - (3 * $rbk)) / 4;
        } else {
            // Jika RBK < 12 (underload) atau > 20 (extreme overload)
            $skor = 1; 
        }

        // 4. Pengaman akhir (Safety Net)
        return number_format(max(1, $skor), 2);
    }
    /**
     * Hitung Skor Indikator 33: Publikasi Ilmiah DTPS (Tabel 4.d)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 17-18
     */
    public static function hitungSkorPublikasiDtps($prodi_id)
    {
        // 1. Ambil NDTPS (Dosen Tetap Inti)
        $ndtps = \App\Models\ProfilDosen::where('prodi_id', $prodi_id)
                ->where('kategori_dosen', 'Dosen Tetap')
                ->where('kesesuaian_kompetensi', 'V')
                ->count();

        if ($ndtps == 0) return number_format(0, 2);

        // 2. Ambil data publikasi dari Tabel 4.d
        $publikasi = \App\Models\PublikasiIlmiahDtps::where('prodi_id', $prodi_id)->get();

        $ni = 0; // Internasional
        $nn = 0; // Nasional
        $nw = 0; // Wilayah / Lokal / Tidak Terakreditasi

        foreach ($publikasi as $pub) {
            $total = $pub->jumlah_total; // Menggunakan kolom auto-kalkulasi Anda
            $jenis = strtolower($pub->jenis_publikasi);

            if (str_contains($jenis, 'internasional')) {
                $ni += $total;
            } elseif (str_contains($jenis, 'nasional') && !str_contains($jenis, 'tidak terakreditasi')) {
                // Jurnal/Prosiding Nasional Terakreditasi
                $nn += $total;
            } else {
                // Jurnal Nasional Tidak Terakreditasi, Wilayah, Lokal, Media Massa
                $nw += $total;
            }
        }

        // 3. Hitung Rasio per tahun per dosen (dibagi 3 tahun, dibagi NDTPS)
        $ri = $ni / 3 / $ndtps;
        $rn = $nn / 3 / $ndtps;
        $rw = $nw / 3 / $ndtps;

        // Faktor Ketetapan Publikasi DTPS
        $a = 0.05;
        $b = 0.50;
        $c = 2.00;

        // 4. Logika Skor
        if ($ri > $a && $rn > $b) {
            $skor = 4;
        } else {
            $ri_capped = min($ri, $a);
            $rn_capped = min($rn, $b);
            $rw_capped = min($rw, $c);

            $A_val = $ri_capped / $a;
            $B_val = $rn_capped / $b;
            $C_val = $rw_capped / $c;

            $skor = 3.75 * (
                ($A_val + $B_val + ($C_val / 2)) - 
                ($A_val * $B_val) - 
                (($A_val * $C_val) / 2) - 
                (($B_val * $C_val) / 2) + 
                (($A_val * $B_val * $C_val) / 2)
            );
        }

        return number_format(max(0, $skor), 2);
    }
    /**
     * Hitung Skor Indikator 34: Luaran Penelitian dan PkM DTPS (Tabel 4.f / 4.e)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 18 (Sistem Bobot RLP)
     */
    public static function hitungSkorKaryaIlmiahDtps($prodi_id)
    {
        // 1. Ambil NDTPS (Dosen Tetap Inti)
        $ndtps = \App\Models\ProfilDosen::where('prodi_id', $prodi_id)
                ->where('kategori_dosen', 'Dosen Tetap')
                ->where('kesesuaian_kompetensi', 'V')
                ->count();

        // Tidak ada skor kurang dari 2 (Sesuai pengaman matriks)
        if ($ndtps == 0) return number_format(2.00, 2); 

        // 2. Ambil data luaran karya ilmiah DTPS
        $luaran = \App\Models\KaryaIlmiahDtps::where('prodi_id', $prodi_id)->get();

        $nPaten = 0;    // Bobot 3
        $nTTG_NBC = 0;  // Bobot 2
        $nHKI = 0;      // Bobot 1

        foreach ($luaran as $item) {
            $jenis = strtolower($item->jenis_publikasi);
            $total = $item->jumlah_total; // Pakai auto-kalkulasi dari migrasi Anda

            if (str_contains($jenis, 'paten')) {
                $nPaten += $total;
            } elseif (str_contains($jenis, 'teknologi') || str_contains($jenis, 'produk') || str_contains($jenis, 'buku') || str_contains($jenis, 'isbn') || str_contains($jenis, 'chapter')) {
                $nTTG_NBC += $total;
            } else {
                // Asumsi sisanya adalah Hak Cipta / Pencatatan Ciptaan biasa
                $nHKI += $total;
            }
        }

        // 3. Hitung RLP sesuai rumus matriks: ((3 x NPaten) + 2 x (NTTG + NBC) + NHKI) / NDTPS
        $pembilang = (3 * $nPaten) + (2 * $nTTG_NBC) + $nHKI;
        $rlp = $pembilang / $ndtps;

        // 4. Logika Skor Matriks Hal. 18
        if ($rlp >= 3) {
            $skor = 4;
        } else {
            // Skor = 2 + ((2 x RLP) / 3)
            $skor = 2 + ((2 * $rlp) / 3);
        }

        // Pengaman berlapis: Tidak ada skor kurang dari 2
        return number_format(max(2, $skor), 2);
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
     * Hitung Skor Indikator 32: Kegiatan PkM DTPS (Tabel 3.c)
     * Presisi sesuai Matriks APS-AV 2025
     */
    public static function hitungSkorPkmDtps($prodi_id)
    {
        // 1. Ambil NDTPS (Dosen Tetap Inti)
        $ndtps = \App\Models\ProfilDosen::where('prodi_id', $prodi_id)
                ->where('kategori_dosen', 'Dosen Tetap')
                ->where('kesesuaian_kompetensi', 'V')
                ->count();

        if ($ndtps == 0) return number_format(0, 2);

        // 2. Ambil data PkM dari Tabel 3.c
        $pkm = PkmDtps::where('prodi_id', $prodi_id)->get();

        $ni = 0; // Luar Negeri
        $nn = 0; // Dalam Negeri
        $nw = 0; // PT / Mandiri / Wilayah

        foreach ($pkm as $p) {
            $total = $p->jumlah_ts2 + $p->jumlah_ts1 + $p->jumlah_ts;
            $sumber = strtolower($p->sumber_pembiayaan);

            if (str_contains($sumber, 'luar negeri') || str_contains($sumber, 'internasional')) {
                $ni += $total;
            } elseif (str_contains($sumber, 'dalam negeri') || str_contains($sumber, 'nasional') || str_contains($sumber, 'kementerian')) {
                $nn += $total;
            } else {
                $nw += $total;
            }
        }

        // 3. Hitung Rasio per tahun per dosen
        $ri = $ni / 3 / $ndtps;
        $rn = $nn / 3 / $ndtps;
        $rw = $nw / 3 / $ndtps;

        // Faktor Ketetapan
        $a = 0.05;
        $b = 0.30;
        $c = 1.00;

        // 4. Logika Skor
        if ($ri > $a && $rn > $b) {
            $skor = 4;
        } else {
            $ri_capped = min($ri, $a);
            $rn_capped = min($rn, $b);
            $rw_capped = min($rw, $c);

            $A_val = $ri_capped / $a;
            $B_val = $rn_capped / $b;
            $C_val = $rw_capped / $c;

            $skor = 3.75 * (
                ($A_val + $B_val + ($C_val / 2)) - 
                ($A_val * $B_val) - 
                (($A_val * $C_val) / 2) - 
                (($B_val * $C_val) / 2) + 
                (($A_val * $B_val * $C_val) / 2)
            );
        }

        return number_format(max(0, $skor), 2);
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

    /**
     * Hitung Skor Indikator 50: Kesesuaian Bidang Kerja Lulusan (Tabel 6.f.2)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 26
     */
    public static function hitungSkorKesesuaianKerja($prodi_id)
    {
        // 1. Ambil data hanya untuk lulusan TS-2 dan TS-1
        $data = KesesuaianBidangKerja::where('prodi_id', $prodi_id)
                    ->whereIn('tahun_lulus', ['TS-2', 'TS-1'])
                    ->get();

        if ($data->isEmpty()) return number_format(1.00, 2); // Minimum skor adalah 1

        $totalLulusan = $data->sum('jumlah_lulusan');
        $totalTerlacak = $data->sum('jumlah_lulusan_terlacak');

        if ($totalTerlacak == 0) return number_format(1.00, 2);

        // 2. Hitung KBK (Kesesuaian Tinggi + Sedang)
        $kesesuaianTinggiSedang = $data->sum('kesesuaian_tinggi') + $data->sum('kesesuaian_sedang');
        
        // KBK dalam format desimal (contoh: 0.60 untuk 60%)
        $kbk = $kesesuaianTinggiSedang / $totalTerlacak;

        // 3. Logika Skor Matriks Hal. 26
        // Jika memasukkan $kbk = 0.60 ke rumus (20 * 0.60) / 3 = 12 / 3 = 4
        if ($kbk >= 0.60) {
            $skor = 4;
        } else {
            $skor = (20 * $kbk) / 3;
        }

        // 4. Syarat Response Rate: Minimal 30% (0.30)
        $responseRate = $totalTerlacak / $totalLulusan;
        if ($responseRate < 0.30) {
            // Penalti proporsional jika responden di bawah 30%
            $skor = $skor * ($responseRate / 0.30);
        }

        return number_format(max(1, $skor), 2); // Pastikan tidak jatuh di bawah 1.00
    }

    /**
     * Hitung Skor Indikator 51: Tingkat & Ukuran Tempat Kerja Lulusan (Tabel 6.g.1)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 26
     */
    public static function hitungSkorTempatKerja($prodi_id)
    {
        $data = \App\Models\TempatKerjaLulusan::where('prodi_id', $prodi_id)->get();

        if ($data->isEmpty()) return number_format(0, 2);

        $nl = $data->sum('jumlah_lulusan');
        $nTerlacak = $data->sum('jumlah_tanggapan'); // Mengacu pada kolom respon

        if ($nl == 0 || $nTerlacak == 0) return number_format(0, 2);

        // Jumlah lulusan berdasarkan tingkat
        $ni = $data->sum('tingkat_multinasional');
        $nn = $data->sum('tingkat_nasional');
        $nw = $data->sum('tingkat_lokal');

        // Rasio dalam format desimal (contoh: 0.05 untuk 5%)
        $ri = $ni / $nl;
        $rn = $nn / $nl;
        $rw = $nw / $nl;

        // Faktor Ketetapan
        $a = 0.05; // 5%
        $b = 0.20; // 20%
        $c = 0.90; // 90%

        // Kondisi Skor 4.00
        if ($ri > $a && $rn > $b) {
            $skor = 4;
        } else {
            // Batasi nilai rasio maksimal sesuai nilai a, b, c (Aturan "Jika RI >= a... dst")
            $ri_capped = min($ri, $a);
            $rn_capped = min($rn, $b);
            $rw_capped = min($rw, $c);

            $A = $ri_capped / $a;
            $B = $rn_capped / $b;
            $C = $rw_capped / $c;

            // Persamaan Polinomial LAM Teknik
            $skor = 3.75 * (
                ($A + $B + ($C / 2)) - 
                ($A * $B) - 
                (($A * $C) / 2) - 
                (($B * $C) / 2) + 
                (($A * $B * $C) / 2)
            );
        }

        // Syarat Response Rate: Minimal 30%
        $responseRate = $nTerlacak / $nl;
        if ($responseRate < 0.30) {
            // Berikan penalti proporsional jika partisipasi tracer study rendah
            $skor = $skor * ($responseRate / 0.30);
        }

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Indikator 52: Kepuasan Pengguna Lulusan (Tabel 6.g.2)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 26
     */
    public static function hitungSkorKepuasanPengguna($prodi_id)
    {
        $data = \App\Models\KepuasanPenggunaLulusan::where('prodi_id', $prodi_id)->get();

        if ($data->isEmpty()) return number_format(0, 2);

        $totalTki = 0;

        foreach ($data as $item) {
            // Mengubah nilai persentase di database (misal 80.5) menjadi desimal (0.805)
            $ai = $item->sangat_baik / 100;
            $bi = $item->baik / 100;
            $ci = $item->cukup / 100;
            $di = $item->kurang / 100;

            // Rumus: TKi = (4 x ai) + (3 x bi) + (2 x ci) + (1 x di)
            $tki = (4 * $ai) + (3 * $bi) + (2 * $ci) + (1 * $di);
            
            $totalTki += $tki;
        }

        // Skor akhir adalah total TKi dibagi 7 (konstan sesuai 7 aspek LAM Teknik)
        $skor = $totalTki / 7;

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Indikator 17: Integrasi Penelitian & PkM dalam Pembelajaran (Tabel 3.a.3)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 10-11
     */
    public static function hitungSkorIntegrasiPembelajaran($prodi_id)
    {
        // 1. Ambil data integrasi pembelajaran milik prodi terkait
        $data = \App\Models\IntegrasiPembelajaran::where('prodi_id', $prodi_id)->get();

        if ($data->isEmpty()) return number_format(1.00, 2); // Matriks mensyaratkan minimal skor 1

        // 2. Hitung jumlah Mata Kuliah UNIK yang diintegrasikan
        // (Satu mata kuliah bisa diisi oleh beberapa penelitian, tapi dihitung 1 MK)
        $mkTerintegrasi = $data->unique('mata_kuliah')->count();

        // 3. Tentukan Total Mata Kuliah Inti Prodi
        // TODO: Ganti angka 40 ini dengan query Count ke tabel Kurikulum Anda jika ada.
        // Contoh: $totalMkInti = Kurikulum::where('prodi_id', $prodi_id)->where('jenis_mk', 'Inti')->count();
        $totalMkInti = 40; 

        if ($totalMkInti == 0) return number_format(1.00, 2);

        // 4. Hitung Persentase Integrasi
        $persentase = ($mkTerintegrasi / $totalMkInti) * 100;

        // 5. Logika Skor Matriks Hal. 10-11
        // Syarat utama: minimal 10% dari MK Inti
        if ($persentase >= 10) {
            $skor = 4; // Asumsi 4 aspek kualitatif terpenuhi karena sudah tervalidasi di RPS
        } else {
            // Jika kurang dari 10%, skor merosot proporsional menuju batas bawah (1.00)
            $skor = 1 + (3 * ($persentase / 10));
        }

        return number_format(max(1, min(4, $skor)), 2);
    }

    /**
     * Hitung Skor Indikator 19: Basic Science & Matematika (Tabel 3.a.4)
     * Presisi sesuai Matriks APS-AV 2025 Hal. 12
     */
    public static function hitungSkorBasicScience($prodi_id)
    {
        // 1. Hitung total SKS basic science untuk prodi terkait
        $totalSks = \App\Models\MatkulBasicScience::where('prodi_id', $prodi_id)
                    ->sum('jumlah_sks');

        // 2. Logika Skor Matriks Hal. 12
        if ($totalSks >= 25) {
            $skor = 4;
        } elseif ($totalSks >= 20) {
            $skor = 3;
        } elseif ($totalSks >= 15) {
            $skor = 2;
        } elseif ($totalSks >= 10) {
            $skor = 1;
        } else {
            $skor = 0;
        }

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Indikator 34: Luaran Penelitian & PkM DTPS (Tabel 4.f)
     * Sesuai Matriks LAM Teknik 2025 Hal. 19 [cite: 123]
     */
    public static function hitungSkorLuaranPenelitianPkM($prodi_id)
    {
        // 1. Hitung NDTPS (Dosen Tetap sesuai kompetensi) [cite: 123]
        $ndtps = ProfilDosen::where('prodi_id', $prodi_id)
            ->where('kategori_dosen', 'Dosen Tetap')
            ->where('kesesuaian_kompetensi', 'V')
            ->count();

        // Jika tidak ada dosen, skor minimal 0 (hindari pembagian dengan nol)
        if ($ndtps == 0) return number_format(0.00, 2);

        // 2. Ambil data luaran dari tabel-tabel yang sudah dibuat [cite: 123]
        $nPaten = LuaranHkiPaten::where('prodi_id', $prodi_id)->count();
        $nTTG   = LuaranTeknologiProduk::where('prodi_id', $prodi_id)->count();
        $nBC    = LuaranBukuIsbn::where('prodi_id', $prodi_id)->count();
        $nHKI   = LuaranHkiHakCipta::where('prodi_id', $prodi_id)->count();

        // 3. Hitung Rasio Luaran Penelitian (RLP) [cite: 123]
        // Rumus: RLP = ((3 * Paten) + (2 * (TTG + Buku)) + Hak Cipta) / NDTPS
        $rlp = ((3 * $nPaten) + 2 * ($nTTG + $nBC) + $nHKI) / $ndtps;

        // 4. Penentuan Skor sesuai Matriks Hal. 19 [cite: 123]
        if ($rlp >= 3) {
            $skor = 4;
        } else {
            // Rumus: Skor = 2 + (2 * RLP / 3)
            $skor = 2 + ((2 * $rlp) / 3);
        }

        return number_format(max(0, min(4, $skor)), 2);
    }

    /**
     * Hitung Skor Indikator 20: Capstone Design (Tabel 3.a.5)
     * Referensi: Matriks Penilaian LAM Teknik Hal. 13
     */
    public static function hitungSkorCapstoneDesign($prodi_id)
    {
        // Ambil data Capstone Design milik prodi terkait
        $data = \App\Models\CapstoneDesign::where('prodi_id', $prodi_id)->first();

        // Jika tidak ada data sama sekali (Tidak menyelenggarakan)
        if (!$data) return number_format(0.00, 2);
    
        $skor = 0;

        // Logika penilaian berjenjang sesuai urutan matriks
        if ($data->has_panduan) {
            $skor = 1;
            if ($data->has_cpl_rumusan) {
                $skor = 2;
                if ($data->has_standar_keteknikan) {
                    $skor = 3;
                    if ($data->has_bukti_sahih) {
                        $skor = 4;
                    }
                }
            }
        }

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Indikator 4: SPMI (Tabel 7)
     * Referensi: Matriks Penilaian LAM Teknik Hal. 5
     */
    public static function hitungSkorSpmi($prodi_id)
    {
        $dokumen = DokumenSpmi::where('prodi_id', $prodi_id)->get();
        
        if ($dokumen->isEmpty()) return number_format(0.00, 2);

        // 1. Cek Kelengkapan 4 Dokumen Baku (Kebijakan, Manual, Standar, Formulir)
        $jenisWajib = ['Kebijakan', 'Manual', 'Standar', 'Formulir'];
        $dokumenAda = $dokumen->pluck('jenis_dokumen')->unique()->toArray();
        $hasSemuaDokumen = count(array_intersect($jenisWajib, $dokumenAda)) == 4;

        // 2. Cek Siklus PPEPP dan Laporan AMI
        $hasPPEPP = $dokumen->where('is_ppepp', true)->isNotEmpty();
        $hasAMI = $dokumen->where('is_ami', true)->isNotEmpty();

        $skor = 0;

        // Logika Berjenjang Matriks LAM Teknik
        if ($hasSemuaDokumen) {
            $skor = 1; // Aspek 1 terpenuhi
            if ($hasPPEPP) {
                $skor = 3; // Matriks: Terlaksana PPEPP & Bukti Sahih (Aspek 2 & 3)
                if ($hasAMI) {
                    $skor = 4; // Aspek 4 terpenuhi
                }
            }
        }

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Indikator 21: Evaluasi Kurikulum (Tabel 3.a.2)
     * Referensi: Matriks LAM Teknik Hal. 14
     */
    public static function hitungSkorEvaluasiKurikulum($prodi_id)
    {
        // Ambil data kurikulum terakhir milik prodi
        $data = Kurikulum::where('prodi_id', $prodi_id)->latest()->first();

        if (!$data) return number_format(0.00, 2);

        $skor = 0;

        // Logika Berjenjang (Cascading) sesuai Matriks
        if ($data->libatkan_stakeholder) {
            $skor = 1;
            if ($data->sesuai_visi_misi) {
                $skor = 2;
                if ($data->update_berkala) {
                    $skor = 3;
                    if ($data->implementasi_hasil_evaluasi) {
                        $skor = 4;
                    }
                }
            }
        }

        return number_format($skor, 2);
    }

    /**
     * Hitung Skor Kriteria I: VMTS (Indikator 1, 2, 3)
     * Referensi: Matriks LAM Teknik Hal. 2-3
     */
    public static function hitungSkorVmts($prodi_id)
    {
        // Pastikan mengambil data Visi Keilmuan PS sesuai prodi 
        $data = VisiMisi::where('prodi_id', $prodi_id)
                        ->where('jenis_vmts', 'Visi Keilmuan PS')
                        ->first();

        if (!$data) return ['ind1' => '0.00', 'ind2' => '0.00', 'ind3' => '0.00', 'total' => '0.00'];

        // --- Indikator 1: Kekhasan (Cascading)  ---
        $skor1 = 0;
        if ($data->is_linear_pt && $data->is_sesuai_renstra) {
            $skor1 = 2;
            if ($data->is_sesuai_kurikulum) {
                $skor1 = 3;
                if ($data->is_tinjau_berkala) $skor1 = 4;
            }
        }

        // --- Indikator 2: Mekanisme (Pelibatan Stakeholder)  ---
        $skor2 = 0;
        if ($data->melibatkan_internal) {
            $skor2 = 1; // Hanya Internal
            if ($data->melibatkan_lulusan) {
                $skor2 = 2; // + Lulusan
                if ($data->melibatkan_pengguna) {
                    $skor2 = 3; // + Pengguna Lulusan
                    if ($data->melibatkan_pakar) $skor2 = 4; // + Pakar (Lengkap)
                }
            }
        }

        // --- Indikator 3: Pemahaman & Pencapaian [cite: 21] ---
        $skor3 = 0;
        if ($data->is_sosialisasi_menyeluruh) {
            $skor3 = 1;
            if ($data->is_dipahami_semua) {
                $skor3 = 2;
                if ($data->has_capaian_konkret) {
                    $skor3 = 3;
                    if ($data->is_berdampak_berkelanjutan) $skor3 = 4;
                }
            }
        }

        $total = ($skor1 + $skor2 + $skor3) / 3;

        return [
            'ind1' => number_format($skor1, 2),
            'ind2' => number_format($skor2, 2),
            'ind3' => number_format($skor3, 2),
            'total' => number_format($total, 2)
        ];
    }

    /**
     * Hitung Skor Indikator 18: Jam Pembelajaran Praktik (PJP)
     * Referensi: Matriks LAM Teknik 2025 Hal 11
     */
    public static function hitungSkorPjp($prodi_id)
    {
        // 1. Ambil total jam praktik (JP) dan teori dari database
        $total_praktik = DokumenPembelajaran::where('prodi_id', $prodi_id)->sum('konversi_praktik');
        $total_teori = DokumenPembelajaran::where('prodi_id', $prodi_id)->sum('konversi_teori');

        // 2. Hitung total jam keseluruhan (JB)
        $total_jam = $total_praktik + $total_teori;

        // Jika belum ada data sama sekali, kembalikan nilai 0
        if ($total_jam == 0) {
            return [
                'total_praktik' => 0, 
                'total_jam' => 0, 
                'persentase' => '0.00', 
                'skor' => '0.00'
            ];
        }

        // 3. Hitung persentase PJP (Desimal)
        $pjp = $total_praktik / $total_jam;

        // 4. Logika Penilaian LAM Teknik
        $skor = 0;
        if ($pjp >= 0.20 && $pjp <= 0.50) {
            $skor = 4.00;
        } elseif ($pjp < 0.20) {
            $skor = 20 * $pjp;
        } elseif ($pjp > 0.50) {
            $skor = 8 - (8 * $pjp);
        }

        return [
            'total_praktik' => number_format($total_praktik, 0),
            'total_jam' => number_format($total_jam, 0),
            'persentase' => number_format($pjp * 100, 1), // Tampilkan dalam format persen (misal 25.5)
            'skor' => number_format($skor, 2)
        ];
    }

    /**
     * Hitung Skor Indikator 37: Rekognisi/Pengakuan Kepakaran DTPS
     * Referensi: Tabel 4.d LKPS LAM Teknik
     */
    public static function hitungSkorRekognisiDtps($prodi_id)
    {
        // 1. Ambil jumlah Dosen Tetap Program Studi (DTPS)
        // Sesuaikan nama field 'kategori_dosen' dengan yang ada di tabel profil_dosens Anda
        $jumlah_dtps = ProfilDosen::where('prodi_id', $prodi_id)
                                  ->where('kategori_dosen', 'Dosen Tetap')
                                  ->count();

        // Hindari error division by zero jika prodi belum input dosen
        if ($jumlah_dtps == 0) {
            return [
                'internasional' => 0, 'nasional' => 0, 'wilayah' => 0, 
                'r_dtps' => '0.00', 'skor' => '0.00'
            ];
        }

        // 2. Hitung jumlah pengakuan berdasarkan tingkat
        $internasional = PengakuanDtps::where('prodi_id', $prodi_id)->where('tingkat', 'Internasional')->count();
        $nasional = PengakuanDtps::where('prodi_id', $prodi_id)->where('tingkat', 'Nasional')->count();
        $wilayah = PengakuanDtps::where('prodi_id', $prodi_id)->where('tingkat', 'Wilayah')->count();

        // 3. Hitung Rasio R_DTPS
        $r_dtps = ($internasional + (0.5 * $nasional) + (0.25 * $wilayah)) / $jumlah_dtps;

        // 4. Tentukan Skor
        $skor = 0;
        if ($r_dtps >= 0.5) {
            $skor = 4.00;
        } else {
            $skor = 2 + (4 * $r_dtps);
        }

        // Batasi skor maksimal 4.00 jika ada anomali rumus
        if ($skor > 4.00) $skor = 4.00;

        return [
            'internasional' => $internasional,
            'nasional' => $nasional,
            'wilayah' => $wilayah,
            'r_dtps' => number_format($r_dtps, 2),
            'skor' => number_format($skor, 2)
        ];
    }
} 

