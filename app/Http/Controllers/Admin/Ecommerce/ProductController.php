<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\CreateProductRequest;
use App\Http\Requests\Ecommerce\UpdateProductRequest;
use App\Models\Ecommerce\Category;
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
            'redirect' => route('ecommerce.admin.ecommerce.product.edit', $product->id),
            'message'  => trans('message.success'),
        ];
    }

    public function edit(Product $product)
    {
        $categories = Category::whereParentId(0)
            ->with('childrens')
            ->get();

        return view('admin.ecommerce.products.edit', compact('product', 'categories'));
    }

    public function show(Product $product)
    {
        return collect($product)->merge([
            'categories' => $product->categories()->pluck('id', 'id'),
        ]);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {

        $product->withName($request->name)
            ->withPrice($request->price)
            ->withDescription($request->price)
            ->publish();

        $product->categories()->sync((array) json_decode($request->categories));

        $thumb = $request->file('thumb');

        if ($thumb) {
            $image_first = $product->images()->first();

            Image::deleteImage($image_first->getOriginal()['path']);

            $storeFile = Image::setDir('uploads/ecommerces')->fromForm($thumb);

            $product->newImage($image_first)
                ->withType('thumb')
                ->withPath($storeFile->name)
                ->publish();
        }

        return [
            'redirect' => route('ecommerce.admin.ecommerce.product.index'),
            'message'  => trans('message.success'),
        ];
    }

    public function destroy(Product $product)
    {
        $image_first = $product->images()->first();
        Image::deleteImage($image_first->getOriginal()['path']);
        $product->delete();
        return;
    }

    public function apiGetProducts(Request $request)
    {
        $take = $request->take ?: 10;

        $product = Product::latest()
            ->paginate($take);

        return $product;
    }
}
