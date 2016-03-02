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
