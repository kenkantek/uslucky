<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\DiscountCreateRequest;
use App\Http\Requests\Admin\Discount\DiscountEditRequest;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        return view('admin.discounts.index');
    }

    public function create()
    {
        return view('admin.discounts.create');
    }

    public function store(DiscountCreateRequest $request)
    {
        $discount = (new Discount())
            ->withName($request->name)
            ->withDescription($request->description)
            ->withCode($request->code)
            ->withBeginAt($request->begin_at)
            ->withEndAt($request->end_at)
            ->publish();

        return response()->json([
            'message'  => trans('message.success'),
            'redirect' => route('admin.discount.index'),
        ]);
    }

    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    public function update(Discount $discount, DiscountEditRequest $request)
    {
        $discount
            ->withName($request->name)
            ->withDescription($request->description)
            ->withCode($request->code)
            ->withBeginAt($request->begin_at)
            ->withEndAt($request->end_at)
            ->withActive($request->active)
            ->publish();

        return response()->json([
            'message'  => trans('message.success'),
            'redirect' => route('admin.discount.index'),
        ]);
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();

        return response()->json(['message' => trans('message.success')]);
    }

    //API
    public function apiIndex(Request $request)
    {
        $keyword = $request->keyword ?: '';
        $take    = $request->take ?: 10;

        return Discount::search($keyword)
            ->latest()
            ->paginate($take)
            ->appends(['take' => $take, 'keyword' => $keyword]);
    }

    public function autocomplete(Request $request)
    {
        return Discount::search($request->keyword)
            ->latest()
            ->take(15)
            ->get();
    }
}
