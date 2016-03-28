<?php

namespace App\Http\Controllers\Admin\Results;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PowerballController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.results.powerball.index');
    }

    public function getResults(Request $request)
    {
        $powerball = Game::find(1);
        return $powerball->results()
            ->whereBetween('draw_at', $request->only(['date_from', 'date_to']))
            ->pluck('nj_id');
    }

    public function assignToResult(Request $request)
    {
        $nj_id     = $request->id;
        $powerball = Game::find(1);

        if ($powerball->results()->whereNjId($nj_id)->first()) {
            return response(['message' => 'Record exists in system.'], 400);
        }

        $results = $request->results[0];
        $numbers = [];
        foreach ($results['primary'] as $key => $number) {
            if ($key < 4) {
                $numbers[] = $number;
            } elseif ($key === 6) {
                $ball = substr($number, -2);
            }
        }
        $multiplier = $results['multiplier'];
        $annuity    = substr($request->estimatedJackpot, 0, -2);
        $draw_at    = Carbon::createFromTimestamp(substr($request->drawTime, 0, -3))->format('Y-m-d');
        // dd($draw_at);

        $result = $powerball->newResult()
            ->withNj($nj_id)
            ->withNumbers(array_map('intval', $numbers))
            ->withBall($ball)
            ->withMultiplier($multiplier)
            ->withAnnuity($annuity)
            ->withDrawAt($draw_at)
            ->publish();

        return $result->nj_id;
    }
}
