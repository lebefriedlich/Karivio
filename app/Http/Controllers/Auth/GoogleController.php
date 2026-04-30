<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/gmail.send', 'email', 'profile'])
            ->with(['access_type' => 'offline', 'prompt' => 'consent select_account'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google.');
        }

        $userData = [
            'name' => $user->name,
            'email' => $user->email,
            'google_id' => $user->id,
            'avatar' => $user->avatar,
            'google_token' => $user->token,
            'google_refresh_token' => $user->refreshToken,
            'google_token_expires_at' => now()->addSeconds($user->expiresIn),
        ];

        $existingUser = User::where('google_id', $user->id)
            ->orWhere('email', $user->email)
            ->first();

        if ($existingUser) {
            // Update data and tokens
            $existingUser->update($userData);
            Auth::login($existingUser);
        } else {
            $newUser = User::create($userData);
            Auth::login($newUser);
        }

        return redirect()->intended('/dashboard');
    }
}
