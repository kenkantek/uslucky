<?php

namespace App\Models;

use App\Events\AwardEvent;
use App\Traits\StatusTrait;
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
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
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
        $draw_at = Carbon::createFromFormat('Y-m-d', $this->draw_at)->toDateString();
        return Ticket::whereHas('order', function ($q) use ($draw_at) {
            $q->whereDate('draw_at', '=', $draw_at);
        })->get();
    }

    protected function verifyTickets($tickets)
    {
        $final = [];
        foreach ($tickets as $ticket) {
            $verify = $this->verifyTicket($ticket);
            if ($verify) {
                // verify là ticket có chiến thắng
                // dd($verify->award->level->award);
                $award = $verify->newAward()
                    ->withLevel($verify->level)
                    ->withAddAward($verify->add_award)
                    ->publish();
                //status for award
                $status = $award->updateOrNewStatus()
                    ->withStatus('unpaid')
                    ->publish();

                event(new AwardEvent($verify));
                array_push($final, $status);
            }
        }
        return $final; //tickets trúng thưởng
    }

    protected function verifyTicket($ticket)
    {
        if ($ticket->order->status->status != 'purchased') {
            return false;
        }

        $match_numbers = collect($ticket->numbers)->intersect($this->numbers)->count();
        $ball          = $ticket->ball == $this->ball;

        $prize = 0;
        if ($match_numbers == 5) {
            if ($ball) {
                //jackpot = Prize 1
                $prize = 1;
            } else {
                // Prize 2
                $prize = 2;
            }
        } elseif ($match_numbers == 4) {
            if ($ball) {
                //Prize 3
                $prize = 3;
            } else {
                // Prize 4
                $prize = 4;
            }
        } elseif ($match_numbers == 3) {
            if ($ball) {
                //Prize 5
                $prize = 5;
            } else {
                // Prize 6
                $prize = 6;
            }
        } elseif ($match_numbers == 2 && $ball) {
            //Prize 7
            $prize = 7;
        } elseif ($match_numbers == 1 && $ball) {
            //Prize 8
            $prize = 8;
        } elseif ($match_numbers == 0 && $ball) {
            //Prize 9
            $prize = 9;
        }
        $ticket->level     = Level::whereLevel($prize)->first();
        $ticket->add_award = $prize === 1 ? $this->annuity : 0;
        return $prize ? $ticket : false;
    }
}
