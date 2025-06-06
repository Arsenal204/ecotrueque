<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GitHubController extends Controller
{
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGitHubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            $user = User::firstOrCreate(
                ['email' => $githubUser->getEmail()],
                [
                    'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                    'password' => bcrypt(Str::random(24)),
                ]
            );

            Auth::login($user);

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Hubo un problema con GitHub.');
        }
    }
}
