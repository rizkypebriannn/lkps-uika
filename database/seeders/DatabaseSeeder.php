<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Prodi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Jalankan ProdiSeeder terlebih dahulu
        $this->call([
            ProdiSeeder::class,
            CapstoneDesignSeeder::class,
        ]);

        // 2. Ambil semua prodi yang baru saja dibuat
        $prodis = Prodi::all();

        // 3. Looping untuk membuat User Admin di setiap Prodi
        foreach ($prodis as $prodi) {
            // Kita buat email otomatis berdasarkan nama prodi
            // Contoh: "Teknik Sipil" -> "admin.sipil@uikabogor.ac.id"
            $slug = Str::slug(str_replace('Teknik ', '', $prodi->nama_prodi));
            $email = "admin." . $slug . "@uikabogor.ac.id";

            User::factory()->create([
                'name' => "Admin " . $prodi->nama_prodi,
                'email' => $email,
                'password' => Hash::make('password123'), // Password seragam untuk testing
                'prodi_id' => $prodi->id,
            ]);
        }

        // 4. Buat satu Super Admin Global (Opsional - prodi_id null)
        User::factory()->create([
            'name' => 'Super Admin Fakultas',
            'email' => 'admin.fakultas@uikabogor.ac.id',
            'password' => Hash::make('admin123'),
            'prodi_id' => null, // Karena sudah disetting nullable di migration
        ]);
    }
}