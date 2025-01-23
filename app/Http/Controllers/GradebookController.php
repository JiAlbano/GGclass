<?php

namespace App\Http\Controllers;

use App\Models\Classes as Classroom;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GradebookController extends Controller
{
    // Function to display the challenges page
    public function show($classId)
    {
        // Fetch the authenticated user
        $user = Auth::user();
    
        // Fetch the class details
        $class = Classroom::findOrFail($classId);
    
        // Pass class details, user, and classId to the view
        return view('gradebook', compact('class', 'user', 'classId'));
    }


}
