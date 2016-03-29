<?php

namespace App\Models;

use Cache;
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

    public function publish()
    {
        $this->save();
        return $this;
    }

    public static function getConfig($id)
    {
        $powerball = Game::find($id);
        return Cache::rememberForever('config-' . $powerball->name, function () use ($powerball) {
            return $powerball->settings()->pluck('value', 'key');
        });
    }
}
