<?php

namespace App\Http\Controllers\Admin\Results;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Game;
use App\Models\Order;
use App\Models\Result;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        \JavaScript::put([
            '_games' => Game::all(),
        ]);
    }

    public function index()
    {
        return view('admin.results.index');
    }

    public function awards()
    {
        return view('admin.results.award');
    }

    public function getResultsNj($id, Request $request)
    {
        $powerball = Game::find($id);
        return $powerball->results()
            ->whereBetween('draw_at', $request->only(['date_from', 'date_to']))
            ->pluck('nj_id');
    }

    public function assignToResult($id, Request $request)
    {
        $nj_id = $request->id;
        $game  = Game::find($id);

        if ($game->results()->whereNjId($nj_id)->first()) {
            return response(['message' => 'Record exists in system.'], 400);
        }

        $results = $request->results[0];
        $numbers = [];
        foreach ($results['primary'] as $key => $number) {
            if ($key < 5) {
                $numbers[] = $number;
            } elseif ($key === 6) {
                $ball = substr($number, -2);
            }
        }
        $multiplier = $results['multiplier'];
        $annuity    = substr($request->estimatedJackpot, 0, -2);
        $draw_at    = Carbon::createFromTimestamp(substr($request->drawTime, 0, -3))->format('Y-m-d');
        // dd($draw_at);

        $result = $game->newResult()
            ->withNj($nj_id)
            ->withNumbers(array_map('intval', $numbers))
            ->withBall($ball)
            ->withMultiplier($multiplier)
            ->withAnnuity($annuity)
            ->withDrawAt($draw_at)
            ->publish();

        //make status
        $result->updateOrNewStatus()
            ->withStatus('pendding')
            ->publish();

        return $result->nj_id;
    }

    public function getResults(Request $request)
    {
        $keyword = $request->keyword ?: '';
        $take    = $request->take ?: 10;
        $game_id = $request->game_id ?: 1;

        return Result::search($keyword)
            ->with('game', 'status', 'awards')
            ->latest('draw_at')
            ->whereBetween('draw_at', $request->only(['dateFrom', 'dateTo']))
            ->gameId($game_id)
            ->paginate($take)
            ->appends(['take' => $take, 'keyword' => $keyword]);
    }

    public function awardDetail(Result $result)
    {
        \JavaScript::put([
            '_result' => $result->load('game', 'status'),
        ]);
        return view('admin.results.award-detailt', compact('result'));
    }

    public function validateCal(Result $result)
    {
        return Order::whereDate('draw_at', '=', $result->draw_at)->whereHas('status', function ($q) {
            $q->whereStatus('order placed')->orWhere('status', 'pending purchase');
        })->pluck('id');
    }

    public function onCalculate(Result $result)
    {
        return DB::transaction(function () use ($result) {
            $final = $result->calculateWinning();

            $result->apply_module = true;
            $status = $result->status;
            $status->status = 'processing';
            $result->save();
            $status->save();
            return $final;
        });
    }

    public function onFinish(Result $result)
    {
        return $result->updateOrNewStatus($result->status)
            ->withStatus('done')->publish();
    }

    public function getTicketAward(Result $result)
    {
        return $result->awards()->with('status', 'level', 'ticket.order.user')->get();
    }

    public function putStatusTicket(Award $award)
    {
        $status = $award->updateOrNewStatus($award->status)
            ->withStatus('paid')
            ->publish();
        return $status;

    }
}
