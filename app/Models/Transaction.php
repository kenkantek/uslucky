<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Carbon\Carbon;
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
        $this->type = $type;
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

        $aff_conf = AffiliateConfig::first();
        $trans = $this->where('user_id', \Auth::user()->id)->where('type','<>',1)->first();
        if (($trans=='') && (session()->has('ref'))&&($aff_conf->status == 1)) {


            //get affiliate info of user share link
            $aff = Affiliate::where('code', session()->get('ref'))->first();

            //if type = 1 calculator percent else plus value to amount of user share link

            if ($aff->type==1) {
                //calculator percent
                $aff_amount = ($aff->avalue / 100) * $this->amount;
                //set amount to user is member affiliate
                $aff->amount = $aff->amount + $aff_amount;
                $aff->save();

            } elseif ($aff->type==2) {
                $aff_amount  = $aff->avalue;
                $aff->amount = $aff->amount + $aff_amount;
                $aff->save();
            } else {
                $this->save();
                return $this;
            }
            //create transaction affiliate
            $affiliate_id = $aff->id;
            $this->save();
            $order_id                 = $this->id;
            $aff_tran                 = new AffiliateTransaction;
            $aff_tran->affiliate_id   = $affiliate_id;
            $aff_tran->transaction_id = $order_id;
            $aff_tran->type           = $aff->type;
            $aff_tran->amount         = $aff_amount;
            $aff_tran->save();
            //update amount of amount table of user is member affiliate
            $user_amount         = Amount::where('user_id', $aff->user_id)->firstOrNew(['user_id' => $aff->user_id]);
            $user_amount->amount = $user_amount->amount + $aff_amount;
            $user_amount->save();

            return $this;
        }
        else {
            $this->save();
            return $this;
        }

    }
    //END NEW TRACSACTION

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('g:ia \o\n d F Y');
    }

    public function getDescriptionAttribute($data)
    {
        return trim($data) ? $data : 'N/A';
    }
}
