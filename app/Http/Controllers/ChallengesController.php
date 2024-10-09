<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ChallengesController extends Controller
{
    // Function to display the challenges page
    public function index($classId)
    {
        // Fetch all users
        $user = Auth::user();

        // Fetch the class details
        $class = Classroom::findOrFail($classId);

        // Fetch challenges related to the class
        $challenges = Challenge::where('class_id', $classId)->get();

        // Pass class, users, and challenges to the view
        return view('challenges', compact('class', 'user', 'challenges'));
    }

    // Function to handle adding new challenges (optional)
    public function create(Request $request, $classId)
    {
        $request->validate([
            'challengeType' => 'required|in:exam,test_and_quizzes,activity',
        ]);

        $challenge = new Challenge();
        $challenge->title = $request->input('challengeType'); // Use the type as the title
        $challenge->class_id = $classId;
        $challenge->type = $request->input('challengeType');
        $challenge->user_id = Auth::id(); // or another method to get the user_id
        $challenge->save();

        return redirect()->route('challenges', ['classId' => $classId]);
    }
}
