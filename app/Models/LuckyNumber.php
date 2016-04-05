<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyNumber extends Model
{
    protected $casts = [
        'numbers' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    // BEGIN NEW
    public function withGame($game)
    {
        $this->game()->associate($game);
        return $this;
    }

    public function withNumbers(array $numbers)
    {
        $this->numbers = $numbers;
        return $this;
    }
    public function withLine($line)
    {
        $this->line = $line;
        return $this;
    }
    public function publish()
    {
        $this->save();
        return $this;
    }
    // END
}
