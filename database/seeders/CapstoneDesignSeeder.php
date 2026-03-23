<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CapstoneDesign;
use App\Models\Prodi;

class CapstoneDesignSeeder extends Seeder
{
    public function run()
    {
        $prodis = Prodi::all();

        foreach ($prodis as $prodi) {
            CapstoneDesign::create([
                'prodi_id' => $prodi->id,
                
                // Data Administratif
                'mk_pendukung' => 'Metodologi Penelitian, Praktikum Terpadu',
                'sks_pendukung' => 4,
                'mk_capstone' => 'Tugas Akhir / Capstone Design',
                'sks_capstone' => 4,
                'semester' => '8',
                'cakupan_bahasan' => 'Perancangan rekayasa komprehensif memecahkan masalah kompleks',
                
                // Data Kualitatif (Kita set TRUE semua agar tembus Skor 4.00)
                'has_panduan' => true,
                'has_cpl_rumusan' => true,
                'has_standar_keteknikan' => true,
                'has_bukti_sahih' => true,
            ]);
        }
    }
}