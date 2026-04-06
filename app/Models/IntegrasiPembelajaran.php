<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrasiPembelajaran extends Model
{
    // Wajib ada agar data bisa disimpan
    protected $guarded = ['id'];

    // Relasi balik ke Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}