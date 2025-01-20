<?php

namespace App\Http\Controllers;
use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentChallengeScore;


class StudentattendanceController extends Controller
{
    public function show($classId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class

        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items (assuming it's stored in StudentChallengeScore model)
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

        return view('attendance-student', compact('class', 'user', 'totalScores', 'sumOfScores', 'numberOfItems')); // Pass both variables to the view
    }
}
