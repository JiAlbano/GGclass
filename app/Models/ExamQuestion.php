<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id', 'question', 'type', 'options', 'answer_key', 'correct_answer', 'image'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
