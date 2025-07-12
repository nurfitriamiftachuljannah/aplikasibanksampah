<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSampah;
use Illuminate\Support\Facades\DB;

class JenisSampahSeeder extends Seeder
{
    public function run(): void
    {
    

         DB::table('jenis_sampahs')->insert([
            [
                'nama' => 'Botol Plastik',
                'harga' => 2500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kaleng',
                'harga' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kardus',
                'harga' => 2000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Botol Kaca',
                'harga' => 6500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kertas',
                'harga' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ember',
                'harga' => 1500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Koran',
                'harga' => 1000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Buku',
                'harga' => '1500',
                'created_at' => now(),
                'updated_at' => now()
            ],
           
        ]);
    }
}
