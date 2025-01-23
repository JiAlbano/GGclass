<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentChallengeScore;
use App\Models\Quiz;
use App\Models\Exam;

class GradeController extends Controller
{
    // Function to display the challenges page
    public function show($classId)
    {
        // Fetch the logged-in user
        $user = Auth::user();

        // Fetch the class details
        $class = Classroom::findOrFail($classId);

        // Get the total_score scores of the user
        $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

        // Calculate the sum of the total scores
        $sumOfScores = $totalScores->sum();

        // Retrieve the number of items
        $numberOfItems = StudentChallengeScore::where('student_id', $user->id)->sum('number_of_items');

           // Fetch quiz scores specific to the class
        $quizData = Quiz::join('student_challenge_scores', 'quizzes.id', '=', 'student_challenge_scores.challenge_id')
            ->where('quizzes.class_id', $classId)
            ->where('student_challenge_scores.student_id', $user->id)
            ->where('student_challenge_scores.challenge_type', 'quiz')
            ->select(
                'quizzes.title',
                'student_challenge_scores.total_score',
                'student_challenge_scores.number_of_items'
            )
            ->get();

        // Fetch exam scores specific to the class
        $examData = Exam::join('student_challenge_scores', 'exams.id', '=', 'student_challenge_scores.challenge_id')
            ->where('exams.class_id', $classId)
            ->where('student_challenge_scores.student_id', $user->id)
            ->where('student_challenge_scores.challenge_type', 'exam')
            ->select(
                'exams.exam_type',
                'student_challenge_scores.total_score',
                'student_challenge_scores.number_of_items'
            )
            ->get();

        // Pass data to the view
        return view('grade-quiz-student', compact('class', 'user', 'totalScores', 'sumOfScores', 'numberOfItems', 'quizData', 'examData'));
    }

}
