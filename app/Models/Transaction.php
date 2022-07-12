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
}
