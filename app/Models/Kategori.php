<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description'
    ];
    protected $guarded = ['name'];
    
    public function kamera()
    {
        return $this->hasMany('App\Models\Kamera');
    }
}
