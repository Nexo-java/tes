<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userslogin extends Model
{
    use HasFactory;

    protected $table = 'userslogin';

    protected $fillable = [
        'uname',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}
