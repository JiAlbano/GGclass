<?php

namespace App\Exports;

use App\Models\Classes as Classroom;
use App\Models\User;
use App\Models\Student;
use App\Models\Assessment;
use App\Models\AssessmentType;
use App\Models\ExamType;
use App\Models\Score;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use DB;

class StudentsExport
{
    public function export($classId)
    {
        $filePath = storage_path('app/public/adnugradebook.xlsx'); 
        $spreadsheet = IOFactory::load($filePath); 
        // Populate the first sheet
        $this->populateFirstSheet($classId, $spreadsheet);

        // Populate the second sheet
        $this->populateSecondSheet($classId,$spreadsheet);

        // // Populate the third sheet
        // $this->populateThirdSheet($spreadsheet);

        // Save the modified file to a temporary location
        $writer = new Xlsx($spreadsheet);
        $tempFilePath = storage_path('app/public/temporary_gradebook.xlsx');
        $writer->save($tempFilePath);

        // Return the file for download
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }

    private function populateFirstSheet($classId, $spreadsheet)
    {
        $sheet1 = $spreadsheet->getSheet(0); // First sheet

        $classUsers = DB::table('classes')
        ->join('class_user', 'classes.id', '=', 'class_user.class_id')
        ->join('users', 'class_user.user_id', '=', 'users.id')
        ->join('courses', 'users.course_id', '=', 'courses.id')
        ->where('classes.id', '=', $classId)
        ->select('users.first_name', 'users.last_name', 'users.ign','users.course_id','users.grading_system', 'users.id_number','courses.course_name') // Select specific user fields
        ->get();


        $assessments = Assessment::take(6)->get();

        // Populate student details (B22 to E121)
        $startRow = 22;
        foreach ($classUsers as $index => $student) {
            $row = $startRow + $index;

            $sheet1->setCellValue("B{$row}", $student->id_number);      // Student ID
            $sheet1->setCellValue("C{$row}", $student->first_name . ' ' . $student->last_name);      // Full Name
            $sheet1->setCellValue("D{$row}", $student->course_name);         // Course
            $sheet1->setCellValue("E{$row}", $student->grading_system); // Grading System
        }

        // Populate assessments (G10-G15 for names, H10-H15 for percentages)
        foreach ($assessments as $index => $assessment) {
            $row = 10 + $index;
            $sheet1->setCellValue("G{$row}", $assessment->assessment_name);
            $sheet1->setCellValue("H{$row}", $assessment->assessment_percentage . '%');
        }
    }

    private function populateSecondSheet($classId, $spreadsheet)
    {
        $sheet2 = $spreadsheet->getSheet(1); // Second sheet

        $classUsers = DB::table('classes')
        ->join('class_user', 'classes.id', '=', 'class_user.class_id')
        ->join('users', 'class_user.user_id', '=', 'users.id')
        ->join('courses', 'users.course_id', '=', 'courses.id')
        ->where('classes.id', '=', $classId)
        ->select('users.first_name', 'users.last_name', 'users.ign','users.course_id','users.grading_system', 'users.id_number','courses.course_name') // Select specific user fields
        ->get();

        $assessments = Assessment::with('assessmentTypes')->get();
        $startColumnIndex = 7; // Column G

        foreach ($assessments as $assessment) {
            foreach ($assessment->assessmentTypes as $type) {
                $column = Coordinate::stringFromColumnIndex($startColumnIndex);

                // Set assessment name in row 2
                $sheet2->setCellValue("{$column}2", $assessment->assessment_name);

                // Set total scores in row 3
                $sheet2->setCellValue("{$column}3", (int) $type->total_scores);

                // Populate student scores (rows 4-103)
                foreach ($classUsers as $rowIndex => $student) {
                    $score = Score::where('student_id', $student->id_number)
                                  ->where('assessment_type_id', $type->assessment_type_id)
                                  ->first();
                    $sheet2->setCellValue("{$column}" . (4 + $rowIndex), $score->score ?? 0);
                }

                $startColumnIndex++;
            }
        }
    }

    private function populateThirdSheet($spreadsheet)
    {
        $sheet3 = $spreadsheet->getSheet(2); // Third sheet
        $assessments = Assessment::all();

        $startColumnIndex = 5; // Column E
        foreach ($assessments as $index => $assessment) {
            $column = Coordinate::stringFromColumnIndex($startColumnIndex + $index * 3);
            $sheet3->setCellValue("{$column}2", $assessment->assessment_name);
        }
    }
}
