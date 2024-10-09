<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
class SignupTeacherController extends Controller
{
    public function handleSignup(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'id_number' => 'required|string|unique:users,id_number',

        ]);

        if(!$validatedData) {
            return redirect()->back()->with('error', $validatedData);
        }

        // Insert the validated data into the teachers table
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'id_number' => $request->id_number,

            'user_type' => 'teacher',
        ]);

        // Redirect or send a response after successful sign-up
        return redirect('/auth.view');
    }
}
