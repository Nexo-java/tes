<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datesiswa extends Model
{
    protected $table = 'datesiswas';
    protected $fillable = [ 'nama',  'tanggal_lahir'];
}
