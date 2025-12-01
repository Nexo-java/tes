<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pengguna;

class ProfileController extends Controller
{
    // Menampilkan halaman profil user
    public function index()
    {
        $user = Auth::user();
        $pengguna = $user->pengguna; // ambil data profil dari relasi

        // Tampilkan view profil user
        return view('user.profile', compact('user', 'pengguna'));
    }

    // Menampilkan form edit profil user
    public function edit()
    {
        $user = Auth::user();
        $pengguna = $user->pengguna;

        // Tampilkan view edit profil user
        return view('user.edit-profile', compact('user', 'pengguna'));
    }

    // Proses update data profil user
    public function update(Request $request)
    {
        /** @var \App\Models\Pengguna $pengguna */
        $pengguna = Auth::guard('pengguna')->user();

        if (!$pengguna) {
            // User tidak ditemukan
            return back()->with('error', 'User not found');
        }

        // Validasi input
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas_siswa' => 'required|string|max:50',
            'jurusan_siswa' => 'required|string|max:100',
            'email_siswa' => 'required|email|max:255',
        ]);

        // Update data pengguna
        $pengguna->update([
            'nama_siswa' => $request->nama_siswa,
            'kelas_siswa' => $request->kelas_siswa,
            'jurusan_siswa' => $request->jurusan_siswa,
            'email_siswa' => $request->email_siswa,
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Profile updated successfully!');
    }
}

