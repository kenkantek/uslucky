<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Ecommerce\Category;
use App\Models\Game;
use JavaScript;

class PagesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        JavaScript::put([
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
        $categories = Category::whereParentId(0)
            ->with(['childrens' => function ($q) {
                $q->with('products');
            }])
            ->get();

        $nyc = collect($categories)->first(function ($key, $item) {
            return $item->name == 'NYC';
        });

        $vagas = collect($categories)->first(function ($key, $item) {
            return $item->name == 'Vagas';
        });

        return view('pages.home', compact('nyc', 'vagas'));
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
        $contacts          = new Contact;
        $contacts->name    = $request->name;
        $contacts->phone   = $request->phone;
        $contacts->email   = $request->email;
        $contacts->message = $request->message;
        $contacts->save();
        return $contacts;
    }
}
