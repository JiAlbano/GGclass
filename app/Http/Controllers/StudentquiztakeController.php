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
        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items (assuming it's stored in StudentChallengeScore model)
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

        return view('quiz-take-student', compact('class', 'user', 'questions', 'quiz', 'taken', 'totalScores', 'sumOfScores', 'numberOfItems', 'challengetype')); // Pass both variables to the view
    }
}
