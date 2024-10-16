<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Assessment;
use App\Models\Score;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class StudentsExport
{
    public function export()
    {
        $filePath = storage_path('app/public/adnugradebook.xlsx'); // XLSX template
        $spreadsheet = IOFactory::load($filePath); // Load the XLSX file

        // Populate the first sheet
        $sheet1 = $spreadsheet->getSheet(0);
        $students = Student::all();
        $assessments = Assessment::all();
        $startRow = 22;

        foreach ($students as $index => $student) {
            $row = $startRow + $index;
            $sheet1->setCellValue("B{$row}", (int) $student->school_id);
            $sheet1->setCellValue("C{$row}", $student->full_name);
            $sheet1->setCellValue("D{$row}", $student->course);
            $gradingSystem = (int) ($assessments->first()->grading_system ?? 0);
            $sheet1->setCellValue("E{$row}", $gradingSystem);
        }

        // Populate the second sheet
        $sheet2 = $spreadsheet->getSheet(1);
        $assessments = Assessment::with('assessmentTypes')->get();
        $startColumnIndex = 3; // Column C

        foreach ($assessments as $assessment) {
            foreach ($assessment->assessmentTypes as $type) {
                $column = Coordinate::stringFromColumnIndex($startColumnIndex);

                // Set the assessment name in row 2
                $sheet2->setCellValue("{$column}2", $assessment->assessment_name);

                // Set total scores in row 3
                $sheet2->setCellValue("{$column}3", (int) $type->total_scores);

                // Populate student scores in rows 4-103
                foreach ($students as $rowIndex => $student) {
                    $score = Score::where('student_id', $student->school_id)
                                  ->where('assessment_type_id', $type->assessment_type_id)
                                  ->first();
                    $scoreValue = (int) ($score->score ?? 0);
                    $sheet2->setCellValue("{$column}" . (4 + $rowIndex), $scoreValue);
                }
                $startColumnIndex++;
            }
        }

        // Populate the third sheet with specific assessments
        $sheet3 = $spreadsheet->getSheet(2);
        $targetAssessmentIds = [202400005, 202400006, 202400007, 202400008];
        $filteredAssessments = Assessment::whereIn('assessment_id', $targetAssessmentIds)->get();

        // Start from column E (5th column)
        $startColumnIndex = 5;

        foreach ($filteredAssessments as $index => $assessment) {
            $column = Coordinate::stringFromColumnIndex($startColumnIndex + $index * 3);
            $sheet3->setCellValue("{$column}2", $assessment->assessment_name);
        }

        // Save the modified file to a temporary location using XLSX writer
        $writer = new Xlsx($spreadsheet);
        $tempFilePath = storage_path('app/public/temporary_gradebook.xlsx');
        $writer->save($tempFilePath);

        // Return the file for download
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }
}
