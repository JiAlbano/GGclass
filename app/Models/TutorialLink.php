<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorialLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutorial_id',
        'url'
    ];

    // Relationship with Tutorial
    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }
}