<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Challenge;
use App\Models\StudentChallengeScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GradequizController extends Controller
{
    // Function to display the challenges page
    public function show($classId, $quizId)
    {
        // Fetch all users
        $user = Auth::user();

        // Fetch the class details
        $class = Classroom::findOrFail($classId);

        $grades = StudentChallengeScore::where('challenge_id', $quizId)
        ->where('challenge_type', 'quiz')
        ->join('users', 'users.id', '=', 'student_challenge_scores.student_id')
        ->select('student_challenge_scores.*', 'users.first_name', 'users.last_name')
        ->get();
        // Pass class, users, and challenges to the view
        return view('grade-quiz', compact('class', 'user', 'grades'));
    }


}
