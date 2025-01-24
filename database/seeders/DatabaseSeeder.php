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
            AssessmentTypeSeeder::class,
            DepartmentSeeder::class,
            TeacherSeeder::class,
            // Add more seeders as needed...
        ]);
        // Call the CourseSeeder first
        $this->call(CourseSeeder::class);

    }
}

