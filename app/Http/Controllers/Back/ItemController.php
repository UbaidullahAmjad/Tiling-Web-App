<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\Item,
    Models\Gallery,
    Models\Attribute,
    Models\AttributeOption,
    Models\UpSellingProduct,
    Models\CrossSellingProduct,
    Http\Requests\ItemRequest,
    Http\Controllers\Controller,
    Http\Requests\GalleryRequest,
    Repositories\Back\ItemRepository
};
use App\Models\Category;
use App\Models\ChieldCategory;
use App\Models\Currency;
use App\Models\Subcategory;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\ItemRepository $repository
     *
     */
    public function __construct(ItemRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->repository = $repository;
    }


    public function add()
    {
        return view('back.item.add');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $item_type = $request->has('item_type') ? ($request->item_type ? $request->item_type : '') : '';
        $is_type = $request->has('is_type') ? ($request->is_type ? $request->is_type : '') : '';
        $category_id = $request->has('category_id') ? ($request->category_id ? $request->category_id : '') : '';
        $orderby = $request->has('orderby') ? ($request->orderby ? $request->orderby : 'desc') : 'desc';

        $datas = Item::
        when($item_type, function ($query, $item_type) {
            return $query->where('item_type', $item_type);
        })
        ->when($is_type, function ($query, $is_type) {
            if($is_type != 'outofstock'){
                return $query->where('is_type', $is_type);
            }else{
                return $query->whereStock(0)->whereItemType('normal');
            }

        })
        ->when($category_id, function ($query, $category_id) {
            return $query->where('category_id', $category_id);
        })
        ->when($orderby, function ($query, $orderby) {
            return $query->orderby('id', $orderby);
        })
        ->get();

        return view('back.item.index',[
            'datas' => $datas
        ]);
    }

    /**
     * Show the form for get subcategory a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsubCategory(Request $request)
    {

        if($request->category_id){
            $data = Category::findOrFail($request->category_id);
            $data = $data->subcategory;
        }else{
            $data = [];
        }

        return response()->json(['data'=>$data]);
    }

    /**
     * Show the form for get subcategory a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getChildCategory(Request $request)
    {

        if($request->subcategory_id){
            $data = Subcategory::findOrFail($request->subcategory_id);
            $data = $data->childcategory;
        }else{
            $data = [];
        }

        return response()->json(['data'=>$data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $att = Attribute::all();

        // foreach($att as $attribute){
        //     // dump($attribute->name);
        //     // dump();
        //     if($attribute->abbrivation == 'liter' || $attribute->abbrivation == 'piece' || $attribute->abbrivation == "m²"){
        //         dump($attribute->abbrivation);
        //     }
        // }
        // dd('stop');
        return view('back.item.create',[
            'curr' => Currency::where('is_default',1)->first(),
            'warehouses' => Warehouse::first(),
            'attributes' => Attribute::all(),
            'items'      => Item::all(),  
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        // dd($request->all());
        // if($request->att_name == 0){
        //     return back()->withError(__('Please Select one of the variants'));
        // }
        $item_id = $this->repository->store($request);

        if($request->is_button == 1){
            return redirect()->route('back.item.edit',$item_id)->withSuccess(__('Product Added Successfully along with Variants'));
        }else if($request->is_button == 0){
            return redirect(route('back.item.index'))->withSuccess(__('Product Added Successfully along with Variants'));
        }else{
            return redirect(route('back.item.create'))->withSuccess(__('Some Data is wrong'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        // dd($item);
        $warehouses = WareHouse::first();
        $our_item = Item::find($item->id);
        // $attribute = $item->attributes->first();
        $attribute_options = $item->attributeOptions;

        $items = Item::where('id', '!=', $item->id)->get();
        // dd($attribute_options);
        $attribute_option = $item->attributeOptions->first();
        // dd($attribute_options);
        $attribute = '';
        if(!empty($attribute_option)){
            $attribute = Attribute::find($attribute_option->attribute_id);
        }
        
        $up_selling = UpSellingProduct::where('parent_product', $item->id)->pluck('child_product');
        $cross_selling = CrossSellingProduct::where('parent_product', $item->id)->pluck('child_product');

        $up_sell_array = [];
        $cross_sell_array = [];
        foreach($up_selling as $up){
            array_push($up_sell_array, $up);
        }
        foreach($cross_selling as $c){
            array_push($cross_sell_array, $c);
        }
        // dd($up_selling);
        
        $attributes = Attribute::all();
        // dd($attribute);
        // dd($attributes);
        // $attributes = Attribute::join()
        // dd($item);
        return view('back.item.edit',[
            'item' => $item,
            'our_item' => $our_item,

            'curr' => Currency::where('is_default',1)->first(),
            'social_icons' => json_decode($item->social_icons,true),
            'social_links' => json_decode($item->social_links,true),
            'specification_name' => json_decode($item->specification_name,true),
            'specification_description' => json_decode($item->specification_description,true),
            'warehouses' => $warehouses,
            'selected_attribute' => $attribute,
            'attributes' => $attributes,
            'attribute_options' => $attribute_options,
            'up_sell_array' => $up_sell_array,
            'cross_sell_array' => $cross_sell_array,
            'items'         => $items,
            'attribute_option' => $attribute_option

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, Item $item)
    {
        // dd($request->all());
        if(is_numeric($request->att_name)){
            return back()->withError(__('Please Select one of the variants'));
        }
        $item = $this->repository->update($item, $request);

        if($item == true){
            return redirect()->route('back.item.index')->withSuccess(__('Product Updated Successfully.'));
        }else{
            return redirect()->route('back.item.edit',$item->id)->withError(__('Some thing went wrong'));
        }
    }

    /**
     * Change the status for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function status(Item $item,$status)
    {
        $item->update(['status' => $status]);
        return redirect()->back()->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
            $ups = UpSellingProduct::where('parent_product', $item->id)->get();
            if(count($ups) > 0){
                foreach($ups as $up){
                    $up->delete();
                }
            }
            $cps = CrossSellingProduct::where('parent_product', $item->id)->get();
            if(count($cps) > 0){
                foreach($cps as $up){
                    $up->delete();
                }
            }
        $this->repository->delete($item);
        return redirect()->back()->withSuccess(__('Product Deleted Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function galleries(Item $item)
    {
        return view('back.item.galleries',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\GalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function galleriesUpdate(GalleryRequest $request)
    {
        $this->repository->galleriesUpdate($request);
        return redirect()->back()->withSuccess(__('Gallery Information Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function galleryDelete(Gallery $gallery)
    {
        $this->repository->galleryDelete($gallery);
        return redirect()->back()->withSuccess(__('Successfully Deleted From Gallery.'));
    }


    public function highlight(Item $item)
    {
        return view('back.item.highlight',[
            'item' => $item
        ]);
    }
    public function highlight_update(Item $item,Request $request)
    {
        $this->repository->highlight($item, $request);
        return redirect()->route('back.item.index')->withSuccess(__('Product Updated Successfully.'));
    }




    // ---------------- DIGITAL PRODUCT START ---------------//

    public function deigitalItemCreate()
    {
        return view('back.item.digital.create',[
            'curr' => Currency::where('is_default',1)->first()
        ]);
    }

    public function deigitalItemStore(ItemRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('back.item.index')->withSuccess(__('New Product Added Successfully.'));
    }

    public function deigitalItemEdit($id)
    {
        $item = Item::findOrFail($id);

        return view('back.item.digital.edit',[
            'item' => $item,
            'curr' => Currency::where('is_default',1)->first(),
            'social_icons' => json_decode($item->social_icons,true),
            'social_links' => json_decode($item->social_links,true),
            'specification_name' => json_decode($item->specification_name,true),
            'specification_description' => json_decode($item->specification_description,true),
        ]);
    }


    // ---------------- LICENSE PRODUCT START ---------------//

    public function licenseItemCreate()
    {
        return view('back.item.license.create',[
            'curr' => Currency::where('is_default',1)->first()
        ]);
    }

    public function licenseItemStore(ItemRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('back.item.index')->withSuccess(__('New Product Added Successfully.'));
    }

    public function licenseItemEdit($id)
    {
        $item = Item::findOrFail($id);

        return view('back.item.license.edit',[
            'item' => $item,
            'curr' => Currency::where('is_default',1)->first(),
            'social_icons' => json_decode($item->social_icons,true),
            'social_links' => json_decode($item->social_links,true),
            'specification_name' => json_decode($item->specification_name,true),
            'specification_description' => json_decode($item->specification_description,true),
            'license_name' => json_decode($item->license_name,true),
            'license_key' => json_decode($item->license_key,true),
        ]);
    }


    public function stockOut()
    {
        $datas = Item::where('item_type','normal')->where('stock',0)->get();
        return view('back.item.stockout',compact('datas'));
    }

    public function changeAttribute(Request $request){
        // dd($request->all());
        $attribute = Attribute::find($request->id);

        $attribute_options = AttributeOption::where('item_id', $request->item_id)->get();
        if (count($attribute_options) > 0) {
            foreach ($attribute_options as $option) {
                $option->delete();
            }
        }

        return response()->json($attribute);
    }


    public function uploadMultipleImages(Request $request){
        // dd($request->all());
        $filename = '';
        if(isset($request->images) && count($request->images) > 0){
            $images = $request->images;
            // dd($images);
            foreach($images as $image){
                $filename = $image->getClientOriginalName();
                $image->move('assets/images/product_images',$filename);
            }

            return back()->withSuccess(__('Images Added successfully.'));
            
        }else{
            return back()->withSuccess(__('Please Select at-least one image.'));
        }
        
            
        
    }

    public function removeVariant(Request $request){
        $att_op = AttributeOption::find($request->var_id);
        $att_op->delete();

        $response = [
            'item_id' => $request->item_id,
            'var_id' => $request->var_id,
        ];

        return response()->json($response);
    }



}
