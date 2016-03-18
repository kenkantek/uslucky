<?php

namespace App\Http\Controllers;

use Javascript;

class GameController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['only' => 'getPayment']);
        $this->middleware('game_time');
    }

    public function getPowerball()
    {
        Javascript::put([
            '_powerball'        => powerballNextTime(),
            '_each_per_ticket'  => env('EACH_PER_TICKET'),
            '_extra_per_ticket' => env('EXTRA_PER_TICKET'),
        ]);
        return view('games.powerball');
    }

    // Lay thong tin de Purchase
    public function getPayment()
    {
        return response([
            'amount'   => $this->user->balance,
            'payments' => $this->user->payments,
        ]);
    }

}
