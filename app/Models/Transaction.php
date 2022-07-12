<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrant_id',
        'merchant_order_id',
        'reference',
        'status_code',
        'status_message',
        'amount',
        'fee',
        'payment_code',
        'result_code',
        'response',
        'notification',
        'registration_batch',
    ];

    public function registrant()
    {
        return $this->belongsTo(Registrant::class);
    }

    public function getExpiredTime()
    {
        // date("Y-m-d H:i:s", strtotime("2022-07-11 19:00:56") + 3600)
        return $this->created_at->addMinutes(60);
    }

    public function getPaymentCode()
    {
        $data = [
            "VC" =>
            "(Visa / Master Card / JCB) Virtual Account",
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

        return $data[$this->payment_code];
    }
}
