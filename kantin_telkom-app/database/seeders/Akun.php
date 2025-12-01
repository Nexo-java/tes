<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Akun extends Seeder
{
    public function run(): void
    {
        // Tambahkan data pengguna admin terlebih dahulu
        DB::table('tb_penggunas')->insert([
            'nis' => 0000000000,
            'nama_siswa' => 'Admin Kantin',
            'telp_siswa' => '08123456789',
            'email_siswa' => 'admin@gmail.com',
            'jurusan_siswa' => 'Administrator',
            'kelas_siswa' => '-',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Setelah itu baru buat akun admin
        DB::table('tb_akuns')->insert([
            'username' => 'admin',
            'password' => 'admin123',
            'role' => 'admin',
            'nis' => 0000000000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
