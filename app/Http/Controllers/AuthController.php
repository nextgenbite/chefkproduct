<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
    try {
        $user = Socialite::driver('google')->user();
        
        // Here you have access to the user data, so you can proceed to authenticate the user or handle as needed.
        // For example:
        $authenticatedUser = User::findOrCreateUser($user);
        Auth::login($authenticatedUser);

        // Redirect the user after login
        return redirect()->intended('/dashboard');
    } catch (\Exception $e) {
        // Handle any exceptions
        return redirect()->route('login')->with('error', 'Unable to login with Google. Please try again.');
    }
}
}
