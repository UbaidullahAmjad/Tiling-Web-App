<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{

      protected $fillable = ['name', 'available_quantity', 'delivery_time'];

      public function item()
      {
            return $this->hasOne('App\Models\Item')->withDefault();
      }
}
