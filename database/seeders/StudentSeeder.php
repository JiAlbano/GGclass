<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('students')->insertOrIgnore([
            [
                'student_id' => '202010501',                     
                'full_name' => 'Jan Raphael Peoro',       
                'in_game_name' => 'Ainz',               
                'email' => 'japeoro@gbox.adnu.edu.ph',     
                'course' => 'BS IT',  
                'grading_system' => 2018, 

            ],
            [
                'student_id' => '202010502',
                'full_name' => 'John Irvin Panganiban',
                'in_game_name' => 'Jirvs',
                'email' => 'jirvs@gbox.adnu.edu.ph',
                'course' => 'BS IT',
                'grading_system' => 2018, 
            ],
            [
                'student_id' => '202010503',
                'full_name' => 'John Ignacious Albano',
                'in_game_name' => 'Beelzebub',
                'email' => 'jigs@gbox.adnu.edu.ph',
                'course' => 'BS IT',
                'grading_system' => 2018, 
            ],

            [
                'student_id' => '202010504',
                'full_name' => 'Angel Santos',
                'in_game_name' => 'Angel',
                'email' => 'angel@gbox.adnu.edu.ph',
                'course' => 'BS IS',
                'grading_system' => 2018, 
            ],

            [
                'student_id' => '202010505',
                'full_name' => 'Brandon Yu',
                'in_game_name' => 'Mr. Yu',
                'email' => 'yu@gbox.adnu.edu.ph',
                'course' => 'BS IS',
                'grading_system' => 2018, 
            ],

            [
                'student_id' => '202010506',
                'full_name' => 'Catherine Penelope',
                'in_game_name' => 'Pen',
                'email' => 'cath@gbox.adnu.edu.ph',
                'course' => 'BS IS',
                'grading_system' => 2018, 
            ],
            
            [
                'student_id' => '202010507',
                'full_name' => 'Christian Rafael',
                'in_game_name' => 'Tian',
                'email' => 'tian@gbox.adnu.edu.ph',
                'course' => 'BS IT',
                'grading_system' => 2018, 
            ],

            [
                'student_id' => '202010508',
                'full_name' => 'Steffany Hanzel',
                'in_game_name' => 'Stef',
                'email' => 'stef@gbox.adnu.edu.ph',
                'course' => 'BS IS',
                'grading_system' => 2018, 
            ],
        ]);
    }
}
