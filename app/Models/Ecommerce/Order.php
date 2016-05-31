<?php

namespace App\Models\Ecommerce;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'ecommerce_orders';

    //BEGIN NEW ORDER
    public function withTotal($total)
    {
        $this->total = $total;
        return $this;
    }
    public function withDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    public function publish()
    {
        $this->save();
        return $this;
    }
    //END NEW ORDER

    //RELATIONSHIP
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'ecommerce_order_product');
    }
}
