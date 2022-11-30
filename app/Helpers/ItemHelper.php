<?php

namespace App\Helpers;
use App\Models\Item;

class ItemHelper
{
    
    /**
     * @param $name
     *
     * @return string
     */
    public static function toSlug($name):string
    {
        return strtolower( str_replace(' ', '-', str_replace(' - ', '-', $name)) );
    }


}
