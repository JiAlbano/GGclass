<?php

namespace App\Http\Controllers;
use App\Models\Assessment;
use App\Models\AssessmentType;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        // Retrieve all assessments from the database
        $assessments = Assessment::all(); // Get all assessments

        // Return the 'student-data' view and pass the assessments to it
        return view('grade-book.student-data.student-data', compact('assessments'));
    }

    public function showAssessmentsByType($type)
    {
        // Fetch the assessments by the clicked type (e.g., quiz, activity, etc.)
        $assessments = AssessmentType::where('assessment_id', $type)->get();

        // Return the student-assessment view and pass the fetched assessments to it
        return view('grade-book.student-assessment.student-assessment', compact('assessments'));
    }
}
