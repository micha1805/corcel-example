<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Http\Traits\NavLinksTrait;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function create(CreateMessageRequest $request)
    {
        $user = $request->user();
        $image = $request->file('image');

        $message = Message::create([
            'content' => $request->input('message'),
            'image' => $image->store('message', 'public'),
            'user_id' => $user->id,
        ]);

        return redirect('/message/' . $message->id);
    }

    public function getResponses(Message $message)
    {
        return $message->responses;
    }

    public function search(Request $request)
    {
        $navLinks = NavLinksTrait::getNavLinks();

        //* Get all messages that match the query, and then load its users
        $query = $request->input('query');
        $messages = Message::search($query)->get();
        $messages->load('user');

        return view('messages.index', [
            'messages' => $messages,
            'navLinks' => $navLinks,
        ]);
    }

    public function show(Message $message)
    {
        $navLinks = NavLinksTrait::getNavLinks();

        return view('messages.show', [
            'message' => $message,
            'navLinks' => $navLinks,
        ]);
    }
}
