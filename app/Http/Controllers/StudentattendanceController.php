<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentChallengeScore;
use Carbon\Carbon;

class StudentattendanceController extends Controller
{
    public function show($classId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class

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

        // Fetch attendance data for the user and format the date
        $attendanceData = Attendance::where('user_id', $user->id)->get(['date', 'note', 'status'])->map(function ($attendance) {
            $attendance->date = Carbon::parse($attendance->date)->format('F d, Y'); // Format the date
            return $attendance;
        });

        // Fetch attendance data for the user YYYY/DD/MM format
        // $attendanceData = Attendance::where('user_id', $user->id)->get(['date', 'note', 'status']);

        return view('attendance-student', compact('class', 'user', 'totalScores', 'sumOfScores', 'numberOfItems', 'attendanceData')); // Pass both variables to the view
    }
}
