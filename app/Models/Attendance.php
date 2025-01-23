<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;


    // Allow mass assignment for these fields (optional)
    protected $fillable = ['user_id', 'date', 'note', 'status'];
}
