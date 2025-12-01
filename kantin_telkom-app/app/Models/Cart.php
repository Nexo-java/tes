<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    public $timestamps = false;

    protected $fillable = [
        'nis',
        'menu_id',
        'jml',
        'subtotal',
    ];

    // 🔹 Relasi ke Pengguna (siswa)
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'nis', 'nis');
    }

    // 🔹 Relasi ke Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }
}
