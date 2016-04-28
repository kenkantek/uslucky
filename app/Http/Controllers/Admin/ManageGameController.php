<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\PowerballRequest;
use App\Models\Game;
use App\Models\ManageGame;
use Cache;

class ManageGameController extends Controller
{
    public function show($id)
    {
        return view('admin.managegame', compact('id'));
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
}
