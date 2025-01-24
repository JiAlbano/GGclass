<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'class_id'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Class
    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    // Relationship with BulletinFile
    public function files()
    {
        return $this->hasMany(BulletinFile::class);
    }

    // Relationship with TutorialLink
    // public function links()
    // {
    //     return $this->hasMany(TutorialLink::class);
    // }
}