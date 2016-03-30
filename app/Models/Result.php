<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Result extends Model
{
    use Eloquence, StatusTrait;

    protected $fillable          = ['numbers', 'ball', 'multiplier', 'annuity', 'draw_at'];
    protected $dates             = ['created_at', 'updated_at', 'draw_at'];
    protected $casts             = ['numbers' => 'array'];
    protected $searchableColumns = [
        'numbers', 'annuity', 'draw_at',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }

    // BEGIN new Result
    public function withNj($nj)
    {
        $this->nj_id = $nj;
        return $this;
    }

    public function withNumbers($numbers)
    {
        $this->numbers = $numbers;
        return $this;
    }

    public function withBall($ball)
    {
        $this->ball = $ball;
        return $this;
    }

    public function withMultiplier($multiplier)
    {
        $this->multiplier = $multiplier;
        return $this;
    }

    public function withAnnuity($annuity)
    {
        $this->annuity = $annuity;
        return $this;
    }

    public function withDrawAt($draw_at)
    {
        $this->draw_at = $draw_at;
        return $this;
    }

    public function publish()
    {
        $this->save();
        return $this;
    }
    // END new Result

    public function getDrawAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function scopeGameId($query, $type = 1)
    {
        return $query->where('game_id', $type);
    }
}
