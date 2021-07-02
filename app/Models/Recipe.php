<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'description',
    'prepTime',
    'cookTime',
    'totalTime',
    'recipeYield',
    'suitableForDiet',
    'recipeCuisine',
    'price',
    'cost',
    'costPriceRatio',
    'mc',
    'profitableness',
    'deliveryCharges',
    'inStock',
    ];

    function recipeImages()
    {
        return $this->hasMany('App\Models\RecipeImage');
    }

    function recipeCategory()
    {
        return $this->belongsTo('App\Models\RecipeCategory');
    }

}