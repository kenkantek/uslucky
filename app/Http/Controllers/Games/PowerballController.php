<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Models\Game;
use DB;
use Illuminate\Http\Request;

class PowerballController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function postPowerball(Request $request)
    {
        // return $request->all();
        $user = $this->user;
        return DB::transaction(function () use ($user, $request) {
            // Save to Order
            $order = $user->newOrder()
            ->withGame(Game::find(1))
            ->withExtra($request->extra)
            ->withDrawAt(powerballNextTime()['time'])
            ->publish();

            // Save to Ticket
            $order->newMultiTicket($request->tickets);

            // Payment it
            if ($request->method == 1) {
                // Account balance

            } else {
                //Credit card
            }

            return $order;
        });
    }
}
