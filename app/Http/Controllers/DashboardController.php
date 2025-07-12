<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penyetoran;
use App\Models\Tabungan;


class DashboardController extends Controller
{
    public function index(){

        $data = array(
            "title" => "Dashboard",
            "menuDashboard" => "active",
        );
        $totalNasabah = User::where('peran', 'Nasabah')->count();
        $totalPengelola = User::where('peran', 'Pengelola')->count();
        $totalSaldoPenyetoran = Penyetoran::sum('total');
        $totalTarikSaldo = Tabungan::sum('jumlah');

    return view('dashboard', [
    'title' => 'Dashboard',
    'menuDashboard' => 'active',
    'totalNasabah' => $totalNasabah,
    'totalPengelola' => $totalPengelola,
    'totalSaldoPenyetoran' => $totalSaldoPenyetoran,
    'totalTarikSaldo' => $totalTarikSaldo,
    ]);

    }

    public function pengelola()
    {
        $totalNasabah = User::where('peran', 'Nasabah')->count();
        $totalPengelola = User::where('peran', 'Pengelola')->count();
        $totalSaldoPenyetoran = Penyetoran::sum('total');
        $totalTarikSaldo = Tabungan::sum('jumlah');

         return view('dashboard', [
        'menuDashboard' => 'active',
        'title' => 'Dashboard Pengelola',
        'totalNasabah' => $totalNasabah,
        'totalPengelola' => $totalPengelola,
        'totalSaldoPenyetoran' => $totalSaldoPenyetoran,
        'totalTarikSaldo' => $totalTarikSaldo,
    ]);
    }

    public function nasabah()
    {
        $totalNasabah = User::where('peran', 'Nasabah')->count();
        $totalPengelola = User::where('peran', 'Pengelola')->count();
        $totalSaldoPenyetoran = Penyetoran::sum('total');
        $totalTarikSaldo = Tabungan::sum('jumlah');

         return view('dashboard', [
        'menuDashboard' => 'active',
        'title' => 'Dashboard Nasabah',
        'totalNasabah' => $totalNasabah,
        'totalPengelola' => $totalPengelola,
        'totalSaldoPenyetoran' => $totalSaldoPenyetoran,
        'totalTarikSaldo' => $totalTarikSaldo,
    ]);
    }



}
