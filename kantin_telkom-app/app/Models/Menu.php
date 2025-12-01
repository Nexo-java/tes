<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'id_kantin',
        'nama_menu',
        'harga',
        'stok',
        'gambar_menu',
        'deks_menu',
        'status_menu',
    ];
    protected $table = 'tb_menus';
    protected $primaryKey = 'menu_id';

public function kantin()
{
    return $this->belongsTo(Kantin::class, 'id_kantin');
}

public function scopeAktif($query)
{
    return $query->where('status_menu', 'aktif');
}

   public function menus()
    {
        return $this->hasMany(Menu::class, 'id_kantin', 'id_kantin');
    }

    /**
     * Kurangi stok menu dan nonaktifkan jika habis
     */
    public function kurangiStok($jumlah)
    {
        $newStok = $this->stok - $jumlah;
        $this->stok = max(0, $newStok);

        // Nonaktifkan menu jika stok habis
        if ($newStok <= 0) {
            $this->status_menu = 'nonaktif';
        }

        return $this->save();
    }

    /**
     * Cek apakah menu tersedia (aktif dan stok > 0)
     */
    public function isTersedia()
    {
        return $this->status_menu === 'aktif' && $this->stok > 0;
    }

    /**
     * Tambah stok menu dan aktifkan jika sebelumnya nonaktif karena stok habis
     */
    public function tambahStok($jumlah)
    {
        $this->stok += $jumlah;

        // Aktifkan menu jika stok bertambah dan sebelumnya nonaktif
        if ($this->stok > 0 && $this->status_menu === 'nonaktif') {
            $this->status_menu = 'aktif';
        }

        return $this->save();
    }
}

