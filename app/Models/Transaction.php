<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrant_id',
        'transaction_id',
        'order_id',
        'status_code',
        'status_message',
        'gross_amount',
        'payment_type',
        'transaction_time',
        'transaction_status',
        'fraud_status',
        'pdf_url',
        'settlement_time',
        'response',
        'notification',
        'registration_batch',
        'registration_price',
    ];

    public function registrant()
    {
        return $this->belongsTo(Registrant::class);
    }
}
