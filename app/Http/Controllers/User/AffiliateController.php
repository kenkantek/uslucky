<?php

namespace App\Http\Controllers\User;

use App\Models\Affiliate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AffiliateController extends Controller
{
    public function getAffiliate()
    {
	    return Affiliate::with('affiliates')->where('user_id',\Auth::user()->id)->get();
    }
	
	public function postAffiliate()
	{
		$aff = new Affiliate;
		$aff->user_id = \Auth::user()->id;
		$aff->code = str_random(8);
		$aff->save();

		return $aff;
	}
}
