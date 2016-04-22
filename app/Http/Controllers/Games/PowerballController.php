<?php

namespace App\Http\Controllers\Games;

use App\Billing\Billing;
use App\Billing\BillingFacade;
use App\Http\Controllers\Controller;
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
        $billing = new BillingFacade(
            (new Billing)->setUser($this->user)
                ->setMethod($request->method)
                ->setTickets($request->tickets)
                ->setStatus('order placed')
                ->setGameType(1)
                ->setExtra($request->extra)
                ->setDrawAt(powerballNextTime()['time'])
                ->setDescription($request->description)
                ->setSource($request->source)
        );

        return $billing->save();
    }

    public function putLuckys(Request $request)
    {
        $tickets = $request->tickets;

        $lucky1 = $this->user->luckys()
            ->whereGameId(1) // 1 = Powerball
            ->whereLine($request->line)
            ->first();

        $lucky = $this->user->newOrUpdateLuckys($lucky1);

        $lucky1 || $lucky = $lucky->withGame(1);

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
