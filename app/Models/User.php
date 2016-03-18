<?php

namespace App\Models;

use App\Traits\TransactionTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use TransactionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'avatar', 'email', 'password', 'active_code', 'facebook_id', 'active',
    ];

    protected $appends = ['image', 'fullname', 'balance'];

    protected $dates = ['birthday'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'avatar',
    ];

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
}
