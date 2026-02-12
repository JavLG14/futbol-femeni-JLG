<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Check if user exists
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // User exists, check role
            if ($user->role !== 'convidat') {
                return redirect()->route('login')->with('error', 'El teu usuari no pot entrar amb Google. Usa el formulari.');
            }

            // If user exists and is 'convidat', update google details if needed (optional but good practice)
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);

        } else {
            // User does not exist, create as 'convidat'
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt('password'), // Testing password
                'role' => 'convidat',
            ]);
        }

        // Login the user
        Auth::login($user);

        return redirect('/');
    }
}