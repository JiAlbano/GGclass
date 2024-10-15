<?php

namespace App\Http\Controllers;
use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Challenge;


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

        $class = Classroom::findOrFail($classId);
        return view('challenges-student', compact('challenges', 'user', 'class')); // Pass both variables to the view
    }
}
