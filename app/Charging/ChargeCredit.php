<?php
namespace App\Charging;

use App\Billing\Billing;
use App\Charging\Status;
use App\Charging\Transaction;
use App\Models\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;

class ChargeCredit implements ChargeInterface
{
    use Transaction, Status;

    public function charge(Billing $billing)
    {
        $order        = $billing->order;
        $user         = $billing->user;
        $balance      = $user->balance;
        $amount       = $billing->calculateAmount();
        $amount_total = $balance;

        try {
            //Charge Stripe
            $charge = Stripe::charges()->create([
                'source'        => $billing->source,
                'currency'      => 'USD',
                'amount'        => $amount,
                'description'   => $billing->description,
                'receipt_email' => $user->email,
            ]);

            if (!$charge['failure_code']) {
                $transaction = $this->makeTransaction($order, $amount, $balance, $amount_total, $billing->description);

                $status = $this->makeStatus($transaction, $charge['status']);

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
}
