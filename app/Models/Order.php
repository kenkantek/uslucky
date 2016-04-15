<?php

namespace App\Models;

use App\Traits\ImageTrait;
use App\Traits\StatusTrait;
use App\Traits\TransactionTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Order extends Model
{
    use Eloquence, StatusTrait, ImageTrait, TransactionTrait;

    protected $searchableColumns = [
        'id', 'draw_at',
        'user.email', 'user.last_name', 'user.first_name',
    ];
    protected $dates   = ['created_at', 'updated_at', 'draw_at'];
    protected $appends = ['draw_date', 'ticket_total', 'price', 'url', 'game_name', 'multiplier'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    //BEGIN NEW ORDER
    public function withExtra($extra)
    {
        $this->extra = $extra;
        return $this;
    }
    public function withGame(Game $game)
    {
        $this->game()->associate($game);
        return $this;
    }
    public function withDrawAt($draw_at)
    {
        $this->draw_at = Carbon::parse($draw_at);
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

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function newTicket()
    {
        $ticket = new Ticket;
        $ticket->order()->associate($this);
        return $ticket;
    }

    public function newMultiTicket($tickets)
    {
        $newTickets = [];
        foreach ($tickets as $ticket) {
            $newTicket = $this->newTicket()
                ->withNumbers($ticket['numbers'])
                ->withBall($ticket['ball'])
                ->publish();

            $status = $newTicket->updateOrNewStatus()
                ->withStatus('waiting')
                ->publish();

            array_push($newTickets, $newTicket);
        }
        $this->tickets()->saveMany($newTickets);
        return $this;
    }

    public function getTicketTotalAttribute()
    {
        return $this->tickets()->count();
    }

    public function getPriceAttribute()
    {
        $config = ManageGame::getConfig(1)->toArray();
        $price  = $this->ticket_total * $config['each_per_ticket'];
        if ($this->extra) {
            $price += $this->ticket_total * $config['extra_per_ticket'];
        }
        return $price;
    }

    public function getUrlAttribute()
    {
        return route('front::orders.show', $this->id);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->toFormattedDateString();
    }

    public function getDrawDateAttribute()
    {
        return Carbon::parse($this->draw_at)->toFormattedDateString();
    }

    public function getMultiplierAttribute()
    {
        $result = Result::whereGameId($this->game_id)
            ->whereDate('draw_at', '=', $this->draw_at)->first();
        return $result ? $result->multiplier : null;
    }

    public function getGameNameAttribute()
    {
        return $this->game()->first()->name;
    }

    public function getDescriptionAttribute($data)
    {
        return trim($data) ? $data : 'N/A';
    }

    public function refundOrder()
    {
        $user    = $this->user;
        $price   = $this->price;
        $balance = $user->balance;

        $transaction = $this->newTransaction($user)
            ->withType(1)
            ->withAmount($price)
            ->withAmountPrev($balance)
            ->withAmountTotal($price + $balance)
            ->withDescription("Account Refund money of order #{$this->id}")
            ->publish();
        // Transaction add status
        $status = $transaction->updateOrNewStatus()
            ->withStatus('succeeded')
            ->publish();

        // update Amount
        $user->updateAmount($user->amount)
            ->withAmount($price + $balance)
            ->publish();
    }

}
