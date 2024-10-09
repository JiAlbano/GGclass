<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Classes as Classroom;
class User extends Authenticatable
{

    use HasFactory, Notifiable;
    public function classes()
    {
        return $this->belongsToMany(Classroom::class, 'class_user', 'user_id', 'class_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'password',
        'google_id',
        'google_access_token', // Add this line
        'google_profile_image', // Added this
        'user_type',
        'id_number',
        'birthday',
        'course_id',
    ];


}
