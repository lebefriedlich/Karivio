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
            \Log::info('Google Login Attempt', ['email' => $user->email]);
        } catch (Exception $e) {
            \Log::error('Google Login Error', ['message' => $e->getMessage()]);
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
            \Log::info('Existing User Found', ['id' => $existingUser->id]);
            $existingUser->update($userData);
            Auth::login($existingUser);
        } else {
            \Log::info('Creating New User', ['email' => $user->email]);
            $newUser = User::create($userData);
            Auth::login($newUser);
        }

        if (Auth::check()) {
            \Log::info('Login Successful', ['user_id' => Auth::id()]);
        } else {
            \Log::error('Login Failed - Auth::check() returned false');
        }

        return redirect()->intended('/dashboard');
    }
}
