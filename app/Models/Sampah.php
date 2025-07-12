<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    protected $fillable = ['jenis_sampah_id', 'harga','foto'];
    
    
    public function jenisSampah()
    {
    return $this->belongsTo(JenisSampah::class);
    }

}

