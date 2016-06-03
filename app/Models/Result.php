<?php

namespace App\Models;

use App\Events\AwardEvent;
use App\Traits\StatusTrait;
use App\VerifyingTicket\VerifyMega;
use App\VerifyingTicket\VerifyPowerball;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Result extends Model
{
    use Eloquence, StatusTrait;

    protected $fillable          = ['numbers', 'ball', 'multiplier', 'annuity', 'draw_at'];
    protected $dates             = ['created_at', 'updated_at', 'draw_at'];
    protected $casts             = ['numbers' => 'array'];
    protected $searchableColumns = [
        'numbers', 'annuity', 'draw_at',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }

    public function awards()
    {
        return $this->hasMany(Award::class);
    }

    // BEGIN new Result
    public function withNj($nj)
    {
        $this->nj_id = $nj;
        return $this;
    }

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

    public function withMultiplier($multiplier)
    {
        $this->multiplier = $multiplier;
        return $this;
    }

    public function withAnnuity($annuity)
    {
        $this->annuity = $annuity;
        return $this;
    }

    public function withDrawAt($draw_at)
    {
        $this->draw_at = $draw_at;
        return $this;
    }

    public function publish()
    {
        $this->save();
        return $this;
    }
    // END new Result

    public function getDrawAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    public function scopeGameId($query, $type = 1)
    {
        return $query->where('game_id', $type);
    }

    public function calculateWinning()
    {
        return $this->verifyTickets($this->getTickets());
    }

    protected function getTickets()
    {
        $draw_at = Carbon::parse($this->draw_at)->toDateString();
        return Ticket::whereHas('order', function ($q) use ($draw_at) {
            $q->whereDate('draw_at', '=', $draw_at);
        })->get();
    }

    protected function verifyTickets($tickets)
    {
        $final = [];
        foreach ($tickets as $ticket) {
            $game_id = $ticket->order->game_id;

            switch ($game_id) {
                case 1:
                    $verify = $ticket->verifyTicket($this, new VerifyPowerball);
                    break;
                case 2:
                    $verify = $ticket->verifyTicket($this, new VerifyMega);
                    break;

                default:
                    $verify = false;
                    break;
            }

            if ($verify) {
                // verify là ticket có chiến thắng

                //Add  new Award
                $award = $verify->newAward()
                    ->withLevel($verify->level)
                    ->withResult($this)
                    ->withAddAward($verify->add_award)
                    ->publish();

                //status for award
                $status = $award->updateOrNewStatus()
                    ->withStatus('unpaid')
                    ->publish();

                //Transaction
                $this->makeTransaction($verify, $award);

                event(new AwardEvent($verify, $verify->makePrizeMoney($this)));

                array_push($final, $status);
            }
        }
        return $final; //tickets trúng thưởng
    }

    protected function makeTransaction(Ticket $ticket, Award $award)
    {
        $prizeMoney = $ticket->makePrizeMoney($this);
        $order      = $ticket->order;
        $user       = $order->user;
        $balance    = $user->balance;

        // var_dump($award);
        $transaction = $award->newTransaction($user)
            ->withType(1)
            ->withAmount($prizeMoney)
            ->withAmountPrev($balance)
            ->withAmountTotal($prizeMoney + $balance)
            ->withDescription(trans('transaction.winner', ['order' => $order->id]))
            ->publish();

        // Transaction add status
        $status = $transaction->updateOrNewStatus()
            ->withStatus('succeeded')
            ->publish();

        // update Amount
        $user->updateAmount($user->amount)
            ->withAmount($prizeMoney + $balance)
            ->publish();
    }

}
