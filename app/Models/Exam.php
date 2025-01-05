<?php

// 1. First, create a new Exam model
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Classes as Classroom;
    
class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'class_id', 'type', 'enable_token', 'time_duration'
    ];

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function scores()
    {
        return $this->hasMany(ExamScore::class);
    }
}
