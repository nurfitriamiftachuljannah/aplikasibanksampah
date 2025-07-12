<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenyetoranController;
use App\Http\Controllers\PengelolaDataController;
use App\Http\Controllers\PenarikanSaldoController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Login & Register
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginProses'])->name('loginProses');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'registerProses']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Setelah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/penyetoran', [PenyetoranController::class, 'index'])->name('penyetoran.index');
    Route::get('/tabungan', [TabunganController::class, 'index'])->name('tabungan.index');
});

// Khusus Nasabah
Route::middleware(['auth', 'checkRole:Nasabah'])->group(function () {
    Route::get('/dashboard-nasabah', [DashboardController::class, 'nasabah'])->name('dashboard.nasabah');
});

// Khusus Pengelola
Route::middleware(['auth', 'checkRole:Pengelola'])->group(function () {
    Route::get('/dashboard-pengelola', [DashboardController::class, 'pengelola'])->name('dashboard.pengelola');

    // Data Pengelola
    Route::resource('datapengelola', PengelolaDataController::class);
    Route::get('/datapengelola/export/pdf', [PengelolaDataController::class, 'exportPdf'])->name('datapengelola.export.pdf');

    // Data Nasabah
    Route::resource('datanasabah', NasabahController::class);
    Route::get('/datanasabah/export/pdf', [NasabahController::class, 'exportPdf'])->name('datanasabah.export.pdf');

    // Data Sampah
    Route::resource('datasampah', SampahController::class);
    Route::get('/datasampah/export/pdf', [SampahController::class, 'exportPdf'])->name('datasampah.export.pdf');

    // Penyetoran
    Route::get('/penyetoran/create', [PenyetoranController::class, 'create'])->name('penyetoran.create');
    Route::post('/penyetoran', [PenyetoranController::class, 'store'])->name('penyetoran.store');
    Route::get('/penyetoran/{id}/edit', [PenyetoranController::class, 'edit'])->name('penyetoran.edit');
    Route::put('/penyetoran/{id}', [PenyetoranController::class, 'update'])->name('penyetoran.update');
    Route::delete('/penyetoran/{id}', [PenyetoranController::class, 'destroy'])->name('penyetoran.destroy');
    Route::get('/penyetoran/export/pdf', [PenyetoranController::class, 'exportPdf'])->name('penyetoran.export.pdf');

    // Tabungan
    Route::get('/tabungan/create', [TabunganController::class, 'create'])->name('tabungan.create');
    Route::post('/tabungan', [TabunganController::class, 'store'])->name('tabungan.store');
    Route::get('/tabungan/{id}/edit', [TabunganController::class, 'edit'])->name('tabungan.edit');
    Route::put('/tabungan/{id}', [TabunganController::class, 'update'])->name('tabungan.update');
    Route::delete('/tabungan/{id}', [TabunganController::class, 'destroy'])->name('tabungan.destroy');
    Route::get('/tabungan/export/pdf', [TabunganController::class, 'exportPdf'])->name('tabungan.export.pdf');
});

// API Get Saldo
Route::get('/get-saldo/{nasabah_id}', function ($nasabah_id) {
    $setor = \App\Models\Penyetoran::where('nasabah_id', $nasabah_id)->sum('total');
    $tarik = \App\Models\Tabungan::where('nasabah_id', $nasabah_id)->sum('jumlah');
    return response()->json([
        'saldo' => $setor - $tarik
    ]);
});
