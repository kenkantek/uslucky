<?php

namespace App\Models;

use App\Traits\StatusTrait;
use App\VerifyingTicket\VerifyTicketInterface;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use StatusTrait;

    protected $casts = [
        'numbers' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }

    public function award()
    {
        return $this->hasOne(Award::class);
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

    public function newAward()
    {
        $award = new Award;
        $award->ticket()->associate($this);
        return $award;
    }

    public function verifyTicket(Result $result, VerifyTicketInterface $verifyTicket)
    {
        $match_numbers = collect($this->numbers)->intersect($result->numbers)->count();
        $ball          = $this->ball == $result->ball;
        return $verifyTicket->verify($this, $result, $match_numbers, $ball);
    }

    public function makePrizeMoney(Result $result)
    {
        $level      = $this->level;
        $prizeMoney = $this->add_award + $level->award;
        $extra      = $level->level == 1 ? false : $this->order->extra;
        return $extra ? min(2000000, $result->multiplier * $prizeMoney) : $prizeMoney;
    }

}
