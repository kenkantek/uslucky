<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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
}
