<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        DB::table('siswas')->insert([
            [
                'nama' => 'Andi',
                'kelas' => 10,
                'jurusan' => 'RPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Budi',
                'kelas' => 11,
                'jurusan' => 'TKJ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Citra',
                'kelas' => 12,
                'jurusan' => 'MM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
