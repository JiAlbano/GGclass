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
        $user = Auth::user();// Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class
        $quizzes = Quiz::where('class_id', $classId)->get();
        $studentChallengesTaken = StudentChallengeScore::where('student_id', Auth::id())
                ->distinct()  // Ensure distinct results
                ->pluck('challenge_id'); 
        return view('quiz-student', compact('class', 'user', 'quizzes', 'studentChallengesTaken')); // Pass both variables to the view
    }
}
