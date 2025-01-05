<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Quiz;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\StudentChallengeScore;
use App\Models\Student;
use App\Models\ExamScore;
use App\Models\ExamQuestionAnswer;
use App\Models\StudentQuestionAnswers;

class MigrateQuizToExamData extends Migration
{
    public function up()
    {
        DB::beginTransaction();
    
        try {
            $quizzes = Quiz::with(['questions'])->get();
            Log::info('Migrating quizzes...');

            // Create a mapping of quiz questions to exam questions
            $questionMapping = [];

            foreach ($quizzes as $quiz) {
                Log::info('Migrating quiz: ' . $quiz->id);

                // Create a new exam from quiz
                $exam = Exam::create([
                    'title' => $quiz->title,
                    'description' => $quiz->description,
                    'class_id' => $quiz->class_id,
                    'enable_token' => $quiz->enable_token,
                    'time_duration' => $quiz->time_duration,
                    'type' => 'final'
                ]);
                Log::info('Created exam: ' . $exam->id);

                // 2. Migrate Questions and store mapping
                foreach ($quiz->questions as $question) {
                    Log::info('Migrating question: ' . $question->id);

                    $examQuestion = ExamQuestion::create([
                        'exam_id' => $exam->id,
                        'question' => $question->question,
                        'type' => $question->type,
                        'options' => $question->options,
                        'correct_answer' => $question->correct_answer,
                        'image' => $question->image
                    ]);

                    // Store mapping of old question ID to new question ID
                    $questionMapping[$quiz->id][$question->id] = $examQuestion->id;
                }

                // 3. Migrate Scores
                $scores = StudentChallengeScore::where('challenge_id', $quiz->id)->get();
                Log::info('Migrating ' . $scores->count() . ' scores for quiz ' . $quiz->id);

                foreach ($scores as $score) {
                    // Check if student exists first
                    $student = Student::find($score->student_id);
                    
                    if (!$student) {
                        // Create the student with the correct fields
                        $student = new Student();
                        $student->school_id = $score->student_id;
                        $student->full_name = 'Migrated Student ' . $score->student_id;
                        $student->in_game_name = 'Player' . $score->student_id;
                        $student->email = 'migrated.student.' . $score->student_id . '@example.com';
                        $student->course = 'Default Course';
                        $student->save();
                        
                        Log::info('Created new student with school_id: ' . $score->student_id);
                    }

                    // Create exam score
                    try {
                        // Update challenge_type from 'quiz' to 'exam'
                        DB::table('student_challenge_scores')
                        ->where('challenge_id', $quiz->id)
                        ->update([
                            'challenge_type' => 'exam',
                            'exam_type' => $exam->type, // Use the new exam's type
                        ]);

                        // Migrate Student Answers and Update Challenge Type
                        foreach ($quiz->questions as $question) {
                            $studentAnswers = StudentQuestionAnswers::where('question_id', $question->id)->get();
                        
                            foreach ($studentAnswers as $answer) {
                                // Map old question ID to new exam question ID
                                $newQuestionId = $questionMapping[$quiz->id][$question->id] ?? null;
                        
                                if (!$newQuestionId) {
                                    Log::warning('No mapping found for question ID: ' . $question->id);
                                    continue;
                                }
                        
                                // Update the existing student_question_answers table
                                DB::table('student_question_answers')
                                ->where('id', $answer->id)
                                ->update([
                                    'question_id' => $newQuestionId, // Correct the mapping here
                                    'challenge_type' => 'exam',     // Update the challenge type
                                    'exam_type' => $exam->type,     // Set the exam type
                                ]);
                                Log::info('Updated student answer for question: ' . $question->id . ' to exam question: ' . $newQuestionId);
                            }
                        }
                        
                        // After processing all answers for this quiz, update `student_challenge_scores`
                        DB::table('student_challenge_scores')
                            ->where('challenge_id', $quiz->id)
                            ->update([
                                'challenge_type' => 'exam',
                                'exam_type' => $exam->type, // Use the new exam's type
                            ]);
                        
                        Log::info('Successfully updated challenge_type from quiz to exam');
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        Log::error('Failed to update challenge_type: ' . $e->getMessage());
                        throw $e;
                    }
                }
                
            }            
    
            DB::commit();
            Log::info('Migration completed successfully!');
            echo "Migration completed successfully!\n";
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Migration failed: ' . $e->getMessage());
            echo "Migration failed: " . $e->getMessage() . "\n";
        }
    }


    public function down()
    {
        DB::beginTransaction();
    
        try {
            // Remove all migrated exams (where type = 'final')
            $exams = Exam::where('type', 'final')->get();
    
            foreach ($exams as $exam) {
                ExamQuestion::where('exam_id', $exam->id)->delete();
                ExamScore::where('exam_id', $exam->id)->delete();
                ExamQuestionAnswer::where('exam_id', $exam->id)->delete();  // Removing answers as well
                $exam->delete();
            }
    
            DB::commit();
            Log::info('Rollback completed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Rollback failed: ' . $e->getMessage());
        }
    }
}
