<?php

namespace App\Models;

use App\Traits\TransactionTrait;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use TransactionTrait;

    protected $fillable = [
        'stripe_id', 'card_name', 'card_brand', 'card_last_four', 'month_exp', 'year_exp', 'default',
    ];
    protected $hidden = ['stripe_id'];
}
