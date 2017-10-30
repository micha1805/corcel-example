<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\PrivateMessage;
use App\User;
use App\Http\Traits\NavLinksTrait;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private function findByUsername($username)
    {
        return User::where('username', $username)->firstOrFail();
    }

    public function follow($username, Request $request)
    {
        //* Logged user
        $me = $request->user();
        //* User to follow
        $user = $this->findByUsername($username);

        //* Follow user
        $me->follows()->attach($user);

        //* Notify user by email
        $user->notify(new UserFollowed($me));

        //* Redirect to the followed user profile view
        return redirect('/user/' . $username)->withSuccess('Usuario seguido');
    }

    public function getNotifications(Request $request)
    {
        return $request->user()->notifications;
    }

    public function sendPrivateMessage($username, Request $request)
    {
        $navLinks = NavLinksTrait::getNavLinks();

        //* Logged user
        $me = $request->user();
        //* User to send message
        $user = $this->findByUsername($username);
        //* Message to send
        $message = $request->input('message');

        //* Check if exists a conversation bewtween two users; if exists, return conversation, else, create it and attach users
        $conversation = Conversation::between($me, $user);

        //* Attach private message
        $privateMessage = PrivateMessage::create([
            'conversation_id' => $conversation->id,
            'message' => $message,
            'user_id' => $me->id,
        ]);

        return redirect('/conversation/' . $conversation->id);
    }

    public function showFollowers($username)
    {
        $navLinks = NavLinksTrait::getNavLinks();
        $user = $this->findByUsername($username);

        return view('users.follows', [
            'follows' => $user->followers,
            'navLinks' => $navLinks,
            'user' => $user,
        ]);
    }

    public function showFollows($username)
    {
        $navLinks = NavLinksTrait::getNavLinks();
        $user = $this->findByUsername($username);

        return view('users.follows', [
            'follows' => $user->follows,
            'navLinks' => $navLinks,
            'user' => $user,
        ]);
    }

    public function showProfile($username)
    {
        $navLinks = NavLinksTrait::getNavLinks();
        $user = $this->findByUsername($username);

        return view('users.profile', [
            'navLinks' => $navLinks,
            'user' => $user,
        ]);
    }

    public function unfollow($username, Request $request)
    {
        //* Logged user
        $me = $request->user();
        //* User to follow
        $user = $this->findByUsername($username);

        //* Unfollow user
        $me->follows()->detach($user);

        //* Redirect to the followed user profile view
        return redirect('/user/' . $username)->withSuccess('Has dejado de seguir a este usuario');
    }
}
