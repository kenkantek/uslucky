<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return $product;
    }
}
