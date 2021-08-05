<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishRecipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'dish_id',
        'recipe_id',
        'qty'
    ];

}
