<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatkulBasicScience extends Model
{
    // Buka izin pengisian massal
    protected $guarded = ['id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}