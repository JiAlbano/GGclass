<?php

namespace App\Http\Controllers;
use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Challenge;
use App\Models\StudentChallengeScore;

class StudentchallengesController extends Controller
{
    public function show($classId)
    {
        $user = Auth::user(); /// Fetch all users
        // $class = Classroom::findOrFail($classId); // Fetch the class
        $challenges = Challenge::where('class_id', $classId)
        ->join('classes', 'challenges.class_id', '=', 'classes.id')
        ->select('challenges.id as challenge_id', 'challenges.*', 'classes.*')
        ->get();

        $totalScores = StudentChallengeScore::join('challenges', 'student_challenge_scores.challenge_id', '=', 'challenges.id')
        ->where('student_challenge_scores.student_id', $user->id)
        ->where('challenges.class_id', $classId) // Use the class_id from the challenges table
        ->pluck('student_challenge_scores.total_score');

    // Sum scores for the class
    $sumOfScores = $totalScores->sum();

    // Retrieve the number of items for the class
    $numberOfItems = StudentChallengeScore::join('challenges', 'student_challenge_scores.challenge_id', '=', 'challenges.id')
        ->where('student_challenge_scores.student_id', $user->id)
        ->where('challenges.class_id', $classId)
        ->sum('student_challenge_scores.number_of_items');

        $class = Classroom::findOrFail($classId);
        return view('challenges-student', compact('challenges', 'user', 'class', 'totalScores', 'sumOfScores', 'numberOfItems')); // Pass both variables to the view
    }
}
