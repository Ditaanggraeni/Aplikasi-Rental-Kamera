<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamera extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'kategori_id','merk', 'harga'
    ];
    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}

