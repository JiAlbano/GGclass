<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\StudentChallengeScore;
use App\Models\User;
use App\Models\Tutorial; // Import the Tutorial model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudenttutorialsController extends Controller
{
  public function show($classId)
  {
      $user = Auth::user(); // Fetch the authenticated user
      $class = Classroom::findOrFail($classId); // Fetch the class

      // Get the total_score scores of the user
      $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

      // Calculate the sum of the total scores
      $sumOfScores = $totalScores->sum();

      // Retrieve the number of items
      $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

      // Fetch the tutorials for the class
      $tutorials = Tutorial::where('class_id', $classId)->get();

      // Pass the data to the view
      return view('tutorials-student', compact('class', 'user', 'numberOfItems', 'totalScores', 'sumOfScores', 'tutorials'));
  }

  public function display($classId, $tutorialId)
  {
    $user = Auth::user(); // Fetch the authenticated user
    $class = Classroom::findOrFail($classId); // Fetch the class
    $tutorial = Tutorial::findOrFail($tutorialId); // Fetch the specific tutorial

    // Pass the data to the view
    return view('tutorial-dashboard.display-student-tutorial', compact('class', 'user', 'tutorial'));
  }
}