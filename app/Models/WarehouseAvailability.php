<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['attribute_options_id', 'availability'];

    public function attributeOption()
    {
        return $this->belongsTo('App\Models\AttributeOption')->withDefault();
    }
}
