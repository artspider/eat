<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishProduct extends Model
{
    use HasFactory;

    protected $table = 'dish_product';

    protected $fillable = [
        'dish_id',
        'product_id',
        'qty',
        'unit_id'
    ];
}
