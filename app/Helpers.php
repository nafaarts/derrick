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

function getPaymentCode($code)
{
    $data = [
        "VC" => "(Visa / Master Card / JCB) Virtual Account",
        "BC" => "BCA Virtual Account",
        "M2" => "Mandiri Virtual Account",
        "VA" => "Maybank Virtual Account",
        "I1" => "BNI Virtual Account",
        "B1" => "CIMB Niaga Virtual Account",
        "BT" => "Permata Bank Virtual Account",
        "A1" => "ATM Bersama",
        "AG" => "Bank Artha Graha",
        "NC" => "Bank Neo Commerce/BNC",
        "BR" => "BRIVA",
        "S1" => "Bank Sahabat Sampoerna Ritail",
        "FT" => "Pegadaian/ALFA/Pos",
        "A2" => "POS Indonesia",
        "IR" => "Indomaret",
        "OV" => "OVO (Support Void)",
        "SA" => "ShopeePay Apps (Support Void)",
        "LF" => "LinkAja Apps (Fixed Fee)",
        "LA" => "LinkAja Apps (Percentage Fee)",
        "DA" => "DANA",
        "SP" => "ShopeePay",
        "LQ" => "LinkAja",
        "NQ" => "Nobu"
    ];

    return $data[$code];
}
