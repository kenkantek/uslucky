<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function apiProducts()
    {
        $products = Product::all();
        return array_chunk($products->toArray(), 2);
    }
}
