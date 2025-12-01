<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'login' => 'required', // bisa NIS atau Username
            'password' => 'required'
        ]);

        // Cari akun berdasarkan login (nis untuk siswa, username untuk admin)
        $akun = Akun::where('username', $request->login)
            ->orWhere('nis', $request->login)
            ->first();

        // Kalau akun tidak ada
        if (!$akun) {
            return back()->withErrors(['login' => 'Akun tidak ditemukan']);
        }

        // Cek password (sebaiknya gunakan Hash, tapi di sini plain)
        if ($akun->password !== $request->password) {
            return back()->withErrors(['password' => 'Password salah']);
        }

        // Login dengan guard yang sesuai
        if ($akun->role === 'admin') {
            Auth::login($akun);
            return back()->with([
                'success' => 'Login berhasil!',
                'redirectTo' => route('admin.dashboard')
            ]);
        } elseif ($akun->role === 'siswa') {
            // Get pengguna data
            $pengguna = $akun->pengguna;
            if (!$pengguna) {
                return back()->withErrors(['login' => 'Data pengguna tidak ditemukan']);
            }
            Auth::guard('pengguna')->login($pengguna);
            return back()->with([
                'success' => 'Login berhasil!',
                'redirectTo' => route('user.dashboard')
            ]);
        } else {
            Auth::login($akun);
            return back()->with([
                'success' => 'Login berhasil!',
                'redirectTo' => '/'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
