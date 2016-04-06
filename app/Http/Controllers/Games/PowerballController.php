<?php

namespace App\Http\Controllers\Games;

use App\Events\Order\UserPurchasedTicket;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\ManageGame;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use DB;
use Exception;
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
        $user = $this->user;
        return DB::transaction(function () use ($user, $request) {
            // Save to Order
            $order = $user->newOrder()
            ->withGame(Game::find(1))
            ->withExtra((bool) $request->extra)
            ->withDrawAt(powerballNextTime()['time'])
            ->withDescription($request->description)
            ->publish();

            // Add status
            $order->updateOrNewStatus()
            ->withStatus('wait for purchase')
            ->publish();

            // Save to Ticket
            $order->newMultiTicket($request->tickets);

            // Payment it
            if ($request->method == 1) {
                $res = $this->chargeFromBalance($user, $request);
                //event Email
            } else {
                $res = $this->chargeFromCredit($user, $request);
            }
            //event Mail
            event(new UserPurchasedTicket($order));
            return $res === true ? $order : response(['message' => $res], 400);
        });
    }

    // Return $amount
    protected function chargeFromBalance($user, $request)
    {
        $balance       = $user->balance; // prev
        $amount        = $this->calculateAmount($request);
        $balance_total = $balance - $amount;

        try {
            $transaction = $user->newTransaction()
                ->withType(2)
                ->withAmount($amount)
                ->withAmountPrev($balance)
                ->withAmountTotal($balance_total)
                ->withDescription($request->description)
                ->publish();

            // Transaction add status
            $status = $transaction->updateOrNewStatus()
                ->withStatus('succeeded')
                ->publish();

            $amount = $user->updateAmount($user->amount)
                ->withAmount($balance_total)
                ->publish();
            return true;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected function chargeFromCredit($user, $request)
    {
        $balance       = $user->balance; // prev
        $amount        = $this->calculateAmount($request);
        $balance_total = $balance - $amount;

        try {
            //Charge Stripe
            $charge = Stripe::charges()->create([
                'source'        => $request->source,
                'currency'      => 'USD',
                'amount'        => $amount,
                'description'   => $request->description,
                'receipt_email' => $user->email,
            ]);

            if (!$charge['failure_code']) {
                // Transaction
                $transaction = $user->newTransaction()
                    ->withType(2)
                    ->withAmount($amount)
                    ->withAmountPrev($balance)
                    ->withAmountTotal($balance_total)
                    ->withDescription($request->description)
                    ->publish();

                // Transaction add status
                $status = $transaction->updateOrNewStatus()
                    ->withStatus($charge['status'])
                    ->publish();
            }
            return true;

        } catch (Cartalyst\Stripe\Exception\BadRequestException $e) {
            $message = $e->getMessage();
        } catch (Cartalyst\Stripe\Exception\UnauthorizedException $e) {
            $message = $e->getMessage();
        } catch (Cartalyst\Stripe\Exception\InvalidRequestException $e) {
            $message = $e->getMessage();
        } catch (Cartalyst\Stripe\Exception\NotFoundException $e) {
            $message = $e->getMessage();
        } catch (Cartalyst\Stripe\Exception\CardErrorException $e) {
            $message = $e->getMessage();
        } catch (Cartalyst\Stripe\Exception\ServerErrorException $e) {
            $message = $e->getMessage();
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    // tinh toan Amount from client
    protected function calculateAmount($request)
    {
        $config = ManageGame::getConfig(1)->toArray();
        $amount = count($request->tickets) * $config['each_per_ticket'];
        if ($request->extra) {
            $amount += count($request->tickets) * $config['extra_per_ticket'];
        }
        return $amount;
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
