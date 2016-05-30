<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\CreateProductRequest;
use App\Models\Image;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.ecommerce.products.index');
    }

    public function create()
    {
        return view('admin.ecommerce.products.create');
    }

    public function store(CreateProductRequest $request)
    {
        $product = new Product;

        $product->withName($request->name)
            ->withPrice($request->price)
            ->withDescription($request->price)
            ->publish();

        $thumb = $request->file('thumb');

        if ($thumb) {
            $storeFile = Image::setDir('uploads/ecommerces')->fromForm($thumb);
            $product->newImage()
                ->withType('thumb')
                ->withPath($storeFile->name)
                ->publish();
        }

        return [
            'redirect' => route('ecommerce.admin.ecommerce.products.index'),
            'message'  => trans('message.success'),
        ];
    }
}
