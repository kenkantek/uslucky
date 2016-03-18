<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $appends = ['ticket_total', 'price', 'url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
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
        return count(Ticket::whereOrderId($this->id)->get());
    }

    public function getPriceAttribute()
    {
        return ($this->ticket_total * 2) + ($this->extra * $this->ticket_total);
    }

    public function getUrlAttribute()
    {
        return route('front::settings.ticket', $this->id);
    }

}
