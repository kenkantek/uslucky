<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promotion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
	public function index()
	{
		$promotion = Promotion::first();

		return view('admin.promotion.index', compact('promotion'));
	}

	public function apiPromotion()
	{
		return $promotion = Promotion::first();
	}

	public function update(Request $request, $id)
	{
		Promotion::where('id',$id)->update([
			'name'     => $request->name,
			'amount'   => $request->amount,
			'status'   => $request->status,
			'contents' => $request->contents,
		]);

		return 'done';

	}
}
