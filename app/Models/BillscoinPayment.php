<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillscoinPayment extends Model
{
    use HasFactory;

    protected $table = 'billscoin_payment';

    protected $fillable = [
        'billscoin_id',
        'payment_id',
        'qty',
        'total'
    ];
}
