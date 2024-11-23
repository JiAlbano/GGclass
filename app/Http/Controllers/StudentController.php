<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Assessment;
use App\Models\AssessmentType;
use App\Models\Score;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
// Method to get all students and pass them to the view
public function index () {

  // Retrieve all students from the database
  $student_list = Student::orderBy('full_name')->get(); 


  // Pass the students data to the 'student-list' view
  return view('grade-book.student-list.student-list', compact('student_list'));
}

// Method to display individual student data
public function show($school_id)
{
  // Retrieve the student by their school_id
  $student_data = Student::where('school_id', $school_id)->firstOrFail(); 
  // firstOrFail() returns the first result, or throws an error if no result is found

  // Fetch the assessments from the database
  $test = Assessment::all();

  // Return the 'student-data' view and pass the student data to it
  return view('grade-book.student-data.student-data',  compact('student_data', 'test'));
}
      
public function assessment($school_id, $assessment_id)
{
    // Retrieve the student by their school_id
    $student_data = Student::where('school_id', $school_id)->firstOrFail();

    // Retrieve the assessment name by its assessment_id
    $assessment = Assessment::where('assessment_id', $assessment_id)->firstOrFail();

    // Retrieve all the assessment types that belong to the selected assessment
    $assessment_types = AssessmentType::where('assessment_id', $assessment_id)->get();

    // Retrieve the student's scores for those assessment types
    $scores = Score::where('student_id', $school_id)
    ->whereIn('assessment_type_id', $assessment_types->pluck('assessment_type_id'))
    ->get()
    ->keyBy('assessment_type_id'); // Key by 'assessment_type_id' to match with assessment types

    // Return the student-assessment view, passing student data, assessment name, assessment types, and scores
    return view('grade-book.student-assessment.student-assessment', compact('student_data', 'assessment', 'assessment_types', 'scores'));
}

// Method to export the Excel template file
public function export()
    {
      $studentsExport = new StudentsExport();
        return $studentsExport->export();
    }

}
