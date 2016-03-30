<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Game;

class PagesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->middleware('auth');
        \JavaScript::put([
            '_games' => Game::all(),
        ]);
    }

    public function getIndex()
    {
        return view('home');
    }

    public function getAbout()
    {
        return view('page.about');
    }

    public function getContact()
    {
        return view('page.contact');
    }

    public function getWinning()
    {
        return view('page.winnumber');
    }

    public function putContact(ContactRequest $request)
    {
        $contacts          = new Contact();
        $contacts->name    = $request->name;
        $contacts->phone   = $request->phone;
        $contacts->email   = $request->email;
        $contacts->message = $request->message;
        $contacts->save();
        return $contacts;
    }
}
