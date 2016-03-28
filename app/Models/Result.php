<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['numbers', 'ball', 'multiplier', 'annuity', 'draw_at'];
    protected $dates    = ['created_at', 'updated_at', 'draw_at'];
    protected $casts    = ['numbers' => 'array'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

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
}
