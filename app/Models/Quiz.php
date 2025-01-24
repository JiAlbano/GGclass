<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes as Classroom;
class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'class_id',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function classroom()
{
    return $this->belongsTo(Classroom::class, 'class_id');
}
}
