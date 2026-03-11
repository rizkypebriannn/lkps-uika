<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KerjasamaPengabdian extends Model
{
    protected $guarded = ['id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}