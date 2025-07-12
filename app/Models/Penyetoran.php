<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisSampah;
use App\Models\User;

class Penyetoran extends Model
{
    use HasFactory;

    protected $table = 'penyetorans';

    protected $fillable = [
        'nasabah_id',
        'jenis_sampah_id',
        'berat',
        'harga_per_kg',
        'total',
        'tanggal_setor',
    ];

    protected $casts = [
        'tanggal_setor' => 'date',
    ];

    public function nasabah()
    {
        return $this->belongsTo(User::class, 'nasabah_id');
    }

    public function jenisSampah()
    {
        return $this->belongsTo(JenisSampah::class);
    }
}
