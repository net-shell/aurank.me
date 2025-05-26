<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(uniqid()),
                ]);
            } elseif (empty($user->google_id)) {
                $user->update(['google_id' => $googleUser->id]);
            }

            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // Log the error or handle it as needed
            // For example, you can redirect back with an error message
            // Log::error('Google authentication failed: ' . $e->getMessage());
            // Or you can return a view with an error message
            // return redirect('/login')->withErrors('Google authentication failed');
            // For now, we will just redirect back with an error message
            return redirect('/login')->withErrors('Google authentication failed');
        }
    }
}
