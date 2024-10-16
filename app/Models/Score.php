<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $primaryKey = 'score_id';

    // A score belongs to a student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'school_id');
    }

    // A score belongs to an assessment type (e.g., "Score 50" belongs to "Quiz 1")
    public function assessmentType()
    {
        return $this->belongsTo(AssessmentType::class, 'assessment_type_id');
    }
}
