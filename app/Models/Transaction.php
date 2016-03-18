<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use StatusTrait;

    protected $fillable = ['type', 'amount', 'amount_prev', 'amount_total', 'description'];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }

    //BEGIN NEW TRANSACTION
    public function withType($type)
    {
        $this->type = (bool) $type;
        return $this;
    }
    public function withAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    public function withAmountPrev($amount_prev)
    {
        $this->amount_prev = $amount_prev;
        return $this;
    }
    public function withAmountTotal($amount_total)
    {
        $this->amount_total = $amount_total;
        return $this;
    }
    public function withDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    public function publish()
    {
        $this->save();
        return $this;
    }
    //END NEW TRACSACTION
}
