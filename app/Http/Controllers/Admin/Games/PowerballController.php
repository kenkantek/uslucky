<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\ManageGame;
use Cache;
use Illuminate\Http\Request;

class PowerballController extends Controller
{
    public function index()
    {
        return view('admin.games.powerball');
    }

    public function update(Request $request, $id)
    {

        $key        = ManageGame::findOrFail($id);
        $key->value = $request->value;
        Cache::forget('config-' . $key->game->name);
        $key->save();

        return $key;
    }

    public function getKeys()
    {
        $keys = Game::find(1);
        return $keys->settings;
    }
}
