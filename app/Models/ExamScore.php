<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ExamScore extends Model
{
    use HasFactory;

    protected $primaryKey = 'score_id';

    protected $fillable = [
        'student_id', 'exam_id', 'score', 'token_used', 'total_score'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'school_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
