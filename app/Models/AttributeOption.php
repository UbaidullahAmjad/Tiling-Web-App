<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    protected $fillable = [
        'attribute_id','item_id', 'name', 'keyword', 'price', 'stock', 'length', 'height', 'broad', 'quantity','image','description',
        'item_number', 'material', 'use', 'format', 'surface', 'edge', 'weight_per_unit', 'box_contains','variable_quantity',
        'frost_resistance', 'synonyms'
    ];

    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute')->withDefault();
    }


    public function warehouseAvailability()
    {
        return $this->belongsTo('App\Models\WarehouseAvailability')->withDefault();
    }

    public $timestamps = false;
}
