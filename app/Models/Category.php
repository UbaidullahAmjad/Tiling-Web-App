<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug', 'photo','status','is_feature','meta_keywords','meta_descriptions','serial','description',
                        'title','sub_title','short_description','second_title','second_description','second_short_description'];
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function subcategory()
    {
        return $this->hasMany('App\Models\Subcategory');
    }

    public function categoryImages()
    {
        return $this->hasMany('App\Models\CategoryImage');
    }

}
