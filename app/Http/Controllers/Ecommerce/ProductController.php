<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load(['images' => function ($q) {
            $q->whereType('images');
        }]);
        return view('ecommerce.products.show', compact('product'));
    }
}
