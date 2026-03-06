<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPembelajaran extends Model
{
    // Baris di bawah ini adalah kuncinya (mengizinkan pengisian form massal)
    protected $guarded = ['id'];
}