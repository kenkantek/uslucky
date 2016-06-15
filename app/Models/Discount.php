<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Discount extends Model
{
    use Eloquence;

    protected $dates = ['created_at', 'updated_at', 'begin_at', 'end_at'];

    protected $searchableColumns = [
        'name', 'code', 'description',
    ];

    protected $appends = [
        'status',
    ];

    //BEGIN NEW DISCOUNT
    public function withName($name)
    {
        $this->name = $name;

        return $this;
    }
    public function withDescription($description)
    {
        $this->description = $description;

        return $this;
    }
    public function withValue($value)
    {
        $this->value = $value;

        return $this;
    }
    public function withCode($code)
    {
        $this->code = strtoupper($code);

        return $this;
    }
    public function withBeginAt($begin_at)
    {
        $this->begin_at = Carbon::parse($begin_at);

        return $this;
    }
    public function withEndAt($end_at)
    {
        $this->end_at = Carbon::parse($end_at);

        return $this;
    }
    public function withActive($active)
    {
        $this->active = (boolean) $active;

        return $this;
    }
    public function publish()
    {
        $this->save();

        return $this;
    }
    //END NEW DISCOUNT

    //BEGIN RELATIONHSIP
    public function games()
    {
        return $this->morphedByMany(Game::class, 'discountable');
    }
    //END RELATIONHSIP

    //BEGIN ACCSESSTOER
    public function getBeginAtAttribute($data)
    {
        return Carbon::parse($data)->format('Y-m-d');
    }
    public function getEndAtAttribute($data)
    {
        return Carbon::parse($data)->format('Y-m-d');
    }
    public function getStatusAttribute()
    {
        if ($this->active) {
            $end_at = Carbon::parse($this->getOriginal('end_at'));
            $day    = Carbon::now()->diffInDays($end_at, false);

            return $day > 0
            ? "left $day day(s)"
            : 'expired';
        }

        return 'disabled';
    }
    //END ACCSESSTOER
}
