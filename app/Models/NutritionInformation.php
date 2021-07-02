<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'calories',
        'carbohydrateContent',
        'cholesterolContent',
        'fatContent',
        'fiberContent',
        'proteinContent',
        'saturatedFatContent',
        'servingSize',
        'sodiumContent',
        'sugarContent',
        'transFatContent',
        'unsaturatedFatContent'
    ];
}
