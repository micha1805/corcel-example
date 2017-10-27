<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Http\Traits\NavLinksTrait;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function show(Message $message)
    {
        $navLinks = NavLinksTrait::getNavLinks();

        return view('messages.show', [
            'message' => $message,
            'navLinks' => $navLinks,
        ]);
    }

    public function create(CreateMessageRequest $request)
    {
        $user = $request->user();

        $message = Message::create([
            'content' => $request->input('message'),
            'image' => 'http://lorempixel.com/600/338?' . random_int(0, 100),
            'user_id' => $user->id,
        ]);

        return redirect('/messages/' . $message->id);
    }
}
