<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin user',
                'email' => 'admin_user@gmail.com',
                'type_user' => 'admin',
                'status' => 'active',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'Third party user',
                'email' => 'third_party_user@gmail.com',
                'type_user' => 'third-party',
                'status' => 'active',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'Regular user',
                'email' => 'regular_user@gmail.com',
                'type_user' => 'regular',
                'status' => 'active',
                'password' => bcrypt('12345678')
            ]
        ]);
    }
}
