<?php

namespace App\Http\Controllers;
use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentquiztakeController extends Controller
{
    public function show($classId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::find($classId); // Fetch the class

        return view('quiz-take-student', compact('class', 'user')); // Pass both variables to the view
    }
}
