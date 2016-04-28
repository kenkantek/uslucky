<?php

namespace App\Http\Controllers\Games;

use App\Billing\Billing;
use App\Billing\BillingFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MegamilionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function postMegamilion(Request $request)
    {
        $billing = new BillingFacade(
            (new Billing)->setUser($this->user)
                ->setMethod($request->method)
                ->setTickets($request->tickets)
                ->setStatus('order placed')
                ->setGameType(2)
                ->setExtra($request->extra)
                ->setDrawAt(megaNextTime()['time'])
                ->setDescription($request->description)
                ->setSource($request->source)
        );

        return $billing->save();
    }

    // numbers lucky
    public function putLuckys(Request $request)
    {
        $tickets = $request->tickets;

        $lucky1 = $this->user->luckys()
            ->whereGameId(2) // 2 = Mega Millions
            ->whereLine($request->line)
            ->first();

        $lucky = $this->user->newOrUpdateLuckys($lucky1);

        $lucky1 || $lucky = $lucky->withGame(2);

        $lucky = $lucky->withLine($request->line)
            ->withNumbers($tickets)
            ->publish();

        return $lucky;
    }

    public function getResults()
    {
        return curlGetUrl();
    }
}
