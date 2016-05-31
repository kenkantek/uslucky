<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use JavaScript;

class CartController extends Controller
{
    public function index()
    {
        JavaScript::put([
            '_stripe' => [
                'key' => config('services.stripe.key'),
            ],
            '_date'   => [
                'month' => generateMonth(),
                'year'  => generateYear(15),
                'now'   => Carbon::now()->format('m/d/Y H:i:s'),
            ],
        ]);

        return view('ecommerce.cart');
    }
}
