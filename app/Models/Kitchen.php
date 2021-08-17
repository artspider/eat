<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory;

    public function getStatusAttribute($value){
        $statusMap = [
          0 => 'ENVIADO A COCINA',
          1 => 'RECIBIDO EN COCINA',
          2 => 'EN PROCESO',
          3 => 'ENVIADO A CHEF',
          4 => 'RECIBIDO POR CHEF',
          5 => 'CONSUMIDO',
          6 => 'BOTADO'
        ];
  
        return $statusMap[$value];
      }

      public function recipe()
      {
          return $this->belongsTo('App\Models\Recipe');
      }
}
