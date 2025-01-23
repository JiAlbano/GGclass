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
        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items (assuming it's stored in StudentChallengeScore model)
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

        return view('quiz-student', compact('class', 'user', 'quizzes', 'studentChallengesTaken', 'totalScores', 'sumOfScores', 'numberOfItems','challengetype')); // Pass both variables to the view
    }
}
