<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Game;
use App\Models\Result;

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

    public function getLang($locale)
    {
        $path = resource_path("lang/$locale");
        file_exists($path) && session()->set('locale', $locale);
        return redirect()->intended();
    }

    public function getIndex()
    {
        $result      = Result::whereGameId(1)->latest('draw_at')->first();
        $result_mega = Result::whereGameId(2)->latest('draw_at')->first();
        $powerball   = powerballNextTime();
        $mega        = megaNextTime();
        return view('pages.home', compact('powerball', 'result', 'mega', 'result_mega'));
    }

    public function getAbout()
    {
        return view('pages.about');
    }

    public function getContact()
    {
        return view('pages.contact');
    }

    public function getWinning()
    {
        return view('pages.winnumber');
    }

    public function getSpecialOffers()
    {
        return view('pages.special_offers');
    }

    public function getTrustSecurity()
    {
        return view('pages.trust_security');
    }

    public function getPayment()
    {
        return view('pages.payment');
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
