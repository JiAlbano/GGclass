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

        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items (assuming it's stored in StudentChallengeScore model)
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

        // Pass the data to the view
        return view('profile-student', compact('class', 'user', 'totalScores', 'sumOfScores', 'numberOfItems'));
    }

    // navbar function
    public function getNavbarData($classId)
    {
        $user = Auth::user(); // Fetch the authenticated user
        $class = Classroom::findOrFail($classId); // Fetch the class

        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

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

