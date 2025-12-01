<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Kantin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    // Tampilkan semua menu milik 1 kantin
    public function index(Request $request, Kantin $kantin)
    {
        $perPage = $request->get('per_page', 5); // default 5

        // Ambil data menu sesuai pagination
        if ($perPage === 'all') {
            $menus = $kantin->menus()->get(); // ambil semua data tanpa paginate
        } else {
            $menus = $kantin->menus()->paginate((int)$perPage);
        }

        // Hitung jumlah notifikasi (hanya yang benar-benar 'belum' / unread)
        $notifCount = \App\Models\Transaksi::whereHas('transaksiDetails', function($query) {
            $query->where('status', 'belum');
        })->count();

        // Tampilkan view index menu
        return view('admin.menus.index', compact('kantin', 'menus', 'perPage', 'notifCount'));
    }

    // Menampilkan form tambah menu
    public function create(Kantin $kantin)
    {
        return view('admin.menus.create', compact('kantin'));
    }

    // Proses simpan menu baru
    public function store(Request $request, Kantin $kantin)
    {
        // Validasi input
        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar_menu' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deks_menu' => 'nullable|string',
        ]);


        // Jika ada file gambar, simpan ke storage
        if ($request->hasFile('gambar_menu')) {
            $gambar = $request->file('gambar_menu')->store('menu', 'public');
        } else {
            // Jika tidak ada gambar, gunakan nama menu + .jpg
            $gambar = $request->nama_menu . '.jpg';
        }

        // Simpan data menu ke database
        Menu::create([
            'id_kantin' => $kantin->id_kantin, // otomatis sesuai kantin
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar_menu' => $gambar,
            'deks_menu' => $request->deks_menu,
            'status_menu' => 'aktif',
        ]);

        // Redirect ke halaman index menu dengan pesan sukses
        return redirect()->route('admin.kantin.menus.index', $kantin->id_kantin)
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    // Toggle status menu aktif/nonaktif
    public function toggle(Kantin $kantin, Menu $menu)
    {
        $menu->status_menu = $menu->status_menu === 'aktif' ? 'nonaktif' : 'aktif'; // Ubah status
        $menu->save(); // Simpan perubahan

        // Redirect ke halaman index menu dengan pesan sukses
        return redirect()->route('admin.kantin.menus.index', $kantin->id_kantin)
            ->with('success', 'Status menu berhasil diubah!');
    }

    // Menampilkan form edit menu
    public function edit(Kantin $kantin, Menu $menu)
    {
        return view('admin.menus.edit', compact('kantin', 'menu'));
    }

    // Proses update data menu
    public function update(Request $request, Kantin $kantin, Menu $menu)
    {
        // Validasi input
        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar_menu' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deks_menu' => 'nullable|string',
        ]);

        $gambar = $menu->gambar_menu;
        // Jika ada file gambar baru, simpan ke storage
        if ($request->hasFile('gambar_menu')) {
            $gambar = $request->file('gambar_menu')->store('menu', 'public');
        }

        $oldStok = $menu->stok;
        $newStok = $request->stok;

        // Update data menu di database
        $menu->update([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'stok' => $newStok,
            'gambar_menu' => $gambar,
            'deks_menu' => $request->deks_menu,
        ]);

        // Jika stok ditambah dan menu nonaktif, aktifkan kembali
        if ($newStok > 0 && $menu->status_menu === 'nonaktif') {
            $menu->status_menu = 'aktif';
            $menu->save();
        }

        // Jika stok 0 atau kurang, nonaktifkan menu
        if ($newStok <= 0) {
            $menu->status_menu = 'nonaktif';
            $menu->save();
        }

        // Redirect ke halaman index menu dengan pesan sukses
        return redirect()->route('admin.kantin.menus.index', $kantin->id_kantin)
            ->with('success', 'Menu berhasil diupdate!');
    }

    // Proses hapus menu
    public function destroy(Kantin $kantin, Menu $menu)
    {
        $menu->delete(); // Hapus data menu dari database
        // Redirect ke halaman index menu dengan pesan sukses
        return redirect()->route('admin.kantin.menus.index', $kantin->id_kantin)
            ->with('success', 'Menu berhasil dihapus!');
    }




}
