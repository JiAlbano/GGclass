<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentChallengeScore;

class StudentprofilestudentController extends Controller
{
    // badge progress
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

        // Pass the data to the view
        return view('profile-student', compact('class', 'user', 'totalScores', 'sumOfScores', 'numberOfItems'));
    }

    // navbar function
    public function getNavbarData($classId)
    {
        $user = Auth::user(); // Fetch the authenticated user
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

        // Return data (structured similarly to 'show')
        return [
            'class' => $class,
            'user' => $user,
            'totalScores' => $totalScores,
            'sumOfScores' => $sumOfScores,
            'numberOfItems' => $numberOfItems,
        ];
    }
}

