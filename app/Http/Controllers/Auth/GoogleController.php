<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Log;

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

        // If user doesn't exist, sign up user as student
        if (!$user) {
            $user= User::create([
                'first_name' => $googleUser->getName(),
                'middle_name' => "",
                'last_name' => "",
                'email' => $googleUser->getEmail(),
                'id_number' => "",
                'course_id' =>0,
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


        return redirect()->intended(route('classroom.index'));

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
        return redirect('http://127.0.0.1:8000/')->with('message', 'Successfully logged out.');
    }

}
