<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $primaryKey = 'assessment_id'; // Define the primary key
    public $incrementing = false; // Disable auto-increment since we're using custom IDs

    // An assessment has many assessment types (e.g., "Tests and Quizzes" has "Quiz 1", "Quiz 2")
    public function assessmentTypes()
    {
        return $this->hasMany(AssessmentType::class, 'assessment_id');
    }
}
