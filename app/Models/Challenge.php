<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'user_id', 'title', 'type'];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scores()
{
    return $this->hasMany(StudentChallengeScore::class, 'challenge_id');
}

}
