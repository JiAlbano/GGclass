<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample assessments
        DB::table('assessments')->insert([
            [
                'assessment_id' => 'test101',
                'assessment_name' => 'Tests and Quizzes', 
                'grading_system' => 2018, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_id' => 'test102',
                'assessment_name' => 'Activity', 
                'grading_system' => 2018, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_id' => 'test103',
                'assessment_name' => 'Project', 
                'grading_system' => 2018, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_id' => 'test104',
                'assessment_name' => 'Term Paper', 
                'grading_system' => 2018, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
