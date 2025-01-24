<?php

namespace App\Http\Controllers;
use App\Models\Classes as Classroom;
use App\Models\StudentChallengeScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;


class StudentquizController extends Controller
{
    public function show($classId)
    {
        $challengetype = 'quiz';
        $user = Auth::user();// Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class
        $quizzes = Quiz::where('class_id', $classId)->get();
        $studentChallengesTaken = StudentChallengeScore::where('student_id', Auth::id())
                ->where('challenge_type', $challengetype)
                ->distinct()  // Ensure distinct results
                ->pluck('challenge_id'); 
                                    $totalScores = StudentChallengeScore::join('challenges', 'student_challenge_scores.challenge_id', '=', 'challenges.id')
                                    ->where('student_challenge_scores.student_id', $user->id)
                                    ->where('challenges.class_id', $classId) // Use the class_id from the challenges table
                                    ->pluck('student_challenge_scores.total_score');
                        
                                // Sum scores for the class
                                $sumOfScores = $totalScores->sum();
                        
                                // Retrieve the number of items for the class
                                $numberOfItems = StudentChallengeScore::join('challenges', 'student_challenge_scores.challenge_id', '=', 'challenges.id')
                                    ->where('student_challenge_scores.student_id', $user->id)
                                    ->where('challenges.class_id', $classId)
                                    ->sum('student_challenge_scores.number_of_items');

        return view('quiz-student', compact('class', 'user', 'quizzes', 'studentChallengesTaken', 'totalScores', 'sumOfScores', 'numberOfItems','challengetype')); // Pass both variables to the view
    }
}
