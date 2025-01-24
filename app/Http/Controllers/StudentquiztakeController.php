<?php

namespace App\Http\Controllers;
use App\Models\Classes as Classroom;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\StudentChallengeScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentquiztakeController extends Controller
{
    public function show($classId, $quizId)
    {
        $challengetype = 'quiz';
        $user = Auth::user(); // Fetch all users
        $class = Classroom::find($classId); // Fetch the class
        $questions = Question::where('quiz_id', $quizId)->get();
        $taken = StudentChallengeScore::where('challenge_id', $quizId)->where('student_id', $user->id)->where('challenge_type', $challengetype)->count();
        $quiz = Quiz::find($quizId);
        $challengetype = 'quiz';

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

        return view('quiz-take-student', compact('class', 'user', 'questions', 'quiz', 'taken', 'totalScores', 'sumOfScores', 'numberOfItems', 'challengetype')); // Pass both variables to the view
    }
}
