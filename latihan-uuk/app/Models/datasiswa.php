<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datasiswa extends Model
{
    protected $table = 'datasiswas';
    protected $primaryKey = 'siswa_id';
    protected $fillable = ['nama_siswa', 'kelas_siswa', 'jenis_kelamin'];

    public function getRouteKeyName()
    {
        return 'siswa_id';
    }
}
