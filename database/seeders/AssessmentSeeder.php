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
                'assessment_id' => '202400005',
                'assessment_name' => 'Test and Quizzes', 
                'assessment_percentage' => '40',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_id' => '202400006',
                'assessment_name' => 'Recitation', 
                'assessment_percentage' => '35',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_id' => '202400007',
                'assessment_name' => 'Project', 
                'assessment_percentage' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assessment_id' => '202400008',
                'assessment_name' => 'Term Paper', 
                'assessment_percentage' => '15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
