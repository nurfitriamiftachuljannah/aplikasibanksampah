<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyetoran;
use App\Models\JenisSampah;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PenyetoranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Penyetoran',
            'menuAdminPenyetoran' => 'active',
            'penyetorans' => Penyetoran::with(['nasabah', 'jenisSampah'])->get(),
        ];
        return view('penyetoran.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Penyetoran',
            'menuAdminSampah' => 'active',
            'nasabah' => User::where('peran', 'Nasabah')->get(),
            'jenissampah' => JenisSampah::all(),
        ];
        return view('penyetoran.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:users,id',
            'jenis_sampah_id' => 'required|exists:jenis_sampahs,id',
            'berat' => 'required|numeric|min:0',
            'harga_per_kg' => 'required|numeric',
            'tanggal_setor' => 'required|date',
        ]);

        $total = $request->berat * $request->harga_per_kg;

        Penyetoran::create([
            'nasabah_id' => $request->nasabah_id,
            'jenis_sampah_id' => $request->jenis_sampah_id,
            'berat' => $request->berat,
            'harga_per_kg' => $request->harga_per_kg,
            'total' => $total,
            'tanggal_setor' => $request->tanggal_setor,
        ]);

        return redirect()->route('penyetoran.index')->with('success', 'Setoran berhasil ditambahkan.');
    }

    public function exportPdf()
    {
        ini_set('max_execution_time', 300);
        $penyetoran = Penyetoran::with(['nasabah', 'jenisSampah'])->get();

        $pdf = Pdf::loadView('penyetoran.export-pdf', compact('penyetoran'))
                  ->setPaper('A4', 'landscape');

        return $pdf->download('laporan-penyetoran.pdf');
    }

    public function edit($id)
    {
        $penyetoran = Penyetoran::findOrFail($id);
        $nasabah = User::where('peran', 'Nasabah')->get();
        $jenissampah = JenisSampah::all();
        $title = 'Edit Data Penyetoran';

        return view('penyetoran.edit', compact('penyetoran', 'nasabah', 'jenissampah', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:users,id',
            'jenis_sampah_id' => 'required|exists:jenis_sampahs,id',
            'berat' => 'required|numeric|min:0',
            'harga_per_kg' => 'required|numeric',
            'tanggal_setor' => 'required|date',
        ]);

        $total = $request->berat * $request->harga_per_kg;
        $penyetoran = Penyetoran::findOrFail($id);

        $penyetoran->update([
            'nasabah_id' => $request->nasabah_id,
            'jenis_sampah_id' => $request->jenis_sampah_id,
            'berat' => $request->berat,
            'harga_per_kg' => $request->harga_per_kg,
            'total' => $total,
            'tanggal_setor' => $request->tanggal_setor,
        ]);

        return redirect()->route('penyetoran.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $penyetoran = Penyetoran::findOrFail($id);
        $penyetoran->delete();

        return redirect()->route('penyetoran.index')->with('success', 'Data berhasil dihapus');
    }
}
