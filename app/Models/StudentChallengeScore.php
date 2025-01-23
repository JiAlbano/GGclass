<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentChallengeScore extends Model
{
    use HasFactory;

    protected $table = 'student_challenge_scores';

    protected $fillable = [
        'challenge_id', 
        'student_id', 
        'score', 
        'token_used', 
        'total_score',
        'challenge_type', 
        'number_of_items', 
        'exam_type', // Ensure this column exists
    ];
    public function challenge()
{
    return $this->belongsTo(Challenge::class);
}

public function student()
{
    return $this->belongsTo(User::class, 'student_id');
}

}
