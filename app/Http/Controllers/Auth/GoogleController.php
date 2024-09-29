<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

               // Check if the account is already registered in the database
               $user = User::where('email', '=', $googleUser->getEmail())->first();
               
        // if user doesn't exist
        if ($user === null) {
            return redirect('/auth.view')->withErrors('Please sign up your account first.');
        }
        
        //logged in account
        Auth::login($user);

        return redirect()->intended(route('classroom.index')); // redirect to the intended page after login
    }
}
