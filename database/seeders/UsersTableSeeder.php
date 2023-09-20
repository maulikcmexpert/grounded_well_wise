<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'first_name' => 'Admin',
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@123'),
        ]);
    }
}
