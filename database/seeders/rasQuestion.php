<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rasQuestion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ras_questions')->insert([
            [
                'question' => 'I have a desire to succeed.',
                'subscale' => '3',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'I have my own plan for how to stay or become well.',
                'subscale' => '3',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'I have goals in life that I want to reach.',
                'subscale' => '3',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'I believe I can meet my current personal goals.',
                'subscale' => '3',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'I have a purpose in life.',
                'subscale' => '3',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => "Even when I don't care about myself, other people do.",
                'subscale' => '4',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => "Fear doesn't stop me from living the way I want to.",
                'subscale' => '1',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => " I can handle what happens in my life.",
                'subscale' => '1',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],

            [
                'question' => 'I like myself.',
                'subscale' => '1',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'If people really knew me, they would like me.',
                'subscale' => '1',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'I have an idea of who I want to become.',
                'subscale' => '1',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'Something good will eventually happen.',
                'subscale' => '1',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => "I'm hopeful about my future.",
                'subscale' => '1',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'I continue to have new interests.',
                'subscale' => '1',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'Coping with my mental illness is no longer the main focus of my life.',
                'subscale' => '5',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'My symptoms interfere less and less with my life.',
                'subscale' => '5',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'My symptoms seem to be a problem for shorter periods of time each time they occur.',
                'subscale' => '5',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'I know when to ask for help.',
                'subscale' => '2',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'I am willing to ask for help.',
                'subscale' => '2',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'I ask for help when I need it.',
                'subscale' => '2',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],

            [
                'question' => 'I can handle stress.',
                'subscale' => '1',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'I have people I can count on.',
                'subscale' => '4',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => "Even when I don't believe in myself, other people do.",
                'subscale' => '4',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],
            [
                'question' => 'It is important to have a variety of friends.',
                'subscale' => '4',
                'created_at' => date('Y-m-d,H:i:s'),
                'updated_at' => date('Y-m-d,H:i:s')
            ],

        ]);
    }
}
