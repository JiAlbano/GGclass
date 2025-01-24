<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use App\Models\BulletinFile;
use App\Models\TutorialLink;
use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BulletinsController extends Controller
{
    public function show($classId)
    {
        $user = Auth::user(); // Fetch the authenticated user
        $class = Classroom::findOrFail($classId);
        $tutorials = Bulletin::where('class_id', $classId)->get();

        return view('bulletins', compact('class', 'user', 'tutorials')); 
    }

    public function create($classId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class

        return view('bulletin-dashboard.create-bulletin', compact('class', 'user')); // Pass both variables to the view
    }

    public function display($classId, $tutorialId)
    {
        $user = Auth::user(); // Fetch the authenticated user
        $class = Classroom::findOrFail($classId); // Fetch the class
        $bulletin = Bulletin::findOrFail($tutorialId); // Fetch the specific tutorial

        return view('bulletin-dashboard.display-bulletin', compact('class', 'user', 'bulletin')); // Pass variables to the view
    }

    public function store(Request $request, $classId)
    {
        // Validate the input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png',
            'links.*' => 'nullable|url'
        ]);
    
        // Save the bulletin to the database
        $bulletin = Bulletin::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => Auth::id(), // Get currently logged-in user's ID
            'class_id' => $classId // Link the bulletin to the class
        ]);
    
        // Save the uploaded files
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('bulletins/files', 'public');
                BulletinFile::create([
                    'bulletin_id' => $bulletin->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'filename' => $file->getClientOriginalName()
                ]);
            }
        }
    
        // Save the links
        if ($request->has('links')) {
            foreach ($request->input('links') as $url) {
                TutorialLink::create([
                    'bulletin_id' => $bulletin->id,
                    'url' => $url
                ]);
            }
        }
    
        // Redirect to the bulletins page with success message
        return redirect()->route('bulletins', ['classId' => $classId])
                         ->with('success', 'Bulletin created successfully!');
    }

    public function destroy($classId, $bulletinId)
{
    // Fetch the bulletin to be deleted
    $bulletin = Bulletin::findOrFail($bulletinId);

    // Delete associated files
    foreach ($bulletin->files as $file) {
        Storage::disk('public')->delete($file->file_path);
        $file->delete();
    }

    // Delete the bulletin itself
    $bulletin->delete();

    // Redirect back to the bulletins page with a success message
    return redirect()->route('bulletins', ['classId' => $classId])
                     ->with('success', 'Bulletin deleted successfully!');
}
}