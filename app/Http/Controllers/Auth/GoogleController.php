<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $email = $googleUser->getEmail();
            $googleId = $googleUser->getId();
            $avatar = $googleUser->getAvatar();

            if (
                ! filled($email)
                || ! filled($googleId)
                || ! filter_var($googleUser->getRaw()['email_verified'] ?? false, FILTER_VALIDATE_BOOLEAN)
            ) {
                return redirect()->route('login')
                    ->withErrors(['google' => 'Your Google account must have a verified email address.']);
            }

            $user = User::where('email', $email)->first();

            if ($user === null) {
                $user = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'name' => $googleUser->getName() ?: $email,
                        'google_id' => $googleId,
                        'image' => $avatar,
                        'password' => Hash::make(Str::random(64)),
                        'email_verified_at' => now(),
                    ],
                );
            }

            if (filled($user->google_id) && $user->google_id !== $googleId) {
                throw new \RuntimeException('This account is already linked to a different Google account.');
            }

            if (! $user->wasRecentlyCreated) {
                $user->google_id = $googleId;

                if (! filled($user->image) && filled($avatar)) {
                    $user->image = $avatar;
                }

                $user->email_verified_at ??= now();
                $user->save();
            } else {
                $user->assignRole('student');
            }

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->to('/');
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('login')
                ->withErrors(['google' => 'Unable to sign in with Google. Please try again.']);
        }
    }
}
