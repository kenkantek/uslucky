<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use StatusTrait;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function result()
    {
        return $this->belongsTo(Result::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }

    // BEGIN NEW AWARD
    public function withAddAward($add_award)
    {
        $this->add_award = $add_award;
        return $this;
    }

    public function withResult($result)
    {
        $this->result()->associate($result);
        return $this;
    }
    public function withLevel($level)
    {
        $this->level()->associate($level);
        return $this;
    }
    public function publish()
    {
        $this->save();
        return $this;
    }
    // END NEW AWARD
}
