<?php

namespace App\Http\Controllers\Front;

use Illuminate\{Http\Request, Support\Facades\Log};

use App\{
    Models\Item,
    Models\Category,
    Http\Controllers\Controller,
};
use App\Helpers\PriceHelper;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Brand;
use App\Models\ChieldCategory;
use App\Models\Setting;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Session;

class CatalogController extends Controller
{
	public function index(Request $request)
	{
        // dump('index');
        // dd($request->all());
        // attribute search
        $attr_item_ids = [];
        // if($request->attribute){
        //     $attrubutes_get = Attribute::where('name',$request->attribute)->get();
        //     foreach($attrubutes_get as $attr_item_id){
        //         $attr_item_ids[] = $attr_item_id->item_id;
        //     }
        // }

        $option_attr_ids = [];

        if($request->option){
            $option_get = AttributeOption::whereIn('name',explode(',',$request->option))->get();
            foreach($option_get as $option_attr_id){
                $option_attr_ids[] = $option_attr_id->attribute_id;
            }
        }



        $option_wise_item_ids = [];
        foreach(Attribute::whereIn('id',$option_attr_ids)->get() as $attr_item_id){
            $option_wise_item_ids[] = $attr_item_id->item_id;
        }
        $setting = Setting::first();
        $sorting = $request->has('sorting') ?  ( !empty($request->sorting) ? $request->sorting : null ) : null;
        $new = $request->has('new') ?  ( !empty($request->new) ? 1 : null ) : null;
        $feature = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'feature') ? 1 : null ) : null;
        $top = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'top') ? 1 : null ) : null;
        $best = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'best') ? 1 : null ) : null;
        $new = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'new') ? 1 : null ) : null;
        $brand = $request->has('brand') ?  ( !empty($request->brand) ? Brand::whereSlug($request->brand)->firstOrFail() : null ) : null;
        $search = $request->has('search') ?  ( !empty($request->search) ? $request->search : null ) : null;

        $category = $request->has('category') ? ( !empty($request->category) ? Category::whereSlug($request->category)->firstOrFail() : null ) : null;
        // dd($category);
        $subcategory = $request->has('subcategory') ? ( !empty($request->subcategory) ? Subcategory::whereSlug($request->subcategory)->firstOrFail() : null ) : null;
        $childcategory = $request->has('childcategory') ? ( !empty($request->childcategory) ? ChieldCategory::where('slug',$request->childcategory)->first() : null ) : null;
        $minPrice = $request->has('minPrice') ?  ( !empty($request->minPrice) ? PriceHelper::convertPrice($request->minPrice) : null ) : null;
        $maxPrice = $request->has('maxPrice') ?  ( !empty($request->maxPrice) ? PriceHelper::convertPrice($request->maxPrice) : null ) : null;

        $subcategorys = [];
        if(!empty($category)){
            $subcategorys = Subcategory::where('category_id', $category->id)->get();

        }
        $items = Item::with('category')
        // ->when($category, function ($query, $category) {
        //     return $query->where('category_id', $category->id);
        // })
        // ->when($subcategory, function ($query, $subcategory) {
        //     return $query->where('subcategory_id', $subcategory->id);
        // })
        // ->when($childcategory, function ($query, $childcategory) {
        //     return $query->where('childcategory_id', $childcategory->id);
        // })

        // ->when($feature, function ($query) {
        //     return $query->whereIsType('feature');
        // })

        // ->when($new, function ($query) {
        //     return $query->orderby('id','desc');
        // })
        // ->when($top, function ($query) {
        //     return $query->whereIsType('top');
        // })
        // ->when($best, function ($query) {
        //     return $query->whereIsType('best');
        // })
        // ->when($new, function ($query) {
        //     return $query->whereIsType('new');
        // })



        ->when($sorting, function($query, $sorting) {
            if($sorting == 'low_to_high'){
                return $query->orderby('discount_price','asc');
            }else{
                return $query->orderby('discount_price','desc');
            }

        })

        ->when($attr_item_ids, function($query, $attr_item_ids) {
          return $query->whereIn('id',$attr_item_ids);
        })
        ->when($option_wise_item_ids, function($query, $option_wise_item_ids) {
          return $query->whereIn('id',$option_wise_item_ids);
        })

        ->where('status',1)

        ->orderby('id','desc')->paginate($setting->view_product);

        // attribute check
        $checkItem = Item::whereStatus(1)->get();

        $attr_array = [];
        $attr_name = [];
        foreach($checkItem as $product){
            foreach($product->attributeOptions as $att){
                $attr = Attribute::find($att->attribute_id);
                if(!in_array($attr->name,$attr_name)){
                    $attr_array[] = $attr->id;
                    $attr_name[] = $attr->name;
                }
            }
        }
        $attrubutes =[];
        foreach($attr_array as $id){
            $attrubutes[] = Attribute::with('options')->findOrFail($id);
        }

        $blade = 'front.catalog.index';

        if($request->view_check){
            Session::put('view_catalog',$request->view_check);

        }

        if(Session::has('view_catalog')){
            $checkType = Session::get('view_catalog');
            $name_string_count = 55;
        }else{
            Session::put('view_catalog','grid');
            $checkType = Session::get('view_catalog');
            $name_string_count = 38;
        }

        // dd('hhhh');
        if($request->ajax() && empty($request->prod_check)){
            // dd($request->all());
            $blade = 'front.catalog.catalog';
        }else if($request->ajax() && !empty($request->prod_check)){

            $blade = 'front.catalog.ProductNew';
        }

        return view($blade,[
            'attrubutes' => $attrubutes,

            'items' => $items,
            'name_string_count' => $name_string_count,
            'category' => $category,
            'subcategorys' => $subcategorys,
            // 'subcategory' => $subcategory,
            'childcategory' => $childcategory,
            'checkType'  => $checkType,
            // 'brands' => Brand::withCount('items')->whereStatus(1)->get(),
            'categories' => Category::whereStatus(1)->orderby('serial','asc')->withCount(['items' => function($query) {
                $query->where('status',1);
            }])->get(),
        ]);
	}


     // Product Page Method
    public function index1(Request $request, $id)
    {
        // dd($request->all());
        // dd('index1');
        $items = Item::has('attributeOptions')->with('attributeOptions')->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();
        $new_items = Item::has('attributeOptions')->with('attributeOptions')->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();

        if ($request->view_check) {
            Session::put('view_catalog', $request->view_check);
        }

        if (Session::has('view_catalog')) {
            $checkType = Session::get('view_catalog');
            // $name_string_count = 55;
        }
        else {
            Session::put('view_catalog', 'grid');
            $checkType = Session::get('view_catalog');
            // $name_string_count = 38;
        }
        $n_array = [];
        if ($request->ajax()) {
            $new_items_arr = [];
            foreach ($items as $item) {
                $at = $item->join('attribute_options', 'attribute_options.item_id', 'items.id')->where('attribute_options.item_id', $item->id)->first();
                array_push($new_items_arr, $at);
            }
            // dd($new_items_arr);
            $max = $request->maxPrice;
            $min = $request->minPrice;

            /* sorting filter start */
            if($request->has('sorting') && !empty($request->sorting)) {
                // dd($request->sorting);
                switch ($request->sorting) {
                    case 'high_to_low':
                        for ($j = 0; $j < count($new_items_arr); $j++) {
                            for ($i = 0; $i < count($new_items_arr) - 1; $i++) {

                                if ($new_items_arr[$i]->price < $new_items_arr[$i + 1]->price) {
                                    $temp = $new_items_arr[$i + 1];
                                    $new_items_arr[$i + 1] = $new_items_arr[$i];
                                    $new_items_arr[$i] = $temp;
                                }
                            }
                        }
                        foreach($new_items_arr as $n){
                            $n['id'] = $n['item_id'];
                            array_push($n_array,$n);
                        }
                        $items = $n_array;
                        break;
                    case 'low_to_high':
                        for ($j = 0; $j < count($new_items_arr); $j++) {
                            for ($i = 0; $i < count($new_items_arr) - 1; $i++) {

                                if ($new_items_arr[$i]->price > $new_items_arr[$i + 1]->price) {
                                    $temp = $new_items_arr[$i + 1];
                                    $new_items_arr[$i + 1] = $new_items_arr[$i];
                                    $new_items_arr[$i] = $temp;
                                }
                            }
                        }
                        foreach($new_items_arr as $n){
                            $n['id'] = $n['item_id'];
                            array_push($n_array,$n);
                        }
                        $items = $n_array;
                        break;
                }
            }
            //dd($items);
            /* sorting filter end */

            /* min & max start */
            if($request->has('minPrice') && $request->minPrice !== null && $request->has('maxPrice') && $request->maxPrice !== null) {
                $items = [];
                for ($j = 0; $j < count($new_items_arr); $j++) {
                    if ($new_items_arr[$j]->price > $request->minPrice && $new_items_arr[$j]->price < $request->maxPrice) {
                        $items[$j] = $new_items_arr[$j];
                    }
                }
            }
            /* min & max end */
        }
       
        return view(($request->ajax()) ? 'front.catalog.ProductNew' : 'front.catalog.show_products', [
            'items' => $items,
            'new_items' => $new_items,

            'checkType' => $checkType,
            'categories' => Category::whereStatus(1)->orderby('serial', 'asc')->withCount(['items' => function ($query) {
                $query->where('status', 1);
            }])->get(),
            'id' => $id
        ]);
    }


    public function viewType($type)
    {
        Session::put('view_catalog',$type);
        return response()->json($type);
    }


    public function suggestSearch(Request $request)
    {
        $category = null;
        if($request->category){
            $category = Category::whereSlug($request->category)->first();
        }
        $search = $request->search;
        $items = Item::whereStatus(1)
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')->orderby('id','desc')->take(10);
        })
        ->when($category, function ($query, $category) {
            return $query->where('category_id', $category->id);
        })
        ->get();

        return view('includes.search_suggest',compact('items'));
    }

}