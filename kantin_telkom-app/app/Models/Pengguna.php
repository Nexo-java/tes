<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Akun;

class Pengguna extends Authenticatable
{
    protected $table = 'tb_penggunas';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'nis',
        'nama_siswa',
        'telp_siswa',
        'email_siswa',
        'jurusan_siswa',
        'kelas_siswa',
    ];

    public function akun()
    {
        return $this->hasOne(Akun::class, 'nis', 'nis');
    }

    /**
     * Saat pengguna baru dibuat → otomatis buat akun baru.
     */
    protected static function booted()
    {
        static::created(function ($pengguna) {
            Akun::create([
                'username' => $pengguna->nama_siswa, // atau bisa juga pakai NIS
                'password' => 'makan@' . $pengguna->nis, // password = makan@NIS
                'role' => 'siswa', // default role
                'nis' => $pengguna->nis,
            ]);
        });
    }
}
