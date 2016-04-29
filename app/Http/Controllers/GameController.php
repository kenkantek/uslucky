<?php

namespace App\Http\Controllers;

use App\Models\ManageGame;
use Carbon\Carbon;
use Javascript;

class GameController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['only' => 'getPayment']);
        $this->middleware('game_time');

        JavaScript::put([
            '_stripe' => [
                'key' => config('services.stripe.key'),
            ],
            '_date'   => [
                'month' => generateMonth(),
                'year'  => generateYear(15),
                'now'   => Carbon::now()->format('m/d/Y H:i:s'),
            ],
        ]);
    }

    public function getIndex()
    {
        return view('games.index');
    }

    public function getPowerball()
    {
        $game_id = 1;
        Javascript::put(array_add(ManageGame::getConfig($game_id)->toArray(), '_nextTime', powerballNextTime()));
        JavaScript::put([
            '_game_id' => $game_id,
            '_luckys'  => $this->user ? $this->user->luckys()->whereGameId($game_id)->pluck('numbers', 'line') : [],
        ]);
        return view('games.powerball');
    }

    public function getMegamillions()
    {
        $game_id = 2;
        Javascript::put(array_add(ManageGame::getConfig($game_id)->toArray(), '_nextTime', megaNextTime()));
        JavaScript::put([
            '_game_id' => $game_id,
            '_luckys'  => $this->user ? $this->user->luckys()->whereGameId($game_id)->pluck('numbers', 'line') : [],
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
