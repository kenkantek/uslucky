<?php

namespace App\Http\Controllers;

use App\Models\ManageGame;
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
        Javascript::put(array_add(ManageGame::getConfig(1)->toArray(), '_powerball', powerballNextTime()));
        JavaScript::put([
            '_stripe' => [
                'key' => config('services.stripe.key'),
            ],
            '_date'   => [
                'month' => generateMonth(),
                'year'  => generateYear(15),
            ],
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
