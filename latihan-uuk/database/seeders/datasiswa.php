<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class datasiswa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('datasiswas')->insert([
            [
                'nama_siswa' => 'Rina',
                'kelas_siswa' =>'11A',
                'jenis_kelamin' => 'perempuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
