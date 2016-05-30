<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.products.add');
    }

    public function index()
    {
        return view('admin.products.list');
    }
}
