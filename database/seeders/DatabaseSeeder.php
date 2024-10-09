<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CourseSeeder; // Import the CourseSeeder\
use Database\Seeders\StudentSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StudentSeeder::class,
            AssessmentSeeder::class,
            AssessmentTypeSeeder::class
        ]);
        // Call the CourseSeeder first
        $this->call(CourseSeeder::class);

        // Create a male user
        User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'id_number' => '123456',
            'birthday' => '2000-01-01',
            'gender' => 'male', // Male user
            'user_type' => 'student',
        ]);

        // Create a female user
        User::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'id_number' => '654321',
            'birthday' => '1995-05-15',
            'gender' => 'female', // Female user
            'user_type' => 'student',
        ]);
    }
}

