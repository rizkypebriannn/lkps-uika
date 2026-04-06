<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model {
    protected $guarded = ['id']; // Mengizinkan pengisian masal (Mass Assignment)

    // Relasi balik ke Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
