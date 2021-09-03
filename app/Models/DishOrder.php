<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'dish_id',
        'order_id',
        'qty',
        'price',
        'total',
        'command'
    ];
}
