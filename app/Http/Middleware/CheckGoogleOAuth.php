<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckGoogleOAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated via Google OAuth
        if (!Auth::check() || Auth::user()->provider !== 'google') {
            // Redirect to login if not authenticated with Google
            return redirect()->route('googleRedirect');
        }

        return $next($request);
    }
}
