<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Challenge;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentQuestionAnswers;
use App\Models\StudentChallengeScore;

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
            'challengeType' => 'required|in:exam,test_and_quizzes,activity,term paper,project',
        ]);

        $challenge = new Challenge();
        $challenge->title = $request->input('challengeType'); // Use the type as the title
        $challenge->class_id = $classId;
        $challenge->type = $request->input('challengeType');
        $challenge->user_id = Auth::id(); // or another method to get the user_id
        $challenge->save();

        return redirect()->route('challenges', ['classId' => $classId]);
    }

    public function recordScore(Request $request) {
        $answers = $request->input('answer');
        $studentScore = $request->input('studentScore');
        $modifiedAnswerData = array_map(function($answer) {
            $answer['student_id'] = Auth::id();  // Add student_id to each answer
            $answer['created_at'] = Date('Y-m-d H:i:s');
            return $answer;
        }, $answers);
        $studentScore[0]['student_id'] = Auth::id();
        $studentScore[0]['created_at'] = Date('Y-m-d H:i:s');
        $token_count = $request->input('token_count');
        try {
            StudentQuestionAnswers::insert($modifiedAnswerData);
            StudentChallengeScore::insert($studentScore);
            $user = User::find(Auth::id());
            $user->token_count = $token_count;
            $user->save();
            return 1;
        } catch(Exception $e) {
            return $e;
        }
    }
}
