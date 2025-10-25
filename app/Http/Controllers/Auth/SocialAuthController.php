<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

// Note: This controller expects laravel/socialite to be installed and configured.
// If Socialite is not installed, these methods will error at runtime.
class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        // only allow google for now
        if ($provider !== 'google') {
            abort(404);
        }

        // Lazy-load Socialite to avoid class errors when package missing
        if (!class_exists(\Laravel\Socialite\Facades\Socialite::class)) {
            abort(500, 'Socialite package not installed. Run composer require laravel/socialite.');
        }

        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    public function callback(Request $request, $provider)
    {
        if ($provider !== 'google') {
            abort(404);
        }

        if (!class_exists(\Laravel\Socialite\Facades\Socialite::class)) {
            abort(500, 'Socialite package not installed. Run composer require laravel/socialite.');
        }

        try {
            $socialUser = \Laravel\Socialite\Facades\Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['social' => 'Gagal masuk melalui Google.']);
        }

        // Prefer to find by provider + provider_id first
        $user = User::where('provider', 'google')->where('provider_id', $socialUser->getId())->first();

        if (!$user) {
            // If not found by provider id, try by email
            $user = User::where('email', $socialUser->getEmail())->first();
        }

        if (!$user) {
            // create user -- use a random password (hashed by model)
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User ' . Str::random(4),
                'email' => $socialUser->getEmail(),
                // password will be cast to hashed by model
                'password' => Str::random(32),
                'provider' => 'google',
                'provider_id' => $socialUser->getId(),
                // mark as verified because Google already verified the email
                'email_verified_at' => now(),
            ]);
        } else {
            // ensure provider info saved for existing account
            $updates = [];
            if (empty($user->provider) || empty($user->provider_id)) {
                $updates['provider'] = 'google';
                $updates['provider_id'] = $socialUser->getId();
            }
            // If existing user hasn't verified email, mark it verified because Google verified it
            if (empty($user->email_verified_at)) {
                $updates['email_verified_at'] = now();
            }

            if (!empty($updates)) {
                $user->update($updates);
                // reload fresh instance
                $user->refresh();
            }
        }

        Auth::login($user, true);

        return redirect()->intended('/dashboard');
    }
}
