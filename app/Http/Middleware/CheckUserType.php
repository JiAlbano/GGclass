<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import the Log facade

class CheckUserType
{
    public function handle($request, Closure $next, $type)
    {
        // Log the user type for debugging
        if (Auth::check()) {
            Log::info('User Type:', ['user_type' => Auth::user()->user_type]);
        } else {
            Log::info('User is not authenticated.');
        }

        // Check if the user is authenticated and has the required user type
        if (!Auth::check() || Auth::user()->user_type !== $type) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
