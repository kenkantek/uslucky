<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Events\Ecommerce\OrderUpdateStatusEvent;
use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Order as EcommerceOrder;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.ecommerce.orders.index');
    }

    public function show(EcommerceOrder $order)
    {
        return view('admin.ecommerce.orders.show', compact('order'));
    }

    public function apiIndex(Request $request)
    {
        $keyword = $request->keyword ?: '';

        $take = $request->take ?: 10;

        return EcommerceOrder::search($keyword)
            ->with(['user', 'status'])
            ->withCount('products')
            ->latest()
            ->paginate($take)
            ->appends(['take' => $take, 'keyword' => $keyword]);
    }

    public function apiShow(EcommerceOrder $order)
    {
        return $order->load(['user', 'status', 'products']);
    }

    public function apiUpdateStatus(EcommerceOrder $order, Request $request)
    {
        return DB::transaction(function () use ($order, $request) {

            $order->updateOrNewStatus($order->status)
                ->withStatus($request->status['status'])
                ->publish();

            if($request->status['status'] != 'pending purchase') {
                event(new OrderUpdateStatusEvent($order, $this->user));
            }

            return;
        });

    }
}
