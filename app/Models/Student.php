<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'school_id'; // school_id is the primary key

    // A student has many scores for different assessment types
    public function scores()
    {
        return $this->hasMany(Score::class, 'student_id', 'school_id');
    }
}
