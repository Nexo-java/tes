<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticable;

class Users extends Authenticable
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mutator to hash password before saving
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
