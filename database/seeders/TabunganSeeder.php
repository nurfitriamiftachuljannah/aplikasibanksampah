<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tabungan;
use Illuminate\Support\Facades\DB;

class TabunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
    Tabungan::create([
    'nasabah_id' => 1,
    'jenis_transaksi' => 'Setor',
    'jumlah' => 10000,
    'keterangan' => 'Setoran awal',
    'tanggal' => now(),
    ]);
    }
}
