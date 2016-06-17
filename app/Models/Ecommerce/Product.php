<?php

namespace App\Models\Ecommerce;

use App\Models\Image;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ImageTrait;

    protected $table = 'ecommerce_products';

    protected $appends = [
        'thumb',
    ];

    //BEGIN NEW PRODUCT
    public function withName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function withDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    public function withPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    public function withContent($content)
    {
        $this->content = $content;
        return $this;
    }
    public function publish()
    {
        $this->save();
        return $this;
    }
    //END NEW PRODUCT

    //RELATIONSHIP
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'ecommerce_order_product')
            ->withPivot('count', 'price');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ecommerce_category_product');
    }

    //ACCESSOR
    public function getThumbAttribute()
    {
        $thumb = $this->images()->first();
        return $thumb ? asset($thumb->path) : null;
    }
}
