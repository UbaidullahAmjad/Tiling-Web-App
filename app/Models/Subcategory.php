<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['name', 'slug', 'navigation_img', 'header_img', 'description', 'special_desc', 'category_id','status'];
    public $timestamps = false;


    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault();
    }

    public function childcategory()
    {
        return $this->hasMany('App\Models\ChieldCategory')->where('status',1);
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item')->where('status',1);
    }

    public function galleryImages()
    {
        return $this->hasMany('App\Models\SubcategoryGallery');
    }
}
