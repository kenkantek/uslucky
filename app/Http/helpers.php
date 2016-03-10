<?php
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

    $powerball = Cache::rememberForever('powerball', function () {
        $reader = new \Sabre\Xml\Reader();
        $reader->xml(file_get_contents('http://feeds.feedblitz.com/PennsylvaniaLottery-WinningNumbers-Powerball'));
        $result = $reader->parse();
        $source = $result['value'][0]['value'][4]['value'][2]['value'];
        preg_match('/[\d]{2}\/[\d]{2}\/[\d]{4}/', $source, $nextTime);
        preg_match('/(?<=\$)[\d,]+/', $source, $amount);
        return [
            'time'   => current($nextTime),
            'amount' => filter_var(current($amount), FILTER_SANITIZE_NUMBER_INT),
        ];
    });

    return $powerball;
}
