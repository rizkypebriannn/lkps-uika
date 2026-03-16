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


        // Lempar ke view
        return view('dashboard', compact('skorKerjasama', 'skorDosenS3', 'skorJabatanDosen', 'skorKecukupanDosen', 'skorTendik',
            'skorBebanKerja'));
    }
}