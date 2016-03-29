<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\PowerballRequest;
use App\Models\Game;
use App\Models\ManageGame;
use Cache;

class PowerballController extends Controller
{
    public function index()
    {
        return view('admin.games.powerball');
    }

    public function update($id, PowerballRequest $request)
    {
        $setting        = ManageGame::findOrFail($id);
        $setting->value = $request->value;
        $setting->save();
        Cache::forget('config-' . $setting->game->name);
        return $setting;
    }

    public function getKeys()
    {
        return Game::find(1)->settings;
    }
}
