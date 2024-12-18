<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    // Specify the table name if it does not follow Laravel's default naming convention
  
    protected $table = 'classes';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'id',
        'school_year',
        'semester',
        'subject',
        'section',
        'schedule_day',
        'start_time',
        'end_time',
        'room',
        'teacher_id',
        'class_code',
    ];
        // Relationship: Class belongs to a teacher (User)
        public function teacher()
        {
            return $this->belongsTo(User::class, 'teacher_id'); // 'teacher_id' is the foreign key
        }
    }

