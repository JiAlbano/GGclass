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

        return Socialite::driver('google')->with(['hd' => 'gbox.adnu.edu.ph'])->redirect();
    }

    public function handleGoogleCallback()
    {
        //get the user data from google
        $googleUser = Socialite::driver('google')->stateless()->user();

        //checking if acc is similar acc as @gbox.adnu.edu.ph
        if (strpos($googleUser->getEmail(), '@gbox.adnu.edu.ph') === false) { 
                return redirect('/auth.view')->withErrors('Only Gbox account are allowed.');
            }

        //checking if the acc is already registered in data base using $googleUser->getEmail()
        $user = User::where('email', '=', $googleUser->getEmail())->where('is_approve', '=', 1)->first();

        // if user doesn't exist
        if ($user === null) {
            return redirect('/auth.view')->withErrors('Please sign up your account first.');
        }
        //logged in account
        Auth::login($user);

        return redirect()->intended('bulletins.view'); // redirect to the intended page after login
    }
}
