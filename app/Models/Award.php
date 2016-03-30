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

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    // BEGIN NEW AWARD
    public function withAddAward($add_award)
    {
        $this->add_award = $add_award;
        return $this;
    }
    public function withLevel($level_id)
    {
        $this->level()->associate($level_id);
        return $this;
    }
    public function publish()
    {
        $this->save();
        return $this;
    }
    // END NEW AWARD
}
