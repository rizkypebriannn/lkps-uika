<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScoringService;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil ID Prodi yang sedang login
        $prodi_id = auth()->user()->prodi_id;

        // 2. Panggil mesin hitung untuk Kerjasama
        $skorKerjasama = ScoringService::hitungSkorKerjasama($prodi_id);
        $skorDosenS3 = ScoringService::hitungSkorDosenS3($prodi_id);
        $skorJabatanDosen = ScoringService::hitungSkorJabatanDosen($prodi_id);
        $skorKecukupanDosen = ScoringService::hitungSkorKecukupanDosen($prodi_id);
        $skorTendik = ScoringService::hitungSkorTendik($prodi_id);
        $skorBebanKerja = ScoringService::hitungSkorBebanKerja($prodi_id);
        $skorPublikasiDtps = ScoringService::hitungSkorPublikasiDTPS($prodi_id);
        $skorKaryaIlmiahDtps = ScoringService::hitungSkorKaryaIlmiahDTPS($prodi_id);
        $skorLuaranPaten = ScoringService::hitungSkorLuaranPaten($prodi_id);
        $skorLuaranHakCipta = ScoringService::hitungSkorLuaranHakCipta($prodi_id);
        $skorLuaranTeknologi = ScoringService::hitungSkorLuaranTeknologi($prodi_id);
        $skorLuaranBuku = ScoringService::hitungSkorLuaranBuku($prodi_id);
        $skorKurikulum = ScoringService::hitungSkorKurikulum($prodi_id);
        $skorPenelitianMhs = ScoringService::hitungSkorPenelitianMhs($prodi_id);
        $skorPkmMhs = ScoringService::hitungSkorPkmMhs($prodi_id);
        $skorRasioMhs = ScoringService::hitungSkorRasioMahasiswa($prodi_id);
        $skorMhsAsing = ScoringService::hitungSkorMahasiswaAsing($prodi_id);
        $skorIpkLulusan = ScoringService::hitungSkorIpkLulusan($prodi_id);
        $skorPrestasiMhs = ScoringService::hitungSkorPrestasiMahasiswa($prodi_id);
        $skorMasaStudi = ScoringService::hitungSkorMasaStudi($prodi_id);
        $skorLulusTepatWaktu = ScoringService::hitungSkorLulusTepatWaktu($prodi_id);
        $skorPublikasiMhs = ScoringService::hitungSkorPublikasiMahasiswa($prodi_id);
        $skorLuaranMhs = ScoringService::hitungSkorLuaranMhs($prodi_id);
        $skorWaktuTunggu = ScoringService::hitungSkorWaktuTunggu($prodi_id);
        $skorKesesuaianKerja = ScoringService::hitungSkorKesesuaianKerja($prodi_id);
        $skorTempatKerja = ScoringService::hitungSkorTempatKerja($prodi_id);
        $skorKepuasanPengguna = ScoringService::hitungSkorKepuasanPengguna($prodi_id);
        $skorPenelitianDtps = ScoringService::hitungSkorPenelitianDtps($prodi_id);
        $skorPkmDtps = ScoringService::hitungSkorPkmDtps($prodi_id);
        $skorIntegrasiPembelajaran = ScoringService::hitungSkorIntegrasiPembelajaran($prodi_id);
        $skorBasicScience = ScoringService::hitungSkorBasicScience($prodi_id);


        // Lempar ke view
        return view('dashboard', compact('skorKerjasama', 'skorDosenS3', 'skorJabatanDosen', 'skorKecukupanDosen', 'skorTendik',
            'skorBebanKerja', 'skorPublikasiDtps', 'skorKaryaIlmiahDtps', 'skorLuaranPaten', 'skorLuaranHakCipta', 'skorLuaranTeknologi', 
            'skorLuaranBuku', 'skorKurikulum', 'skorPenelitianMhs', 'skorPkmMhs', 'skorRasioMhs', 'skorMhsAsing', 'skorIpkLulusan', 'skorPrestasiMhs', 'skorMasaStudi',
            'skorLulusTepatWaktu', 'skorPublikasiMhs', 'skorLuaranMhs', 'skorWaktuTunggu', 'skorKesesuaianKerja', 'skorTempatKerja', 'skorKepuasanPengguna', 'skorPenelitianDtps',
            'skorPkmDtps', 'skorIntegrasiPembelajaran', 'skorBasicScience'));
    } 
}