<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable  = [
        'company_name',
        'contact_name',
        'contact_title',
        'address',
        'suburb',
        'city',
        'state',
        'zip',
        'phone',
        'website',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
