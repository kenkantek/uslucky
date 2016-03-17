<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
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

    public function updateOrNewStatus($status = null)
    {
        $status = $status instanceof Status ? $status : new Status;
        $status->statusable()->associate($this);
        $status->regarding($this);
        $status->status = 'waiting'; //default
        return $status;
    }
}
