<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Insert dummy accounts
        User::insert([
            [
                'first_name' => 'Carlos',
                'last_name' => 'Garcia',
              
                'email' => 'carlos.garcia@gbox.adnu.edu.ph',
                'password' => Hash::make('password123'),
                'google_id' => '1234567890',
                'google_access_token' => 'randomaccesstoken1234567890',
                'google_profile_image' => 'https://example.com/profile1.jpg',
                'user_type' => 'student',
                'id_number' => '202010501',
                'course_id' => 1,
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Albano',
        
                'email' => 'jialbano@gbox.adnu.edu.ph',
                'password' => Hash::make('password123'),
                'google_id' => '9876543210',
                'google_access_token' => 'randomaccesstoken9876543210',
                'google_profile_image' => 'https://example.com/profile2.jpg',
                'user_type' => 'teacher',
                'id_number' => '202010502',
                'course_id' => 2,
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
            
                'email' => 'john.doe@gbox.adnu.edu.ph',
                'password' => Hash::make('password123'),
                'google_id' => '1029384756',
                'google_access_token' => 'randomaccesstoken1029384756',
                'google_profile_image' => 'https://example.com/profile3.jpg',
                'user_type' => 'student',
                'id_number' => '202010503',
                'course_id' => 1,
            ],
        ]);
    }
}