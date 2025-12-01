<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = true;

    protected $fillable = [
        'nis',
        'metode_bayar',
        'bukti_transfer',
        'status_pembayaran',
        'tgl_transaksi',
    ];

    // 🔹 Relasi ke Pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'nis', 'nis');
    }

    // 🔹 Relasi ke Detail Transaksi
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi', 'id_transaksi');
    }

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi', 'id_transaksi');
    }

    // 🔹 Relasi ke Karcis
    public function karcis()
    {
        return $this->hasOne(Karcis::class, 'id_transaksi', 'id_transaksi');
    }
}
