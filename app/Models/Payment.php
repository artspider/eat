<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'type',
        'total'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
