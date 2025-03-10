<?php

namespace App\Http\Controllers;
use App\Models\Classes as Classroom;
use App\Models\ClassUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentChallengeScore;

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
            ->leftJoin('student_challenge_scores', 'student_challenge_scores.student_id', 'users.id') // Join using student_id
            ->where('class_user.class_id', $classId)
            ->select(
                'users.id as user_id', 
                'users.ign', 
                'users.first_name',
                'users.last_name',
                'users.google_profile_image',
                \DB::raw('SUM(student_challenge_scores.total_score) as total_score'), // Sum the total_score for each ClassUser
                \DB::raw('SUM(student_challenge_scores.number_of_items) as total_items') // Sum the number_of_items for each user
            )
            ->groupBy('users.id', 'users.ign', 'users.google_profile_image') // Group by user to get the sum per user
            ->get();

            // Get the total_score scores of the user for a specific class
            $totalScores = StudentChallengeScore::where('student_id', $user->id)

                ->pluck('total_score');

            // Calculate the sum of the total scores for the class
            $sumOfScores = $totalScores->sum();

            // Retrieve the number of items for the class
            $numberOfItems = StudentChallengeScore::where('student_id', $user->id)
           
                ->sum('number_of_items');


        // Pass the class, user, and player data to the view
        return view('players', compact('class', 'user', 'class_player', 'totalScores', 'sumOfScores', 'numberOfItems'));
    }

}


    
