<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('userslogin')->insert([
            [
                'uname' => 'Ahmadullah',
                'password' =>Hash::make('Ahmad123') ,
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'uname' => 'Admin',
                'password' => Hash::make('Admin123'),
                'role'  => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            [
                'uname' => 'Bapak Tono',
                'password' => 'Tono123',
                'role'  => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

             ]);
    }
}
