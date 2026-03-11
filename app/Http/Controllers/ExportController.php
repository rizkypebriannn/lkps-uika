<?php

namespace App\Http\Controllers;


use App\Models\Mahasiswa;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\BebanKerjaDosen;
use App\Models\CapstoneDesign;
use App\Models\DokumenPembelajaran;
use App\Models\IntegrasiPembelajaran;
use App\Models\KaryaIlmiahDtps;
use App\Models\KaryaIlmiahSitasi;
use App\Models\KerjasamaPendidikan;
use App\Models\KerjasamaPenelitian;
use App\Models\KerjasamaPengabdian;
use App\Models\KinerjaDtps;
use App\Models\Kurikulum;
use App\Models\LuaranBukuIsbn;
use App\Models\LuaranHkiHakCipta;
use App\Models\LuaranHkiPaten;
use App\Models\LuaranTeknologiProduk;
use App\Models\MatkulBasicScience;
use App\Models\PenelitianDtps;
use App\Models\PenggunaanDana;
use App\Models\PkmDtps;
use App\Models\Prodi;
use App\Models\ProdukJasaDtps;
use App\Models\ProfilDosen;
use App\Models\PublikasiIlmiahDtps;
use App\Models\TenagaKependidikan;
use App\Models\PengakuanDtps;
use App\Models\PembimbingLapangan;
use App\Models\PrasaranaPeralatan;
use App\Models\DokumenK3l;
use App\Models\FasilitasK3l;
use App\Models\JumlahMahasiswa;
use App\Models\IpkLulusan;
use App\Models\PrestasiAkademik;
use App\Models\PrestasiNonAkademik;
use App\Models\MasaStudiLulusan;
use App\Models\PublikasiIlmiahMahasiswa;
use App\Models\PublikasiMahasiswaTerapan;
use App\Models\LuaranHkiMahasiswa;
use App\Models\LuaranHkiBagian2;
use App\Models\LuaranHkiBagian3;
use App\Models\LuaranHkiBagian4;
use App\Models\ProdukJasaMahasiswa;
use App\Models\WaktuTungguLulusan;
use App\Models\KesesuaianBidangKerja;
use App\Models\TempatKerjaLulusan;
use App\Models\KepuasanPenggunaLulusan;
use App\Models\PenelitianDtpsMahasiswa;
use App\Models\PenelitianDtpsRujukan;
use App\Models\PkmDtpsMahasiswa;
use App\Models\DokumenSpmi;
use App\Models\PelaksanaanSpmi;

class ExportController extends Controller
{
    public function export()
    {
        // ========================================================
        // KODE PENYELAMAT: Mengatasi Error Timeout & Kehabisan Memori
        // ========================================================
        set_time_limit(300); // Memberi waktu maksimal 5 menit (300 detik)
        ini_set('memory_limit', '1024M'); // Memberikan kelonggaran RAM hingga 1GB
        // ========================================================

        // 1. Baca Template Asli LAMTEKNIK dari folder public/template/
        $templatePath = public_path('template/LKPS_LAMTEKNIK.xlsx');

        // Peringatan jika file template belum ditaruh di foldernya
        if (!file_exists($templatePath)) {
            abort(404, 'File template Excel tidak ditemukan di: ' . $templatePath);
        }

        // Buka file excel (Proses ini memang agak lama, mohon ditunggu)
        $spreadsheet = IOFactory::load($templatePath);

        // ========================================================
        // EKSPOR TABEL 1: VISI, MISI, TUJUAN, & STRATEGI
        // ========================================================
        if ($spreadsheet->sheetNameExists('1')) {
            $sheet1 = $spreadsheet->getSheetByName('1');
           $visiMisis = \App\Models\VisiMisi::where('prodi_id', auth()->user()->prodi_id)->get();
            
            $row1 = 7;
            $no1 = 1;

            foreach ($visiMisis as $vm) {
                $sheet1->setCellValue('A' . $row1, $no1);
                $sheet1->setCellValue('B' . $row1, $vm->jenis_vmts);
                $sheet1->setCellValue('C' . $row1, $vm->pernyataan);
                $sheet1->setCellValue('D' . $row1, $vm->no_sk);
                $sheet1->setCellValue('E' . $row1, $vm->link_dokumen);
                
                $row1++;
                $no1++;
            }
        }


       

        // ========================================================
        // EKSPOR TABEL 3.a.1: KURIKULUM
        // ========================================================
        if ($spreadsheet->sheetNameExists('3a1')) {
            $sheet3a1 = $spreadsheet->getSheetByName('3a1');
            $kurikulums = \App\Models\Kurikulum::where('prodi_id', auth()->user()->prodi_id)->orderBy('semester', 'asc')->get();
            
            $row3a1 = 10; // Berdasarkan template, data biasanya mulai di baris 15
            $no3a1 = 1;

            foreach ($kurikulums as $mk) {
                $sheet3a1->setCellValue('A' . $row3a1, $no3a1);
                $sheet3a1->setCellValue('B' . $row3a1, $mk->semester);
                $sheet3a1->setCellValue('C' . $row3a1, $mk->kode_mk);
                $sheet3a1->setCellValue('D' . $row3a1, $mk->nama_mk);
                $sheet3a1->setCellValue('E' . $row3a1, $mk->is_mk_kompetensi ? 'V' : '');
                $sheet3a1->setCellValue('F' . $row3a1, $mk->sks_kuliah);
                $sheet3a1->setCellValue('G' . $row3a1, $mk->sks_seminar);
                $sheet3a1->setCellValue('H' . $row3a1, $mk->sks_praktikum);
                $sheet3a1->setCellValue('I' . $row3a1, $mk->konversi_kredit_jam);
                $sheet3a1->setCellValue('J' . $row3a1, $mk->dokumen_rps);
                $sheet3a1->setCellValue('K' . $row3a1, $mk->unit_penyelenggara);
                
                $row3a1++;
                $no3a1++;
            }
        }
        // ========================================================
        // EKSPOR TABEL 2.a.1: KERJASAMA PENDIDIKAN
        // ========================================================
        if ($spreadsheet->sheetNameExists('2a1')) {
            $sheet2a1 = $spreadsheet->getSheetByName('2a1');
            $kerjasamas = \App\Models\KerjasamaPendidikan::where('prodi_id', auth()->user()->prodi_id)->orderBy('tanggal_awal', 'asc')->get();
            
            $row2a1 = 13; // Di file Excel Anda, baris pertama pengisian adalah baris ke-12
            $no2a1 = 1;

            foreach ($kerjasamas as $kj) {
                $sheet2a1->setCellValue('A' . $row2a1, $no2a1);
                $sheet2a1->setCellValue('B' . $row2a1, $kj->lembaga_mitra);
                
                // Centang (V) otomatis berdasarkan tingkat kerjasama
                $sheet2a1->setCellValue('C' . $row2a1, $kj->tingkat == 'Internasional' ? 'V' : '');
                $sheet2a1->setCellValue('D' . $row2a1, $kj->tingkat == 'Nasional' ? 'V' : '');
                $sheet2a1->setCellValue('E' . $row2a1, $kj->tingkat == 'Lokal/Wilayah' ? 'V' : '');
                
                $sheet2a1->setCellValue('F' . $row2a1, $kj->judul_kegiatan);
                $sheet2a1->setCellValue('G' . $row2a1, $kj->manfaat);
                
                // Format Tanggal Excel (Berdasarkan template LAMTEKNIK formatnya HH/BB/TTTT)
                $sheet2a1->setCellValue('H' . $row2a1, \Carbon\Carbon::parse($kj->tanggal_awal)->format('d/m/Y'));
                $sheet2a1->setCellValue('I' . $row2a1, \Carbon\Carbon::parse($kj->tanggal_akhir)->format('d/m/Y'));
                
                $sheet2a1->setCellValue('J' . $row2a1, $kj->durasi);
                $sheet2a1->setCellValue('K' . $row2a1, $kj->status_kerjasama);
                $sheet2a1->setCellValue('L' . $row2a1, $kj->bukti_kerjasama);
                
                $row2a1++;
                $no2a1++;
            }
        }
        // ========================================================
        // EKSPOR TABEL 2.a.2: KERJASAMA PENELITIAN
        // ========================================================
        if ($spreadsheet->sheetNameExists('2a2')) {
            $sheet2a2 = $spreadsheet->getSheetByName('2a2');
           $kerjasamaPnl = \App\Models\KerjasamaPenelitian::where('prodi_id', auth()->user()->prodi_id)->orderBy('tanggal_awal', 'asc')->get();
            
            $row2a2 = 13; // Di file Excel Anda, baris pertama pengisian adalah baris ke-12
            $no2a2 = 1;

            foreach ($kerjasamaPnl as $kj) {
                $sheet2a2->setCellValue('A' . $row2a2, $no2a2);
                $sheet2a2->setCellValue('B' . $row2a2, $kj->lembaga_mitra);
                
                // Centang (V) otomatis
                $sheet2a2->setCellValue('C' . $row2a2, $kj->tingkat == 'Internasional' ? 'V' : '');
                $sheet2a2->setCellValue('D' . $row2a2, $kj->tingkat == 'Nasional' ? 'V' : '');
                $sheet2a2->setCellValue('E' . $row2a2, $kj->tingkat == 'Lokal/Wilayah' ? 'V' : '');
                
                $sheet2a2->setCellValue('F' . $row2a2, $kj->judul_kegiatan);
                $sheet2a2->setCellValue('G' . $row2a2, $kj->manfaat);
                
                $sheet2a2->setCellValue('H' . $row2a2, \Carbon\Carbon::parse($kj->tanggal_awal)->format('d/m/Y'));
                $sheet2a2->setCellValue('I' . $row2a2, \Carbon\Carbon::parse($kj->tanggal_akhir)->format('d/m/Y'));
                
                $sheet2a2->setCellValue('J' . $row2a2, $kj->durasi);
                $sheet2a2->setCellValue('K' . $row2a2, $kj->status_kerjasama);
                $sheet2a2->setCellValue('L' . $row2a2, $kj->bukti_kerjasama);
                
                $row2a2++;
                $no2a2++;
            }
        }
        // ========================================================
        // EKSPOR TABEL 2.a.3: KERJASAMA PENGABDIAN MASYARAKAT
        // ========================================================
        if ($spreadsheet->sheetNameExists('2a3')) {
            $sheet2a3 = $spreadsheet->getSheetByName('2a3');
            $kerjasamaPkm = \App\Models\KerjasamaPengabdian::where('prodi_id', auth()->user()->prodi_id)->orderBy('tanggal_awal', 'asc')->get();

            $row2a3 = 13; // Baris pengisian di file excel 2a3
            $no2a3 = 1;

            foreach ($kerjasamaPkm as $kj) {
                $sheet2a3->setCellValue('A' . $row2a3, $no2a3);
                $sheet2a3->setCellValue('B' . $row2a3, $kj->lembaga_mitra);
                
                // Centang (V) otomatis
                $sheet2a3->setCellValue('C' . $row2a3, $kj->tingkat == 'Internasional' ? 'V' : '');
                $sheet2a3->setCellValue('D' . $row2a3, $kj->tingkat == 'Nasional' ? 'V' : '');
                $sheet2a3->setCellValue('E' . $row2a3, $kj->tingkat == 'Lokal/Wilayah' ? 'V' : '');
                
                $sheet2a3->setCellValue('F' . $row2a3, $kj->judul_kegiatan);
                $sheet2a3->setCellValue('G' . $row2a3, $kj->manfaat);
                
                $sheet2a3->setCellValue('H' . $row2a3, \Carbon\Carbon::parse($kj->tanggal_awal)->format('d/m/Y'));
                $sheet2a3->setCellValue('I' . $row2a3, \Carbon\Carbon::parse($kj->tanggal_akhir)->format('d/m/Y'));
                
                $sheet2a3->setCellValue('J' . $row2a3, $kj->durasi);
                $sheet2a3->setCellValue('K' . $row2a3, $kj->status_kerjasama);
                $sheet2a3->setCellValue('L' . $row2a3, $kj->bukti_kerjasama);
                
                $row2a3++;
                $no2a3++;
            }
        }
        // ========================================================
        // EKSPOR TABEL 2.b: PENGGUNAAN DANA
        // ========================================================
        if ($spreadsheet->sheetNameExists('2b')) {
            $sheet2b = $spreadsheet->getSheetByName('2b');
            $danas = \App\Models\PenggunaanDana::where('prodi_id', auth()->user()->prodi_id)->get();
            
            // Di Excel LAMTEKNIK, tabel dana biasanya mulai diisi pada baris ke-12 atau 13
            // Kita atur mulai baris 13, sesuaikan jika di template asli posisinya berbeda
            $row2b = 13; 
            $no2b = 1;

            foreach ($danas as $dana) {
                $sheet2b->setCellValue('A' . $row2b, $no2b);
                $sheet2b->setCellValue('B' . $row2b, $dana->jenis_penggunaan);
                
                // Dana UPPS
                $sheet2b->setCellValue('C' . $row2b, $dana->upps_ts2);
                $sheet2b->setCellValue('D' . $row2b, $dana->upps_ts1);
                $sheet2b->setCellValue('E' . $row2b, $dana->upps_ts);
                
                // (Kolom F di Excel biasanya adalah rumus otomatis untuk Rata-rata UPPS, jadi kita lewati)
                
                // Dana PS
                $sheet2b->setCellValue('G' . $row2b, $dana->ps_ts2);
                $sheet2b->setCellValue('H' . $row2b, $dana->ps_ts1);
                $sheet2b->setCellValue('I' . $row2b, $dana->ps_ts);
                
                // (Kolom J di Excel biasanya adalah rumus otomatis untuk Rata-rata PS, jadi kita lewati)
                
                $row2b++;
                $no2b++;
            }
        }
        // ========================================================
        // EKSPOR TABEL 3.a.2: MATA KULIAH DAN DOKUMEN PEMBELAJARAN
        // ========================================================
        if ($spreadsheet->sheetNameExists('3a2')) {
            $sheet3a2 = $spreadsheet->getSheetByName('3a2');
            $dokumens = \App\Models\DokumenPembelajaran::where('prodi_id', auth()->user()->prodi_id)->get();
            
            // Berdasarkan gambar Excel LAMTEKNIK, baris 1 dimulai di Cell A9
            $row3a2 = 10; 
            $no3a2 = 1;

            foreach ($dokumens as $dok) {
                $sheet3a2->setCellValue('A' . $row3a2, $no3a2);
                $sheet3a2->setCellValue('B' . $row3a2, $dok->mata_kuliah);
                $sheet3a2->setCellValue('C' . $row3a2, $dok->bobot_sks);
                $sheet3a2->setCellValue('D' . $row3a2, $dok->konversi_teori);
                $sheet3a2->setCellValue('E' . $row3a2, $dok->konversi_praktik);
                
                // Centang (V) otomatis jika form Link Dokumen RPS diisi
                $sheet3a2->setCellValue('F' . $row3a2, $dok->dokumen_rps ? 'V' : '');
                
                $row3a2++;
                $no3a2++;
            }
        }
        // ========================================================
        // EKSPOR TABEL 3.a.3: INTEGRASI KEGIATAN PENELITIAN/PkM
        // ========================================================
        if ($spreadsheet->sheetNameExists('3a3')) {
            $sheet3a3 = $spreadsheet->getSheetByName('3a3');
           $integrasis = \App\Models\IntegrasiPembelajaran::where('prodi_id', auth()->user()->prodi_id)->get();
            
            $row3a3 = 13; // Sesuai baris di gambar Excel
            $no3a3 = 1;

            foreach ($integrasis as $item) {
                $sheet3a3->setCellValue('A' . $row3a3, $no3a3);
                $sheet3a3->setCellValue('B' . $row3a3, $item->nama_dosen);
                $sheet3a3->setCellValue('C' . $row3a3, $item->judul_kegiatan);
                $sheet3a3->setCellValue('D' . $row3a3, $item->mata_kuliah);
                $sheet3a3->setCellValue('E' . $row3a3, $item->bentuk_integrasi);
                $sheet3a3->setCellValue('F' . $row3a3, $item->tahun_ts2);
                $sheet3a3->setCellValue('G' . $row3a3, $item->tahun_ts1);
                $sheet3a3->setCellValue('H' . $row3a3, $item->tahun_ts);
                $sheet3a3->setCellValue('I' . $row3a3, $item->kesesuaian_peta_jalan);
                $sheet3a3->setCellValue('J' . $row3a3, $item->bukti_sahih);
                $sheet3a3->setCellValue('K' . $row3a3, $item->kesesuaian_rps);
                
                $row3a3++;
                $no3a3++;
            }
        }
        // ========================================================
        // EKSPOR TABEL 3.a.4: BASIC SCIENCE & MATEMATIKA
        // ========================================================
        if ($spreadsheet->sheetNameExists('3a4')) {
            $sheet3a4 = $spreadsheet->getSheetByName('3a4');
            $matkuls = \App\Models\MatkulBasicScience::where('prodi_id', auth()->user()->prodi_id)->orderBy('semester', 'asc')->get();
            
            // Baris mulai berdasarkan gambar Excel LAMTEKNIK
            $row3a4 = 10; 
            $no3a4 = 1;

            foreach ($matkuls as $mk) {
                $sheet3a4->setCellValue('A' . $row3a4, $no3a4);
                $sheet3a4->setCellValue('B' . $row3a4, $mk->nama_mata_kuliah);
                $sheet3a4->setCellValue('C' . $row3a4, $mk->semester);
                $sheet3a4->setCellValue('D' . $row3a4, $mk->jumlah_sks);
                
                $row3a4++;
                $no3a4++;
            }
        }
        // ========================================================
        // EKSPOR TABEL 3.a.5: CAPSTONE DESIGN
        // ========================================================
        if ($spreadsheet->sheetNameExists('3a5')) {
            $sheet3a5 = $spreadsheet->getSheetByName('3a5');
            // Tentu saja, Export juga harus difilter sesuai Prodi yang login!
            $capstones = \App\Models\CapstoneDesign::where('prodi_id', auth()->user()->prodi_id)->orderBy('semester', 'asc')->get();
            
            $row3a5 = 10; 
            $no3a5 = 1;

            foreach ($capstones as $item) {
                $sheet3a5->setCellValue('A' . $row3a5, $no3a5);
                $sheet3a5->setCellValue('B' . $row3a5, $item->mk_pendukung);
                $sheet3a5->setCellValue('C' . $row3a5, $item->sks_pendukung);
                $sheet3a5->setCellValue('D' . $row3a5, $item->mk_capstone);
                $sheet3a5->setCellValue('E' . $row3a5, $item->sks_capstone);
                $sheet3a5->setCellValue('F' . $row3a5, $item->semester);
                $sheet3a5->setCellValue('G' . $row3a5, $item->cakupan_bahasan);
                
                $row3a5++;
                $no3a5++;
            }
        }

        // ========================================================
        // EKSPOR TABEL 3.b: PENELITIAN DTPS
        // ========================================================
        if ($spreadsheet->sheetNameExists('3b')) {
            $sheet3b = $spreadsheet->getSheetByName('3b');
            $penelitians = \App\Models\PenelitianDtps::where('prodi_id', auth()->user()->prodi_id)->get();
            
            $row3b = 11; // Sesuaikan angka ini dengan baris kuning di Excel Anda
            foreach ($penelitians as $d) {
                $sheet3b->setCellValue('B' . $row3b, $d->sumber_pembiayaan);
                $sheet3b->setCellValue('C' . $row3b, $d->jumlah_ts2);
                $sheet3b->setCellValue('D' . $row3b, $d->jumlah_ts1);
                $sheet3b->setCellValue('E' . $row3b, $d->jumlah_ts);
                $row3b++;
            }
        }
        // EKSPOR TABEL 3.c: PkM DTPS
        if ($spreadsheet->sheetNameExists('3c')) {
            $sheet3c = $spreadsheet->getSheetByName('3c');
            $pkms = \App\Models\PkmDtps::where('prodi_id', auth()->user()->prodi_id)->get();
            $row3c = 11; 
            foreach ($pkms as $d) {
                $sheet3c->setCellValue('B' . $row3c, $d->sumber_pembiayaan);
                $sheet3c->setCellValue('C' . $row3c, $d->jumlah_ts2);
                $sheet3c->setCellValue('D' . $row3c, $d->jumlah_ts1);
                $sheet3c->setCellValue('E' . $row3c, $d->jumlah_ts);
                $row3c++;
            }
        }

        // EKSPOR TABEL 4.a: PROFIL DOSEN
        if ($spreadsheet->sheetNameExists('4a')) {
            $sheet4a = $spreadsheet->getSheetByName('4a');
            $dosens = \App\Models\ProfilDosen::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4a = 14; 
            $no4a = 1;
            
            foreach ($dosens as $d) {
                $sheet4a->setCellValue('A' . $row4a, $no4a);
                $sheet4a->setCellValue('B' . $row4a, $d->nama_dosen);
                $sheet4a->setCellValue('C' . $row4a, $d->nidn);
                $sheet4a->setCellValue('D' . $row4a, $d->kategori_dosen);
                $sheet4a->setCellValue('E' . $row4a, $d->pendidikan_s1);
                $sheet4a->setCellValue('F' . $row4a, $d->pendidikan_s2);
                $sheet4a->setCellValue('G' . $row4a, $d->pendidikan_s3);
                $sheet4a->setCellValue('H' . $row4a, $d->bidang_keahlian);
                
                // Centang V untuk Kesesuaian Kompetensi Inti
                if ($d->kesesuaian_kompetensi == 'Sesuai') {
                    $sheet4a->setCellValue('I' . $row4a, 'V');
                }
                
                $sheet4a->setCellValue('J' . $row4a, $d->jabatan_akademik);
                $sheet4a->setCellValue('K' . $row4a, $d->sertifikat_pendidik);
                $sheet4a->setCellValue('L' . $row4a, $d->sertifikat_kompetensi_bidang);
                $sheet4a->setCellValue('M' . $row4a, $d->sertifikat_kompetensi_lembaga);
                $sheet4a->setCellValue('N' . $row4a, $d->sertifikat_keinsinyuran_skip);
                $sheet4a->setCellValue('O' . $row4a, $d->sertifikat_keinsinyuran_stri);
                $sheet4a->setCellValue('P' . $row4a, $d->matkul_ps_diakreditasi);
                
                // Centang V untuk Kesesuaian Bidang Keahlian dgn Matkul
                if ($d->kesesuaian_matkul == 'Sesuai') {
                    $sheet4a->setCellValue('Q' . $row4a, 'V');
                }
                
                $sheet4a->setCellValue('R' . $row4a, $d->matkul_ps_lain);
                
                $row4a++;
                $no4a++;
            }
        }

        // EKSPOR TABEL 4B 

        if ($spreadsheet->sheetNameExists('4b')) {
            $sheet4b = $spreadsheet->getSheetByName('4b');
            $tenagas = \App\Models\TenagaKependidikan::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4b = 11; 
            $no4b = 1;
            
            foreach ($tenagas as $t) {
                $sheet4b->setCellValue('A' . $row4b, $no4b);
                $sheet4b->setCellValue('B' . $row4b, $t->nama_tenaga_kependidikan);
                
                if ($t->pendidikan_terakhir == 'S3') $sheet4b->setCellValue('C' . $row4b, 'V');
                if ($t->pendidikan_terakhir == 'S2') $sheet4b->setCellValue('D' . $row4b, 'V');
                if ($t->pendidikan_terakhir == 'S1') $sheet4b->setCellValue('E' . $row4b, 'V');
                if ($t->pendidikan_terakhir == 'D4') $sheet4b->setCellValue('F' . $row4b, 'V');
                if ($t->pendidikan_terakhir == 'D3') $sheet4b->setCellValue('G' . $row4b, 'V');
                if ($t->pendidikan_terakhir == 'D2') $sheet4b->setCellValue('H' . $row4b, 'V');
                if ($t->pendidikan_terakhir == 'D1') $sheet4b->setCellValue('I' . $row4b, 'V');
                if ($t->pendidikan_terakhir == 'SMA/SMK') $sheet4b->setCellValue('J' . $row4b, 'V');

                $sheet4b->setCellValue('K' . $row4b, $t->sertifikat_kompetensi);
                $sheet4b->setCellValue('L' . $row4b, $t->unit_kerja);
                
                $row4b++;
                $no4b++;
            }
        }
        // EKSPOR TABEL 4.c: BEBAN KERJA DOSEN
        if ($spreadsheet->sheetNameExists('4c')) {
            $sheet4c = $spreadsheet->getSheetByName('4c');
            $dosens_bk = \App\Models\BebanKerjaDosen::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4c = 11; 
            $no4c = 1;
            
            foreach ($dosens_bk as $d) {
                $sheet4c->setCellValue('A' . $row4c, $no4c);
                $sheet4c->setCellValue('B' . $row4c, $d->nama_dosen);
                
                // Centang V jika DTPS
                if ($d->is_dtps == 'Ya') {
                    $sheet4c->setCellValue('C' . $row4c, 'V');
                }
                
                $sheet4c->setCellValue('D' . $row4c, $d->sks_ps_diakreditasi);
                $sheet4c->setCellValue('E' . $row4c, $d->sks_ps_lain_dalam_pt);
                $sheet4c->setCellValue('F' . $row4c, $d->sks_ps_lain_luar_pt);
                $sheet4c->setCellValue('G' . $row4c, $d->sks_penelitian);
                $sheet4c->setCellValue('H' . $row4c, $d->sks_pkm);
                $sheet4c->setCellValue('I' . $row4c, $d->sks_tugas_tambahan);
                $sheet4c->setCellValue('J' . $row4c, $d->sks_jumlah);
                $sheet4c->setCellValue('K' . $row4c, $d->sks_rata_rata);
                
                $row4c++;
                $no4c++;
            }
        }
        // EKSPOR TABEL 4.d: PUBLIKASI ILMIAH DTPS
        if ($spreadsheet->sheetNameExists('4d')) {
            $sheet4d = $spreadsheet->getSheetByName('4d');
            $publikasis = \App\Models\PublikasiIlmiahDtps::where('prodi_id', auth()->user()->prodi_id)->get();
            
            // Peta baris Excel berdasarkan Jenis Publikasi
            $rowMap = [
                'Jurnal nasional tidak terakreditasi' => 11,
                'Jurnal nasional terakreditasi' => 12,
                'Jurnal internasional' => 13,
                'Jurnal internasional bereputasi' => 14,
                'Prosiding seminar nasional' => 15,
                'Prosiding seminar internasional (tidak terindeks)' => 16,
                'Prosiding seminar internasional (terindeks Scopus/WoS)' => 17,
            ];

            foreach ($publikasis as $p) {
                if (isset($rowMap[$p->jenis_publikasi])) {
                    $row = $rowMap[$p->jenis_publikasi];
                    $sheet4d->setCellValue('C' . $row, $p->jumlah_ts2);
                    $sheet4d->setCellValue('D' . $row, $p->jumlah_ts1);
                    $sheet4d->setCellValue('E' . $row, $p->jumlah_ts);
                    $sheet4d->setCellValue('F' . $row, $p->jumlah_total);
                }
            }
        }
        // EKSPOR TABEL 4.e: KARYA ILMIAH / PAMERAN
        if ($spreadsheet->sheetNameExists('4e')) {
            $sheet4e = $spreadsheet->getSheetByName('4e');
            $karyas = \App\Models\KaryaIlmiahDtps::where('prodi_id', auth()->user()->prodi_id)->get();
            
            // Peta baris Excel berdasarkan Jenis Publikasi/Pameran
            $rowMap4e = [
                'Jurnal nasional tidak terakreditasi' => 7,
                'Jurnal nasional terakreditasi' => 8,
                'Jurnal internasional' => 9,
                'Jurnal internasional bereputasi' => 10,
                'Prosiding di seminar nasional/wilayah' => 11,
                'Prosiding tidak terindeks di seminar internasional' => 12,
                'Prosiding terindeks Scopus / WoS di seminar internasional' => 13,
                'Pagelaran/pameran/presentasi dalam forum di tingkat wilayah' => 14,
                'Pagelaran/pameran/presentasi dalam forum di tingkat nasional' => 15,
                'Pagelaran/pameran/presentasi dalam forum di tingkat internasional' => 16,
            ];

            foreach ($karyas as $k) {
                if (isset($rowMap4e[$k->jenis_publikasi])) {
                    $row = $rowMap4e[$k->jenis_publikasi];
                    $sheet4e->setCellValue('C' . $row, $k->jumlah_ts2);
                    $sheet4e->setCellValue('D' . $row, $k->jumlah_ts1);
                    $sheet4e->setCellValue('E' . $row, $k->jumlah_ts);
                    $sheet4e->setCellValue('F' . $row, $k->jumlah_total);
                }
            }
        }
        // EKSPOR TABEL 4.f Bagian 1: HKI PATEN
        // Catatan: Ganti '4f' dengan nama sheet yang sebenarnya di template Anda jika berbeda
        if ($spreadsheet->sheetNameExists('4f-1')) {
            $sheet4f = $spreadsheet->getSheetByName('4f-1');
            $patens = \App\Models\LuaranHkiPaten::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4f = 7; // Mulai dari baris 7 sesuai gambar
            $no4f = 1;
            
            foreach ($patens as $p) {
                $sheet4f->setCellValue('A' . $row4f, $no4f);
                $sheet4f->setCellValue('B' . $row4f, $p->judul_luaran);
                $sheet4f->setCellValue('C' . $row4f, \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y'));
                $sheet4f->setCellValue('D' . $row4f, $p->nomor_paten);
                
                $row4f++;
                $no4f++;
            }
        }
        // EKSPOR TABEL 4.f Bagian 2: HKI HAK CIPTA DLL
        // Catatan: Ganti '4f2' dengan nama sheet yang sebenarnya jika berbeda
        if ($spreadsheet->sheetNameExists('4f-2')) {
            $sheet4f2 = $spreadsheet->getSheetByName('4f-2');
            $ciptas = \App\Models\LuaranHkiHakCipta::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4f2 = 7; 
            $no4f2 = 1;
            
            foreach ($ciptas as $c) {
                $sheet4f2->setCellValue('A' . $row4f2, $no4f2);
                $sheet4f2->setCellValue('B' . $row4f2, $c->judul_luaran);
                $sheet4f2->setCellValue('C' . $row4f2, \Carbon\Carbon::parse($c->tanggal)->format('d/m/Y'));
                $sheet4f2->setCellValue('D' . $row4f2, $c->keterangan);
                
                $row4f2++;
                $no4f2++;
            }
        }
        // EKSPOR TABEL 4.f Bagian 3: TEKNOLOGI & PRODUK
        // Catatan: Ganti '4f3' dengan nama sheet yang sebenarnya di file Excel Anda (misalnya '4f3', '4f(3)', dst)
        if ($spreadsheet->sheetNameExists('4f-3')) {
            $sheet4f3 = $spreadsheet->getSheetByName('4f-3');
            $produks = \App\Models\LuaranTeknologiProduk::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4f3 = 7; 
            $no4f3 = 1;
            
            foreach ($produks as $p) {
                $sheet4f3->setCellValue('A' . $row4f3, $no4f3);
                $sheet4f3->setCellValue('B' . $row4f3, $p->judul_luaran);
                $sheet4f3->setCellValue('C' . $row4f3, $p->tahun);
                $sheet4f3->setCellValue('D' . $row4f3, $p->keterangan);
                
                $row4f3++;
                $no4f3++;
            }
        }
        // EKSPOR TABEL 4.f Bagian 4: BUKU BER-ISBN
        // Catatan: Ganti '4f4' dengan nama sheet yang sebenarnya di file template Anda
        if ($spreadsheet->sheetNameExists('4f-4')) {
            $sheet4f4 = $spreadsheet->getSheetByName('4f-4');
            $bukus = \App\Models\LuaranBukuIsbn::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4f4 = 7; 
            $no4f4 = 1;
            
            foreach ($bukus as $b) {
                $sheet4f4->setCellValue('A' . $row4f4, $no4f4);
                $sheet4f4->setCellValue('B' . $row4f4, $b->judul_luaran);
                $sheet4f4->setCellValue('C' . $row4f4, \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y'));
                $sheet4f4->setCellValue('D' . $row4f4, $b->keterangan);
                
                $row4f4++;
                $no4f4++;
            }
        }
        // EKSPOR TABEL 4.g: PRODUK/JASA DTPS
        // Ganti '4g' dengan nama sheet yang sebenarnya di file template Excel Anda
        if ($spreadsheet->sheetNameExists('4g')) {
            $sheet4g = $spreadsheet->getSheetByName('4g');
            $produk_jasa = \App\Models\ProdukJasaDtps::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4g = 6; // Mulai dari baris ke-5 sesuai gambar
            $no4g = 1;
            
            foreach ($produk_jasa as $pj) {
                $sheet4g->setCellValue('A' . $row4g, $no4g);
                $sheet4g->setCellValue('B' . $row4g, $pj->nama_dtps);
                $sheet4g->setCellValue('C' . $row4g, $pj->nama_produk);
                $sheet4g->setCellValue('D' . $row4g, $pj->deskripsi_produk);
                $sheet4g->setCellValue('E' . $row4g, $pj->bukti);
                
                $row4g++;
                $no4g++;
            }
        }
        // EKSPOR TABEL 4.h: KINERJA DTPS
        // Ganti '4h' dengan nama sheet yang sebenarnya di file template Excel Anda
        if ($spreadsheet->sheetNameExists('4h')) {
            $sheet4h = $spreadsheet->getSheetByName('4h');
            $kinerjas = \App\Models\KinerjaDtps::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4h = 16; // Mulai dari baris ke-15 sesuai gambar
            $no4h = 1;
            
            foreach ($kinerjas as $kj) {
                $sheet4h->setCellValue('A' . $row4h, $no4h);
                $sheet4h->setCellValue('B' . $row4h, $kj->nama_dtps);
                $sheet4h->setCellValue('C' . $row4h, $kj->jumlah_ts2);
                $sheet4h->setCellValue('D' . $row4h, $kj->jumlah_ts1);
                $sheet4h->setCellValue('E' . $row4h, $kj->jumlah_ts);
                $sheet4h->setCellValue('F' . $row4h, $kj->keterangan);
                $sheet4h->setCellValue('G' . $row4h, $kj->jumlah_publikasi);
                
                $row4h++;
                $no4h++;
            }
        }
        // EKSPOR TABEL 4.i: SITASI KARYA ILMIAH
        // Ganti '4i' dengan nama sheet yang sebenarnya di file template Excel Anda
        if ($spreadsheet->sheetNameExists('4i')) {
            $sheet4i = $spreadsheet->getSheetByName('4i');
            $sitasis = \App\Models\KaryaIlmiahSitasi::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4i = 6; // Mulai dari baris ke-5 sesuai gambar
            $no4i = 1;
            
            foreach ($sitasis as $sitasi) {
                $sheet4i->setCellValue('A' . $row4i, $no4i);
                $sheet4i->setCellValue('B' . $row4i, $sitasi->nama_dtps);
                $sheet4i->setCellValue('C' . $row4i, $sitasi->judul_artikel);
                $sheet4i->setCellValue('D' . $row4i, $sitasi->jumlah_sitasi);
                
                $row4i++;
                $no4i++;
            }
        }
        // EKSPOR TABEL 4.j: PENGAKUAN/REKOGNISI DTPS
        // Ganti '4j' dengan nama sheet yang sebenarnya di file template Excel Anda
        if ($spreadsheet->sheetNameExists('4j')) {
            $sheet4j = $spreadsheet->getSheetByName('4j');
            $pengakuans = \App\Models\PengakuanDtps::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4j = 12; // Mulai dari baris ke-11 sesuai gambar
            $no4j = 1;
            
            foreach ($pengakuans as $p) {
                $sheet4j->setCellValue('A' . $row4j, $no4j);
                $sheet4j->setCellValue('B' . $row4j, $p->nama_dtps);
                $sheet4j->setCellValue('C' . $row4j, $p->bidang_keahlian);
                $sheet4j->setCellValue('D' . $row4j, $p->rekognisi);
                $sheet4j->setCellValue('E' . $row4j, $p->bukti_pendukung);
                
                // Logika Checkmark Tingkat (V)
                if ($p->tingkat == 'Wilayah') {
                    $sheet4j->setCellValue('F' . $row4j, 'V');
                } elseif ($p->tingkat == 'Nasional') {
                    $sheet4j->setCellValue('G' . $row4j, 'V');
                } elseif ($p->tingkat == 'Internasional') {
                    $sheet4j->setCellValue('H' . $row4j, 'V');
                }
                
                $sheet4j->setCellValue('I' . $row4j, $p->tahun);
                
                $row4j++;
                $no4j++;
            }
        }
        // EKSPOR TABEL 4.k: PEMBIMBING LAPANGAN
        // Ganti '4k' dengan nama sheet yang sebenarnya di file template Excel Anda
        if ($spreadsheet->sheetNameExists('4k')) {
            $sheet4k = $spreadsheet->getSheetByName('4k');
            $pembimbings = \App\Models\PembimbingLapangan::where('prodi_id', auth()->user()->prodi_id)->get();
            $row4k = 6; // Mulai dari baris ke-6 sesuai gambar
            $no4k = 1;
            
            foreach ($pembimbings as $pb) {
                $sheet4k->setCellValue('A' . $row4k, $no4k);
                $sheet4k->setCellValue('B' . $row4k, $pb->nama);
                $sheet4k->setCellValue('C' . $row4k, $pb->industri);
                $sheet4k->setCellValue('D' . $row4k, $pb->bidang_keinsinyuran);
                $sheet4k->setCellValue('E' . $row4k, $pb->pengalaman_kerja);
                $sheet4k->setCellValue('F' . $row4k, $pb->pendidikan_tinggi);
                
                // Logika Checkmark Kategori SIP (V)
                if ($pb->kategori_sip == 'IPM') {
                    $sheet4k->setCellValue('G' . $row4k, 'V');
                } elseif ($pb->kategori_sip == 'IPU') {
                    $sheet4k->setCellValue('H' . $row4k, 'V');
                }
                
                $sheet4k->setCellValue('I' . $row4k, $pb->nomor_sip);
                $sheet4k->setCellValue('J' . $row4k, \Carbon\Carbon::parse($pb->tanggal_berakhir_sip)->format('d/m/Y'));
                $sheet4k->setCellValue('K' . $row4k, $pb->jumlah_bimbingan);
                
                $row4k++;
                $no4k++;
            }
        } 
        // EKSPOR TABEL 5.a: PRASARANA & PERALATAN
        if ($spreadsheet->sheetNameExists('5a')) {
            $sheet5a = $spreadsheet->getSheetByName('5a');
            $prasaranas = \App\Models\PrasaranaPeralatan::where('prodi_id', auth()->user()->prodi_id)->get();
            $row5a = 10; // Sesuai gambar, data pertama ada di baris 13
            $no5a = 1;
            
            foreach ($prasaranas as $p) {
                $sheet5a->setCellValue('A' . $row5a, $no5a);
                $sheet5a->setCellValue('B' . $row5a, $p->nama_prasarana);
                $sheet5a->setCellValue('C' . $row5a, $p->jumlah_prasarana);
                $sheet5a->setCellValue('D' . $row5a, $p->nama_sarana);
                $sheet5a->setCellValue('E' . $row5a, $p->standar_minimal);
                $sheet5a->setCellValue('F' . $row5a, $p->dimiliki_upps);
                
                // Kepemilikan (Sendiri / Sewa)
                if ($p->kepemilikan == 'Sendiri') {
                    $sheet5a->setCellValue('G' . $row5a, 'V');
                } elseif ($p->kepemilikan == 'Sewa') {
                    $sheet5a->setCellValue('H' . $row5a, 'V');
                }
                
                // Kondisi (Terawat / Tidak Terawat)
                if ($p->kondisi == 'Terawat') {
                    $sheet5a->setCellValue('I' . $row5a, 'V');
                } elseif ($p->kondisi == 'Tidak Terawat') {
                    $sheet5a->setCellValue('J' . $row5a, 'V');
                }
                
                // Logbook (Ada / Tidak Ada)
                if ($p->logbook == 'Ada') {
                    $sheet5a->setCellValue('K' . $row5a, 'V');
                } elseif ($p->logbook == 'Tidak Ada') {
                    $sheet5a->setCellValue('L' . $row5a, 'V');
                }

                $sheet5a->setCellValue('M' . $row5a, $p->waktu_penggunaan);
                
                $row5a++;
                $no5a++;
            }
        }
        // EKSPOR TABEL 5.b: DOKUMEN K3L
        if ($spreadsheet->sheetNameExists('5b')) {
            $sheet5b = $spreadsheet->getSheetByName('5b');
            $dokumens = \App\Models\DokumenK3l::where('prodi_id', auth()->user()->prodi_id)->get();
            $row5b = 17; // Mulai dari baris ke-7 sesuai gambar
            $no5b = 1;
            
            foreach ($dokumens as $dok) {
                $sheet5b->setCellValue('A' . $row5b, $no5b);
                $sheet5b->setCellValue('B' . $row5b, $dok->jenis_dokumen);
                $sheet5b->setCellValue('C' . $row5b, $dok->jumlah);
                $sheet5b->setCellValue('D' . $row5b, $dok->riwayat_pengesahan);
                
                $row5b++;
                $no5b++;
            }
        }
        // EKSPOR TABEL 5.c: FASILITAS K3L
        if ($spreadsheet->sheetNameExists('5c')) {
            $sheet5c = $spreadsheet->getSheetByName('5c');
            $fasilitasK3l = \App\Models\FasilitasK3l::where('prodi_id', auth()->user()->prodi_id)->get();
            $row5c = 17; // Mulai dari baris ke-17 sesuai gambar
            $no5c = 1;
            
            foreach ($fasilitasK3l as $fasilitas) {
                $sheet5c->setCellValue('A' . $row5c, $no5c);
                $sheet5c->setCellValue('B' . $row5c, $fasilitas->nama_sarana);
                $sheet5c->setCellValue('C' . $row5c, $fasilitas->fungsi);
                $sheet5c->setCellValue('D' . $row5c, $fasilitas->jumlah_unit);
                
                // Logika Checkmark Kondisi (V)
                if ($fasilitas->kondisi == 'Terawat') {
                    $sheet5c->setCellValue('E' . $row5c, 'V');
                } elseif ($fasilitas->kondisi == 'Tidak Terawat') {
                    $sheet5c->setCellValue('F' . $row5c, 'V');
                }
                
                $row5c++;
                $no5c++;
            }
        }
        // EKSPOR TABEL 6.a: JUMLAH MAHASISWA
        if ($spreadsheet->sheetNameExists('6a')) {
            $sheet6a = $spreadsheet->getSheetByName('6a');
            $mahasiswas = \App\Models\JumlahMahasiswa::where('prodi_id', auth()->user()->prodi_id)->get();
            $row6a = 7; // Mulai baris ke-6 sesuai gambar
            $no6a = 1;
            
            foreach ($mahasiswas as $mhs) {
                $sheet6a->setCellValue('A' . $row6a, $no6a);
                $sheet6a->setCellValue('B' . $row6a, $mhs->program_studi);
                
                // Centang V jika diakreditasi
                if ($mhs->is_diakreditasi == 'Ya') {
                    $sheet6a->setCellValue('C' . $row6a, 'V');
                }
                
                // Mhs Aktif
                $sheet6a->setCellValue('D' . $row6a, $mhs->aktif_ts2);
                $sheet6a->setCellValue('E' . $row6a, $mhs->aktif_ts1);
                $sheet6a->setCellValue('F' . $row6a, $mhs->aktif_ts);
                
                // Mhs Asing Full Time
                $sheet6a->setCellValue('G' . $row6a, $mhs->asing_ft_ts2);
                $sheet6a->setCellValue('H' . $row6a, $mhs->asing_ft_ts1);
                $sheet6a->setCellValue('I' . $row6a, $mhs->asing_ft_ts);
                
                // Mhs Asing Part Time
                $sheet6a->setCellValue('J' . $row6a, $mhs->asing_pt_ts2);
                $sheet6a->setCellValue('K' . $row6a, $mhs->asing_pt_ts1);
                $sheet6a->setCellValue('L' . $row6a, $mhs->asing_pt_ts);
                
                $row6a++;
                $no6a++;
            }
        }
        // EKSPOR TABEL 6.b: IPK LULUSAN
        if ($spreadsheet->sheetNameExists('6b')) {
            $sheet6b = $spreadsheet->getSheetByName('6b');
            $ipks = \App\Models\IpkLulusan::where('prodi_id', auth()->user()->prodi_id)->get();
            
            foreach ($ipks as $ipk) {
                // Tentukan baris berdasarkan tahun lulus (sesuai gambar)
                $targetRow = 0;
                if ($ipk->tahun_lulus == 'TS-2') {
                    $targetRow = 6;
                } elseif ($ipk->tahun_lulus == 'TS-1') {
                    $targetRow = 7;
                } elseif ($ipk->tahun_lulus == 'TS') {
                    $targetRow = 8;
                }

                if ($targetRow > 0) {
                    $sheet6b->setCellValue('C' . $targetRow, $ipk->jumlah_lulusan);
                    $sheet6b->setCellValue('D' . $targetRow, $ipk->ipk_min);
                    $sheet6b->setCellValue('E' . $targetRow, $ipk->ipk_rata);
                    $sheet6b->setCellValue('F' . $targetRow, $ipk->ipk_maks);
                }
            }
        }
        // EKSPOR TABEL 6.c.1: PRESTASI AKADEMIK MAHASISWA
        if ($spreadsheet->sheetNameExists('6c1')) { // Sesuaikan nama sheet Excel Anda
            $sheet6c1 = $spreadsheet->getSheetByName('6c1');
            $prestasis = \App\Models\PrestasiAkademik::where('prodi_id', auth()->user()->prodi_id)
                            ->orderBy('waktu_perolehan', 'desc')
                            ->get();
            $row6c1 = 10; // Mulai baris ke-9 sesuai gambar
            $no6c1 = 1;
            
            foreach ($prestasis as $prestasi) {
                $sheet6c1->setCellValue('A' . $row6c1, $no6c1);
                $sheet6c1->setCellValue('B' . $row6c1, $prestasi->nama_kegiatan);
                $sheet6c1->setCellValue('C' . $row6c1, \Carbon\Carbon::parse($prestasi->waktu_perolehan)->format('d/m/Y'));
                
                // Centang V untuk Tingkat
                if ($prestasi->tingkat == 'Lokal/Wilayah') {
                    $sheet6c1->setCellValue('D' . $row6c1, 'V');
                } elseif ($prestasi->tingkat == 'Nasional') {
                    $sheet6c1->setCellValue('E' . $row6c1, 'V');
                } elseif ($prestasi->tingkat == 'Internasional') {
                    $sheet6c1->setCellValue('F' . $row6c1, 'V');
                }
                
                $sheet6c1->setCellValue('G' . $row6c1, $prestasi->prestasi_dicapai);
                
                $row6c1++;
                $no6c1++;
            }
        }
        // EKSPOR TABEL 6.c.2: PRESTASI NON-AKADEMIK MAHASISWA
        if ($spreadsheet->sheetNameExists('6c2')) { // Sesuaikan nama sheet Excel Anda
            $sheet6c2 = $spreadsheet->getSheetByName('6c2');
            $prestasisNon = \App\Models\PrestasiNonAkademik::where('prodi_id', auth()->user()->prodi_id)
                            ->orderBy('waktu_perolehan', 'desc')
                            ->get();
            $row6c2 = 11; // Mulai baris ke-10 sesuai gambar
            $no6c2 = 1;
            
            foreach ($prestasisNon as $prestasi) {
                $sheet6c2->setCellValue('A' . $row6c2, $no6c2);
                $sheet6c2->setCellValue('B' . $row6c2, $prestasi->nama_kegiatan);
                $sheet6c2->setCellValue('C' . $row6c2, \Carbon\Carbon::parse($prestasi->waktu_perolehan)->format('d/m/Y'));
                
                // Centang V untuk Tingkat
                if ($prestasi->tingkat == 'Lokal/Wilayah') {
                    $sheet6c2->setCellValue('D' . $row6c2, 'V');
                } elseif ($prestasi->tingkat == 'Nasional') {
                    $sheet6c2->setCellValue('E' . $row6c2, 'V');
                } elseif ($prestasi->tingkat == 'Internasional') {
                    $sheet6c2->setCellValue('F' . $row6c2, 'V');
                }
                
                $sheet6c2->setCellValue('G' . $row6c2, $prestasi->prestasi_dicapai);
                
                $row6c2++;
                $no6c2++;
            }
        }
        // EKSPOR TABEL 6.d: MASA STUDI LULUSAN
        if ($spreadsheet->sheetNameExists('6d')) { // Sesuaikan nama sheet Excel Anda jika beda
            $sheet6d = $spreadsheet->getSheetByName('6d');
            $masa_studi = \App\Models\MasaStudiLulusan::where('prodi_id', auth()->user()->prodi_id)->get();
            
            foreach ($masa_studi as $ms) {
                $targetRow = 0;
                
                // Menentukan baris Excel sesuai Tahun Masuk
                switch ($ms->tahun_masuk) {
                    case 'TS-7': $targetRow = 34; break;
                    case 'TS-6': $targetRow = 35; break;
                    case 'TS-5': $targetRow = 36; break;
                    case 'TS-4': $targetRow = 37; break;
                    case 'TS-3': $targetRow = 38; break;
                    case 'TS-2': $targetRow = 39; break;
                    case 'TS-1': $targetRow = 40; break;
                    case 'TS':   $targetRow = 41; break;
                }

                if ($targetRow > 0) {
                    $sheet6d->setCellValue('B' . $targetRow, $ms->jumlah_masuk);
                    
                    // Kolom C, D, E, F (Jumlah Lulusan)
                    // (Sistem kita otomatis mengisi 0, sehingga aman dimasukkan meskipun di sel Excel berwarna abu-abu)
                    $sheet6d->setCellValue('C' . $targetRow, $ms->lulus_3_5);
                    $sheet6d->setCellValue('D' . $targetRow, $ms->lulus_4_5);
                    $sheet6d->setCellValue('E' . $targetRow, $ms->lulus_5_5);
                    $sheet6d->setCellValue('F' . $targetRow, $ms->lulus_6_5);
                }
            }
        }
        // EKSPOR TABEL 6.e.1: PUBLIKASI ILMIAH MAHASISWA
        if ($spreadsheet->sheetNameExists('6e1')) { // Sesuaikan nama sheet Excel Anda
            $sheet6e1 = $spreadsheet->getSheetByName('6e1');
            $publikasis = \App\Models\PublikasiIlmiahMahasiswa::where('prodi_id', auth()->user()->prodi_id)->get();
            
            foreach ($publikasis as $pub) {
                $targetRow = 0;
                
                // Cek kategori untuk menentukan baris penempatan
                switch ($pub->media_publikasi) {
                    case 'Jurnal nasional tidak terakreditasi': $targetRow = 7; break;
                    case 'Jurnal nasional terakreditasi': $targetRow = 8; break;
                    case 'Jurnal internasional': $targetRow = 9; break;
                    case 'Jurnal internasional bereputasi': $targetRow = 10; break;
                    case 'Prosiding di seminar nasional/wilayah': $targetRow = 11; break;
                    case 'Prosiding tidak terindeks di seminar internasional': $targetRow = 12; break;
                    case 'Prosiding terindeks Scopus / WoS di seminar internasional': $targetRow = 13; break;
                }

                if ($targetRow > 0) {
                    $sheet6e1->setCellValue('C' . $targetRow, $pub->ts_2);
                    $sheet6e1->setCellValue('D' . $targetRow, $pub->ts_1);
                    $sheet6e1->setCellValue('E' . $targetRow, $pub->ts);
                }
            }
        }
        // EKSPOR TABEL 6.e.2: PUBLIKASI MAHASISWA TERAPAN
        if ($spreadsheet->sheetNameExists('6e2')) { // Sesuaikan nama sheet Excel
            $sheet6e2 = $spreadsheet->getSheetByName('6e2');
            $publikasiTerapan = \App\Models\PublikasiMahasiswaTerapan::where('prodi_id', auth()->user()->prodi_id)->get();
            
            foreach ($publikasiTerapan as $pub) {
                $targetRow = 0;
                
                // Cek jenis publikasi untuk menentukan baris penempatan
                switch ($pub->jenis_publikasi) {
                    case 'Publikasi di jurnal nasional tidak terakreditasi': $targetRow = 7; break;
                    case 'Publikasi di jurnal nasional terakreditasi': $targetRow = 8; break;
                    case 'Publikasi di jurnal internasional': $targetRow = 9; break;
                    case 'Publikasi di jurnal internasional bereputasi': $targetRow = 10; break;
                    case 'Prosiding di seminar nasional/wilayah': $targetRow = 11; break;
                    case 'Prosiding tidak terindeks di seminar internasional': $targetRow = 12; break;
                    case 'Prosiding terindeks Scopus / WoS di seminar internasional': $targetRow = 13; break;
                    case 'Pagelaran/pameran/presentasi dalam forum di tingkat wilayah': $targetRow = 14; break;
                    case 'Pagelaran/pameran/presentasi dalam forum di tingkat nasional': $targetRow = 15; break;
                    case 'Pagelaran/pameran/presentasi dalam forum di tingkat internasional': $targetRow = 16; break;
                }

                if ($targetRow > 0) {
                    $sheet6e2->setCellValue('C' . $targetRow, $pub->ts_2);
                    $sheet6e2->setCellValue('D' . $targetRow, $pub->ts_1);
                    $sheet6e2->setCellValue('E' . $targetRow, $pub->ts);
                }
            }
        }
        // EKSPOR TABEL 6.e.3: HKI MAHASISWA
        // Ganti '6e3' dengan nama sheet asli dari template Anda jika berbeda (misal: '6.e.3')
        if ($spreadsheet->sheetNameExists('6e3-1')) { 
            $sheet6e3 = $spreadsheet->getSheetByName('6e3-1');
            $hkis = \App\Models\LuaranHkiMahasiswa::where('prodi_id', auth()->user()->prodi_id)
                        ->orderBy('tanggal', 'desc')
                        ->get();
            $row6e3 = 12; // Mulai dari baris ke-12 sesuai gambar
            $no6e3 = 1;
            
            foreach ($hkis as $hki) {
                $sheet6e3->setCellValue('A' . $row6e3, $no6e3);
                $sheet6e3->setCellValue('B' . $row6e3, $hki->luaran_penelitian);
                $sheet6e3->setCellValue('C' . $row6e3, \Carbon\Carbon::parse($hki->tanggal)->format('d/m/Y'));
                $sheet6e3->setCellValue('D' . $row6e3, $hki->status);
                $sheet6e3->setCellValue('E' . $row6e3, $hki->nomor_registrasi);
                
                $row6e3++;
                $no6e3++;
            }
        }
        // EKSPOR TABEL 6.e.3-2: BAGIAN-2 HKI
        // Nama sheet menyesuaikan tab di excel Anda yaitu '6e3-2'
        if ($spreadsheet->sheetNameExists('6e3-2')) {
            $sheet6e3_2 = $spreadsheet->getSheetByName('6e3-2');
            $hki_bagian2 = \App\Models\LuaranHkiBagian2::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tanggal', 'desc')
                    ->get();
            
            $row6e3_2 = 8; // Mulai dari baris ke-7 sesuai baris kuning di gambar Excel
            $no6e3_2 = 1;

            foreach ($hki_bagian2 as $item) {
                $sheet6e3_2->setCellValue('A' . $row6e3_2, $no6e3_2);
                $sheet6e3_2->setCellValue('B' . $row6e3_2, $item->luaran_penelitian_pkm);
                $sheet6e3_2->setCellValue('C' . $row6e3_2, \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y'));
                $sheet6e3_2->setCellValue('D' . $row6e3_2, $item->nomor_hki);

                $row6e3_2++;
                $no6e3_2++;
            }
        }
        // EKSPOR TABEL 6.e.3-3: BAGIAN-3 TEKNOLOGI TEPAT GUNA
        // Sesuaikan nama sheet ('6e3-3') dengan nama sheet asli di Excel Anda
        if ($spreadsheet->sheetNameExists('6e3-3')) {
            $sheet6e3_3 = $spreadsheet->getSheetByName('6e3-3');
            $data_bagian3 = \App\Models\LuaranHkiBagian3::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tanggal', 'desc')
                    ->get();
            
            $row6e3_3 = 18; // Mulai dari baris ke-18 sesuai blok kuning di Excel
            $no6e3_3 = 1;

            foreach ($data_bagian3 as $item) {
                $sheet6e3_3->setCellValue('A' . $row6e3_3, $no6e3_3);
                $sheet6e3_3->setCellValue('B' . $row6e3_3, $item->luaran_penelitian);
                $sheet6e3_3->setCellValue('C' . $row6e3_3, \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y'));
                $sheet6e3_3->setCellValue('D' . $row6e3_3, $item->status);
                $sheet6e3_3->setCellValue('E' . $row6e3_3, $item->nomor_sertifikat);

                $row6e3_3++;
                $no6e3_3++;
            }
        }
        // EKSPOR TABEL 6.e.3-4: BAGIAN-4 BUKU BER-ISBN / BOOK CHAPTER
        if ($spreadsheet->sheetNameExists('6e3-4')) {
            $sheet6e3_4 = $spreadsheet->getSheetByName('6e3-4');
            $data_bagian4 = \App\Models\LuaranHkiBagian4::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tanggal', 'desc')
                    ->get();
            
            $row6e3_4 = 8; // Mulai dari baris ke-8 sesuai blok kuning di Excel
            $no6e3_4 = 1;

            foreach ($data_bagian4 as $item) {
                $sheet6e3_4->setCellValue('A' . $row6e3_4, $no6e3_4);
                $sheet6e3_4->setCellValue('B' . $row6e3_4, $item->luaran_penelitian);
                $sheet6e3_4->setCellValue('C' . $row6e3_4, \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y'));
                $sheet6e3_4->setCellValue('D' . $row6e3_4, $item->nomor_isbn);

                $row6e3_4++;
                $no6e3_4++;
            }
        }
        // EKSPOR TABEL 6.e.4: PRODUK/JASA MAHASISWA
        if ($spreadsheet->sheetNameExists('6e4')) {
            $sheet6e4 = $spreadsheet->getSheetByName('6e4');
            $produk_jasa = \App\Models\ProdukJasaMahasiswa::where('prodi_id', auth()->user()->prodi_id)->get();
            
            $row6e4 = 6; // Mulai dari baris ke-7 
            $no6e4 = 1;

            foreach ($produk_jasa as $item) {
                $sheet6e4->setCellValue('A' . $row6e4, $no6e4);
                $sheet6e4->setCellValue('B' . $row6e4, $item->nama_mahasiswa);
                $sheet6e4->setCellValue('C' . $row6e4, $item->nama_produk_jasa);
                $sheet6e4->setCellValue('D' . $row6e4, $item->deskripsi);
                $sheet6e4->setCellValue('E' . $row6e4, $item->bukti);

                $row6e4++;
                $no6e4++;
            }
        }
        // EKSPOR TABEL 6.f.1: WAKTU TUNGGU LULUSAN
        if ($spreadsheet->sheetNameExists('6f1')) {
            $sheet6f1 = $spreadsheet->getSheetByName('6f1');
            $waktu_tunggu = WaktuTungguLulusan::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tahun_lulus', 'asc') // Urutkan TS-2 ke TS-1
                    ->get();
            
            $row6f1 = 31; // Mulai dari baris 31

            foreach ($waktu_tunggu as $item) {
                // Sesuai gambar Excel, langsung isi kolom A - F tanpa nomor urut
                $sheet6f1->setCellValue('A' . $row6f1, $item->tahun_lulus);
                $sheet6f1->setCellValue('B' . $row6f1, $item->jumlah_lulusan);
                $sheet6f1->setCellValue('C' . $row6f1, $item->jumlah_lulusan_terlacak);
                $sheet6f1->setCellValue('D' . $row6f1, $item->wt_kurang_3_bulan);
                $sheet6f1->setCellValue('E' . $row6f1, $item->wt_antara_3_18_bulan);
                $sheet6f1->setCellValue('F' . $row6f1, $item->wt_lebih_18_bulan);

                $row6f1++;
            }
        }
        // EKSPOR TABEL 6.f.2: KESESUAIAN BIDANG KERJA LULUSAN
        if ($spreadsheet->sheetNameExists('6f2')) {
            $sheet6f2 = $spreadsheet->getSheetByName('6f2');
            $kesesuaian = KesesuaianBidangKerja::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tahun_lulus', 'asc')
                    ->get();
            
            // PENTING: Ganti 11 dengan angka baris pertama di blok kuning Excel Anda
            $row6f2 = 7; 

            foreach ($kesesuaian as $item) {
                // Langsung isi kolom A - F tanpa nomor urut
                $sheet6f2->setCellValue('A' . $row6f2, $item->tahun_lulus);
                $sheet6f2->setCellValue('B' . $row6f2, $item->jumlah_lulusan);
                $sheet6f2->setCellValue('C' . $row6f2, $item->jumlah_lulusan_terlacak);
                $sheet6f2->setCellValue('D' . $row6f2, $item->kesesuaian_rendah);
                $sheet6f2->setCellValue('E' . $row6f2, $item->kesesuaian_sedang);
                $sheet6f2->setCellValue('F' . $row6f2, $item->kesesuaian_tinggi);

                $row6f2++;
            }
        }
        // EKSPOR TABEL 6.g.1: TEMPAT KERJA LULUSAN
        if ($spreadsheet->sheetNameExists('6g1')) {
            $sheet6g1 = $spreadsheet->getSheetByName('6g1');
            $tempat_kerja = TempatKerjaLulusan::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tahun_lulus', 'asc')
                    ->get();
            
            $row6g1 = 7; // Mulai dari baris ke-7

            foreach ($tempat_kerja as $item) {
                // Mengisi kolom A sampai G
                $sheet6g1->setCellValue('A' . $row6g1, $item->tahun_lulus);
                $sheet6g1->setCellValue('B' . $row6g1, $item->jumlah_lulusan);
                $sheet6g1->setCellValue('C' . $row6g1, $item->jumlah_tanggapan);
                $sheet6g1->setCellValue('D' . $row6g1, $item->jumlah_terlacak);
                $sheet6g1->setCellValue('E' . $row6g1, $item->tingkat_lokal);
                $sheet6g1->setCellValue('F' . $row6g1, $item->tingkat_nasional);
                $sheet6g1->setCellValue('G' . $row6g1, $item->tingkat_multinasional);

                $row6g1++;
            }
        }

        // EKSPOR TABEL 6.g.2: KEPUASAN PENGGUNA LULUSAN
        if ($spreadsheet->sheetNameExists('6g2')) {
            $sheet6g2 = $spreadsheet->getSheetByName('6g2');
            $kepuasan = KepuasanPenggunaLulusan::where('prodi_id', auth()->user()->prodi_id)->get();
            
            $row6g2 = 7; // Mulai dari baris ke-7
            $no6g2 = 1;

            foreach ($kepuasan as $item) {
                $sheet6g2->setCellValue('A' . $row6g2, $no6g2);
                $sheet6g2->setCellValue('B' . $row6g2, $item->jenis_kemampuan);
                $sheet6g2->setCellValue('C' . $row6g2, $item->sangat_baik);
                $sheet6g2->setCellValue('D' . $row6g2, $item->baik);
                $sheet6g2->setCellValue('E' . $row6g2, $item->cukup);
                $sheet6g2->setCellValue('F' . $row6g2, $item->kurang);
                $sheet6g2->setCellValue('G' . $row6g2, $item->rencana_tindak_lanjut);

                $row6g2++;
                $no6g2++;
            }
        }

        // EKSPOR TABEL 6.h.1: PENELITIAN DTPS YANG MELIBATKAN MAHASISWA
        if ($spreadsheet->sheetNameExists('6h1')) {
            $sheet6h1 = $spreadsheet->getSheetByName('6h1');
            $penelitian_dtps = PenelitianDtpsMahasiswa::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tahun', 'desc')
                    ->get();
            
            $row6h1 = 11; // Mulai dari baris ke-11
            $no6h1 = 1;

            foreach ($penelitian_dtps as $item) {
                $sheet6h1->setCellValue('A' . $row6h1, $no6h1);
                $sheet6h1->setCellValue('B' . $row6h1, $item->nama_dosen);
                $sheet6h1->setCellValue('C' . $row6h1, $item->tema_penelitian);
                $sheet6h1->setCellValue('D' . $row6h1, $item->nama_mahasiswa);
                $sheet6h1->setCellValue('E' . $row6h1, $item->judul_kegiatan);
                $sheet6h1->setCellValue('F' . $row6h1, $item->tahun);

                $row6h1++;
                $no6h1++;
            }
        }
        
        // EKSPOR TABEL 6.h.2: PENELITIAN DTPS RUJUKAN TESIS/DISERTASI
        if ($spreadsheet->sheetNameExists('6h2')) {
            $sheet6h2 = $spreadsheet->getSheetByName('6h2');
            $penelitian_rujukan = PenelitianDtpsRujukan::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tahun', 'desc')
                    ->get();
            
            $row6h2 = 6; // Mulai dari baris ke-6
            $no6h2 = 1;

            foreach ($penelitian_rujukan as $item) {
                $sheet6h2->setCellValue('A' . $row6h2, $no6h2);
                $sheet6h2->setCellValue('B' . $row6h2, $item->nama_dosen);
                $sheet6h2->setCellValue('C' . $row6h2, $item->tema_penelitian);
                $sheet6h2->setCellValue('D' . $row6h2, $item->nama_mahasiswa);
                $sheet6h2->setCellValue('E' . $row6h2, $item->judul_tesis);
                $sheet6h2->setCellValue('F' . $row6h2, $item->tahun);

                $row6h2++;
                $no6h2++;
            }
        }
        // EKSPOR TABEL 6.i: PKM DTPS YANG MELIBATKAN MAHASISWA
        if ($spreadsheet->sheetNameExists('6i')) {
            $sheet6i = $spreadsheet->getSheetByName('6i');
            $pkm_dtps = PkmDtpsMahasiswa::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tahun', 'desc')
                    ->get();
            
            $row6i = 6; // Mulai dari baris ke-6
            $no6i = 1;

            foreach ($pkm_dtps as $item) {
                // Merapikan format nama mahasiswa untuk Excel
                $daftar_mhs = explode(', ', $item->nama_mahasiswa);
                $mahasiswa_excel = "";
                
                if (count($daftar_mhs) > 1) {
                    foreach ($daftar_mhs as $idx => $mhs) {
                        $mahasiswa_excel .= ($idx + 1) . ". " . $mhs . "\n";
                    }
                    $mahasiswa_excel = rtrim($mahasiswa_excel); // Hapus enter berlebih di akhir
                } else {
                    $mahasiswa_excel = $item->nama_mahasiswa;
                }

                $sheet6i->setCellValue('A' . $row6i, $no6i);
                $sheet6i->setCellValue('B' . $row6i, $item->nama_dosen);
                $sheet6i->setCellValue('C' . $row6i, $item->tema_pkm);
                
                // Masukkan nama yang sudah dinomori
                $sheet6i->setCellValue('D' . $row6i, $mahasiswa_excel);
                // Wajib aktifkan Wrap Text agar enter (\n) di Excel berfungsi
                $sheet6i->getStyle('D' . $row6i)->getAlignment()->setWrapText(true); 
                
                $sheet6i->setCellValue('E' . $row6i, $item->judul_kegiatan);
                $sheet6i->setCellValue('F' . $row6i, $item->tahun);

                $row6i++;
                $no6i++;
            }
        }  

        // EKSPOR TABEL 7.a: DOKUMEN SPMI
        if ($spreadsheet->sheetNameExists('7a')) {
            $sheet7a = $spreadsheet->getSheetByName('7a');
            $dokumen_spmi = DokumenSpmi::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('created_at', 'asc')
                    ->get();
            
            $row7a = 5; // Mulai dari baris ke-5
            $no7a = 1;

            foreach ($dokumen_spmi as $item) {
                $sheet7a->setCellValue('A' . $row7a, $no7a);
                $sheet7a->setCellValue('B' . $row7a, $item->jenis_dokumen);
                $sheet7a->setCellValue('C' . $row7a, $item->nomor_dokumen);
                $sheet7a->setCellValue('D' . $row7a, \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d/m/Y'));

                $row7a++;
                $no7a++;
            }
        }

        // EKSPOR TABEL 7.b: PELAKSANAAN SPMI
        if ($spreadsheet->sheetNameExists('7b')) {
            $sheet7b = $spreadsheet->getSheetByName('7b');
            $pelaksanaan_spmi = PelaksanaanSpmi::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('created_at', 'asc')
                    ->get();
            
            $row7b = 5; // Mulai dari baris ke-5
            $no7b = 1;

            foreach ($pelaksanaan_spmi as $item) {
                $sheet7b->setCellValue('A' . $row7b, $no7b);
                $sheet7b->setCellValue('B' . $row7b, $item->dokumen);
                $sheet7b->setCellValue('C' . $row7b, $item->link_dokumen);
                $sheet7b->setCellValue('D' . $row7b, $item->link_laporan_audit);
                $sheet7b->setCellValue('E' . $row7b, $item->link_laporan_rtm);
                $sheet7b->setCellValue('F' . $row7b, $item->link_dokumen_peningkatan);

                $row7b++;
                $no7b++;
            }
        }

        // ========================================================
        // PROSES PENGUNDUHAN FILE EXCEL KE BROWSER PENGGUNA
        // ========================================================
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        
        // --- JURUS MEMPERCEPAT EXPORT (MATIKAN KALKULASI RUMUS) ---
        // Ini akan mencegah PhpSpreadsheet mikir keras menghitung ulang ratusan rumus Excel
        $writer->setPreCalculateFormulas(false);
        // ----------------------------------------------------------

        $fileName = 'LKPS_LAMTEKNIK_Otomatis_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        header('Cache-Control: max-age=0'); 

        $writer->save('php://output');
        exit;
    }
}
