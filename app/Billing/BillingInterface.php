<?php

namespace App\Billing;

use App\Models\Order;
use App\Models\User;

interface BillingInterface
{
    public function setUser(User $user);
    public function setMethod($method);
    public function setTickets($tickets);
    public function setStatus($status);
    public function setGameType($game_id);
    public function setExtra($extra);
    public function setDrawAt($extra);
    public function setDescription($extra);

    public function newOrder();
    public function applyStatus(Order $order);
    public function saveTickets(Order $order);
    public function calculateAmount();
    public function charge();
    public function fireEvents();
}
