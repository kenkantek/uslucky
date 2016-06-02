<?php

namespace App\Http\Controllers\Ecommerce;

use App\Events\Ecommerce\OrderCreateStatusEvent;
use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Order as EcommerceOrder;
use App\Models\Ecommerce\Product;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use DB;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('ecommerce.orders.index');
    }

    public function show(EcommerceOrder $order)
    {
        return view('ecommerce.orders.show');
    }

    public function store(Request $request)
    {

        return DB::transaction(function () use ($request) {
            $user         = $this->user;
            $balance      = $user->balance;
            $amount       = $this->makeAmount($request->carts);
            $amount_total = $balance - $amount;

            //save to EcommerceOrder
            $order = $user->newEcommerceOrder()
                ->withTotal($amount)
                ->withDescription($request->description)
                ->publish();

            // add status
            $order->updateOrNewStatus()
                ->withStatus('pendding')
                ->publish();

            foreach ($request->carts as $cart) {
                $order->products()->attach($cart['data']['id'], [
                    'count' => $cart['count'],
                    'price' => $cart['data']['price'],
                ]);
            }

            if ($request->method == 1) {
                //from balance
                $message = $this->payWithBalance($user, $amount, $balance, $amount_total, $request->description);

            } else {
                //Credit card
                $message = $this->payWithCreditCard($user, $amount, $balance, $amount_total, $request);
            }

            event(new OrderCreateStatusEvent($order, $user));

            return $message ? response(['message' => 'Success']) : response(['message' => $message], 401);
        });

    }

    private function payWithBalance($user, $amount, $balance, $amount_total, $description)
    {
        try {
            $transaction = $user->newTransaction()
                ->withType(2)
                ->withAmount($amount)
                ->withAmountPrev($balance)
                ->withAmountTotal($amount_total)
                ->withDescription($description)
                ->publish();

            // Transaction add status
            $status = $transaction->updateOrNewStatus()
                ->withStatus('succeeded')
                ->publish();

            $amount = $user->updateAmount($user->amount)
                ->withAmount($amount_total)
                ->publish();

            return true;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function payWithCreditCard($user, $amount, $balance, $amount_total, Request $request)
    {
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
                    ->withAmountTotal($amount_total)
                    ->withDescription($request->description)
                    ->publish();

                // Transaction add status
                $status = $transaction->updateOrNewStatus()
                    ->withStatus($charge['status'])
                    ->publish();
            }
            return true;

        } catch (\Cartalyst\Stripe\Exception\BadRequestException $e) {
            $message = $e->getMessage();
        } catch (\Cartalyst\Stripe\Exception\UnauthorizedException $e) {
            $message = $e->getMessage();
        } catch (\Cartalyst\Stripe\Exception\InvalidRequestException $e) {
            $message = $e->getMessage();
        } catch (\Cartalyst\Stripe\Exception\NotFoundException $e) {
            $message = $e->getMessage();
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            $message = $e->getMessage();
        } catch (\Cartalyst\Stripe\Exception\ServerErrorException $e) {
            $message = $e->getMessage();
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return $message;
    }

    private function makeAmount(array $carts)
    {
        return array_reduce($carts, function ($prve, $cart) {
            return $prve + $this->calcPriceOfProduct($cart['id'], $cart['count']);
        }, 0);
    }

    private function calcPriceOfProduct($product_id, $count)
    {
        $product = Product::findOrFail($product_id);

        return $product->price * $count;
    }
}
