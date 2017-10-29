<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Http\Traits\NavLinksTrait;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function showConversation(Conversation $conversation)
    {
        $navLinks = NavLinksTrait::getNavLinks();

        //* Load users and private messages from this conversation
        $conversation->load('users', 'privateMessages');

        return view('conversations.show', [
            'navLinks' => $navLinks,
            'conversation' => $conversation,
            'user' => auth()->user(),
        ]);
    }
}
