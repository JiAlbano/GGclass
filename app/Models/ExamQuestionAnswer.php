<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id', 'question_id', 'answer', 'student_id', 'is_correct'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'school_id');
    }

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'question_id');
    }
}