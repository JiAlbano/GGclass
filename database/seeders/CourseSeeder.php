<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Course::insert([
        ['course_name' => 'BS CS'],
        ['course_name' => 'BS IT'],
        ['course_name' => 'BS IS'],
        ]);
    }
}
