<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['type', 'amount', 'amount_prev', 'amount_total', 'description'];

    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }
}
