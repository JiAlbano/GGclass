<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Models\TutorialFile;
use App\Models\TutorialLink;
use App\Models\Classes as Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TutorialsController extends Controller
{
   
    public function show($classId)
    {
        $user = Auth::user(); // Fetch the authenticated user
        $class = Classroom::findOrFail($classId); // Fetch the class
        $tutorials = Tutorial::where('class_id', $classId)->get(); // Fetch tutorials for the class

        return view('tutorials', compact('class', 'user', 'tutorials')); // Pass variables to the view
    }

    public function create($classId)
    {
        $user = Auth::user(); // Fetch all users
        $class = Classroom::findOrFail($classId); // Fetch the class

        return view('tutorial-dashboard.create-tutorial', compact('class', 'user')); // Pass both variables to the view
    }


    public function display($classId, $tutorialId)
        {
            $user = Auth::user(); // Fetch the authenticated user
            $class = Classroom::findOrFail($classId); // Fetch the class
            $tutorial = Tutorial::findOrFail($tutorialId); // Fetch the specific tutorial

            return view('tutorial-dashboard.display-tutorial', compact('class', 'user', 'tutorial')); // Pass variables to the view
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
            
                // Save the tutorial to the database
                $tutorial = Tutorial::create([
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'user_id' => Auth::id(), // Get currently logged-in user's ID
                    'class_id' => $classId // Link the tutorial to the class
                ]);
            
                // Save the uploaded files
                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        $path = $file->store('tutorials/files', 'public');
                        TutorialFile::create([
                            'tutorial_id' => $tutorial->id,
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
                            'tutorial_id' => $tutorial->id,
                            'url' => $url
                        ]);
                    }
                }
            
                // Redirect to the tutorials page with success message
                return redirect()->route('tutorials', ['classId' => $classId])
                                 ->with('success', 'Tutorial created successfully!');
            }

            public function destroy($classId, $tutorialId)
{
    // Fetch the tutorial to be deleted
    $tutorial = Tutorial::findOrFail($tutorialId);

    // Delete associated files
    foreach ($tutorial->files as $file) {
        Storage::disk('public')->delete($file->file_path);
        $file->delete();
    }

    // Delete the tutorial itself
    $tutorial->delete();

    // Redirect back to the tutorials page with a success message
    return redirect()->route('tutorials', ['classId' => $classId])
                     ->with('success', 'Tutorial deleted successfully!');
}

}

   