<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenSpmi extends Model
{
    protected $guarded = ['id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}