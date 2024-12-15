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
    protected $fillable = ['teacher_id','class_name', 'subject' , 'section' , 'schedule' , 'room' , 'class_code', 'image_path', ];

}
