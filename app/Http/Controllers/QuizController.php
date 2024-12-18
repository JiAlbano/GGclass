<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Quiz; // Assuming you have a Quiz model
use App\Models\StudentChallengeScore;
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
        $user = Auth::user();

        // Fetch the class details
        $class = Classroom::findOrFail($classId);

        // Fetch quizzes related to the class
        $quizzes = Quiz::where('class_id', $classId)->get();
        // Pass class, users, and quizzes to the view
        return view('test_and_quizzes', compact('class', 'user', 'quizzes'));
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
        $index = 1;
        foreach ($validated['questions'] as $question) {
            // Create the question in the quiz
            $createdQuiz = $quiz->questions()->create([
                'type' => $question['type'],
                'question' => $question['question'],
                'correct_answer' => $question['correct_answer'] ?? null, // Handle if 'correct_answer' is nullable
                'options'   => $question['options'] ?? null
            ]);
            if ($request->hasFile("questions.$index.uploadFile")) {
                $file = $request->file("questions.$index.uploadFile");
                // Store the uploaded file
                $filePath = $file->store('quiz-files', 'public');
                // Save the file path in the created question
                $createdQuiz->image = $filePath;
                $createdQuiz->save();
            }
            $index++;
        }

        // Redirect to the show route (which is a GET request)
        return redirect()->route('test_and_quizzes.show', [
            'classId' => $validated['class_id'],
            'quizId' => $quiz->id
        ])->with('success', 'Quiz created successfully!');
    }

    public function displayQuiz($classId, $quizId)
    {
        // Fetch the specific quiz by ID
        $quiz = Quiz::where('id', $quizId)->where('class_id', $classId)->firstOrFail();

        // Fetch all users
        $user = Auth::user();

        // Optionally, fetch related data like questions
        $questions = $quiz->questions;

        // Fetch the class details
        $class = Classroom::findOrFail($classId);

        // Pass the quiz, class, questions, and users to the view
        return view('quiz-title', compact('class', 'quiz', 'questions', 'user'));
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
  // Fetch all users
  $user = Auth::user();

    // Fetch the class details
    $class = Classroom::findOrFail($classId);

    // Pass the quiz, class, and questions to the view
    return view('take-quiz', compact('class', 'quiz', 'questions', 'user'));
}

public function updateQuestion(Request $request, $classId, $quizId)
{
    // Retrieve the question by ID
    $questionId = $request->input('id');
    $question = Question::find($questionId);

    // Update the question text
    $question->question = $request->input('question');

    // Check question type and update accordingly
    if ($question->type === 'multipleChoice') {
        // Store the options as an array, not a string
        $options = $request->input('options');

        // Assuming 'options' column in your database is of type JSON
        $question->options = $options;
    }

    if ($question->type === 'trueFalse') {
        // Get the correct answer from the request (should be 'true' or 'false')
        $correctAnswer = $request->input('correct_answer');

        // Ensure the value is either 'true' or 'false'
        if (in_array($correctAnswer, ['True', 'False'])) {
            $question->correct_answer = $correctAnswer;
        } else {
            return response()->json(['error' => 'Invalid answer for True/False question'], 400);
        }
    }

    if ($question->type === 'identification') {
        // Update correct answer for identification
        $question->correct_answer = $request->input('correct_answer');
    }

    // Save the updated question
    $question->save();

    // Return a success response with the updated question text
    return response()->json([
        'success' => true,
        'updatedQuestion' => $question->question,
        'updatedAnswer' => $question->correct_answer ?? '',
        'options' => $question->options ?? ''
    ]);
}

public function editToken(Request $request) {
    $quizId = $request->input('quizId');
    $enableToken = $request->input('tokenStatus');
    $quiz = Quiz::findOrFail($quizId);
    $quiz->enable_token = $enableToken;
    return $quiz->save();
}

public function editTimer(Request $request) {
    $timer = $request->input('timer');
    $quizId = $request->input('quizId');
    $quiz = Quiz::findOrFail($quizId);
    $quiz->time_duration = $timer;
    return $quiz->save();
}

public function editScore(Request $request) {
    $id = $request->input('id');
    $newScore = $request->input('newScore');


    $score = StudentChallengeScore::find($id);
    $score->total_score = $newScore;
    if($score->save())
        return 1;
    return 0;
}

}

