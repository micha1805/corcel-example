<?php

namespace App\Http\Controllers;

use App\Http\Traits\NavLinksTrait;
use App\Message;
use Corcel\Model\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showWelcome()
    {
        $messages = Message::latest()->paginate(10);
        $navLinks = NavLinksTrait::getNavLinks();

        return view('welcome', [
            'messages' => $messages,
            'navLinks' => $navLinks,
        ]);
    }

    public function showSamplePage()
    {
        $navLinks = NavLinksTrait::getNavLinks();
        $samplePage = Page::slug('sample-page')->first();

        return view('samplepage', [
            'navLinks' => $navLinks,
            'samplePage' => $samplePage,
        ]);
    }
}
