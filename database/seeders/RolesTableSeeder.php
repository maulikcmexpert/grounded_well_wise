<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
            'created_at' => date('Y-m-d,H:i:s'),
            'updated_at' => date('Y-m-d,H:i:s')
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Administrative staff',
            'role_slug' => 'administrative_staff',
            'created_at' => date('Y-m-d,H:i:s'),
            'updated_at' => date('Y-m-d,H:i:s')
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Therapist',
            'role_slug' => 'therapist',
            'created_at' => date('Y-m-d,H:i:s'),
            'updated_at' => date('Y-m-d,H:i:s')
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Referring Dr',
            'role_slug' => 'referring_dr',
            'created_at' => date('Y-m-d,H:i:s'),
            'updated_at' => date('Y-m-d,H:i:s')
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Patient',
            'role_slug' => 'patient',
            'created_at' => date('Y-m-d,H:i:s'),
            'updated_at' => date('Y-m-d,H:i:s')
        ]);
    }
}
