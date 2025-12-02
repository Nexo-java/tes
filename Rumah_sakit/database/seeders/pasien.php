<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class pasien extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pasiens')->insert([
            [
                'no_pasien' => 1001,
                'nama_pasien' => 'Andi',
                'jenis_kelamin' => 'laki-laki',
                'alamat' => 'Jl. Merdeka No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_pasien' => 1002,
                'nama_pasien' => 'Siti',
                'jenis_kelamin' => 'perempuan',
                'alamat' => 'Jl. Sudirman No. 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
