<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorialsController extends Controller
{
    public function show($classId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class

        return view('tutorials', compact('class', 'user')); // Pass both variables to the view
    }

    public function create($classId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class

        return view('tutorial-dashboard.create-tutorial', compact('class', 'user')); // Pass both variables to the view
    }

    public function display($classId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class

        return view('tutorial-dashboard.display-tutorial', compact('class', 'user')); // Pass both variables to the view
    }

    public function store(Request $request, $classId)
    {
        // Validate the input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        // Save the tutorial to the database
        $tutorial = Tutorial::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => Auth::id(), // Get currently logged-in user's ID
            'class_id' => $classId // Link the tutorial to the class
        ]);

        // Redirect to the tutorials page with success message
        return redirect()->route('tutorials', ['classId' => $classId])
                         ->with('success', 'Tutorial created successfully!');
    }
}
