<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class NasabahController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Data Nasabah',
            'menuAdminNasabah' => 'active',
            'nasabah' => User::where('peran', 'Nasabah')->get(),
        ];
        return view('nasabah.pengelola.index', $data);
    }

    public function create(){
        return view('nasabah.pengelola.create', [
            'title' => 'Tambah Data Nasabah',
            'menuAdminNasabah' => 'active',
        ]);
    }

    public function store(Request $request){
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
            $file->move(public_path('foto_nasabah'), $namaFile);
        }

        User::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'foto' => $namaFile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => 'Nasabah',
            'is_status' => true,
        ]);

        return redirect()->route('datanasabah.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id){
        $nasabah = User::where('peran', 'Nasabah')->findOrFail($id);
        return view('nasabah.pengelola.edit', [
            'title' => 'Edit Data Nasabah',
            'nasabah' => $nasabah,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required|numeric',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:8',
        ]);

        $nasabah = User::where('peran', 'Nasabah')->findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_nasabah'), $namaFile);
            $nasabah->foto = $namaFile;
        }

        $nasabah->update([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $nasabah->password,
        ]);

        return redirect()->route('datanasabah.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id){
        $nasabah = User::where('peran', 'Nasabah')->findOrFail($id);
        $nasabah->delete();
        return redirect()->route('datanasabah.index')->with('success', 'Data berhasil dihapus');
    }

    public function exportPdf(){
        $nasabah = User::where('peran', 'Nasabah')->get();
        $pdf = Pdf::loadView('nasabah.pengelola.export-pdf', compact('nasabah'))
                ->setPaper('A4', 'landscape');

        return $pdf->download('laporan-nasabah.pdf');
    }
}
