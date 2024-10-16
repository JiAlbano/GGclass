<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentTypeSeeder extends Seeder
{
    public function run()
    {
        // Seed data for assessment types
        DB::table('assessment_types')->insert([

            [
                'assessment_type_name' => 'Prelim Exam',
                'total_scores' => '60',
                'assessment_id' => '202400001', // Links to 'Exams'
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'assessment_type_name' => 'Midterm Exam',
                'total_scores' => '60',
                'assessment_id' => '202400002', // Links to 'Exams'
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'assessment_type_name' => 'Prefinal Exam',
                'total_scores' => '60',
                'assessment_id' => '202400003', // Links to 'Exams'
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'assessment_type_name' => 'Final Exam',
                'total_scores' => '60',
                'assessment_id' => '202400004', // Links to 'Exams'
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'assessment_type_name' => 'Quiz 1',
                'total_scores' => '20',
                'assessment_id' => '202400005', // Links to 'Tests and Quizzes'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_type_name' => 'Quiz 2',
                'total_scores' => '20',
                'assessment_id' => '202400005', // Links to 'Tests and Quizzes'
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'assessment_type_name' => 'Activity 1',
                'total_scores' => '30',
                'assessment_id' => '202400006', // Links to 'Activity'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_type_name' => 'Activity 2',
                'total_scores' => '30',
                'assessment_id' => '202400006', // Links to 'Activity'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_type_name' => 'Project 1',
                'total_scores' => '100',
                'assessment_id' => '202400007', // Links to 'Project'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_type_name' => 'Project 2',
                'total_scores' => '100',
                'assessment_id' => '202400007', // Links to 'Project'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_type_name' => 'Term Paper 1',
                'total_scores' => '100',
                'assessment_id' => '202400008', // Links to 'Term Paper'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_type_name' => 'Term Paper 2',
                'total_scores' => '100',
                'assessment_id' => '202400008', // Links to 'Term Paper'
                'created_at' => now(),
                'updated_at' => now(),
            ],

           
        ]);
    }
}
