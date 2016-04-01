<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index()
    {
        \JavaScript::put([
            '_games'   => Game::all(),
            '_results' => Result::latest('draw_at')->take(20)->get(),
        ]);
        return view('admin.users.results.index');
    }

    public function getWinners(Request $request)
    {
        $keyword   = $request->keyword ?: '';
        $take      = $request->take ?: 10;
        $game_id   = $request->game_id ?: 1;
        $result_id = $request->result_id;

        return User::search($keyword)->whereHas('orders', function ($q) use ($game_id, $result_id) {
            $q->whereGameId($game_id)->whereHas('tickets', function ($q2) use ($result_id) {
                $q2->whereHas('award', function ($q3) use ($result_id) {
                    $result_id && $q3->whereResultId($result_id);
                });
            });
        })
            ->latest()
            ->paginate($take)
            ->appends(['take' => $take, 'keyword' => $keyword]);
    }
}
