<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentType extends Model
{
    use HasFactory;

    protected $primaryKey = 'assessment_type_id';

    // An assessment type belongs to an assessment (e.g., "Quiz 1" belongs to "Tests and Quizzes")
    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    // An assessment type has many scores from different students
    public function scores()
    {
        return $this->hasMany(Score::class, 'assessment_type_id');
    }
}
