<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'peran',
        'is_status',
        'telepon',
        'alamat',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tabungan()
    {
    return $this->hasMany(Tabungan::class, 'nasabah_id');
    }

    public function penyetoran()
    {
    return $this->hasMany(Penyetoran::class, 'nasabah_id');
    }

    public function getSisaSaldoAttribute()
    {
    $setoran = $this->penyetoran()->sum('total');
    $penarikan = $this->tabungan()->sum('jumlah');
    return $setoran - $penarikan;
    }

}
