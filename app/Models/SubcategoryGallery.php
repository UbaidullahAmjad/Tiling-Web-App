<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubcategoryGallery extends Model
{
    protected $fillable = ['subcategory_id','image'];
    public $timestamps = false;
}
