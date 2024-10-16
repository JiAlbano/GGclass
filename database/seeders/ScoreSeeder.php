<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreSeeder extends Seeder
{
    public function run()
    {
        // Seed scores for various students and assessment types
        DB::table('scores')->insert([
            // Jan Raphael's Scores
            [
                'student_id' => '202010501',
                'assessment_type_id' =>1, // Prelim
                'score' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010501',
                'assessment_type_id' =>2, // Midterm
                'score' => 51,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010501',
                'assessment_type_id' => 3, // PreFinal
                'score' => 52,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '202010501',
                'assessment_type_id' => 4, // FinalExam
                'score' => 53,
                'created_at' => now(),
                'updated_at' => now(),
                
            ],

            [
                'student_id' => '202010501',
                'assessment_type_id' => 5, // Quiz 1
                'score' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '202010501',
                'assessment_type_id' => 6, // Quiz 2
                'score' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
            [
                'student_id' => '202010501',
                'assessment_type_id' => 7, // Activity 1
                'score' => 21,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010501',
                'assessment_type_id' => 8, // Activity 2
                'score' => 22,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010501',
                'assessment_type_id' => 9, // Project 1
                'score' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010501',
                'assessment_type_id' => 10, // Project 2
                'score' => 95,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010501',
                'assessment_type_id' => 11, // Term Paper 1
                'score' => 98,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010501',
                'assessment_type_id' => 12, // Term Paper 2
                'score' => 99,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // John Irvin
            [
                'student_id' => '202010502',
                'assessment_type_id' =>1, // Prelim
                'score' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010502',
                'assessment_type_id' =>2, // Midterm
                'score' => 51,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010502',
                'assessment_type_id' => 3, // PreFinal
                'score' => 52,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '202010502',
                'assessment_type_id' => 4, // FinalExam
                'score' => 53,
                'created_at' => now(),
                'updated_at' => now(),
                
            ],

            [
                'student_id' => '202010502',
                'assessment_type_id' => 5, // Quiz 1
                'score' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '202010502',
                'assessment_type_id' => 6, // Quiz 2
                'score' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
            [
                'student_id' => '202010502',
                'assessment_type_id' => 7, // Activity 1
                'score' => 21,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010502',
                'assessment_type_id' => 8, // Activity 2
                'score' => 22,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010502',
                'assessment_type_id' => 9, // Project 1
                'score' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010502',
                'assessment_type_id' => 10, // Project 2
                'score' => 95,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010502',
                'assessment_type_id' => 11, // Term Paper 1
                'score' => 98,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010502',
                'assessment_type_id' => 12, // Term Paper 2
                'score' => 99,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // John Ignacious Albano
            
            [
                'student_id' => '202010503',
                'assessment_type_id' =>1, // Prelim
                'score' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010503',
                'assessment_type_id' =>2, // Midterm
                'score' => 51,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010503',
                'assessment_type_id' => 3, // PreFinal
                'score' => 52,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '202010503',
                'assessment_type_id' => 4, // FinalExam
                'score' => 53,
                'created_at' => now(),
                'updated_at' => now(),
                
            ],

            [
                'student_id' => '202010503',
                'assessment_type_id' => 5, // Quiz 1
                'score' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '202010503',
                'assessment_type_id' => 6, // Quiz 2
                'score' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
            [
                'student_id' => '202010503',
                'assessment_type_id' => 7, // Activity 1
                'score' => 21,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010503',
                'assessment_type_id' => 8, // Activity 2
                'score' => 22,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010503',
                'assessment_type_id' => 9, // Project 1
                'score' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010503',
                'assessment_type_id' => 10, // Project 2
                'score' => 95,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010503',
                'assessment_type_id' => 11, // Term Paper 1
                'score' => 98,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010503',
                'assessment_type_id' => 12, // Term Paper 2
                'score' => 99,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Angel Santos

            [
                'student_id' => '202010504',
                'assessment_type_id' =>1, // Prelim
                'score' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010504',
                'assessment_type_id' =>2, // Midterm
                'score' => 51,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010504',
                'assessment_type_id' => 3, // PreFinal
                'score' => 52,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '202010504',
                'assessment_type_id' => 4, // FinalExam
                'score' => 53,
                'created_at' => now(),
                'updated_at' => now(),
                
            ],

            [
                'student_id' => '202010504',
                'assessment_type_id' => 5, // Quiz 1
                'score' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '202010504',
                'assessment_type_id' => 6, // Quiz 2
                'score' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
            [
                'student_id' => '202010504',
                'assessment_type_id' => 7, // Activity 1
                'score' => 21,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010504',
                'assessment_type_id' => 8, // Activity 2
                'score' => 22,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010504',
                'assessment_type_id' => 9, // Project 1
                'score' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010504',
                'assessment_type_id' => 10, // Project 2
                'score' => 95,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010504',
                'assessment_type_id' => 11, // Term Paper 1
                'score' => 98,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'student_id' => '202010504',
                'assessment_type_id' => 12, // Term Paper 2
                'score' => 99,
                'created_at' => now(),
                'updated_at' => now(),
            ],

           // Brandon Yu

           [
            'student_id' => '202010505',
            'assessment_type_id' =>1, // Prelim
            'score' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010505',
            'assessment_type_id' =>2, // Midterm
            'score' => 51,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010505',
            'assessment_type_id' => 3, // PreFinal
            'score' => 52,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'student_id' => '202010505',
            'assessment_type_id' => 4, // FinalExam
            'score' => 53,
            'created_at' => now(),
            'updated_at' => now(),
            
        ],

        [
            'student_id' => '202010505',
            'assessment_type_id' => 5, // Quiz 1
            'score' => 9,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'student_id' => '202010505',
            'assessment_type_id' => 6, // Quiz 2
            'score' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ],
      
        [
            'student_id' => '202010505',
            'assessment_type_id' => 7, // Activity 1
            'score' => 21,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010505',
            'assessment_type_id' => 8, // Activity 2
            'score' => 22,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010505',
            'assessment_type_id' => 9, // Project 1
            'score' => 90,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010505',
            'assessment_type_id' => 10, // Project 2
            'score' => 95,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010505',
            'assessment_type_id' => 11, // Term Paper 1
            'score' => 98,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010505',
            'assessment_type_id' => 12, // Term Paper 2
            'score' => 99,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // Catherine Penelope

        [
            'student_id' => '202010506',
            'assessment_type_id' =>1, // Prelim
            'score' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010506',
            'assessment_type_id' =>2, // Midterm
            'score' => 51,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010506',
            'assessment_type_id' => 3, // PreFinal
            'score' => 52,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'student_id' => '202010506',
            'assessment_type_id' => 4, // FinalExam
            'score' => 53,
            'created_at' => now(),
            'updated_at' => now(),
            
        ],

        [
            'student_id' => '202010506',
            'assessment_type_id' => 5, // Quiz 1
            'score' => 9,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'student_id' => '202010506',
            'assessment_type_id' => 6, // Quiz 2
            'score' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ],
      
        [
            'student_id' => '202010506',
            'assessment_type_id' => 7, // Activity 1
            'score' => 21,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010506',
            'assessment_type_id' => 8, // Activity 2
            'score' => 22,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010506',
            'assessment_type_id' => 9, // Project 1
            'score' => 90,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010506',
            'assessment_type_id' => 10, // Project 2
            'score' => 95,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010506',
            'assessment_type_id' => 11, // Term Paper 1
            'score' => 98,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010506',
            'assessment_type_id' => 12, // Term Paper 2
            'score' => 99,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // Christian Rafael
        [
            'student_id' => '202010507',
            'assessment_type_id' =>1, // Prelim
            'score' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010507',
            'assessment_type_id' =>2, // Midterm
            'score' => 51,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010507',
            'assessment_type_id' => 3, // PreFinal
            'score' => 52,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'student_id' => '202010507',
            'assessment_type_id' => 4, // FinalExam
            'score' => 53,
            'created_at' => now(),
            'updated_at' => now(),
            
        ],

        [
            'student_id' => '202010507',
            'assessment_type_id' => 5, // Quiz 1
            'score' => 9,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'student_id' => '202010507',
            'assessment_type_id' => 6, // Quiz 2
            'score' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ],
      
        [
            'student_id' => '202010507',
            'assessment_type_id' => 7, // Activity 1
            'score' => 21,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010507',
            'assessment_type_id' => 8, // Activity 2
            'score' => 22,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010507',
            'assessment_type_id' => 9, // Project 1
            'score' => 90,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010507',
            'assessment_type_id' => 10, // Project 2
            'score' => 95,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010507',
            'assessment_type_id' => 11, // Term Paper 1
            'score' => 98,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010507',
            'assessment_type_id' => 12, // Term Paper 2
            'score' => 99,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        // Steffany Hanzel
        [
            'student_id' => '202010508',
            'assessment_type_id' =>1, // Prelim
            'score' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010508',
            'assessment_type_id' =>2, // Midterm
            'score' => 51,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010508',
            'assessment_type_id' => 3, // PreFinal
            'score' => 52,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'student_id' => '202010508',
            'assessment_type_id' => 4, // FinalExam
            'score' => 53,
            'created_at' => now(),
            'updated_at' => now(),
            
        ],

        [
            'student_id' => '202010508',
            'assessment_type_id' => 5, // Quiz 1
            'score' => 9,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'student_id' => '202010508',
            'assessment_type_id' => 6, // Quiz 2
            'score' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ],
      
        [
            'student_id' => '202010508',
            'assessment_type_id' => 7, // Activity 1
            'score' => 21,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010508',
            'assessment_type_id' => 8, // Activity 2
            'score' => 22,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010508',
            'assessment_type_id' => 9, // Project 1
            'score' => 90,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010508',
            'assessment_type_id' => 10, // Project 2
            'score' => 95,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010508',
            'assessment_type_id' => 11, // Term Paper 1
            'score' => 98,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'student_id' => '202010508',
            'assessment_type_id' => 12, // Term Paper 2
            'score' => 99,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        ]);
    }
}
