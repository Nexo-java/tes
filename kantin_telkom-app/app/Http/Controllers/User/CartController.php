<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class CartController extends Controller
{
    // Menampilkan isi cart dari session
    public function index(Request $request)
    {
        $cart = session('cart', []); // Ambil cart dari session
        return response()->json(['cart' => $cart]);
    }

    // Menambahkan menu ke cart
    public function add(Request $request)
    {
        $menu = Menu::find($request->menu_id); // Cari menu berdasarkan id
        if (!$menu) return response()->json(['error' => 'Menu not found'], 404);

        $cart = session('cart', []);
        if (isset($cart[$menu->menu_id])) {
            $cart[$menu->menu_id]['qty']++;
        } else {
            $cart[$menu->menu_id] = [
                'id' => $menu->menu_id,
                'name' => $menu->nama_menu,
                'price' => $menu->harga,
                'qty' => 1
            ];
        }

        // Simpan cart ke session
        session(['cart' => $cart]);
        return response()->json(['cart' => $cart]);
    }

    // Update jumlah menu di cart
    public function update(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->menu_id;
        $qty = $request->qty;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, $qty);
            session(['cart' => $cart]);
        }

        return response()->json(['cart' => $cart]);
    }

    // Hapus menu dari cart
    public function remove(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->menu_id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return response()->json(['cart' => $cart]);
    }

    // Kosongkan seluruh cart
    public function clear()
    {
        session()->forget('cart'); // Hapus cart dari session
        return response()->json(['message' => 'Cart cleared']);
    }
}
