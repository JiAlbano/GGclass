<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class QuiztitleController extends Controller
{
    // Display view for the quiz titles
    public function show($classId)
    {
        $class = Classroom::findOrFail($classId); // Fetch the associated class
        $users = User::all(); // Fetch all users
        $quizzes = Quiz::where('class_id', $classId)->get(); // Fetch quizzes for the class

        return view('quiz-title', compact('class', 'users', 'quizzes')); // Pass variables to the view
    }
}
