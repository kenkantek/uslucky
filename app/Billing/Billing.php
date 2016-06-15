<?php
namespace App\Billing;

use App\Charging\ChargeBalance;
use App\Charging\ChargeCredit;
use App\Events\Order\UserPurchasedTicket;
use App\Models\Discount;
use App\Models\Game;
use App\Models\ManageGame;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class Billing implements BillingInterface
{
    public $order;
    public $game_type;
    public $status = 'order placed';
    public $method = 1;
    public $user;
    public $tickets;
    public $extra;
    public $draw_at;
    public $description = '';
    public $source;
    public $coupon;

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setGameType($game_id)
    {
        $this->game_type = Game::findOrFail($game_id);
        return $this;
    }

    public function setExtra($extra)
    {
        $this->extra = (bool) $extra;
        return $this;
    }

    public function setDrawAt($draw_at)
    {
        $this->draw_at = $draw_at;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    public function setCoupon($coupon)
    {
        $this->coupon = $coupon;
        return $this;
    }

    public function newOrder()
    {
        $order = $this->user->newOrder()
            ->withGame($this->game_type)
            ->withExtra($this->extra)
            ->withDrawAt($this->draw_at)
            ->withDescription($this->description)
            ->publish();

        $this->order = $order;
        return $order;
    }

    public function applyStatus(Order $order)
    {
        $order->updateOrNewStatus()
            ->withStatus($this->status)
            ->publish();

        return $this;
    }

    public function saveTickets(Order $order)
    {
        $order->newMultiTicket($this->tickets);

        return $this;
    }

    public function charge()
    {
        $charge = $this->method == 1 ? new ChargeBalance : new ChargeCredit;
        $charge = $charge->charge($this);

        return $charge;
    }

    public function fireEvents()
    {
        event(new UserPurchasedTicket($this->order));
    }

    public function calculateAmount()
    {
        $config = ManageGame::getConfig($this->game_type->id)->toArray();
        $amount = count($this->tickets) * $config['each_per_ticket'];
        if ($this->extra) {
            $amount += count($this->tickets) * $config['extra_per_ticket'];
        }
        $discount = $this->validateDiscount();
        return $discount ? $amount - ($amount * $discount->value) / 100 : $amount;
    }

    public function validateDiscount()
    {
        $now = Carbon::today()->toDateString();

        return Discount::whereCode($this->coupon)
            ->whereActive(true)
            ->whereDate('begin_at', '<=', $now)
            ->whereDate('end_at', '>=', $now)
            ->whereHas('games', function ($q) {
                $q->whereId($this->game_type->id);
            })
            ->first();
    }
}
