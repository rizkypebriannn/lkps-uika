<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JumlahMahasiswa extends Model
{
    // Tambahkan baris ini biar nggak nyasar ke tabel lain!
    protected $table = 'mahasiswas'; 
    
    protected $guarded = ['id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}