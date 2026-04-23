<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'NovaTech',
                'username' => 'novatech',
                'email' => 'novatech@gmail.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Vinicius',
                'username' => 'vini',
                'email' => 'vini@gmail.com',
                'role' => 'user',
                'status' => 'inactive',
                'password' => bcrypt('12345678'),
            ]
        ]);
    }
}
