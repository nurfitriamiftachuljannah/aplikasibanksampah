<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class PengelolaDataController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Pengelola',
            'menuAdminPengelola' => 'active',
            'pengelola' => User::where('peran', 'Pengelola')->get(),
        ];
        return view('admin.pengelola.index', $data);
    }

    public function create()
    {
        return view('admin.pengelola.create', [
            'title' => 'Tambah Data Pengelola',
            'menuAdminPengelola' => 'active',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required|numeric',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $namaFile = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('foto_pengelola'), $namaFile);
        }

        User::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'foto' => $namaFile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => 'Pengelola',
            'is_status' => true,
        ]);

        return redirect()->route('datapengelola.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function exportPdf()
    {
        $pengelola = User::where('peran', 'Pengelola')->get();

        $pdf = Pdf::loadView('admin.pengelola.export-pdf', compact('pengelola'))
                  ->setPaper('A4', 'landscape');

        return $pdf->download('laporan-pengelola.pdf');
    }

    public function edit($id)
    {
        $pengelola = User::where('peran', 'Pengelola')->findOrFail($id);
        return view('admin.pengelola.edit', compact('pengelola'))->with('title', 'Edit Data Pengelola');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required|numeric',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:8',
        ]);

        $pengelola = User::where('peran', 'Pengelola')->findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_pengelola'), $namaFile);
            $pengelola->foto = $namaFile;
        }

        $pengelola->nama = $request->nama;
        $pengelola->telepon = $request->telepon;
        $pengelola->alamat = $request->alamat;
        $pengelola->email = $request->email;

        if ($request->filled('password')) {
            $pengelola->password = Hash::make($request->password);
        }

        $pengelola->save();

        return redirect()->route('datapengelola.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $pengelola = User::where('peran', 'Pengelola')->findOrFail($id);
        $pengelola->delete();

        return redirect()->route('datapengelola.index')->with('success', 'Data berhasil dihapus');
    }

    public function show($id)
    {
    $pengelola = User::where('peran', 'Pengelola')->findOrFail($id);

    return view('pengelola-data.show', [
        'title' => 'Detail Pengelola',
        'pengelola' => $pengelola
    ]);
    }
}
