<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'status',
        'done'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
