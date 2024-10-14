<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuestionAnswers extends Model
{

    use HasFactory;

    protected $fillable = [
        'challenge_id', 'question_id', 'answer', 'student_id', 'is_correct',
    ];
}
