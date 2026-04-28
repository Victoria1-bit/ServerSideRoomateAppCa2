<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    private string $googleRedirect = 'http://127.0.0.1:8000/auth/google/callback';
    private string $facebookRedirect = 'http://127.0.0.1:8000/auth/facebook/callback';

    public function redirectToGoogle()
    {
        config(['services.google.redirect' => $this->googleRedirect]);

        return Socialite::driver('google')
            ->redirectUrl($this->googleRedirect)
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        config(['services.google.redirect' => $this->googleRedirect]);

        return $this->handleProviderCallback('google', $this->googleRedirect);
    }

    public function redirectToFacebook()
    {
        config(['services.facebook.redirect' => $this->facebookRedirect]);

        return Socialite::driver('facebook')
            ->redirectUrl($this->facebookRedirect)
            ->redirect();
    }

    public function handleFacebookCallback()
    {
        config(['services.facebook.redirect' => $this->facebookRedirect]);

        return $this->handleProviderCallback('facebook', $this->facebookRedirect);
    }

    private function handleProviderCallback(string $provider, string $redirectUrl)
    {
        $socialUser = Socialite::driver($provider)
            ->redirectUrl($redirectUrl)
            ->user();

        $user = User::updateOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'Roommate User',
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => Hash::make(Str::random(32)),
                'role' => 'member',
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user, true);

        return redirect()->route('dashboard');
    }
}
