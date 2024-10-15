<?php

namespace App\Http\Controllers;

use Google\Client as GoogleClient; // Make sure you import the Google Client
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    public function destroy(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $client = new GoogleClient();
            $accessToken = Auth::user()->google_access_token;

            if ($accessToken) {
                try {
                    // Set the access token
                    $client->setAccessToken($accessToken);
                    // Revoke access to the Google account
                    $client->revokeToken();
                } catch (\Exception $e) {
                    // Log any error during token revocation
                    Log::error('Error revoking Google token: ' . $e->getMessage());
                }
            }

            // Log the user out of your application
            Auth::logout();

            // Invalidate the session
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // Redirect back to the home page
        return redirect('/');
    }
}