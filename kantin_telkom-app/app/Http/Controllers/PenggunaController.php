<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input dulu
        $request->validate([
            'nis' => 'required|unique:tb_penggunas,nis',
            'nama_siswa' => 'required|string|max:100',
            'telp_siswa' => 'required|string|max:100',
            'email_siswa' => 'required|email|max:100',
            'jurusan_siswa' => 'nullable|string|max:100',
            'kelas_siswa' => 'required|string|max:100',
        ]);

        // Simpan ke tb_penggunas
        $pengguna = Pengguna::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'telp_siswa' => $request->telp_siswa,
            'email_siswa' => $request->email_siswa,
            'jurusan_siswa' => $request->jurusan_siswa,
            'kelas_siswa' => $request->kelas_siswa,
        ]);

        // Buat otomatis akun di tb_akuns
        Akun::create([
            'password' => Hash::make('default123'), // default password
            'role' => 'siswa',                     // otomatis siswa
            'nis' => $pengguna->nis,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna dan akun berhasil dibuat!');
    }
}
