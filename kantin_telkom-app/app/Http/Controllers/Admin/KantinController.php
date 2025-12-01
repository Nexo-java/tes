<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kantin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KantinController extends Controller
{

    // Menampilkan daftar kantin dan jumlah notifikasi
    public function index()
    {
        $kantins = Kantin::all(); // Ambil semua data kantin

        // Hitung jumlah notifikasi (hanya yang benar-benar 'belum' / unread)
        $notifCount = \App\Models\Transaksi::whereHas('transaksiDetails', function($query) {
            $query->where('status', 'belum');
        })->count();

        // Tampilkan view index kantin beserta jumlah notifikasi
        return view('admin.kantin.index', compact('kantins', 'notifCount'));
    }



    // Menampilkan form tambah kantin
    public function create()
    {
        return view('admin.kantin.create');
    }


    // Proses simpan data kantin baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kantin' => 'required|string|max:255',
            'gambar_kantin' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambar = null;
        // Jika ada file gambar, simpan ke storage
        if ($request->hasFile('gambar_kantin')) {
            $gambar = $request->file('gambar_kantin')->store('kantin', 'public');
        }

        // Simpan data ke database
        Kantin::create([
            'nama_kantin' => $request->nama_kantin,
            'gambar_kantin' => $gambar,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kantin.index')->with('success', 'Kantin berhasil ditambahkan!');
    }

    // Menampilkan form edit kantin
    public function edit(Kantin $kantin)
    {
        return view('admin.kantin.edit', compact('kantin'));
    }


    // Proses update data kantin
    public function update(Request $request, Kantin $kantin)
    {
        // Validasi input
        $request->validate([
            'nama_kantin' => 'required|string|max:255',
            'gambar_kantin' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambar = $kantin->gambar_kantin;
        // Jika ada file gambar baru, simpan ke storage
        if ($request->hasFile('gambar_kantin')) {
            $gambar = $request->file('gambar_kantin')->store('kantin', 'public');
        }

        // Update data di database
        $kantin->update([
            'nama_kantin' => $request->nama_kantin,
            'gambar_kantin' => $gambar,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kantin.index')->with('success', 'Kantin berhasil diupdate!');
    }

    // Proses hapus data kantin
    public function destroy(Kantin $kantin)
    {
        $kantin->delete(); // Hapus data dari database
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kantin.index')->with('success', 'Kantin berhasil dihapus!');
    }
}
