<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            'birthday' => 'required|date',
            'gender' => 'required|in:male,female,other',
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
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'user_type' => 'teacher',
            'is_approve' => 0,
        ]);

        // Redirect or send a response after successful sign-up
        return redirect('/auth.view')->with('message', 'You have signup already, please wait for the admin to approve your account.');
    }
}
