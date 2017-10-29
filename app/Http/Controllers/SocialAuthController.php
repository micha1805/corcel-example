<?php

namespace App\Http\Controllers;

use App\Http\Traits\NavLinksTrait;
use App\SocialProfile;
use App\User;
use Illuminate\Http\Request;
use Socialite;

class SocialAuthController extends Controller
{
    public function callback()
    {
        $navLinks = NavLinksTrait::getNavLinks();

        //* User data from facebook
        $facebookUserData = Socialite::driver('facebook')->user();

        //* Query to check if user exists
        $existing = User::whereHas('socialProfiles', function ($query) use ($facebookUserData) {
            $query->where('social_id', $facebookUserData->id);
        })->first();

        //* If user exists
        if ($existing !== null) {
            //* Authenticate User
            auth()->login($existing);

            //* Redirect to the Welcome Page
            return redirect('/');
        }

        //* Flash facebook user data into the session
        session()->flash('facebookUserData', $facebookUserData);

        //* Show facebook form to ask for username
        return view('users.facebook', [
            'navLinks' => $navLinks,
            'facebookUserData' => $facebookUserData,
        ]);
    }

    public function facebook()
    {
        //* Redirect to facebook callback
        return Socialite::driver('facebook')->redirect();
    }

    public function register(Request $request)
    {
        //* User data from facebook
        $facebookUserData = session('facebookUserData');
        //* Username from form input
        $username = $request->input('username');

        //* Create User
        $user = User::create([
            'avatar' => $facebookUserData->avatar,
            'email' => $facebookUserData->email,
            'name' => $facebookUserData->name,
            'username' => $username,
            'password' => str_random(16),
        ]);

        //* Create SocialProfile for this User
        $socialProfile = SocialProfile::create([
            'social_id' => $facebookUserData->id,
            'user_id' => $user->id,
        ]);

        //* Authenticate User
        auth()->login($user);

        //* Redirect to the Welcome Page
        return redirect('/');
    }
}
