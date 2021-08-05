<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'product_id',
        'qty',
        'unit_id'
    ];
}
