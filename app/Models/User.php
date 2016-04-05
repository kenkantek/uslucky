<?php

namespace App\Models;

use App\Traits\TransactionTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sofa\Eloquence\Eloquence;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use TransactionTrait;
    use Eloquence;

    protected $fillable = [
        'first_name', 'last_name', 'avatar', 'email', 'password', 'active_code', 'facebook_id', 'active',
    ];

    protected $appends = ['image', 'fullname', 'balance', 'ticket_total', 'price_total', 'deposit_total', 'withdraw_total'];

    protected $searchableColumns = [
        'id', 'email', 'first_name', 'last_name',
    ];

    protected $dates = ['birthday'];

    protected $hidden = [
        'password', 'remember_token', 'avatar', 'amount', 'transactions', 'orders2',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function amount()
    {
        return $this->hasOne(Amount::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orders2()
    {
        return $this->orders();
    }

    public function luckys()
    {
        return $this->hasMany(LuckyNumber::class);
    }

    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getImageAttribute()
    {
        return asset($this->avatar);
    }

    public function getBirthdayAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d') : null;
    }

    public function setBirthdayAttribute($date)
    {
        return $this->attributes['birthday'] = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d H:i:s');
    }

    public function getBalanceAttribute()
    {
        return $this->amount ? $this->amount->amount : 0;
    }

    public function updateAmount($amount = null)
    {
        if (!$amount instanceof Amount) {
            $amount = new Amount;
            $amount->user()->associate($this);
        }
        return $amount;
    }

    public function newOrder()
    {
        $order = new Order;
        $order->user()->associate($this);
        return $order;
    }

    public function getTicketTotalAttribute()
    {
        // return 0;
        $ticket_total = 0;
        foreach ($this->orders2 as $key => $order) {
            $ticket_total = $order->ticket_total + $ticket_total;
        }
        return $ticket_total;
    }

    public function getPriceTotalAttribute()
    {
        $price_total = 0;
        foreach ($this->orders2 as $key => $order) {
            $price_total = $order->price + $price_total;
        }
        return $price_total;
    }

    public function getDepositTotalAttribute()
    {
        $deposit_total = 0;
        foreach ($this->transactions as $key => $transaction) {
            if ($transaction->type == 1) {
                $deposit_total = $transaction->amount + $deposit_total;
            }
        }
        return $deposit_total;
    }

    public function getWithdrawTotalAttribute()
    {
        $withdraw_total = 0;
        foreach ($this->transactions as $key => $transaction) {
            if ($transaction->type == 0) {
                $withdraw_total = $transaction->amount + $withdraw_total;
            }
        }
        return $withdraw_total;
    }

    public function newOrUpdateLuckys($lucky = null)
    {
        if (!$lucky instanceof LuckyNumber) {
            $lucky = new LuckyNumber;
            $lucky->user()->associate($this);
        }
        return $lucky;
    }
}
