<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageGame extends Model
{
    protected $fillable = ['key', 'value'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function withKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function withValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
