<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentChallengeScore;
use App\Models\Quiz;

class GradeController extends Controller
{
    // Function to display the challenges page
    public function show($classId)
    {
        // Fetch the logged-in user
        $user = Auth::user();

        // Fetch the class details
        $class = Classroom::findOrFail($classId);

        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

        // Retrieve quiz titles, total_score, and number_of_items only for quizzes
        $quizData = Quiz::join('student_challenge_scores', 'quizzes.id', '=', 'student_challenge_scores.challenge_id')
                        ->where('student_challenge_scores.student_id', $user->id)
                        ->where('student_challenge_scores.challenge_type', 'quiz')  // Filter by challenge_type 'quiz'
                        ->select('quizzes.title', 'student_challenge_scores.total_score', 'student_challenge_scores.number_of_items')
                        ->get();

        // Retrieve exam types and their scores only for exams
        $examData = StudentChallengeScore::where('student_id', $user->id)
                                          ->where('challenge_type', 'exam')  // Filter by challenge_type 'exam'
                                          ->select('exam_type', 'total_score', 'number_of_items')
                                          ->get();

        // Pass data to the view
        return view('Grade-quiz-student', compact('class', 'user', 'totalScores', 'sumOfScores', 'numberOfItems', 'quizData', 'examData'));
    }
}
