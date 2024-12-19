<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('users')->insert([
            
            [
                'email' => 'jialbano@gbox.adnu.edu.ph',
                'first_name' => 'John Ignacious',
                'middle_initial' => 'G.',
                'last_name' => 'Albano',
                'user_type' => 'teacher',
                'department' => NULL,
                'id_number' => NULL,
            ],
            [
                'email' => 'japeoro@gbox.adnu.edu.ph',
                'first_name' => 'Jan rapheal',
                'middle_initial' => 'D.',
                'last_name' => 'Peoro',
                'user_type' => 'teacher',
                'department' => NULL,
                'id_number' => NULL,
            ],

            [
                'email' => 'kevega@gbox.adnu.edu.ph',
                'first_name' => 'Kevin',
                'middle_initial' => 'G.',
                'last_name' => 'Vega',
                'google_profile_image' => 'https://lh3.googleusercontent.com/a/ACg8ocJvI4HPss-jFH8gie1sWwEP4PzKS0wX6M-JHtnIsd67xCezlMw=s96-c',
                'ign' => 'kevzo8',
                'google_id' => '103491175805889251811',
                'google_access_token' => 'ya29.a0ARW5m75q2xtKfjFd9xdesTj6N7Z9OkWePVMCUIn4506GCBH67TqjeXX5wbanxtC1qSl6_hpgCukHoyh7bLEp3tmDEPwkyJq4APwEmrJuBJoX5PdAYez10lC6CKLVt72_7UUQHIaU_OkYWQh4SW8ZQGcyf2Y8aX7xaP8aCgYKASISARESFQHGX2Mif671Z68JHFjL67vb-065XQ0170',
                'user_type' => 'teacher',
                'department' => NULL,
                'id_number' => NULL,
            ]
        ]);
    }
}
