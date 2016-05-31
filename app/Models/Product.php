<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ImageTrait;

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
    
}
