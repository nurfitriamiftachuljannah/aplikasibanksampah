<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
    User::firstOrCreate(
    ['email' => 'dian@gmail.com'], // cek berdasarkan email
    [
        'nama' => 'dian',
        'password' => Hash::make('123321123'),
        'peran' => 'Pengelola',
        'is_status' => true,
        'telepon' => '081215461827',
        'alamat' => 'Sekaran',
        'foto' => 'namafile.jpg',
    ]
    );

    User::firstOrCreate(
    ['email' => 'melody@gmail.com'],
    [
        'nama' => 'Melody',
        'password' => Hash::make('123321123'),
        'peran' => 'Nasabah',
        'is_status' => true,
        'telepon' => '081215461828',
        'alamat' => 'Sekaran',
        'foto' => 'namafile.jpg',
        'no_rekening' => '1234567890',
    ]
    );

    }
}
