<?php

namespace App\Http\Controllers\Admin;

use App\Events\Order\OrderDelete;
use App\Events\Order\UpdateStatusEvent;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.orders.index');
    }

    public function show(Order $orders)
    {
        \Javascript::put([
            'order_id' => $orders->id,
        ]);

        return view('admin.orders.show', compact('orders'));
    }

    public function update(Request $request, Order $orders)
    {
        $orders->updateOrNewStatus($orders->status)
            ->withStatus($request->status['status'])
            ->publish();
        event(new UpdateStatusEvent($orders));
        return $orders;
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);
        foreach ($ids as $key => $id) {
            $order = Order::find($id);
            event(new OrderDelete($order));
            $order->delete();
        }
        return $ids;
    }

    public function getPrints(Request $request)
    {
        $orders = Order::with('user')->whereIn('id', $request->ids)->get();
        // return $orders;
        return view('admin.layouts.print', compact('orders'));
    }

    public function getOrders(Request $request)
    {
        $keyword = $request->keyword ?: '';
        $take    = $request->take ?: 10;
        return Order::search($keyword)
            ->with(['user', 'status'])
            ->latest()
            ->paginate($take)
            ->appends(['take' => $take, 'keyword' => $keyword]);
    }

    public function getOrder(Order $order)
    {
        return $order->load(['tickets.status', 'status', 'images' => function ($q) {
            $q->latest('id');
        }]);
    }

    public function postFiles(Order $order, Request $request)
    {
        $file = $request->file('file');

        if ($file) {
            $storeFile = Image::setDir('uploads/orders')->fromForm($file);
            $image     = $order->newImage()
                ->withPath($storeFile->name)
                ->publish();

            return $image;
        }

    }

    public function deleteFile(Order $order, $id)
    {
        $image = $order->images()->whereId($id)->first();
        if ($image && $image->delete()) {
            Image::deleteImage($image->path);
            return $image;
        }
        return response(['message' => 'Can not found image!'], 400);
    }

}
