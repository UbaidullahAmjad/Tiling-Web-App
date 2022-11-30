<?php

namespace App\Http\Controllers\Back;

use App\Helpers\ItemHelper;
use App\Models\Attribute;
use App\Models\AttributeOption;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Item;
use App\Models\Order;
use App\Models\Subcategory;
use App\Models\Transaction;
use App\Models\Warehouse;
use App\Models\UpSellingProduct;
use App\Models\CrossSellingProduct;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use File;
use voku\helper\ASCII;

class CsvProductController extends Controller
{
    
    
    public function index()
    {
        return view('back.item.bulk-upload');
    }
    
    public function export()
    {
        $headers = [
            'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
            ,'Content-type'        => 'text/csv'
            ,'Content-Disposition' => 'attachment; filename=products_csv_export.csv'
            ,'Expires'             => '0'
            ,'Pragma'              => 'public',
        ];
        
        $lists    = Item::where('item_type','!=','affiliate')->get()->toArray();
        // dd($lists);
        $new_list = [];
        foreach($lists as $list){
            $list['photo']         = asset('assets/images/'.$list['photo']);
            $list['slug']          = Str::random(3).$list['slug'].Str::random(2);
            $list['category']      = Category::findOrFail($list['category_id'])->name;
            $list['subcategory']   = $list['subcategory_id'] ? Subcategory::findOrFail($list['subcategory_id'])->name : '';
            $up_selling = UpSellingProduct::where('parent_product', $list['id'])->get();
            $cross_selling = CrossSellingProduct::where('parent_product', $list['id'])->get();
            $ups = [];
            $cros = [];
            // $kk=0;
            
            foreach($up_selling as $up){
                array_push($ups, $up->child_product);
            }
            foreach($cross_selling as $cr){
                array_push($cros, $cr->child_product);
            }
            $list['up_selling'] = implode("-",$ups);
            $list['cross_selling'] = implode("-",$cros);
            unset($list['category_id']);
            unset($list['subcategory_id']);
            $new_list[] = $list;
        }
        // dump($new_list);
        // dd('stop');
        # add headers for each column in the CSV download
        array_unshift($new_list,array_keys($new_list[0]));
        
        $callback = function () use ($new_list){
            $FH = fopen('php://output','w');
            foreach($new_list as $row){
                fputcsv($FH,$row);
            }
            fclose($FH);
        };
        
        return response()->stream($callback,200,$headers);
    }
    
    
    public function transactionExport()
    {
        $headers = [
            'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
            ,'Content-type'        => 'text/csv'
            ,'Content-Disposition' => 'attachment; filename=products_csv_export.csv'
            ,'Expires'             => '0'
            ,'Pragma'              => 'public',
        ];
        
        $lists    = Transaction::all()->toArray();
        $new_list = [];
        foreach($lists as $list){
            $new_list[] = $list;
        }
        
        
        # add headers for each column in the CSV download
        array_unshift($new_list,array_keys($new_list[0]));
        
        $callback = function () use ($new_list){
            $FH = fopen('php://output','w');
            foreach($new_list as $row){
                fputcsv($FH,$row);
            }
            fclose($FH);
        };
        
        return response()->stream($callback,200,$headers);
    }
    
    public function orderExport()
    {
        $headers = [
            'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
            ,'Content-type'        => 'text/csv'
            ,'Content-Disposition' => 'attachment; filename=products_csv_export.csv'
            ,'Expires'             => '0'
            ,'Pragma'              => 'public',
        ];
        
        $lists    = Order::all()->toArray();
        $new_list = [];
        foreach($lists as $list){
            $new_list[] = $list;
        }
        
        # add headers for each column in the CSV download
        array_unshift($new_list,array_keys($new_list[0]));
        
        $callback = function () use ($new_list){
            $FH = fopen('php://output','w');
            foreach($new_list as $row){
                fputcsv($FH,$row);
            }
            fclose($FH);
        };
        
        return response()->stream($callback,200,$headers);
    }
    
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request):RedirectResponse
    {
        // dd($request->all());
        // $files = public_path('/assets/images/product_images');
        // $f = scandir($files)[2];
        // $f->move(public_path('assets'));
        
        // dd('stop');
        $filename = '';
        if($file = $request->file('csv')){
            $filename = time().'-'.$file->getClientOriginalExtension();
            $file->move('assets/temp_files',$filename);
        }
        
        $file = fopen(public_path('assets/temp_files/'.$filename),"r");
        $row  = fgetcsv($file);
        
        if($row){
            $item_fields = $this->setUpItemFields($row);
            
            $attribute_options = $this->setUpProductAttributeOptions($item_fields);
            
        }else{
            return back()->withErrors('Invalid CSV File.');
        }
        
        $i = 0;
        while(($row = (fgetcsv($file))) !== false){
            DB::beginTransaction();
            
            try{
                $item = $this->fillItemFields($item_fields,$row);
                // dd($item);
               // For testing
            //    if(isset($item['gallery_images'])){
            //     $gal_images = explode(',', $item['gallery_images']);
                
            //     if(count($gal_images) > 0){
                    
            //         foreach($gal_images as $gal){
            //             if (file_exists(public_path() . '/assets/images/product_images/' . $gal)) {
            //                 dump( $gal);
                            
            //                 // File::move(public_path('/assets/images/product_images/'.$gal), public_path().'/assets/images/'.$gal);
            //                 // $gale = new Gallery();
            //                 // $gale->item_id = $product->id;
            //                 // $gale->photo = $gal;
            //                 // $gale->save();
                            
            //             }
            //         }
            //     }
                
            // }
               // end testing
                // dd(explode(',',$item['gallery_images']));
                $product = [];
                if( !Item::whereName($item['name'])->first()){
                    $product = $this->createProduct($item);
                    // dd($product);
                    
                    
                    if($product){
                        $attribute_id = $this->createOrGetAttributeId($item['attribute'],$item['attribute_abbreviation']);
                        File::makeDirectory(public_path().'/assets/images/products/'. $product->id);
                        foreach($attribute_options as $option_number => $attribute_option){
                            $required_attribute_option_fields = $this->fillAttributeOptionFields($attribute_option,$row);
                            // dump($required_attribute_option_fields);
                            if($required_attribute_option_fields && !empty($required_attribute_option_fields['price'])
                                && !empty($required_attribute_option_fields['description'])){
                                $required_attribute_option_fields['attribute_id'] = $attribute_id;
                                $required_attribute_option_fields['item_id']      = $product->id;
                                if (file_exists(public_path() . '/assets/images/product_images/' . $required_attribute_option_fields['variant_image'])) {
                                    
                                    File::copy(public_path('/assets/images/product_images/'.$required_attribute_option_fields['variant_image']), public_path().'/assets/images/products/'.$product->id.'/'.$required_attribute_option_fields['variant_image']);
                                    $required_attribute_option_fields['image']        = $required_attribute_option_fields['variant_image'];
                                }
                                

                                
                                $this->createProductAttributeOption($required_attribute_option_fields);
                            }
                        }
                    }
                }
                
                
                DB::commit();
                if($product){
                    // dd('yahan');
                    if (file_exists(public_path() . '/assets/images/product_images/' . $item['photo'])) {
                        
                        
                        File::copy(public_path('/assets/images/product_images/'.$item['photo']), public_path().'/assets/images/products/'.$product->id.'/'.$item['photo']);
                        $product->photo = $item['photo'];
                        $product->save();
                        
                    }
                    if(isset($item['gallery_images'])){
                        $gal_images = explode(',', $item['gallery_images']);
                        // File::makeDirectory(public_path().'/assets/images/Gallery');
                        if(count($gal_images) > 0){
                            foreach($gal_images as $gal){
                                if (file_exists(public_path() . '/assets/images/product_images/' . $gal)) {
                            
                                    //dd($gal);

                                    //dump(public_path('/assets/images/product_images/Kalksteinfliesen-gruen.jpg'));
                                    File::copy(public_path().'/assets/images/product_images/'.$gal, public_path().'/assets/images/'.$gal);
                                    
                                    $gale = new Gallery();
                                    $gale->item_id = $product->id;
                                    $gale->photo = $gal;
                                    $gale->save();
                                    
                                }
                            }
                        }
                        
                    }
                    //dd('stop');
                    // $this->setUpProductGallery($product);
                    
                    
                }
                // dump($product);
                
            }catch(Exception $e){
                DB::rollback();
                // return 
                // dump($e);
            }
            
            $i++;
        }
        // dd('stop');
        fclose($file);
        
        return back()->withSuccess(__('Product(s) Imported Successfully.'));
        
    }
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @param $columnFields
     *
     * @return array
     */
    public function setUpItemFields($columnFields):array
    {
        $fieldsArray = [];
        foreach($columnFields as $field){
            $fieldsArray[] = $field;
        }
        
        return $fieldsArray;
    }
    
    /**
     *
     * @param $columnFields
     *
     * @return array
     */
    public function setUpProductAttributeOptions($columnFields):array
    {
        $attribute_options = [];
        $preset            = 1;
        foreach($columnFields as $index => $column){
            //eg: 12, attribute_option_name1
            if(preg_match('/\d+/',$column,$option_number)){
                if($preset === (int)$option_number[0]){
                    $attribute_field                    = preg_replace('/\d/','',$column);
                    $attribute_options[$preset][$index] = $attribute_field;
                    continue;
                }
                
                $preset = (int)$option_number[0];
                
                if($preset === (int)$option_number[0]){
                    $attribute_field                    = preg_replace('/\d/','',$column);
                    $attribute_options[$preset][$index] = $attribute_field;
                    continue;
                }
            }
            
        }
        
        return $attribute_options;
    }
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @param $itemFields
     * @param $row
     *
     * @return array
     */
    public function fillItemFields($itemFields,$row):array
    {
        $item = [];
        foreach($itemFields as $index => $name){
            if($name === 'category' and !empty($row[$index])){
                $item[$name.'_id'] = $this->createOrFindProductCategory($index,$row);
                continue;
            }
            
            if($name === 'subcategory' and !empty($row[$index])){
                $item[$name.'_id'] = $this->createOrFindProductSubCategory($index,$item['category_id'],$row);
                continue;
            }
            
            $item[$name] = ( !empty($row[$index])) ? $row[$index] : null;
        }
        
        $item['warehouse_id'] = Warehouse::first()->id;
        $item['thumbnail']    = $this->setUpProductThumbnail($item['name']);
        $item['slug']         = ItemHelper::toSlug($item['name']);
        $item['sku']          = Str::random(10);
        return $item;
    }
    
    /**
     * @author      Ali Usman
     * @since       4/23/2022
     *
     * @param $category_name
     * @param $row
     *
     * @return int
     * @description Check if category exists, then use it else create new category for product
     */
    public function createOrFindProductCategory($category_name,$row):int
    {
        $category = Category::whereName($row[$category_name])->first();
        if($category){
            return $category->id;
            
        }else{
            $category = new Category();
            $category->fill(
                [
                    'name'   => $row[$category_name],
                    'title'  => $row[$category_name],
                    'slug'   => ItemHelper::toSlug($row[$category_name]),
                    'serial' => 10,
                    'status' => 1,
                ]
            )->save();
            
            return $category->id;
        }
    }
    
    /**
     * @author      Ali Usman
     * @since       4/23/2022
     *
     * @param $category_name
     * @param $parent_id
     * @param $row
     *
     * @return int
     * @description Check if sub category exists, then use it else create new sub category
     * for product under parent category
     */
    public function createOrFindProductSubCategory($category_name,$parent_id,$row):int
    {
        $sub_category = Subcategory::whereName($row[$category_name])->first();
        if($sub_category){
            return $sub_category->id;
        }else{
            $sub_category = new Subcategory();
            $sub_category->fill(
                [
                    'name'        => $row[$category_name],
                    'slug'        => ItemHelper::toSlug($row[$category_name]),
                    'category_id' => $parent_id,
                    'status'      => 1,
                ]
            )->save();
            
            return $sub_category->id;
        }
    }
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @param  $itemName
     *
     * @return string|null
     */
    public function setUpProductThumbnail($itemName):?string
    {
        $images = $this->getImagesFromProductDirectory($itemName);
        
        if($images){
            foreach($images as $thumb){
                $thumbnail = explode('.',$thumb);
                if($thumbnail[0] === 'thumbnail'){
                    return $thumb;
                }
            }
        }
        
        return '';
    }
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @param $itemName
     *
     * @return array|false
     */
    public function getImagesFromProductDirectory($itemName)
    {
        $product_images_directory = public_path("/assets/images/products/$itemName/");
        // dd($product_images_directory);
        if(file_exists($product_images_directory)){
            return array_diff(scandir($product_images_directory),['.','..']);
        }
        
        return false;
    }
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @param  $itemName
     *
     * @return string|null
     */
//    public function setUpProductFeaturedImage($itemName):?string
//    {
//        $images = $this->getImagesFromProductDirectory($itemName);
//        if($images){
//            foreach($images as $image){
//                $featured_image = explode('.',$image);
//                if($featured_image[0] === 'featured_image'){
//                    return $image;
//                }
//            }
//        }
//
//        return '';
//    }
//

    /**
     * @author Ali Usman
     * @since  4/30/2022
     *
     * @param $item
     *
     * @return \App\Models\Item
     */

    

    public function createProduct($item):Item
    {
        $product = new Item();
        // dd($item);
        $item['product_features']=utf8_encode($item['product_features']);
        $item['product_description']=utf8_encode($item['product_description']);
        $product->fill($item)->save();

        if($item['up_selling']){
            $up_selling = explode('-',$item['up_selling']);
            foreach($up_selling as $up){
                $p = Item::find($up);
                if($p){
                    $u = new UpSellingProduct();
                    $u->parent_product = $product->id;
                    $u->child_product = $up;
                    $u->save();
                }
                
            }
        }

        if($item['cross_selling']){
            $cross_selling = explode('-',$item['cross_selling']);
            foreach($cross_selling as $cross){
                $p = Item::find($cross);
                if($p){
                    $u = new CrossSellingProduct();
                    $u->parent_product = $product->id;
                    $u->child_product = $cross;
                    $u->save();
                }
                
            }
        }
        return $product;
    }
    
    /**
     * @author Ali Usman
     * @since  4/30/2022
     *
     * @param $attributeName
     * @param $attributeAbbreviation
     *
     * @return int
     */
    public function createOrGetAttributeId($attributeName,$attributeAbbreviation):int
    {
        $attribute = Attribute::whereName($attributeName)->first();
        
        if( !$attribute){
            $attribute = new Attribute();
            $attribute->fill([$attributeName,$attributeAbbreviation])->save();
            
            return $attribute->id;
        }
        
        return $attribute->id;
    }
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @param $attributeOptionFields
     * @param $row
     *
     * @return array|false
     */
    public function fillAttributeOptionFields($attributeOptionFields,$row)
    {
        $attribute_option_fields = [];
        foreach($attributeOptionFields as $index => $name){
            $name                           = str_replace('attribute_option_','',$name);
            $attribute_option_fields[$name] = ( !empty($row[$index])) ? $row[$index] : null;
        }
        
        $required_columns = $this->required_attribute_option_keys();
        // dump($required_columns);
        // dd($attribute_option_fields);
        foreach($required_columns as $column){
            if( !array_key_exists($column,$attribute_option_fields)){
                // dump($column);
            }
        }
        // dd('jhhj');
        return $attribute_option_fields;
    }
    
    /**
     * @author Ali Usman
     * @since  4/30/2022
     *
     * @return array
     */
    public function required_attribute_option_keys():array
    {
        return [
            // 'name',
            'price',
            'description',
            'item_number',
            'format',
            'quantity',
            // ''
            'variable_quantity',
        ];
    }
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @param  $itemName
     * @param  $option_number
     *
     * @return string
     */
    public function setUpProductAttributeOptionImage($itemName,$option_number):string
    {
        $images = $this->getImagesFromProductDirectory($itemName);
        if($images){
            foreach($images as $image){
                $image_name = explode('.',$image);
                if($image_name[0] === 'attribute_option_image'.$option_number){
                    return $image;
                }
            }
        }
        
        return '';
    }
    
    /**
     * @author Ali Usman
     * @since  4/30/2022
     *
     * @param $attributeOptionFields
     *
     */
    public function createProductAttributeOption($attributeOptionFields):void
    {
        // dd($attributeOptionFields);
        $attribute_option = new AttributeOption();
        if(!empty($attributeOptionFields['price']) && !empty($attributeOptionFields['description'])){
            $attributeOptionFields['description']=utf8_encode($attributeOptionFields['description']);
            $attributeOptionFields['format']=utf8_encode($attributeOptionFields['format']);
            $attributeOptionFields['surface']=utf8_encode($attributeOptionFields['surface']);
            $attributeOptionFields['edge']=utf8_encode($attributeOptionFields['edge']);
            $attributeOptionFields['frost_resistance']=utf8_encode($attributeOptionFields['frost_resistance']);
            $attributeOptionFields['use']=utf8_encode($attributeOptionFields['use']);
            $attributeOptionFields['material']=utf8_encode($attributeOptionFields['material']);
            // $attributeOptionFields['format']=utf8_encode($attributeOptionFields['format']);
            // $attributeOptionFields['format']=utf8_encode($attributeOptionFields['format']);
            // dd($attributeOptionFields);
            $attribute_option->fill($attributeOptionFields)->save();
            // $attribute_option->use = 
            // return $attribute_option;
        }
        
    }
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @param  $item
     *
     * @return void
     */
    public function setUpProductGallery($item):void
    {
        // dd($item['name']);
        $images = $this->getImagesFromProductDirectory($item['name']);
        // if()
        foreach($images as $image){
            $image_name = explode('.',$image);
            if( !in_array($image_name[0],$this->nonGalleryImages()) and !$this->attributeOptionsImage($image_name[0])){
                $item->galleries()->save(new Gallery(['item_id' => $item->id,'photo' => $image]));
            }
        }
    }
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @return array
     */
    public function nonGalleryImages():array
    {
        $non_gallery_images   = [];
        $non_gallery_images[] = 'thumbnail';
        $non_gallery_images[] = 'featured_image';
        
        return $non_gallery_images;
    }
    
    /**
     * @author Ali Usman
     * @since  4/23/2022
     *
     * @param $imageName
     *
     * @return bool
     */
    public function attributeOptionsImage($imageName):bool
    {
        if(strpos($imageName,'attribute_option_image') === 0){
            return 1;
        }
        
        return 0;
    }
    
    
    /**
     * @author Ali Usman
     * @since  4/30/2022
     * @return array
     */
    public function CSVAttributeOptionColumns():array
    {
        return [
            'attribute_option_name',
            'attribute_price',
            'attribute_stock',
            'attribute_image',
            'attribute_description',
            'attribute_length',
            'attribute_height',
            'attribute_broad',
            'attribute_quantity',
            'attribute_variable_quantity',
        ];
    }
}