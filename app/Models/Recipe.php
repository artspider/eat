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

    function ingredients()
    {
        return $this->belongsToMany('App\Models\Product', 'product_recipe')
        ->withTimestamps()
        ->withPivot('qty', 'unit_id')
        ->orderBy('name');
    }

    function nutrition()
    {
        return $this->hasOne('App\Models\NutritionInformation');
    }

    function kitchen()
    {
        return $this->hasOne('App\Models\Kitchen');
    }
    

}