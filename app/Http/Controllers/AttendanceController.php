<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function show($classId)
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Manually join classes, class_user, and users tables
        $classUsers = DB::table('classes')
            ->join('class_user', 'classes.id', '=', 'class_user.class_id')
            ->join('users', 'class_user.user_id', '=', 'users.id')
            ->where('classes.id', '=', $classId)
            ->select('users.first_name', 'users.last_name', 'users.ign', 'users.google_profile_image') // Select specific user fields
            ->get();

        // Fetch the class details
        $class = Classroom::findOrFail($classId);

        // Pass class, users, and challenges to the view
        return view('attendance', compact('class', 'user', 'classUsers'));
    }
}
