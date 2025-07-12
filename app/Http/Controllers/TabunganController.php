<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabungan;
use App\Models\Penyetoran;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class TabunganController extends Controller
{
    public function index(Request $request)
    {
        $query = Tabungan::with('nasabah');

        if ($request->filled('nama')) {
            $query->whereHas('nasabah', function ($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->nama.'%');
            });
        }

        if ($request->filled('jenis_transaksi')) {
            $query->where('jenis_transaksi', $request->jenis_transaksi);
        }

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $tabungan = $query->latest()->paginate(10);
        foreach ($tabungan as $item) {
        $item->saldo = Penyetoran::where('nasabah_id', $item->nasabah_id)->sum('total') -
                   Tabungan::where('nasabah_id', $item->nasabah_id)->sum('jumlah');
        }
        $saldo_total = Tabungan::selectRaw("SUM(CASE WHEN jenis_transaksi = 'Setor' THEN jumlah WHEN jenis_transaksi = 'Tarik' THEN -jumlah ELSE jumlah END) as saldo")->first()->saldo ?? 0;

        return view('tabungan.index', [
        'tabungan' => $tabungan,
        'saldo_total' => $saldo_total,
        'menuTabungan' => 'active',
        'title' => 'Tabungan Nasabah'
        ]);

    }
    public function create()
    {
        $nasabah = \App\Models\User::where('peran', 'Nasabah')->get();
         return view('tabungan.create', [
        'nasabah' => $nasabah,
        'menuTabungan' => 'active',
        'title' => 'Form Penarikan Saldo'
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        Tabungan::create([
            'nasabah_id' => $request->nasabah_id,
            'jumlah' => $request->jumlah,
            'jenis_transaksi' => 'Tarik',
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('tabungan.index')->with('success', 'Penarikan berhasil disimpan.');
    }

    public function exportPdf()
    {
    $tabungan = Tabungan::with('nasabah')->get();

    $pdf = Pdf::loadView('tabungan.export-pdf', compact('tabungan'))
              ->setPaper('A4', 'landscape');

    return $pdf->download('laporan-tabungan.pdf');
    }

    public function edit($id)
    {
        $tabungan = Tabungan::findOrFail($id);
        $nasabah = User::where('peran', 'Nasabah')->get(); // ← ambil semua nasabah
        $title = 'Edit Data Penarikan';
        $setor = Penyetoran::where('nasabah_id', $tabungan->nasabah_id)->sum('total');
        $tarik = Tabungan::where('nasabah_id', $tabungan->nasabah_id)->sum('jumlah');
        $saldo = $setor - $tarik;

       return view('tabungan.edit', compact('tabungan', 'nasabah', 'title', 'saldo'));

    }

    public function update(Request $request, $id)
    {

    $request->validate([
    'nasabah_id' => 'required',
    'jumlah' => 'required|integer|min:1',
    'tanggal' => 'required|date',
    ]);
    $tabungan = Tabungan::findOrFail($id);
    $tabungan->update($request->all());

    return redirect()->route('tabungan.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
    $tabungan = Tabungan::findOrFail($id);
    $tabungan->delete();

    return redirect()->route('tabungan.index')->with('success', 'Data berhasil dihapus');
    }

}
