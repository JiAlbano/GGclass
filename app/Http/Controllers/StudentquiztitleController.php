<?php

namespace App\Http\Controllers;
use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;

class StudentquiztitleController extends Controller
{
    public function show($classId, $quizId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class
        $quiz = Quiz::findOrFail($quizId);
        return view('quiz-title-student', compact('class', 'user', 'quiz')); // Pass both variables to the view
    }
}
