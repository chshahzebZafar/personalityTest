<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [
        'transaction_id',
        'quiz_id',
        'candidate_id',
        'enrollment_date',
        'payment_type',
        'payment_name',
        'transaction_amount',
        'issuer_name',
        'transaction_currency',
        'mobile_no',
        'rdv_message_key',
        'validation_hash',
        'response_key',
        'recurring_txn',
    ];
}
