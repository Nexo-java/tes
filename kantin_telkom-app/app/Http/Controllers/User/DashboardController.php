<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Kantin;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard user
    public function index()
    {
        $kantins = Kantin::all(); // Ambil semua data kantin
        $menus = Menu::all(); // Ambil semua data menu

        $menus = Menu::aktif()->get(); // Ambil menu yang aktif saja

        // Tampilkan view dashboard user
        return view('User.dashboard', compact('kantins','menus'));
    }

    // Menampilkan halaman canteen user
    public function canteen($id)
    {
        $kantin = Kantin::findOrFail($id); // Ambil data kantin berdasarkan id
        $searchQuery = session('search'); // Ambil query pencarian dari session

        // Ambil menu dari kantin ini
        $menus = Menu::where('id_kantin', $id)->aktif()->get();

        // Jika ada pencarian, urutkan menu: yang cocok di atas
        if ($searchQuery) {
            $menus = $menus->sortBy(function($menu) use ($searchQuery) {
                return stripos($menu->nama_menu, $searchQuery) !== false ? 0 : 1;
            });
        }

        // Ambil semua kantin dan urutkan: kantin sekarang di atas
        $allKantins = Kantin::all()->sortBy(function($k) use ($id) {
            return $k->id_kantin == $id ? 0 : 1;
        });

        // Tampilkan view canteen user
        return view('User.canteen', compact('kantin', 'menus', 'allKantins', 'searchQuery'));
    }

    // Proses pencarian menu di dashboard user
    public function search(\Illuminate\Http\Request $request)
    {
        $query = $request->input('q'); // Ambil query pencarian

        // Cari menu berdasarkan nama
        $menu = Menu::where('nama_menu', 'like', '%' . $query . '%')
                    ->aktif()
                    ->first();

        if ($menu) {
            // Redirect ke halaman canteen dengan query pencarian
            return redirect()->route('user.canteen', $menu->id_kantin)
                           ->with('search', $query);
        }

        // Jika tidak ditemukan, redirect ke dashboard dengan error
        return redirect()->route('user.dashboard')
                       ->with('error', 'Menu "' . $query . '" tidak ditemukan');
    }
}
