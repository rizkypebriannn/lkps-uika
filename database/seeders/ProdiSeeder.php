<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        $daftarProdi = [
            'Teknik Sipil', 
            'Teknik Mesin', 
            'Teknik Elektro', 
            'Teknik Informatika', 
            'Sistem Informasi', 
            'Ilmu Lingkungan', 
            'Rekayasa Pertanian dan Biosistem'
        ];

        foreach ($daftarProdi as $prodi) {
            Prodi::create(['nama_prodi' => $prodi]);
        }
    }
}