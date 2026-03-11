<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KerjasamaPendidikan extends Model
{
    // Buka gembok agar bisa insert data otomatis!
    protected $guarded = ['id'];

    // Relasi ke tabel Prodi (Super penting untuk fitur ke depannya)
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}