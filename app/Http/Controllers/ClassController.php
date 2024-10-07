<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes as Classroom;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClassController extends Controller
{
    public function index()
    {
        $classes = null;

        $user = User::find(Auth::id());
        if ($user->user_type === 'teacher') {
            // Fetch all classes from the database
            $classes = Classroom::all();
        } else {
            $classes = $user->classes()->get();
        }

        // Pass the classes to the welcome view
        return view('classroom_dashboard', compact('classes'));
    }
    // New index method to fetch class information for the logged-in user



    public function createClass(Request $request)
    {
        // Validation logic here
        $request->validate([
            'class_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480' // Validating image upload
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('class_images', 'public');
        }

        do {
            $classCode = strtoupper(Str::random(6)); // 6-character random string
        } while (Classroom::where('class_code', $classCode)->exists());

        // Create a new class
        Classroom::create([
            'class_name' => $request->input('class_name'),
            'section' => $request->input('section'),
            'subject' => $request->input('subject'),
            'room' => $request->input('room'),
            'schedule' => $request->input('schedule'),
            'image_path' => $imagePath, // Save the image path
            'class_code' => $classCode, // Store the generated class code
        ]);

        return redirect()->back()->with('success', 'Class created successfully!');
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
        if ($user->classes()->where('class_id', $class->id)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this class.');
        }

        // Add the student to the class (many-to-many relationship)
        $user->classes()->attach($class->id);

        // return view('classroom_dashboard', ['class' => $class, 'class_code' => $request->class_code]);
        return redirect()->back()->with('success', 'Class joined successfully!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'schedule' => 'required|string|max:255',
            'room' => 'required|string|max:255',
        ]);

        $class = Classroom::findOrFail($id);
        $class->class_name = $request->input('class_name');
        $class->subject = $request->input('subject');

        // If a new class image is uploaded, handle the file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('class_images', 'public');
            // Delete the old image if it exists
        if ($class->image_path) {
            Storage::disk('public')->delete($class->image_path);
        }

        $class->image_path = $imagePath; // This is the correct field

        }

        $class->section = $request->input('section');
        $class->schedule = $request->input('schedule');
        $class->room = $request->input('room');

        // Save the updated class to the database
        $class->save();

         // Redirect to the bulletins route
        return redirect()->route('classroom.index')->with('success', 'Class created successfully!');
    }

    public function destroy($id)
    {
        $class = Classroom::findOrFail($id);
        $class->delete(); // Delete the class
        return redirect()->back()->with('success', 'Class deleted successfully!');
    }


}
