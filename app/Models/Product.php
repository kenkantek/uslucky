<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ImageTrait;

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

    //ACCESSOR
    public function getThumbAttribute()
    {
        $thumb = $this->images()->first();
        return $thumb ? asset($thumb->path) : null;
    }
}
