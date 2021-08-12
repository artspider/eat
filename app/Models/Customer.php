<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'street',
        'suburb',
        'phone',
        'fav1',
        'fav2',
        'fav3',
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }
}
