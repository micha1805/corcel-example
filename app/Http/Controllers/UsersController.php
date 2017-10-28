<?php

namespace App\Http\Controllers;

use App\Http\Traits\NavLinksTrait;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($username)
    {
        $navLinks = NavLinksTrait::getNavLinks();
        $user = User::where('username', $username)->first();

        return view('users.show', [
            'navLinks' => $navLinks,
            'user' => $user,
        ]);
    }
}
