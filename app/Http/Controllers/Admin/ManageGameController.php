<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\PowerballRequest;
use App\Models\Discount;
use App\Models\Game;
use App\Models\ManageGame;
use Cache;

class ManageGameController extends Controller
{
    public function show($id)
    {
        return view('admin.managegame.managegame', compact('id'));
    }

    public function update($id, PowerballRequest $request)
    {
        $setting        = ManageGame::findOrFail($id);
        $setting->value = $request->value;
        $setting->save();
        Cache::forget('config-' . $setting->game->name);

        return $setting;
    }

    public function getKeys($id)
    {
        return Game::find($id)->settings;
    }

    public function discount(Game $game)
    {
        $game->load('discounts');

        return view('admin.managegame.discount', compact('game'));
    }

    public function removeDiscount(Game $game, $discount)
    {
        return $game->discounts()
            ->whereId($discount)
            ->detach($discount);
    }
    public function addDiscount(Game $game, Discount $discount)
    {
        $game->discounts()
            ->attach($discount);

        return $discount;
    }
}
