<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('assessment_types')->insert([
            // Assessments for Tests and Quizzes
            ['assessment_id' => 'test101', 'assessment_type_name' => 'Quiz 1', 'total_score' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test101', 'assessment_type_name' => 'Quiz 2', 'total_score' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test101', 'assessment_type_name' => 'Quiz 3', 'total_score' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test101', 'assessment_type_name' => 'Quiz 4', 'total_score' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test101', 'assessment_type_name' => 'Quiz 5', 'total_score' => 50, 'created_at' => now(), 'updated_at' => now()],

            // Assessments for Activities
            ['assessment_id' => 'test102', 'assessment_type_name' => 'Activity 1', 'total_score' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test102', 'assessment_type_name' => 'Activity 2', 'total_score' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test102', 'assessment_type_name' => 'Activity 3', 'total_score' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test102', 'assessment_type_name' => 'Activity 4', 'total_score' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test102', 'assessment_type_name' => 'Activity 5', 'total_score' => 30, 'created_at' => now(), 'updated_at' => now()],
          
            // Assessments for Projects
            ['assessment_id' => 'test103', 'assessment_type_name' => 'Project 1', 'total_score' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test103', 'assessment_type_name' => 'Project 2', 'total_score' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test103', 'assessment_type_name' => 'Project 3', 'total_score' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test103', 'assessment_type_name' => 'Project 4', 'total_score' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test103', 'assessment_type_name' => 'Project 5', 'total_score' => 100, 'created_at' => now(), 'updated_at' => now()],

            // Assessments for Term Papers
            ['assessment_id' => 'test104', 'assessment_type_name' => 'Term Paper 1', 'total_score' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test104', 'assessment_type_name' => 'Term Paper 2', 'total_score' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test104', 'assessment_type_name' => 'Term Paper 3', 'total_score' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test104', 'assessment_type_name' => 'Term Paper 4', 'total_score' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['assessment_id' => 'test104', 'assessment_type_name' => 'Term Paper 5', 'total_score' => 100, 'created_at' => now(), 'updated_at' => now()],
      
        ]);
    }
}
