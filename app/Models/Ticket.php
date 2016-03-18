<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $appends = [
        'status',
    ];
    use StatusTrait;

    protected $casts = [
        'numbers' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //BEGIN NEW TICKET
    public function withNumbers($numbers)
    {
        sort($numbers);
        $this->numbers = $numbers;
        return $this;
    }
    public function withBall($ball)
    {
        $this->ball = $ball;
        return $this;
    }
    public function publish()
    {
        $this->save();
        return $this;
    }
    //END NEW TICKET
    public function getStatusAttribute()
    {
        return $this->with('status');
    }
}
