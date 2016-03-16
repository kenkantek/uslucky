<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //BEGIN NEW AMOUNT
    public function withAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    public function publish()
    {
        $this->save();
        return $this;
    }
    //END NEW AMOUNT
}
