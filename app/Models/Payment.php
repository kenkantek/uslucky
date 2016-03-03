<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'stripe_id', 'card_name', 'card_brand', 'card_last_four', 'month_exp', 'year_exp',
    ];
    protected $hidden = ['stripe_id'];
}
