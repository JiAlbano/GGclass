<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentChallengeScore extends Model
{

    use HasFactory;

    protected $table = 'student_challenge_scores';
    protected $fillable = [
        'challenge_id', 'student_id', 'score', 'token_used', 'total_score',
    ];
}
