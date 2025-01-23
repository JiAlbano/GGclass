<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes as Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function show($classId, Request $request)
    {
        $date = $request->input('date');
        // Fetch the authenticated user
        $user = Auth::user();

        $classUsers = DB::table('classes')
            ->join('class_user', 'classes.id', '=', 'class_user.class_id')
            ->join('users', 'class_user.user_id', '=', 'users.id')
            ->leftJoin('attendance', 'attendance.user_id', '=', 'users.id')
            ->where('classes.id', '=', $classId);

        // If a date is provided, filter the attendance by the given date
        if (!empty($date)) {
            $classUsers->where('attendance.date', '=', $date);
        }

        // Select specific user fields and attendance fields
        $classUsers = $classUsers->select(
            'users.first_name',
            'users.last_name',
            'users.ign',
            'users.google_profile_image',
            'users.id as student_id',
            'attendance.*' // Select all attendance fields
        )->get();  // Execute the query and get the results
        // Fetch the class details
        $class = Classroom::findOrFail($classId);

        // Pass class, users, and challenges to the view
        return view('attendance', compact('class', 'user', 'classUsers'));
    }

    public function saveAttendance(Request $request) {
        $data = $request->input('data');
        $values = [
            'user_id' => $data[0]['user_id'],
            'note' => $data[0]['note'],
            'date' => $data[0]['date'],
            'status' => $data[0]['status']
        ];
        $result = Attendance::updateOrCreate(array('id' => $data[0]['id']),$values);
        return $result;
    }
}
