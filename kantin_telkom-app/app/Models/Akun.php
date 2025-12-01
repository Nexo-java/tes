<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_akuns';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'password',
        'role',
        'nis',
    ];

    protected $hidden = [
        'password',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'nis', 'nis');
    }
}
