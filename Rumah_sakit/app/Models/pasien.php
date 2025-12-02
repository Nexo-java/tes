<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pasien extends Model
{
    protected $table = 'pasiens';
    protected $primaryKey = 'id';
    protected $fillable = ['no_pasien', 'nama_pasien', 'jenis_kelamin', 'alamat'];

}
