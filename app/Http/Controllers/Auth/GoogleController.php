<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Log;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Classes;

class GoogleController extends Controller
{
    public function redirectToGoogle()
{
    return Socialite::driver('google')
        ->with(['hd' => 'gbox.adnu.edu.ph'])
        ->redirect();
}

    public function handleGoogleCallback()
    {
        //get the user data from google
        $googleUser = Socialite::driver('google')->stateless()->user();

        //checking if acc is similar acc as @gbox.adnu.edu.ph
        if (strpos($googleUser->getEmail(), '@gbox.adnu.edu.ph') === false) {
                return redirect('/')->withErrors('Only Gbox account are allowed.');
            }

   // Find the user by email
   $user = User::where('email', $googleUser->getEmail())->first();

   $full_name = $googleUser->user['name']; // e.g., "John Ignacious G. Albano"

   // Split the name into parts
   $name_parts = explode(' ', $full_name);

   // Extract the last name (assume the last word is the last name)
   $last_name = array_pop($name_parts);

   // Filter out middle initials (e.g., single letters like "G." or "G")
   $filtered_parts = array_filter($name_parts, function ($part) {
       return !(strlen($part) === 1 || preg_match('/^[A-Z]\.$/', $part));
   });

   // Reassemble the first name (remaining parts)
   $first_name = implode(' ', $filtered_parts);


        // If user doesn't exist, sign up user as student
        if (!$user) {
            $user = User::create([
                'first_name' => $first_name,   // First name
                'middle_initial' => null,      // Middle initial removed
                'last_name' => $last_name,     // Last name
                'email' => $googleUser->getEmail(),
                'course_id' => 0,
                'ign' => "",
                'user_type' => 'student',
            ]);
        }
    
        // Update Google-related fields
        $user->google_id = $googleUser->getId();
        $user->google_access_token = $googleUser->token;
        $user->google_profile_image = $googleUser->getAvatar(); // Optional if you want to store profile image
        $user->save();
    


        
    // Log in the user
    Auth::login($user); // This should now be a User model instance

    // Check if the user already has a class created or joined
    if ($user->classes()->exists()) {
        return redirect()->route('class-list'); // Redirect to class-list if class exists
    }
    
    // Redirect logic based on user type and conditions
    if ($user->user_type === 'student') {
        // Check if course_id is not 0 and id_number is not NULL
        if ($user->course_id !== 0 && $user->id_number !== NULL) {
            return redirect()->route('create-class');
        } else {
            return redirect()->route('basic-info-student');
        }
    } else {
        // User is a teacher
        if ($user->department !== NULL) {
            // Check if the class-list has any data with the teacher_id
            if (Classes::where('teacher_id', $user->id)->exists()) {
                // If there are classes with the teacher_id, redirect to class-list
                return redirect()->route('class-list');
            } else {
                // If no classes are found for this teacher_id, redirect to create-class
                return redirect()->route('create-class');
            }
        } else {
            // If no department, redirect to basic-info-teacher to complete profile setup
            return redirect()->route('basic-info-teacher');
        }
    }
}

    public function basicInfoTeacher()
    {
        $user = Auth::user();
        // Your logic for the teacher's basic info page
        $departments = Department::all();
        return view('basic-info-teacher', compact('user', 'departments')); // Return the view for the teacher's info page
    }

    public function basicInfoStudent()
    {
        $user = Auth::user();
        // Your logic for the student's basic info page
        $courses = Course::all();
        return view('basic-info-student', compact('user','courses'));
    }

    public function updateBasicInfo(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the form inputs
        $request->validate([
            'course' => 'required|exists:courses,id',
            'id-number' => 'required|string|max:20',
            'ign' => 'required|string|max:255',
        ]);

        // Update the user's course and ID number
        $user->course_id = $request->input('course');
        $user->id_number = $request->input('id-number');
        $user->ign = $request->input('ign');
        $user->save();

        // Redirect to the create-class page
        return redirect()->route('create-class')->with('success', 'Information updated successfully!');
    }

    public function updateBasicInfoTeacher(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the form inputs
        $request->validate([
            'department' => 'required|exists:departments,id',
            'ign' => 'required|string|max:255',
        ]);

        // Update the user's course and ID number
        $user->department = $request->input('department');
        $user->ign = $request->input('ign');
        $user->save();

        // Redirect to the create-class page
        return redirect()->route('create-class')->with('success', 'Information updated successfully!');
    }

    
    public function logout()
    {
        $client = new GoogleClient();

        // Set the access token for the client
        $accessToken = Auth::user()->google_access_token;

        if ($accessToken) {
            try {
                // Set the access token
                $client->setAccessToken($accessToken);

                // Revoke access to the Google account
                $client->revokeToken();
            } catch (\Exception $e) {
                // Handle error if revocation fails
                Log::error('Error revoking Google token: ' . $e->getMessage());
            }
        }

        // Log the user out of your application
        Auth::logout();

        // Redirect back to the home page
        return redirect('https://novel-lotte-ggclass-d41e3f62.koyeb.app')->with('message', 'Successfully logged out.');
    }

}
