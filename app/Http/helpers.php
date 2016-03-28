<?php
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
        $params = [
            'game-names' => $game,
            'status'     => 'OPEN',
            'size'       => 0,
        ];
        $response = current(json_decode(curlGetUrl($params))->draws);
        // dd($response);
        return [
            'time'   => Carbon::createFromTimestamp(substr($response->drawTime, 0, -3))->format('m/d/Y'),
            'amount' => substr($response->estimatedJackpot, 0, -2),
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
