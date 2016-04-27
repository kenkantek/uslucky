<?php
namespace App\VerifyingTicket;

use App\Models\Result;
use App\Models\Ticket;

class VerifyMega extends VerifyTicketAbstract implements VerifyTicketInterface
{

    public function verify(Ticket $ticket, Result $result, $match_numbers, $ball)
    {
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

        return $prize ? $this->afterVerify($ticket, $result, $prize) : false;
    }
}
