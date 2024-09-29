<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function show($classId)
    {
        $users = User::all(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class

        return view('exam', compact('class', 'users')); // Pass both variables to the view
    }
}
