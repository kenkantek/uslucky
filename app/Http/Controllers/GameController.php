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

    public function getIndex()
    {
        return view('games.index');
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
            '_luckys' => $this->user ? $this->user->luckys()->whereGameId(1)->pluck('numbers', 'line') : [],
        ]);
        return view('games.powerball');
    }

    public function getMegamillions()
    {
        Javascript::put(array_add(ManageGame::getConfig(2)->toArray(), '_powerball', megaNextTime()));
        JavaScript::put([
            '_stripe' => [
                'key' => config('services.stripe.key'),
            ],
            '_date'   => [
                'month' => generateMonth(),
                'year'  => generateYear(15),
            ],
            '_luckys' => $this->user ? $this->user->luckys()->whereGameId(2)->pluck('numbers', 'line') : [],
        ]);
        return view('games.megamillions');
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
