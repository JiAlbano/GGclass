<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Quiz; // Assuming you have a Quiz model
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;

class QuizController extends Controller
{
    // Display view for the quiz dashboard
    public function show($classId)
    {
        // Fetch all users
        $users = User::all();

        // Fetch the class details
        $class = Classroom::findOrFail($classId);

        // Fetch quizzes related to the class
        $quizzes = Quiz::where('class_id', $classId)->get();

        // Pass class, users, and quizzes to the view
        return view('quiz', compact('class', 'users', 'quizzes'));
    }

    // Function to handle adding new quizzes
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'class_id' => 'required|exists:classes,id',
            'questions' => 'required|array',
        ]);

        // Create a new quiz
        $quiz = Quiz::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'class_id' => $validated['class_id'],
        ]);

        // Store questions
        foreach ($validated['questions'] as $question) {
            $quiz->questions()->create($question);
        }

        // Redirect to the show route (which is a GET request)
        return redirect()->route('quiz.show', ['classId' => $validated['class_id'], 'quizId' => $quiz->id])
                         ->with('success', 'Quiz created successfully!');
    }
    public function displayQuiz($classId, $quizId)
    {
        // Fetch the specific quiz by ID
        $quiz = Quiz::where('id', $quizId)->where('class_id', $classId)->firstOrFail();

        // Fetch all users
        $users = User::all();

        // Optionally, fetch related data like questions
        $questions = $quiz->questions;

        // Fetch the class details
        $class = Classroom::findOrFail($classId);

        // Pass the quiz, class, questions, and users to the view
        return view('quiz-title', compact('class', 'quiz', 'questions', 'users'));
    }
    public function update(Request $request, $quizId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $quiz = Quiz::findOrFail($quizId);
        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['success' => true]);
    }

public function showQuiz($classId, $quizId)
{
    // Fetch the specific quiz by ID
    $quiz = Quiz::findOrFail($quizId);

    $questions = Question::where('quiz_id', $quizId)->get(); // Fetch the questions related to the quiz


    // Fetch the class details
    $class = Classroom::findOrFail($classId);

    // Pass the quiz, class, and questions to the view
    return view('take-quiz', compact('class', 'quiz', 'questions'));
}

}

