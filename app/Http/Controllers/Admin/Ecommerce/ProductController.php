<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\CreateProductRequest;
use App\Http\Requests\Ecommerce\UpdateProductRequest;
use App\Models\Ecommerce\Product;
use App\Models\Image;
use Illuminate\Http\Request;

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

    public function edit(Product $products)
    {
        return view('admin.ecommerce.products.edit', compact('products'));
    }

    public function update(Product $products, UpdateProductRequest $request)
    {
        $products->withName($request->name)
            ->withPrice($request->price)
            ->withDescription($request->price)
            ->publish();

        $thumb = $request->file('thumb');

        if ($thumb) {
            $image_first = $products->images()->first();

            Image::deleteImage($image_first->getOriginal()['path']);

            $storeFile = Image::setDir('uploads/ecommerces')->fromForm($thumb);

            $products->newImage($image_first)
                ->withType('thumb')
                ->withPath($storeFile->name)
                ->publish();
        }

        return [
            'redirect' => route('ecommerce.admin.ecommerce.products.index'),
            'message'  => trans('message.success'),
        ];
    }

    public function apiGetShow(Product $products)
    {
        return $products;
    }

    public function apiGetProducts(Request $request)
    {
        $take = $request->take ?: 10;

        $products = Product::latest()
            ->paginate($take);

        return $products;
    }
}
