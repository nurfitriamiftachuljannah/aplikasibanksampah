<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
    return view('auth.login', [
        'title' => 'Login'
    ]);
    }
    
    public function loginProses(Request $request){
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ],[
            'email.required'    => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min'      => 'Password minimal terdiri dari 8 karakter'
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (!$user->is_status) {
                Auth::logout();
                return back()->with('error', 'Akun Anda belum aktif.');
            }

            if ($user->peran === 'Pengelola') {
                return redirect()->route('dashboard.pengelola')->with('success', 'Selamat datang, Pengelola!');
            } elseif ($user->peran === 'Nasabah') {
                return redirect()->route('dashboard.nasabah')->with('success', 'Selamat datang, Nasabah!');
            }

            return redirect()->route('login')->with('error', 'Peran tidak dikenali.');
        }

            return back()->with('error', 'Email atau password salah.')->withInput();
        
    }

    public function showRegisterForm()
    {
    return view('auth.register', [
        'title' => 'Register Akun'
    ]);
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => 'Nasabah',
            'is_status' => true, // Ubah ke false jika ingin aktivasi manual
        ],[
    'email.unique' => 'Email sudah digunakan. Silakan gunakan email lain.',
]);

        Auth::login($user);

        return redirect()->route('dashboard.nasabah')->with('success', 'Registrasi berhasil! Selamat datang di Siresik.');
}

    public function logout(Request $request)
    {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login')->with('success', 'Terima kasih atas kunjungan Anda');
    }

}
