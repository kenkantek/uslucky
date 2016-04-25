<?php

namespace App\VerifyingTicket;

use App\Models\Level;
use App\Models\Result;
use App\Models\Ticket;

abstract class VerifyTicketAbstract
{
    private $game_id = 1;

    public function updateStatusTicket(Ticket $ticket, $status = 'fail')
    {
        $ticket->updateOrNewStatus($ticket->status)->withStatus($status)->publish();
    }

    public function setGameType($game_id)
    {
        $this->game_id = $game_id;
    }

    public function getLevel($prize)
    {
        return Level::whereGameId($this->game_id)->whereLevel($prize)->firstOrFail();
    }

    public function afterVerify(Ticket $ticket, Result $result, $prize)
    {
        $ticket->level = $this->getLevel($prize);

        $ticket->add_award = $prize === 1 ? $result->annuity : 0;

        $this->updateStatusTicket($ticket, $prize ? 'won' : 'fail');

        return $ticket;
    }
}
