<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateTransaction extends Model
{
	protected $appends = ['transaction'];
	
    public function affiliate()
    {
	    return $this->belongsTo(Affiliate::class);
    }

	public function getTransactionAttribute()
	{
		return Transaction::where('id',$this->transaction_id)->first();
	}
}
