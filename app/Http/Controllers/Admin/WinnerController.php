<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index()
    {
        \JavaScript::put([
            '_games' => Game::all(),
        ]);
        return view('admin.users.results.index');
    }

    public function getWinners(Request $request)
    {
        $keyword = $request->keyword ?: '';
        $take    = $request->take ?: 10;
        $game_id = $request->game_id ?: 1;

        return User::search($keyword)->whereHas('orders', function ($q) use ($game_id) {
            $q->whereGameId($game_id)->has('tickets.award');
        })
            ->latest()
            ->paginate($take)
            ->appends(['take' => $take, 'keyword' => $keyword]);
    }
}
