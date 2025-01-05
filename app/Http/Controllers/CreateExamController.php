<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Exam;
use App\Models\ExamScore;
use App\Models\ExamQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateExamController extends Controller
{
    public function create($classId)
    {
        $user = Auth::user();
        $class = Classroom::findOrFail($classId);
        $exams = Exam::where('class_id', $classId)->get();
        return view('createexam', compact('class', 'user', 'exams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'class_id' => 'required|exists:classes,id',
            'questions' => 'required|array',
        ]);

        $exam = Exam::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'class_id' => $validated['class_id'],
            'type' => 'final',
            'enable_token' => false,
            'time_duration' => 0
        ]);

        $index = 1;
        foreach ($validated['questions'] as $question) {
            $createdQuestion = $exam->questions()->create([
                'exam_id' => $exam->id,
                'type' => $question['type'],
                'question' => $question['question'],
                'correct_answer' => $question['correct_answer'] ?? null,
                'options' => $question['options'] ?? null
            ]);

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

        return view('exam-title', compact('class', 'exam', 'questions', 'user'));
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
        $exam = Exam::findOrFail($examId);
        $questions = $exam->questions;
        $class = Classroom::findOrFail($classId);

        return view('exam-take', compact('class', 'exam', 'questions'));
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
        $examId = $request->input('examId');
        $enableToken = $request->input('tokenStatus');
        $exam = Exam::findOrFail($examId);
        $exam->enable_token = $enableToken;
        return $exam->save();
    }

    public function editTimer(Request $request)
    {
        $timer = $request->input('timer');
        $examId = $request->input('examId');
        $exam = Exam::findOrFail($examId);
        $exam->time_duration = $timer;
        return $exam->save();
    }

    public function editScore(Request $request)
    {
        $id = $request->input('id');
        $newScore = $request->input('newScore');

        $score = ExamScore::find($id);
        $score->total_score = $newScore;
        return $score->save() ? 1 : 0;
    }
}