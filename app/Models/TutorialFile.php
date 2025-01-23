<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorialFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutorial_id',
        'file_path',
        'file_type',
        'filename'
    ];

    // Relationship with Tutorial
    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }
}