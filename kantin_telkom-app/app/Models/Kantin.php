<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kantin extends Model
{
    protected $table = 'tb_kantins';
    protected $primaryKey = 'id_kantin';
    public $timestamps = true;

    protected $fillable = [
        'nama_kantin',
        'gambar_kantin'
    ];
    public function menus()
    {
        return $this->hasMany(Menu::class, 'id_kantin', 'id_kantin');
    }
}
