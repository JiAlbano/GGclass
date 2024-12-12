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
                'email' => 'mipanganiban@gbox.adnu.edu.ph',
                'first_name' => 'Mia',
                'middle_initial' => 'E.',
                'last_name' => 'Panganiban',
                'user_type' => 'teacher',
                'department' => NULL,
                'id_number' => NULL,
  
            ],
            
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



        ]);
    }
}
