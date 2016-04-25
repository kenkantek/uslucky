<?php
namespace App\VerifyingTicket;

use App\Models\Result;
use App\Models\Ticket;

interface VerifyTicketInterface
{
    public function verify(Ticket $ticket, Result $result, $match_numbers, $ball);
}
