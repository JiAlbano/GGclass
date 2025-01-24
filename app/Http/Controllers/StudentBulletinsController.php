<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\User;
use App\Models\Bulletin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentChallengeScore;

class StudentBulletinsController extends Controller
{
    public function show($classId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class

        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

         // Fetch all bulletins for the class
         $bulletins = Bulletin::where('class_id', $classId)->get();

        return view('studentbulletins', compact('class', 'user', 'numberOfItems', 'totalScores', 'sumOfScores' , 'bulletins' )); // Pass both variables to the view
    }
    public function display($classId, $bulletinId)
    {
        $user = Auth::user(); // Fetch the authenticated user
        $class = Classroom::findOrFail($classId); // Fetch the class
        $bulletin = Bulletin::findOrFail($bulletinId); // Fetch the specific bulletin
    
        // Pass the data to the view
        return view('bulletin-dashboard.display-student-bulletin', compact('class', 'user', 'bulletin'));
    }


}
