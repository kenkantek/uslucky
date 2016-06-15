<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Game extends Model
{
    use Eloquence;

    protected $fillable = ['name'];

    protected $searchableColumns = [
        'name',
    ];

    public function settings()
    {
        return $this->hasMany(ManageGame::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function discounts()
    {
        return $this->morphToMany(Discount::class, 'discountable');
    }

    //newOrUpdate Setting
    public function newOrUpdateSetting($setting = null)
    {
        if (!$setting instanceof ManageGame) {
            $setting = new ManageGame();
            $setting->game()->associate($this);
        }

        return $setting;
    }

    //new Assign To results
    public function newResult()
    {
        $result = new Result();
        $result->game()->associate($this);

        return $result;
    }
}
