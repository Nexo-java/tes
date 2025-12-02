<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datasiswa extends Model
{
    protected $table = 'datasiswas';
    protected $fillable = ['nama', 'email'];
}
