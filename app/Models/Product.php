<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'unit_id',
        'price',
        'stock',
        'supplier_id',
        'slug',
        'presentation',
        'content',
        'other',
        'brand',
        'photo',
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function recipes()
    {
        return $this->belongsToMany('App\Models\Recipe');
    }

}
