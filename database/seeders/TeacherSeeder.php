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
                'first_name' => 'Mia E. Panganiban',
                'last_name' => "",
                'user_type' => 'teacher',
                'id_number' => NULL,
            ],
            [
                'email' => 'jipanganiban@gbox.adnu.edu.ph',
                'first_name' => 'John Irvin E. Panganiban',
                'last_name' => "",
                'user_type' => 'teacher',
                'id_number' => NULL,
            ],

        ]);
    }
}
