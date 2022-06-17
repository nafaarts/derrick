<?php


function defaultDate($date, $format = 'd F Y')
{
    if ($date == null) {
        return null;
    }
    return \Carbon\Carbon::parse($date)->format($format);
}

function defaultDateFrom($from, $to)
{
    // 22 - 25 Mei 2022
    // 22 Mei - 25 Juni 2022
    // 22 Mei 2022 - 01 Januari 2023

    if ($from == null || $to == null) return null;

    if ($from == $to) return defaultDate($from);


    $from = explode_date($from);
    $to = explode_date($to);

    if ($from[2] == $to[2]) {
        if ($from[1] == $to[1]) {
            return $from[0] . ' - ' . $to[0] . ' ' . $from[1] . ' ' . $from[2];
        } else {
            return $from[0] . ' ' . $from[1] . ' - ' . $to[0] . ' ' . $to[1] . ' ' . $from[2];
        }
    } else {
        return $from[0] . ' ' . $from[1] . ' ' . $from[2] . ' - ' . $to[0] . ' ' . $to[1] . ' ' . $to[2];
    }
}

function explode_date($date)
{
    $date = explode(' ', \Carbon\Carbon::parse($date)->format('d F Y'));
    return $date;
}
