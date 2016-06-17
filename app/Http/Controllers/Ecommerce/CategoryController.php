<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $category->load('products');

        return view('ecommerce.categories.show', compact('category'));
    }
}
