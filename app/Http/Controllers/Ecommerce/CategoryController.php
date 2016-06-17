<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return $category->load('products');
    }
}
