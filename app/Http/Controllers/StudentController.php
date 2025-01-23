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
use App\Models\StudentChallengeScore;
use App\Models\Quiz;
use App\Models\Challenge;


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
          ->select('users.first_name', 'users.last_name', 'users.ign','users.course_id','users.grading_system', 'users.id_number') // Select specific user fields
          ->get();

      // Fetch the class details
      $class = Classroom::findOrFail($classId);

      // Pass class, users, and challenges to the view
      return view('grade-book.student-list.student-list', compact('class', 'user', 'classUsers'));
  }

  public function showschools($classId, $id_number)
{
 // Fetch the authenticated user
 $user = Auth::user();

 // Manually join classes, class_user, and users tables
//  $classUsers = DB::table('classes')
//      ->join('class_user', 'classes.id', '=', 'class_user.class_id')
//      ->join('users', 'class_user.user_id', '=', 'users.id')
//      ->where('classes.id', '=', $classId)
//      ->select('users.first_name', 'users.last_name', 'users.ign','users.course_id','users.grading_system') // Select specific user fields
//      ->get();
      $student = User::join('courses', 'courses.id','=','users.course_id')
                      ->where('id_number', $id_number)
                      ->select('users.first_name','users.last_name', 'users.ign','courses.course_name','users.grading_system', 'users.id_number','users.email', 'users.id')
                      ->get();


      // Get the total_score scores of the user
      $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

      // Calculate the sum of the total scores
      $sumOfScores = $totalScores->sum();

      // Retrieve the number of items
      $numberOfItems = StudentChallengeScore::where('student_id', $student[0]->id)->sum('number_of_items');

      // Retrieve quiz titles, total_score, and number_of_items only for quizzes
      $quizData = Quiz::join('student_challenge_scores', 'quizzes.id', '=', 'student_challenge_scores.challenge_id')
                      ->where('student_challenge_scores.student_id', $student[0]->id)
                      ->where('student_challenge_scores.challenge_type', 'quiz')  // Filter by challenge_type 'quiz'
                      ->select('quizzes.title')
                      ->get();
       $challengetype = Challenge::where('user_id',$user->id) 
                                  ->where('class_id', $classId) 
                                  ->get();          

      // Retrieve exam types and their scores only for exams
      $examData = StudentChallengeScore::where('student_id', $student[0]->id)
                                        ->where('challenge_type', 'exam')  // Filter by challenge_type 'exam'
                                        ->select('exam_type', 'total_score', 'number_of_items')
                                        ->get();
 // Fetch the class details
 $class = Classroom::findOrFail($classId);

    // Pass data to the 'student-assessment' view
    return view('grade-book.student-data.student-assessment', compact('class','challengetype','student' ,'user','totalScores', 'sumOfScores', 'numberOfItems', 'quizData', 'examData'));
}


//   public function showschool($id)
// {
//     // Retrieve the student by ID
//     $student = Student::findOrFail($id);
//     $user = Auth::user();
//     // Convert the full_name to uppercase
//     $student->full_name = strtoupper($student->full_name);

//     $assessments = Assessment::all();
//     $exams = Exam::all();

//     // Pass data to the 'student-assessment' view
//     return view('grade-book.student-data.student-assessment', compact('student', 'assessments', 'exams', 'user'));
// }

public function viewAssessmentScores($student_id, $challengetype_id)
{
              // Fetch the authenticated user
            $user = Auth::user();

            $student = User::join('courses', 'courses.id','=','users.course_id')->get();
            // ->where('users.id', $student_id)
            // ->select('users.first_name','users.last_name', 'users.ign','courses.course_name','users.grading_system', 'users.id_number','users.email', 'users.id')

    // Get the total_score scores of the user
    $totalScores = StudentChallengeScore::where('student_id', $user->id)->pluck('total_score');

    // Calculate the sum of the total scores
    $sumOfScores = $totalScores->sum();

    // Retrieve the number of items
    $numberOfItems = StudentChallengeScore::where('student_id', $student[0]->id)->sum('number_of_items');

    // Retrieve quiz titles, total_score, and number_of_items only for quizzes
    $quizData = Quiz::join('student_challenge_scores', 'quizzes.id', '=', 'student_challenge_scores.challenge_id')
                    ->where('student_challenge_scores.student_id', $student[0]->id)
                    ->where('student_challenge_scores.challenge_type', 'quiz')  // Filter by challenge_type 'quiz'
                    ->select('quizzes.title', 'student_challenge_scores.total_score', 'student_challenge_scores.number_of_items')
                    ->get();


    return view('grade-book.student-assessment.student-score',compact('user','student','quizData','totalScores', 'sumOfScores', 'numberOfItems'));
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