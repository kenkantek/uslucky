<?php

namespace App\Models\Ecommerce;

use App\Models\Status;
use App\Models\User;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Order extends Model
{
    use StatusTrait, Eloquence;

    protected $table = 'ecommerce_orders';

    protected $searchableColumns = [
        'description', 'total',
        'user.email', 'user.last_name', 'user.first_name',
    ];

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
    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'ecommerce_order_product')
            ->withPivot('count', 'price');
    }
}
