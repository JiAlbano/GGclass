<?php

namespace App\Http\Controllers;
use App\Models\Challenge;
use App\Models\Classes as Classroom;
use App\Models\Quiz;
use App\Models\StudentChallengeScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentgradeController extends Controller
{
    public function show($classId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class
        $challenges = Challenge::where('class_id', $classId)->get();

        return view('grade-student', compact('class', 'user', 'challenges')); // Pass both variables to the view
    }

    public function showQuiz($classId)
    {
        // $user = Auth::user(); // Fetch all users
        // $class = Classroom::findOrFail($classId); // Fetch the class

        // return view('grade-student', compact('class', 'user')); // Pass both variables to the view
        $user = Auth::user();// Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class
        $quizzes = Quiz::where('class_id', $classId)->get();
        $studentChallengesTaken = StudentChallengeScore::where('student_id', Auth::id())
        ->where('challenge_type', 'quiz')
        ->distinct('challenge_id')  // Ensure distinct challenge_id
        ->select('challenge_id', 'total_score', 'number_of_items') // Select the necessary columns
        ->get();
        return view('grade-quiz-title-student', compact('class', 'user', 'quizzes', 'studentChallengesTaken'));
    
    }
}