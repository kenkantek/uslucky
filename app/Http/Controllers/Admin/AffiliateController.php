<?php

namespace App\Http\Controllers\Admin;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AffiliateController extends Controller
{
	public function index()
	{
		return view('admin.affiliate.index');
	}

	public function update()
	{

	}

	public function getConfig()
	{
		return view('admin.affiliate.config');
	}

	public function getApprove()
	{
		return view('admin.affiliate.non-approve');
	}

	//api
	public function getAffiliate(Request $request)
	{
		$keyword = $request->keyword ?: '';
		$take    = $request->take ?: 10;

		return User::with('affiliate')->search($keyword)
			->whereHas('affiliate', function ($q){
				$q->where('type', 0);
			})
			->latest()
			->paginate($take)
			->appends(['take' => $take, 'keyword' => $keyword]);
	}

	public function getMember(Request $request)
	{
		$keyword = $request->keyword ?: '';
		$take    = $request->take ?: 10;

		return User::with('affiliate')->search($keyword)
			->whereHas('affiliate', function ($q){
				$q->where('type', '<>', 0);
			})
			->latest()
			->paginate($take)
			->appends(['take' => $take, 'keyword' => $keyword]);
	}

	public function putType(Request $request, $id)
	{
		$aff         = Affiliate::where('user_id', $id)->first();
		$aff->type   = $request->type;
		$aff->avalue = $request->avalue;
		$aff->save();

		return $aff;
	}
}
