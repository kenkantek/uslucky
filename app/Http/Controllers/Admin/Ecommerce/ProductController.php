<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\CreateProductRequest;
use App\Models\Image;
use App\Models\Product;
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
    
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.ecommerce.products.edit', compact('product'));
    }

    public function postUpdate(Request $request, $id)
    {
        $product = Product::with('images')->find($id);
        $product->withName($request->name)
            ->withPrice($request->price)
            ->withDescription($request->price)
            ->publish();

        $thumb = $request->file('thumb');

        if ($thumb) {
            \File::delete($product->images->first()->path);
            Image::destroy($product->images->first()->id);
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
    
    public function getApi(Request $request)
    {
        $take     = $request->take ?: 10;
        $products = Product::latest()
            ->paginate($take);
        return $products;
    }
    
    public function getShow($id)
    {
        $product = Product::find($id);
        return $product;
    }
}
