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

        // Fetch scores and calculate badge eligibility
        $totalScores = StudentChallengeScore::where('student_id', $user->id)
        ->where('class_id', $classId)
        ->pluck('total_score');
        $sumOfScores = $totalScores->sum();
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)
        ->where('class_id', $classId)
        ->sum('number_of_items');

        // Pass the data to the view
        return view('profile-student', compact('class', 'user', 'totalScores', 'sumOfScores', 'numberOfItems'));
    }

    // navbar function
    public function getNavbarData($classId)
    {
        $user = Auth::user(); // Fetch the authenticated user
        $class = Classroom::findOrFail($classId); // Fetch the class

        // Get the total_score scores of the user for a specific class
        $totalScores = StudentChallengeScore::where('student_id', $user->id)
        ->where('class_id', $classId) // Add the class context
        ->pluck('total_score');

        // Calculate the sum of the total scores for the class
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items for the class
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)
        ->where('class_id', $classId) // Add the class context
        ->sum('number_of_items');

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

