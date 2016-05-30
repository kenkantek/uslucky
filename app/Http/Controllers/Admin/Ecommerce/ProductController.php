<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.ecommerce.products.create');
    }

    public function index()
    {
        return view('admin.ecommerce.products.index');
    }
}
