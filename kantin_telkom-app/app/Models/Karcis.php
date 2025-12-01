<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karcis extends Model
{
    protected $table = 'tb_karciss';
    protected $primaryKey = 'karcis_id';
    public $timestamps = true;

    protected $fillable = [
        'id_transaksi',
        'tgl_cetak',
    ];

    // 🔹 Relasi ke Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
