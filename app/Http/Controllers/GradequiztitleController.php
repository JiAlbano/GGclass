<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Challenge;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GradequiztitleController extends Controller
{
    // Function to display the challenges page
    public function show($classId)
    {
        // Fetch all users
        $user = Auth::user();

        // Fetch the class details
        $class = Classroom::findOrFail($classId);

    $quizzes = Quiz::where('class_id', $classId)->get();
        // Pass class, users, and challenges to the view
        return view('grade-quiz-title', compact('class', 'user', 'quizzes'));
    }


}
