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

    protected $appends = ['reward'];

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
        $level = $this->level;
        $prize = $this->add_award + $level->award;
        $extra = $level->level == 1 ? false : $this->order->extra;

        return $this->finalReward($extra, $result->multiplier * $prize, $prize);
    }

    public function getRewardAttribute()
    {
        return $this->award ? $this->reward($this->award) : 0;
    }

    private function reward($award)
    {
        $prize = $award->level->award + $award->add_award;
        $extra = $award->level->level == 1 ? false : $this->order->extra;

        return $this->finalReward($extra, $prize * $award->result->multiplier, $prize);
    }

    private function finalReward($extra, $total, $prize)
    {
        switch ($this->order->game_id) {
            case 1:
                $min = 2000000;
                break;
            default:
                break;
        }

        return $extra ? (isset($min) ? min($min, $total) : $total) : $prize;
    }
}
