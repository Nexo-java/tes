<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        Pengguna::updateOrCreate(
            ['nis' => '543241092'],
            [
                'nama_siswa' => 'Kamil Ihsan',
                'telp_siswa' => '087787',
                'email_siswa' => 'kamil123@gmail.com',
                'jurusan_siswa' => 'PPLG',
                'kelas_siswa' => 'XIE',
            ]
        );
    }
}
