<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Result;
use App\Models\Ticket;
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

        $users = User::search($keyword)->whereHas('orders', function ($q) use ($game_id, $result_id) {
            $q->whereGameId($game_id)->whereHas('tickets', function ($q) use ($result_id) {
                $q->whereHas('award', function ($q) use ($result_id) {
                    $result_id && $q->whereResultId($result_id);
                });
            });
        })
            ->latest()
            ->paginate($take)
            ->appends(['take' => $take, 'keyword' => $keyword]);

        return $users;
    }

    public function getTicketWin(Request $request)
    {
        $user_id   = $request->user_id;
        $game_id   = $request->game_id;
        $result_id = $request->result_id;

        return Ticket::whereHas('order', function ($q) use ($user_id, $game_id, $result_id) {
            $q->whereGameId($game_id)->whereHas('user', function ($q) use ($user_id) {
                $q->whereUserId($user_id);
            });
        })->whereHas('award', function ($q) use ($result_id) {
            $q->whereResultId($result_id);
        })->with('order', 'award.level')->get();
    }
}
