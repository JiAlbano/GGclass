<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'attendance';

    // Allow mass assignment for these fields (optional)
    protected $fillable = ['user_id', 'date', 'note', 'status'];
}
