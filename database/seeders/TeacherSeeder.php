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
                'id_number' => NULL,
                'course_id' => 0,
                'ign' => NULL,
                'user_type' => 'teacher',
                'department' => NULL,
                'google_profile_image' => NULL,
                'google_id' => NULL,
                'google_access_token' => NULL,
            ],
            [
                'email' => 'japeoro@gbox.adnu.edu.ph',
                'first_name' => 'Jan Raphael',
                'middle_initial' => 'D.',
                'last_name' => 'Peoro',
                'id_number' => NULL,
                'course_id' => 0,
                'ign' => NULL,
                'user_type' => 'teacher',
                'department' => NULL,
                'google_profile_image' => NULL,
                'google_id' => NULL,
                'google_access_token' => NULL,
            ],
            [
                'email' => 'kevega@gbox.adnu.edu.ph',
                'first_name' => 'Kevin',
                'middle_initial' => 'G.',
                'last_name' => 'Vega',
                'id_number' => NULL,
                'course_id' => 0,
                'ign' => 'kevzo8',
                'user_type' => 'teacher',
                'department' => NULL,
                




            ],
            
        ]);
    }
}
