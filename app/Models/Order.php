<?php

namespace App\Models;

use App\Traits\ImageTrait;
use App\Traits\StatusTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Order extends Model
{
    use Eloquence, StatusTrait, ImageTrait;

    protected $searchableColumns = [
        'id', 'description', 'draw_at', 'created_at',
        'user.email', 'user.last_name', 'user.first_name', 'game.name',
    ];
    protected $dates   = ['created_at', 'updated_at', 'draw_at'];
    protected $appends = ['ticket_total', 'price', 'url', 'game_name'];

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
        $d = explode('/', $draw_at);
        (count($d) !== 3) && abort(500, 'Something bad happened');
        $this->draw_at = Carbon::create($d[2], $d[0], $d[1], env('HOURS_BEFORE_CLOSE'));
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
        return count($this->tickets);
    }

    public function getPriceAttribute()
    {
        $price = $this->ticket_total * env('EACH_PER_TICKET');
        if ($this->extra) {
            $price += $this->ticket_total * env('EXTRA_PER_TICKET');
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

    public function getDrawAtAttribute($date)
    {
        return Carbon::parse($date)->toFormattedDateString();
    }

    public function getGameNameAttribute()
    {
        return $this->game->name;
    }

}
