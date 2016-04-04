<?php
use App\Models\Game;
use Carbon\Carbon;

function generateMonth()
{
    $month = [];
    for ($i = 1; $i <= 12; $i++) {
        $dateObj = \DateTime::createFromFormat('!m', $i);
        array_push($month, $dateObj->format('F'));
    }

    return $month;
}

function generateYear($add = 15)
{
    $y = date('Y');
    return range($y, $y + $add);
}

function powerballNextTime()
{
    return getGameNextTime('Powerball');
}

function getGameNextTime($game = 'Powerball')
{
    $result = Cache::rememberForever($game, function () use ($game) {
        $config = Game::whereName($game)->first()->settings->pluck('value', 'key');
        $params = [
            'game-names' => $game,
            'status'     => 'OPEN',
            'size'       => 0,
        ];
        $response = current(json_decode(curlGetUrl($params))->draws);
        try {
            $amount = substr($response->estimatedJackpot, 0, -2);
        } catch (Exception $e) {
            $amount = 'Not Published';
        }

        $time = Carbon::createFromTimestamp(substr($response->drawTime, 0, -3))->addHours($config['hours_before_close']);

        // Kiểm tra $time nếu nhỏ hơn ngày hiện tại thì lấy Next
        $now  = Carbon::now();
        $thu4 = $now->copy()->next(Carbon::WEDNESDAY);
        $thu7 = $now->copy()->next(Carbon::SATURDAY);

        if ($time->diffInDays($now, false) < 0 ||
            ($time->diffInDays($now, false) == 0 && $time->diffInHours($now, false) >= 0)) {
            $time   = $thu4->diffInDays($thu7, false) <= 0 ? $thu7 : $thu4;
            $amount = 'Not Published';
        }
        return [
            'time'   => $time->format('m/d/Y'),
            'now'    => $now->format('m/d/Y'),
            'amount' => $amount,
        ];
    });

    return $result;
}

function curlGetUrl($params = [])
{
    $url      = 'https://www.njlottery.com/api/v1/draw-games/draws/page';
    $response = Curl::to($url)
        ->withOption('USERAGENT', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13')
        ->withData(array_merge(['size' => 10, 'page' => 0, 'game-names' => 'Mega Millions'], $params))
        ->get();
    return $response;
}
