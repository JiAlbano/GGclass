<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\ExamScores;
use App\Models\Assessment;
use App\Models\AssessmentType;
use App\Models\Score;
use App\Exports\StudentsExport;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

  public function show($classId)
  {
      // Fetch the authenticated user
      $user = Auth::user();

      // Manually join classes, class_user, and users tables
      $classUsers = DB::table('classes')
          ->join('class_user', 'classes.id', '=', 'class_user.class_id')
          ->join('users', 'class_user.user_id', '=', 'users.id')
          ->where('classes.id', '=', $classId)
          ->select('users.first_name', 'users.last_name', 'users.ign','users.course_id','users.grading_system') // Select specific user fields
          ->get();

      // Fetch the class details
      $class = Classroom::findOrFail($classId);

      // Pass class, users, and challenges to the view
      return view('grade-book.student-list.student-list', compact('class', 'user', 'classUsers'));
  }

  // public function index()
  // {
  //     // Retrieve all students and sort them by full_name in ascending order
  //     $student_list = Student::orderBy('full_name')->get();
  //     $user = Auth::user();   
  //     // Convert each student's full_name to uppercase
  //     $student_list->transform(function ($student) {
  //         $student->full_name = strtoupper($student->full_name);
  //         return $student;
  //     });

  //     return view('grade-book.student-list.student-list', compact('student_list', 'user'));
  // }



  public function showschool($id)
{
    // Retrieve the student by ID
    $student = Student::findOrFail($id);
    $user = Auth::user();
    // Convert the full_name to uppercase
    $student->full_name = strtoupper($student->full_name);

    $assessments = Assessment::all();
    $exams = Exam::all();

    // Pass data to the 'student-assessment' view
    return view('grade-book.student-data.student-assessment', compact('student', 'assessments', 'exams', 'user'));
}

public function viewAssessmentScores($student_id, $assessment_id)
{
    // Retrieve the student's details using the student ID
    $student = Student::findOrFail($student_id);

    // Convert the full_name to uppercase
    $student->full_name = strtoupper($student->full_name);

    // Retrieve all assessment types for the selected assessment
    $assessmentTypes = AssessmentType::where('assessment_id', $assessment_id)->get();

    // Retrieve the scores for the selected student and assessment types
    $scores = Score::where('student_id', $student_id)
                    ->whereIn('assessment_type_id', $assessmentTypes->pluck('assessment_type_id'))
                    ->get();

    // Pass the data to the Blade view
    return view('grade-book.student-assessment.student-score', compact('student', 'scores', 'assessmentTypes'));
}

// Method to view a student's exam scores
public function viewExamScores($student_id, $exam_id)
{
        $student = Student::findOrFail($student_id);
        $student->full_name = strtoupper($student->full_name);

        // Fetch exam types associated with the exam
        $examTypes = ExamType::where('exams_id', $exam_id)->get();

        // Fetch scores for the selected student and exam types
        $examScores = ExamScores::where('student_id', $student_id)
                                ->whereIn('exams_type_id', $examTypes->pluck('exams_type_id'))
                                ->get();

        return view('grade-book.student-assessment.student-score', compact('student', 'examTypes', 'examScores'));
}


public function export()
    {
      $studentsExport = new StudentsExport();
        return $studentsExport->export();
    }


// // Method to display individual student data
// public function show($student_data)
// {
//   // Retrieve the student by their student_data
//   $student_data = Student::where('student_data', $student_data)->firstOrFail(); 
//   // firstOrFail() returns the first result, or throws an error if no result is found

//   // Fetch the assessments from the database
//   $test = Assessment::all();

//   // Return the 'student-data' view and pass the student data to it
//   return view('grade-book.student-data.student-data',  compact('student_data', 'test'));
// }
      
// public function assessment($student_data, $assessment_id)
// {
//     // Retrieve the student by their student_data
//     $student_data = Student::where('student_data', $student_data)->firstOrFail();

//     // Retrieve the assessment name by its assessment_id
//     $assessment = Assessment::where('assessment_id', $assessment_id)->firstOrFail();

//     // Retrieve all the assessment types that belong to the selected assessment
//     $assessment_types = AssessmentType::where('assessment_id', $assessment_id)->get();

//     // Retrieve the student's scores for those assessment types
//     $scores = Score::where('student_id', $student_data)
//     ->whereIn('assessment_type_id', $assessment_types->pluck('assessment_type_id'))
//     ->get()
//     ->keyBy('assessment_type_id'); // Key by 'assessment_type_id' to match with assessment types

//     // Return the student-assessment view, passing student data, assessment name, assessment types, and scores
//     return view('grade-book.student-assessment.student-assessment', compact('student_data', 'assessment', 'assessment_types', 'scores'));
// }

// Method to export the Excel template file
}