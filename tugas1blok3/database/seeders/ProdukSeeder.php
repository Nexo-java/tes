<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produks')->insert([
            [
                'nama_produk' => 'High Grade Gquuuux 1/144',
                'deskripsi' => 'Model kit Gundam High Grade Gquuuux skala 1/144 dengan detail tinggi dan artikulasi yang baik.',
                'harga' => 13000,
                'stok' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'High Grade Gundam RX-78-2',
                'deskripsi' => 'Model kit Gundam High Grade RX-78-2 skala 1/144 dengan detail tinggi dan artikulasi yang baik.',
                'harga' => 20000,
                'stok' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Real Grade Gundam Exia',
                'deskripsi' => 'Model kit Gundam Real Grade Exia skala 1/144 dengan detail tinggi dan artikulasi yang baik.',
                'harga' => 30000,
                'stok' => 20,
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);
    }
}
