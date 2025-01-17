<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes as classroom;
use App\Models\Classes;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClassController extends Controller
{
    // Fetch Classes Based on User Type
    private function fetchClassesForUser($user)
    {
        if ($user->user_type === 'teacher') {
            // Fetch only classes created by the authenticated teacher
            return Classroom::where('teacher_id', $user->id)->get();
        } else {
            return $user->classes()->get(); // Only user's classes for students
        }
    }

    // Create Class Page
    public function create()
    {
        $user = Auth::user();
        $classes = $this->fetchClassesForUser($user);

        return view('class-dashboard.class_dashboard', compact('classes', 'user'));
    }

    // User Page
    public function user()
    {
        $user = Auth::user();
        $classes = $this->fetchClassesForUser($user);

        return view('class-dashboard.class-list', compact('classes', 'user'));
    }

    // Class List Page
    public function index()
    {
        $user = Auth::user();
        $classes = $this->fetchClassesForUser($user);
        return view('class-dashboard.class-list', compact('user', 'classes'));
    }

    // Store a New Class
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'school_year' => 'required|string',
            'semester' => 'required|string',
            'subject' => 'required|string',
            'section' => 'required|string',
            'schedule_day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room' => 'required|string',
        ]);

        // Generate unique class code
        do {
            $classCode = strtoupper(Str::random(6)); // Generate random code
        } while (Classroom::where('class_code', $classCode)->exists());

        // Save new class to the database
        Classroom::create([
            'teacher_id' => Auth::id(),
            'school_year' => $validated['school_year'],
            'semester' => $validated['semester'],
            'subject' => $validated['subject'],
            'section' => $validated['section'],
            'schedule_day' => $validated['schedule_day'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'room' => $validated['room'],
            'class_code' => $classCode,
        ]);

        return redirect()->route('class-list')->with('success', 'Class created successfully!');
    }

    public function joinClass(Request $request)
    {
       // Validate the class code
       $request->validate([
            'class_code' => 'required|string|exists:classes,class_code', // Ensure class_code exists
         ]);

              // Retrieve the specific class by the class_code

         // Find the class by the provided class code
         $class = Classroom::where('class_code', $request->class_code)->firstOrFail();

         // Find the currently authenticated user
         $user = User::find(Auth::id()); // Using User:: to find the authenticated user

         // Check if the student is already enrolled in the class
    // Check if the user is already enrolled
    if ($user->classes()->where('class_id', $class->id)->exists()) {
        return redirect()->route('class-list')->with('error', 'You are already enrolled in this class.');
    }

    // Enroll the user in the class
    $user->classes()->attach($class->id);

    // Redirect to the class list page with a success message
    return redirect()->route('class-list')->with('success', 'Class joined successfully!');
}

 // New index method to fetch class information for the logged-in user



    // public function createClass(Request $request)
    // {
    //     // Validation logic here
    //     $request->validate([
    //         'class_name' => 'required|string|max:255',
    //         'section' => 'required|string|max:255',
    //         'subject' => 'required|string|max:255',
    //         'room' => 'required|string|max:255',
    //         'schedule' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480' // Validating image upload
    //     ]);

    //     // Handle image upload
    //     $imagePath = null;
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('class_images', 'public');
    //     }

    //     do {
    //         $classCode = strtoupper(Str::random(6)); // 6-character random string
    //     } while (Classroom::where('class_code', $classCode)->exists());

    //     // Create a new class
    //     Classroom::create([
    //         'teacher_id' => Auth::id(),
    //         'class_name' => $request->input('class_name'),
    //         'section' => $request->input('section'),
    //         'subject' => $request->input('subject'),
    //         'room' => $request->input('room'),
    //         'schedule' => $request->input('schedule'),
    //         'image_path' => $imagePath, // Save the image path
    //         'class_code' => $classCode, // Store the generated class code
    //     ]);

    //     return redirect()->back()->with('success', 'Class created successfully!');
    // }


    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'class_name' => 'required|string|max:255',
    //         'subject' => 'required|string|max:255',
    //         'section' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
    //         'schedule' => 'required|string|max:255',
    //         'room' => 'required|string|max:255',
    //     ]);

    //     $class = Classroom::findOrFail($id);
    //     $class->class_name = $request->input('class_name');
    //     $class->subject = $request->input('subject');

    //     // If a new class image is uploaded, handle the file upload
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('class_images', 'public');
    //         // Delete the old image if it exists
    //     if ($class->image_path) {
    //         Storage::disk('public')->delete($class->image_path);
    //     }

    //     $class->image_path = $imagePath; // This is the correct field

    //     }

    //     $class->section = $request->input('section');
    //     $class->schedule = $request->input('schedule');
    //     $class->room = $request->input('room');

    //     // Save the updated class to the database
    //     $class->save();

    //      // Redirect to the bulletins route
    //     return redirect()->route('classroom.index')->with('success', 'Class created successfully!');
    // }

    // public function destroy($id)
    // {
    //     $class = Classroom::findOrFail($id);
    //     $class->delete(); // Delete the class
    //     return redirect()->back()->with('success', 'Class deleted successfully!');
    // }


}
