<?php

namespace App\Models;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $fillable = ['category_id','subcategory_id','warehouse_id','name','slug','sku','tags','product_features','product_description','photo','meta_keywords','meta_description','status','min_quantity','thumbnail'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault();
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory')->withDefault();
    }

    public function childcategory()
    {
        return $this->belongsTo('App\Models\ChieldCategory')->withDefault();
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand')->withDefault();
    }

    public function campaigns()
    {
        return $this->hasMany('App\Models\CampaignItem');
    }

    public function tax()
    {
        return $this->belongsTo('App\Models\Tax')->withDefault();
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\Attribute');
    }

    public function attributeOptions()
    {
        return $this->hasMany('App\Models\AttributeOption');
    }

    public function galleries()
    {
        return $this->hasMany('App\Models\Gallery');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse')->withDefault();
    }

    public static function taxCalculate($item)
    {
        if($item->tax){
            $price = $item->discount_price;
            $percentage = $item->tax->value;
            $tax = ($price * $percentage) / 100;
            return $tax;
        }else{
            return 0;
        }

    }




    public function getWishlistItemId()
    {
        return Wishlist::whereItemId($this->id)->first()->id;
    }


    public function user()
    {
    	return $this->belongsTo('App\Models\User','vendor_id')->withDefault();
    }


    public function is_stock()
    {
        $item = $this;
        // license product stock check------------
        if($item->item_type == 'license'){
            if($item->license_key){
                $lisense_key = json_decode($item->license_key,true);
                if(count($lisense_key) > 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        // digital product stock check-------------

        if($item->item_type == 'digital'){
            return true;
        }
        if($item->item_type == 'affiliate'){
            return true;
        }

        // physical product stock check

        if($item->item_type == 'normal'){
            if($item->stock){
                if($item->stock != 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }

        }

    }

}
