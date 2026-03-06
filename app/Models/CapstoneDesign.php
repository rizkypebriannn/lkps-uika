<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapstoneDesign extends Model
{
    protected $guarded = ['id'];
    
    // Relasi balik ke Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}