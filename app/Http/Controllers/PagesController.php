<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\PartnerRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactPartner;
use App\Models\Ecommerce\Category;
use App\Models\Game;
use App\Models\Promotion;
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
			->with([
				'childrens' => function ($q){
					$q->with('products');
				},
			])
			->get();

		$nyc = collect($categories)->first(function ($key, $item){
			return $item->id==3;
		});

		$vagas = collect($categories)->first(function ($key, $item){
			return $item->id==2;
		});

		return view('pages.home', compact('nyc', 'vagas', 'categories'));
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
		$offer = Promotion::first();

		return view('pages.special_offers', compact('offer'));
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

	public function getPartner()
	{
		return view('pages.partner');
	}

	public function postPartner(PartnerRequest $request)
	{
		$partner                 = new ContactPartner;
		$partner->name           = $request->name;
		$partner->address        = $request->address;
		$partner->zipcode        = $request->zipcode;
		$partner->phone          = $request->phone;
		$partner->contact_person = $request->contact_person;
		$partner->cell_phone     = $request->cell_phone;
		$partner->message        = $request->message;
		$partner->save();

		\Mail::send('mail.partner', ['partner' => $partner], function ($m) use ($partner) {
			$m->from(env('MAIL_FROM'), env('MAIL_NAME'));
			$m->to('hoadp.vn@gmail.com', $partner->name)->subject('Register Partnership');
		});
		
		return $partner;
	}
}
