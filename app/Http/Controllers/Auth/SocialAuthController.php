<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;

class SocialAuthController extends Controller
{
    // Google
    public function googleRedirect()
    {
        return Socialite::driver('google')->scopes(['email'])->redirect();
    }

    public function googleCallback()
    {
        try {
            $gUser = Socialite::driver('google')->user(); // ถ้าเจอ state mismatch ให้ลอง ->stateless()
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Google login failed: '.$e->getMessage());
        }

        $email = $gUser->getEmail();
        $user  = User::where('provider','google')->where('provider_id',$gUser->getId())->first()
               ?? ($email ? User::where('email',$email)->first() : null);

        if ($user) {
            $user->update([
                'provider'    => 'google',
                'provider_id' => $gUser->getId(),
                'avatar'      => $gUser->getAvatar(),
                'email'       => $email ?? $user->email,
            ]);
        } else {
            $user = User::create([
                'name'              => $gUser->getName() ?: ($gUser->getNickname() ?: 'User'),
                'email'             => $email ?? ('no-email-google-'.$gUser->getId().'@example.com'),
                'email_verified_at' => now(),
                'password'          => Hash::make(Str::random(24)),
                'provider'          => 'google',
                'provider_id'       => $gUser->getId(),
                'avatar'            => $gUser->getAvatar(),
            ]);
        }

        Auth::login($user, true);
        return redirect()->intended('/');
    }

    // Facebook
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->scopes(['email'])->redirect();
    }

    public function facebookCallback()
    {
        try {
            $fbUser = Socialite::driver('facebook')->user(); // ถ้าเจอ state mismatch ให้ลอง ->stateless()
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Facebook login failed: '.$e->getMessage());
        }

        $email = $fbUser->getEmail();
        $user  = User::where('provider','facebook')->where('provider_id',$fbUser->getId())->first()
               ?? ($email ? User::where('email',$email)->first() : null);

        if ($user) {
            $user->update([
                'provider'    => 'facebook',
                'provider_id' => $fbUser->getId(),
                'avatar'      => $fbUser->getAvatar(),
                'email'       => $email ?? $user->email,
            ]);
        } else {
            $user = User::create([
                'name'              => $fbUser->getName() ?: ($fbUser->getNickname() ?: 'User'),
                'email'             => $email ?? ('no-email-facebook-'.$fbUser->getId().'@example.com'),
                'email_verified_at' => now(),
                'password'          => Hash::make(Str::random(24)),
                'provider'          => 'facebook',
                'provider_id'       => $fbUser->getId(),
                'avatar'            => $fbUser->getAvatar(),
            ]);
        }

        Auth::login($user, true);
        return redirect()->intended('/');
    }
}
