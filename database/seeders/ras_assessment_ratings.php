<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ras_assessment_ratings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ras_ratings')->insert([
            [
                'scale_type' => 'Strongly Disagree',
                'scale' => '1',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'scale_type' => 'Disagree',
                'scale' => '2',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'scale_type' => 'Not Sure',
                'scale' => '3',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'scale_type' => 'Agree',
                'scale' => '4',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'scale_type' => 'Strongly',
                'scale' => '5',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ]
        ]);
    }
}
