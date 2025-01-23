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
    // Relationship: Class has many players (Users) via ClassUser pivot table
    public function players()
    {
        return $this->belongsToMany(User::class, 'class_user', 'class_id', 'user_id')
            ->withPivot('role', 'joined_at') // Example pivot fields
            ->withTimestamps();
    }

    // Relationship: Class has many students
    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_student', 'class_id', 'student_id')
            ->withTimestamps();
    }

    // Relationship: Class has many assessments
    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'class_id');
    }

}
    

