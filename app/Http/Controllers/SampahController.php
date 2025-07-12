<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sampah;
use App\Models\JenisSampah;
use Barryvdh\DomPDF\Facade\Pdf;


class SampahController extends Controller
{
    public function index()
    {
    $data = [
        'title'           => 'Data Sampah',
        'menuAdminSampah' => 'active',
        'sampahs'         => Sampah::with('jenisSampah')->get(),
    ];
    return view('sampah.pengelola.index', $data);
    }

    public function create()
    {
        $data = [
            'title'           => 'Tambah Data Sampah',
            'menuAdminSampah' => 'active',
            'jenissampah'          => JenisSampah::all(),
        ];
        return view('sampah/pengelola/create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_sampah_id' => 'required|exists:jenis_sampahs,id',
            'harga' => 'required|numeric',
            'foto'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'jenis_sampah_id.required'  => 'Jenis sampah harus dipilih', 
            'harga.required' => 'Harga tidak boleh kosong',
            'foto.required'  => 'Foto wajib diunggah',
        ]);

        $namaFile = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_sampah'), $namaFile);
        }

        //$sampah = Sampah::find($request->nama);
        Sampah::create([
        'jenis_sampah_id' => $request->jenis_sampah_id,
        //'nama'            => JenisSampah::find($request->jenis_sampah_id)->nama,
        'harga' => $request->harga,
        'foto' => $namaFile,
        ]);

        return redirect()->route('datasampah.index')->with('success', 'Data sampah berhasil ditambahkan');
    }

    public function exportPdf()
    {
    
    ini_set('max_execution_time', 300);
    $sampah = Sampah::all(); 

    $pdf = Pdf::loadView('sampah.pengelola.export-pdf', compact('sampah'))
              ->setPaper('A4', 'landscape');

    return $pdf->download('laporan-sampah.pdf');
    }

    public function edit($id)
    {
        $sampah = Sampah::findOrFail($id);
        $jenissampah = JenisSampah::all();
        $title = 'Edit Data Sampah';

        return view('sampah.pengelola.edit', compact('sampah', 'jenissampah', 'title'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'jenis_sampah_id' => 'required|exists:jenis_sampahs,id',
        'harga' => 'required|numeric',
        'foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $sampah = Sampah::findOrFail($id);

    // update foto jika ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('foto_sampah'), $namaFile);
        $sampah->foto = $namaFile;
    }

    $sampah->jenis_sampah_id = $request->jenis_sampah_id;
    $sampah->harga = $request->harga;
    $sampah->save();

    return redirect()->route('datasampah.index')->with('success', 'Data berhasil diubah');
    }


    public function destroy($id)
    {
    $sampah = Sampah::findOrFail($id);
    $sampah->delete();

    return redirect()->route('datasampah.index')->with('success', 'Data berhasil dihapus');
    }
}