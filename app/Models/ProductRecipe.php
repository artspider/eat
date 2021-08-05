<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecipe extends Model
{
    use HasFactory;

    protected $table = 'product_recipe';

    protected $fillable = [
        'recipe_id',
        'product_id',
        'qty',
        'unit_id'
    ];
}
