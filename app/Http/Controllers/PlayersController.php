<?php

namespace App\Http\Controllers;
use App\Models\Classes as Classroom;
use App\Models\ClassUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayersController extends Controller
{
    public function show($classId)
    {
        $class = Classroom::join('users', 'users.id', 'classes.teacher_id')
            ->where('classes.id', $classId)
            ->select(
                'classes.id as class_id', 
                'users.ign', 
                'users.google_profile_image', 
                'classes.school_year', 
                'classes.semester', 
                'classes.section', 
                'classes.class_code', 
                'classes.subject', 
                'classes.schedule_day', 
                'classes.start_time', 
                'classes.end_time', 
                'classes.room'
            )
            ->first(); // Retrieve only the first class (assuming one class per classId)

        // Get the authenticated user
        $user = Auth::user();

        // Get the players and their scores, and sum the total_score and number_of_items for each user
        $class_player = ClassUser::join('users', 'users.id', 'class_user.user_id')
            ->where('class_user.class_id', $classId)
            ->select(
                'users.id as user_id', 
                'users.ign', 
                'users.first_name',
                'users.last_name',
                'users.google_profile_image',
            )
            ->groupBy('users.id', 'users.ign', 'users.google_profile_image') // Group by user to get the sum per user
            ->get();


        // Pass the class, user, and player data to the view
        return view('players', compact('class', 'user', 'class_player'));
    }

}


    
