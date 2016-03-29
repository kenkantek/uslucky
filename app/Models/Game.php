<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['name'];

    public function settings()
    {
        return $this->hasMany(ManageGame::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    //newOrUpdate Setting
    public function newOrUpdateSetting($setting = null)
    {
        if (!$setting instanceof ManageGame) {
            $setting = new ManageGame;
            $setting->game()->associate($this);
        }
        return $setting;
    }

    //new Assign To results
    public function newResult()
    {
        $result = new Result;
        $result->game()->associate($this);
        return $result;
    }
}
