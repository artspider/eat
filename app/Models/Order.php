<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'delivery_time',
        'waiter',
        'delivery_guy',
        'table',
        'note',
        'total',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function status()
    {
        return $this->hasMany('App\Models\OrderStatus');
    }

    public function Dishes()
    {
        return $this->belongsToMany('App\Models\Dish', 'dish_orders')
        ->withTimestamps()
        ->withPivot('qty', 'price', 'total')
        ->orderBy('name');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
