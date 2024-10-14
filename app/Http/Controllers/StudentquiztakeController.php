<?php

namespace App\Http\Controllers;
use App\Models\Classes as Classroom;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentquiztakeController extends Controller
{
    public function show($classId, $quizId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::find($classId); // Fetch the class
        $questions = Question::where('quiz_id', $quizId)->get();
        $quiz = Quiz::find($quizId);

        return view('quiz-take-student', compact('class', 'user', 'questions', 'quiz')); // Pass both variables to the view
    }
}
