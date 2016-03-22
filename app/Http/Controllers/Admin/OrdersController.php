<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function getOrders(Request $request)
    {
        $take    = $request->take ?: 10;
        $keyword = $request->keyword ?: '';
        $query   = [null, 'game.name', 'user.first_name', 'user.last_name', 'user.email'];
        $result  = collect([]);

        foreach ($query as $q) {
            $tmp = Order::search($keyword, $q ? [$q] : []);

            if (count($tmp->get())) {

                $result->push(
                    $tmp->with('user')
                        ->latest()
                        ->paginate($take)
                        ->appends(['keyword' => $keyword, 'take' => $take])->toArray()
                );
            }
        }

        return $result->collapse()->unique();
    }

}
