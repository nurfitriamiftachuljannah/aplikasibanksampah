<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;
    protected $table = 'tabungan';
    protected $fillable = ['nasabah_id', 'jumlah', 'tanggal', 'jenis_transaksi', 'tanggal'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function nasabah()
    {
        return $this->belongsTo(User::class);
    }
}
