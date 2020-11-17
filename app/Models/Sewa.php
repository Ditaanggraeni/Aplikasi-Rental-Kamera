<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'merk', 'harga', 'penyewa', 'jaminan', 'tgl_sewa',
        'tgl_kembali', 'denda', 'total'
    ];
}
