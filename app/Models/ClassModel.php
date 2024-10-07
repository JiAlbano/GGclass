<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ClassModel extends Model
{
    use HasFactory;

    // Specify the table name if it does not follow Laravel's default naming convention
    protected $table = 'classes';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'id',
        'class_name',
        'section',
        'subject',
        'room',
        'schedule',
        'teacher_id' => $user->user_type,
        'class_code',
        'image_path' // Added image_path to mass assignable attributes
    ];
}
