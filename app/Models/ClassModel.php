<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'image_path' // Added image_path to mass assignable attributes
    ];
}
