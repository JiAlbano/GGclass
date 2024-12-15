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
                return redirect('/auth.view')->withErrors('Only Gbox account are allowed.');
            }

   // Find the user by email
        $user = User::where('email', $googleUser->getEmail())->first();

        //Seperating full name to first, middle and last name
        $middle_initial = substr(strrchr($googleUser->user['given_name'], ' '), 1);
        $last_name = $googleUser->user['family_name'];
        $lastSpacePos = strrpos($googleUser->user['given_name'], ' ');
        $first_name = substr($googleUser->user['given_name'], 0, $lastSpacePos);

        // If user doesn't exist, sign up user as student
        if (!$user) {
            $user= User::create([
                'first_name' => $first_name,
                'middle_initial' => $middle_initial,
                'last_name' => $last_name,
                'email' => $googleUser->getEmail(),
                'id_number' => "",
                'course_id' =>0,
                'ign'=>"",
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

        // Redirect logic based on user type and conditions
        if ($user->user_type === 'student') {
            // Check if course_id is not 0 and id_number is not an empty string
            if ($user->course_id !== 0 && $user->id_number !== NULL) {
                return redirect()->route('classroom.index');
            } else {
                return redirect()->route('basic-info-student');
            }
        } else {
            // Check if department is not an empty string
            if ($user->department !== NULL) {
                return redirect()->route('classroom.index');
            } else {
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

        // Redirect to the classroom.index page
        return redirect()->route('classroom.index')->with('success', 'Information updated successfully!');
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

        // Redirect to the classroom.index page
        return redirect()->route('classroom.index')->with('success', 'Information updated successfully!');
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
        //  return redirect('http://127.0.0.1:8000/')->with('message', 'Successfully logged out.');
        return redirect('novel-lotte-ggclass-d41e3f62.koyeb.app/')->with('message', 'Successfully logged out.');
    }

}
