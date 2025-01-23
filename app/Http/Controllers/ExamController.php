<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Exam;
use App\Models\StudentChallengeScore;
use App\Models\ExamQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($classId)
    {
        $user = Auth::user();
        $class = Classroom::findOrFail($classId);
        $exams = Exam::where('class_id', $classId)->get();
        return view('exam', compact('class', 'user', 'exams'));
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'class_id' => 'required|exists:classes,id',
            'exam_type' => 'in:prelim,midterm,prefinal,final', // Validate exam type
            'questions' => 'required|array', // Ensure the questions are provided
        ]);
    
        // Create the exam
        $exam = Exam::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'class_id' => $validated['class_id'],
            'exam_type' => $validated['exam_type'], // Use validated exam_type here
            'enable_token' => false,
            'time_duration' => 0,
        ]);
    
        // Loop through the questions provided and store them in the database
        $index = 1;
        foreach ($validated['questions'] as $question) {
            $createdQuestion = $exam->questions()->create([
                'exam_id' => $exam->id,
                'type' => $question['type'],
                'question' => $question['question'],
                'correct_answer' => $question['correct_answer'] ?? null,
                'options' => $question['options'] ?? null
            ]);
    
            // Handle file upload for images in the questions
            if ($request->hasFile("questions.$index.uploadFile")) {
                $file = $request->file("questions.$index.uploadFile");
                $filePath = $file->store('exam-files', 'public');
                $createdQuestion->image = $filePath;
                $createdQuestion->save();
            }
            $index++;
        }
    
        return redirect()->route('exam.show', [
            'classId' => $validated['class_id'],
            'examId' => $exam->id
        ])->with('success', 'Exam created successfully!');
    }
    

    public function displayExam($classId, $examId)
    {
        $exam = Exam::where('id', $examId)
                    ->where('class_id', $classId)
                    ->firstOrFail();
        $user = Auth::user();
        $questions = $exam->questions;
        $class = Classroom::findOrFail($classId);

        return view('exam-titles', compact('class', 'exam', 'questions', 'user'));
    }

    public function update(Request $request, $examId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $exam = Exam::findOrFail($examId);
        $exam->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['success' => true]);
    }

    public function showExam($classId, $examId)
    {
        $user = Auth::user();
        $exam = Exam::findOrFail($examId);
        $questions = $exam->questions;
        $class = Classroom::findOrFail($classId);
        

        return view('exam-take', compact('class', 'exam', 'questions','user'));
    }

    public function updateQuestion(Request $request, $classId, $examId)
    {
        $questionId = $request->input('id');
        $question = ExamQuestion::find($questionId);

        $question->question = $request->input('question');

        if ($question->type === 'multipleChoice') {
            $question->options = $request->input('options');
        }

        if ($question->type === 'trueFalse') {
            $correctAnswer = $request->input('correct_answer');
            if (in_array($correctAnswer, ['True', 'False'])) {
                $question->correct_answer = $correctAnswer;
            } else {
                return response()->json(['error' => 'Invalid answer for True/False question'], 400);
            }
        }

        if ($question->type === 'identification') {
            $question->correct_answer = $request->input('correct_answer');
        }

        $question->save();

        return response()->json([
            'success' => true,
            'updatedQuestion' => $question->question,
            'updatedAnswer' => $question->correct_answer ?? '',
            'options' => $question->options ?? ''
        ]);
    }

    public function editToken(Request $request)
    {
        $examId = $request->input('examid');
        $enableToken = $request->input('tokenStatus');
        $exam = Exam::findOrFail($examId);
        $exam->enable_token = $enableToken;
        return $exam->save();
    }

    public function editTimer(Request $request)
    {
        $timer = $request->input('timer');
        $examId = $request->input('examid');
        $exam = Exam::findOrFail($examId);
        $exam->time_duration = $timer;
        return $exam->save();
    }

    public function editScore(Request $request)
    {
        $id = $request->input('id');
        $newScore = $request->input('newScore');

        $score = StudentChallengeScore::find($id);
        $score->total_score = $newScore;
        return $score->save() ? 1 : 0;
    }

    public function studentexam($classId)
    {
        $challengetype = 'exam';
        $user = Auth::user();// Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class
        $quizzes = Exam::where('class_id', $classId)->get();
        $studentChallengesTaken = StudentChallengeScore::where('student_id', Auth::id())
                ->where('challenge_type', $challengetype)
                ->distinct()  // Ensure distinct results
                ->pluck('challenge_id'); 
        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items (assuming it's stored in StudentChallengeScore model)
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

        return view('quiz-student', compact('class', 'user', 'quizzes', 'studentChallengesTaken', 'totalScores', 'sumOfScores', 'numberOfItems','challengetype' )); // Pass both variables to the view
    }

    public function showtitleexam($classId, $examId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class
        $quiz = Exam::findOrFail($examId);
        $challengetype = 'exam';
        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items (assuming it's stored in StudentChallengeScore model)
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

        return view('quiz-title-student', compact('class', 'user', 'quiz', 'totalScores', 'sumOfScores', 'numberOfItems', 'challengetype')); // Pass both variables to the view
    }

    public function showtakeexam($classId, $examId)
    {
        $challengetype = 'exam';
        $user = Auth::user(); // Fetch all users
        $class = Classroom::find($classId); // Fetch the class
        $questions = ExamQuestion::where('exam_id', $examId)->get();
        $taken = StudentChallengeScore::where('challenge_id', $examId)->where('student_id', $user->id)->where('challenge_type', $challengetype)->count();
        $quiz = Exam::find($examId);

        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');
        $challengetype = 'exam';
        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items (assuming it's stored in StudentChallengeScore model)
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

        return view('quiz-take-student', compact('class', 'user', 'questions', 'quiz', 'taken', 'totalScores', 'sumOfScores', 'numberOfItems', 'challengetype')); // Pass both variables to the view
    }

}


