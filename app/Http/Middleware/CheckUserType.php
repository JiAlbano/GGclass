<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    public function handle($request, Closure $next, $type)
    {
        // Check if the user is authenticated and has the required user type
        if (!Auth::check() || Auth::user()->user_type !== $type) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
