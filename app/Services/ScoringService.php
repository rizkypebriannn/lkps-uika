<?php

namespace App\Services;

use App\Models\KerjasamaPendidikan;
use App\Models\KerjasamaPenelitian;
use App\Models\KerjasamaPengabdian;
use App\Models\ProfilDosen;
use App\Models\TenagaKependidikan;
use App\Models\BebanKerjaDosen;

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
    }
