<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes as Classroom;
use App\Models\ClassModel;
use App\Models\User;


class ClassController extends Controller
{
    public function index()
    {
        // Fetch all classes from the database
        $classes = Classroom::all();

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

        // Create a new class
        Classroom::create([
            'class_name' => $request->input('class_name'),
            'section' => $request->input('section'),
            'subject' => $request->input('subject'),
            'room' => $request->input('room'),
            'schedule' => $request->input('schedule'),
            'image_path' => $imagePath // Save the image path
        ]);

        return redirect()->back()->with('success', 'Class created successfully!');
    }

    public function joinClass(Request $request)
    {
        // Validation logic here
        $request->validate([
            'class_code' => 'required|string|exists:classes,id', // Assuming 'id' is used as the class code
        ]);

        // Logic to join the class

        return redirect()->back()->with('success', 'Joined class successfully!');
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
            \Storage::disk('public')->delete($class->image_path);
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
