<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'servTime',
        'dishYield',
        'dishCuisine',
        'price',
        'cost',
        'costPriceRatio',
        'mc',
        'profitableness',
        'deliveryCharges',
        'slug',
        'inStock',
        ];

        function dishImages()
        {
            return $this->hasMany('App\Models\DishImage');
        }
    
        function products()
        {
            return $this->belongsToMany('App\Models\Product', 'dish_product')
            ->withTimestamps()
            ->withPivot('qty', 'unit_id')
            ->orderBy('name');
        }

        function recipes()
        {
            return $this->belongsToMany('App\Models\Recipe', 'dish_recipe')
            ->withTimestamps()
            ->withPivot('qty')
            ->orderBy('name');
        }

        public function orders()
        {
            return $this->belongsToMany('App\Models\Order');
        }
}
