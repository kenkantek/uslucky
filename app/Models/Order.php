<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = ['created_at', 'updated_at', 'draw_at'];

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
    public function withDrawAt($draw_at)
    {
        $d = explode('/', $draw_at);
        (count($d) !== 3) && abort(500, 'Something bad happened');
        $this->draw_at = Carbon::create($d[2], $d[0], $d[1], 0);
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
