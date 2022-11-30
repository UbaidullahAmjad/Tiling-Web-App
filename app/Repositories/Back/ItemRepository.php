<?php

namespace App\Repositories\Back;

use App\{
    Models\Item,
    Models\Attribute,
    Models\UpSellingProduct,
    Models\CrossSellingProduct,
    Models\AttributeOption,
    Models\WarehouseAvailability,
    Models\Gallery,
    Helpers\ImageHelper
};
use App\Models\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
class ItemRepository
{

    /**
     * Store item.
     *
     * @param  \App\Http\Requests\ItemRequest  $request
     * @return void
     */

    public function store($request)
    {
        $model = new Item();
        $fill = $model->getFillable();
        // dd($fill);
        // dd($request->all());
        $input = $request->only($fill);
        
        $otherData = $request->except($fill);
        // dd($otherData);
        if(!empty($otherData['abbrivation'])){
            if($otherData['abbrivation'] != 'liter' && $otherData['abbrivation'] != 'piece'){
                
                   
                    $request->validate([
                        'image.*' => 'required',
                        'description.*' => 'required',
                        'price.*' => 'required',
                        // 'height.*' => 'required',
                        // 'length.*' => 'required',
                        // 'broad.*' => 'required',
                        'format.*' => 'required',
                        'availability.*' => 'required',
                        'variable_quantity.*' => 'required',
                        'item_number.*' => 'required'
                    ],
                    [
                    'variable_quantity.*.required'=> 'Box Size is required', // custom message
                    'item_number.*.required'=> 'Item Number is Required', // custom message

                    ]
                );
            }else{

                $request->validate([

                    'descriptionn' => 'required',
                    'pricee' => 'required',
                    'quantityy' => 'required'
                ]);
            }
        }
        DB::beginTransaction();
        try{


        $curr = Currency::where('is_default', 1)->first();
       
        if ($request->has('tags')) {
            $input['tags'] = str_replace(["value", "{", "}", "[", "]", ":", "\""], '', $request->tags);
        }

       
        $item = Item::create($input);
        $item_id = $item->id;
        //dd($item);
        if($request->up_selling && count($request->up_selling) > 0){
            $up_selling = $request->up_selling;
            foreach($up_selling as $up){
                $u = new UpSellingProduct();
                $u->parent_product = $item->id;
                $u->child_product = $up;
                $u->save();
            }
        }

        if($request->cross_selling && count($request->cross_selling) > 0){
            $cross_selling = $request->cross_selling;
            foreach($cross_selling as $cross){
                $u = new CrossSellingProduct();
                $u->parent_product = $item->id;
                $u->child_product = $cross;
                $u->save();
            }
        }

        if ($file = $request->file('photo')) {
            $images_name = $this->ItemhandleUploadedImage($request->file('photo'), Item::find($item_id));
            $item->photo = $images_name[0];
            $item->thumbnail = $images_name[1];
            $item->save();
        }
        // if (isset()) {

        // }
      if(isset($request->galleries) && count($request->galleries) > 0){
                foreach($request->galleries as $file){
                    $photo = time() . $file->getClientOriginalName();
					//dd($photo);
                    $file->move(public_path() . '/assets/images/', $photo);
                    $gal = new Gallery();
                    $gal->item_id = $item_id;
                    $gal->photo = $photo;
                    $gal->save();
                }

            }
		//dd($item);



        if(!empty($otherData['abbrivation'])){

            $attribute_id = explode('_', $otherData['att_name'])[1];

            if($otherData['abbrivation'] != 'liter' && $otherData['abbrivation'] != 'piece'){
                if(count($otherData['description']) > 0 && count($otherData['image']) > 0 && count($otherData['price']) > 0 && count($otherData['description']) > 0 && count($otherData['variable_quantity']) > 0){
                    for($i =0; $i < count($otherData['image']); $i++){
                        $attributeOption = AttributeOption::create([
                            'attribute_id' => $attribute_id,
                            'item_id' => $item_id,
							'price' => isset($otherData['price'][$i]) ? $otherData['price'][$i] : NULL,
                            'material' => isset($otherData['material'][$i]) ? $otherData['material'][$i] : NULL,
                            'length' => isset($otherData['length'][$i]) ? $otherData['length'][$i] : NULL,
                            'broad' => isset($otherData['broad'][$i]) ? $otherData['broad'][$i] : NULL,
                            'height' => isset($otherData['height'][$i]) ? $otherData['height'][$i] : NULL,
                            'description' => isset($otherData['description'][$i]) ? $otherData['description'][$i] : NULL,
                            'item_number' => isset($otherData['item_number'][$i]) ? $otherData['item_number'][$i] : NULL,
                            'use' => isset($otherData['used'][$i]) ? $otherData['used'][$i] : NULL,
                            'format' => isset($otherData['format'][$i]) ? $otherData['format'][$i] : NULL,
                            'surface' => isset($otherData['surface'][$i]) ? $otherData['surface'][$i] : NULL,
                            'edge' => isset($otherData['edge'][$i]) ? $otherData['edge'][$i] : NULL,
                            'weight_per_unit' => isset($otherData['weight_per_unit'][$i]) ? $otherData['weight_per_unit'][$i] : NULL,
                            'box_contains' => isset($otherData['box_contains'][$i]) ? $otherData['box_contains'][$i] : NULL,
                            'variable_quantity' => isset($otherData['variable_quantity'][$i]) ? $otherData['variable_quantity'][$i] : NULL,
                            'frost_resistance' => isset($otherData['frost_resistance'][$i]) ? $otherData['frost_resistance'][$i] : NULL,
                            'synonyms' => isset($otherData['synonyms'][$i]) ? $otherData['synonyms'][$i] : NULL,

                        ]);


                            $file = $otherData['image'][$i];
                            $photo = time() . $file->getClientOriginalName();
                            $file->move(public_path() . '/assets/images/products/'. $item->id, $photo);

                            $attributeOption->image = $photo;
                            $attributeOption->save();

                            if(!empty($otherData['availability'][$i])){
                                $payload = [
                                    'attribute_options_id' => $attributeOption->id,
                                    'availability' => $otherData['availability'][$i],
                                ];
                                $saveWarehouseAvailability = WarehouseAvailability::create($payload);

                                $attributeOption->quantity = $otherData['availability'][$i];
                                $attributeOption->save();
                            }
                    }
                }


            }else{
                if(!empty($otherData['descriptionn']) && !empty($otherData['quantityy']) && !empty($otherData['pricee'])){
                    $attributeOption = AttributeOption::create([
                        'attribute_id' => $attribute_id,
                        'item_id' => $item_id,
                        'price' => isset($otherData['pricee']) ? $otherData['pricee'] : NULL,
                        'description' => isset($otherData['descriptionn']) ? $otherData['descriptionn']: NULL,
                        'quantity' => isset($otherData['quantityy']) ? $otherData['quantityy'] : NULL,
                    ]);


                }
            }
        }

            DB::commit();

			//dd("END");

                return $item_id;


        }catch(\Exception $e){
            DB::rollback();
            // dd($e);
            return $e;
        }

    }

    /**
     * Update item.
     *
     * @param  \App\Http\Requests\ItemRequest  $request
     * @return void
     */

    public function update($item, $request)
    {
        // dd($request->all());
        $model = new Item();
        $fill = $model->getFillable();
        // unset($fill['photo']);
        // dd($fill);
        $input = $request->only($fill);
        //dump($input);
        unset($input['photo']);
        // dd($input);
        $otherData = $request->except($fill);
		//dd($otherData);
        $gals = Gallery::where('item_id', $item->id)->get();

            if(isset($request->galleries) && count($request->galleries) > 0){
                $gals = Gallery::where('item_id', $item->id)->get();
                foreach($gals as $gal){
                    $gal->delete();
                }
                foreach($request->galleries as $file){
                    $photo = time() . $file->getClientOriginalName();
                    $file->move(public_path() . '/assets/images/', $photo);
                    $gal = new Gallery();
                    $gal->item_id = $item->id;
                    $gal->photo = $photo;
                    $gal->save();
                }

            }
        // dd($otherData);
        if(!empty($otherData['abbrivation'])){
            if($otherData['abbrivation'] != 'liter' && $otherData['abbrivation'] != 'piece'){

                $request->validate([
                    'image.*' => 'required',
                    'description.*' => 'required',
                    'price.*' => 'required',
                    // 'height.*' => 'required',
                    // 'length.*' => 'required',
                    // 'broad.*' => 'required',
                    'format.*' => 'required',
                    'availability.*' => 'required',
                    'variable_quantity.*' => 'required',
                    'item_number.*' => 'required'

                ],
                [
                    'variable_quantity.*.required'=> 'Box Size is required', // custom message
                    'item_number.*.required'=> 'Item Number is Required', // custom message

                    ]
            );

                if(isset($request->description_new[0]) && $request->description_new[0] != null && isset($request->price_new[0]) && $request->price_new[0] != null
                && $request->format_new[0] != null  && $request->availability_new[0] != null
                && $request->variable_quantity_new[0] != null && $request->item_number_new[0] != null){
                    $request->validate([
                        'image_new.*' => 'required',
                        'description_new.*' => 'required',
                        'price_new.*' => 'required',
                        // 'height_new.*' => 'required',
                        // 'length_new.*' => 'required',
                        // 'broad_new.*' => 'required',
                        'format_new.*' => 'required',
                        'availability_new.*' => 'required',
                        'variable_quantity_new.*' => 'required',
                        'item_number_new.*' => 'required'
                    ],[
                        'variable_quantity_new.*.required'=> 'Box Size is required', // custom message
                        'item_number_new.*.required'=> 'Item Number is Required', // custom message

                        ]);
                }
            }else if(!isset($request->descriptionn) || !isset($request->pricee) || !isset($request->quantityy)){
                if(!isset($request->descriptionnn) && !isset($request->priceee) && !isset($request->quantityyy)){
                    $request->validate([

                        'descriptionn' => 'required',
                        'pricee' => 'required',
                        'quantityy' => 'required'
                    ]);
                }
                

                if(!isset($request->descriptionnn) || !isset($request->priceee) || !isset($request->quantityyy)){
                    $request->validate([

                        'descriptionnn' => 'required',
                        'priceee' => 'required',
                        'quantityyy' => 'required'
                    ]);
                }
            }
        }



        try{



            if ($request->has('meta_keywords')) {
                // dd($request->meta_keywords);
                $input['meta_keywords'] = $request->meta_keywords;
                // dd($input);
            }

            $curr = Currency::where('is_default', 1)->first();
            // $input['discount_price'] = $request->discount_price / $curr->value;
            // $input['previous_price'] = $request->previous_price / $curr->value;


            // if ($request->has('is_social')) {
            //     $input['social_icons'] = json_encode($input['social_icons']);
            //     $input['social_links'] = json_encode($input['social_links']);
            // } else {
            //     $input['is_social']    = 0;
            //     $input['social_icons'] = null;
            //     $input['social_links'] = null;
            // }

            if ($request->has('tags')) {
                $input['tags'] = str_replace(["value", "{", "}", "[", "]", ":", "\""], '', $request->tags);
            }

            // if ($request->has('is_specification')) {
            //     $input['specification_name'] = json_encode($input['specification_name']);
            //     $input['specification_description'] = json_encode($input['specification_description']);
            // } else {
            //     $input['is_specification']    = 0;
            //     $input['specification_name'] = null;
            //     $input['specification_description'] = null;
            // }

            // if ($request->has('license_name') && $request->has('license_key')) {
            //     $input['license_name'] = json_encode($input['license_name']);
            //     $input['license_key'] = json_encode($input['license_key']);
            // } else {
            //     $input['license_name'] = null;
            //     $input['license_key'] = null;
            // }


            // if ($request->item_type == 'digital') {
            //     if (!$request->hasFile('file')) {
            //         if ($request->link) {
            //             if (file_exists('assets/files/' . $item->file)) {
            //                 unlink('assets/files/' . $item->file);
            //             }
            //             $input['file'] = null;
            //         }
            //     }
            // }
            // // digital product file upload
            // if ($request->item_type == 'digital') {
            //     if ($request->hasFile('file')) {
            //         if ($item->file) {
            //             if (file_exists('assets/files/' . $item->file)) {
            //                 unlink('assets/files/' . $item->file);
            //             }
            //         }

            //         $file = $request->file;
            //         $name = time() . str_replace(' ', '', $file->getClientOriginalName());
            //         $file->move('assets/files', $name);
            //         $input['file'] = $name;
            //         $input['link'] = null;
            //     }
            // }
// dd($input);
            $item->update($input);

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
            if($request->up_selling && count($request->up_selling) > 0){
                $up_selling = $request->up_selling;
                foreach($up_selling as $up){
                    $u = new UpSellingProduct();
                    $u->parent_product = $item->id;
                    $u->child_product = $up;
                    $u->save();
                }
            }
    
            if($request->cross_selling && count($request->cross_selling) > 0){
                $cross_selling = $request->cross_selling;
                foreach($cross_selling as $cross){
                    $u = new CrossSellingProduct();
                    $u->parent_product = $item->id;
                    $u->child_product = $cross;
                    $u->save();
                }
            }
    

            $opt = '';
            if(!empty($otherData['abbrivation'])){
                if($otherData['abbrivation'] != 'liter' && $otherData['abbrivation'] != 'piece'){
                    $op = $item->attributeOptions;
                    if(count($op) > 0){
                        $opt = true;
                    }else{
                        $opt = false;
                    }
                }else{
                    $op = $item->attributeOptions ? $item->attributeOptions->first() : '';
                    if(!empty($op)){
                        $opt = true;
                    }else{
                        $opt = false;
                    }
                }
            }

            if(!empty($otherData['abbrivation']) && $opt == false){
                $attribute_id = explode('_', $otherData['att_name'])[1];

                if($otherData['abbrivation'] != 'liter' && $otherData['abbrivation'] != 'piece'){

                    if(count($otherData['description_new']) > 0 && count($otherData['image_new']) > 0 && count($otherData['price_new']) > 0 && count($otherData['variable_quantity_new']) > 0){
                        for($i =0; $i < count($otherData['description_new']); $i++){

                            $attributeOption = AttributeOption::create([
                                'attribute_id' => $attribute_id,
                                'item_id' => $item->id,
                                'price' => isset($otherData['price_new'][$i]) ? $otherData['price_new'][$i] : NULL,
								'material' => isset($otherData['material'][$i]) ? $otherData['material'][$i] : NULL,
                                'length' => isset($otherData['length_new'][$i]) ? $otherData['length_new'][$i] : NULL,
                                'broad' => isset($otherData['broad_new'][$i]) ? $otherData['broad_new'][$i] : NULL,
                                'height' => isset($otherData['height_new'][$i]) ? $otherData['height_new'][$i] : NULL,
                                'description' => isset($otherData['description_new'][$i]) ? $otherData['description_new'][$i] : NULL,
                                'item_number' => isset($otherData['item_number_new'][$i]) ? $otherData['item_number_new'][$i] : NULL,
                                'use' => isset($otherData['used_new'][$i]) ? $otherData['used_new'][$i] : NULL,
                                'format' => isset($otherData['format_new'][$i]) ? $otherData['format_new'][$i] : NULL,
                                'surface' => isset($otherData['surface_new'][$i]) ? $otherData['surface_new'][$i] : NULL,
                                'edge' => isset($otherData['edge_new'][$i]) ? $otherData['edge_new'][$i] : NULL,
                                'weight_per_unit' => isset($otherData['weight_per_unit_new'][$i]) ? $otherData['weight_per_unit_new'][$i] : NULL,
                                'box_contains' => isset($otherData['box_contains_new'][$i]) ? $otherData['box_contains_new'][$i] : NULL,
                                'variable_quantity' => isset($otherData['variable_quantity_new'][$i]) ? $otherData['variable_quantity_new'][$i] : NULL,
                                'frost_resistance' => isset($otherData['frost_resistance_new'][$i]) ? $otherData['frost_resistance_new'][$i] : NULL,
                                'synonyms' => isset($otherData['synonyms_new'][$i]) ? $otherData['synonyms_new'][$i] : NULL,

                            ]);

                                $file = $otherData['image_new'][$i];
                                $photo = time() . $file->getClientOriginalName();
                                $file->move(public_path() . '/assets/images/products/'.$item->id, $photo);

                                $attributeOption->image = $photo;
                                $attributeOption->save();
                                if(!empty($otherData['availability_new'][$i])){
                                    $payload = [
                                        'attribute_options_id' => $attributeOption->id,
                                        'availability' => $otherData['availability_new'][$i],
                                    ];
                                    $saveWarehouseAvailability = WarehouseAvailability::create($payload);

                                    $attributeOption->quantity = $otherData['availability_new'][$i];
                                    $attributeOption->save();
                                }

                        }
                    }


                }else{

                    if(!empty($otherData['descriptionn']) && !empty($otherData['quantityy']) && !empty($otherData['pricee'])){


                        $attributeOption = AttributeOption::create([
                            'attribute_id' => $attribute_id,
                            'item_id' => $item->id,
                            'price' => isset($otherData['pricee']) ? $otherData['pricee'] : NULL,
                            'description' => isset($otherData['descriptionn']) ? $otherData['descriptionn']: NULL,
                            'quantity' => isset($otherData['quantityy']) ? $otherData['quantityy'] : NULL,
                        ]);


                    }
                    // dd('pppppp3333');

                }
            }else if(!empty($otherData['abbrivation']) && $opt == true){
                $attribute_id = explode('_', $otherData['att_name'])[1];
                // dd($var);
                if($otherData['abbrivation'] != "liter" &&  $otherData['abbrivation'] != "piece"){
                // dd($otherData);
                    if(count($otherData['description']) > 0 && count($otherData['price']) > 0 && count($otherData['description']) > 0 && count($otherData['variable_quantity']) > 0){
                        for($i =0; $i < count($otherData['price']); $i++){
                            $id = isset($otherData['option_ids'][$i]) ? $otherData['option_ids'][$i] : 0;
                            $option = AttributeOption::find($id);

                            if(!empty($option)){

                                $attributeOption = $option->update([

                                    'attribute_id' => $attribute_id,
                                    'item_id' => $item->id,
									'material' => isset($otherData['material'][$i]) ? $otherData['material'][$i] : $option->material,
                                    'price' => isset($otherData['price'][$i]) ? $otherData['price'][$i] : $option->price,
                                    'length' => isset($otherData['length'][$i]) ? $otherData['length'][$i] : $option->length,
                                    'broad' => isset($otherData['broad'][$i]) ? $otherData['broad'][$i] : $option->broad,
                                    'height' => isset($otherData['height'][$i]) ? $otherData['height'][$i] : $option->height,
                                    'description' => isset($otherData['description'][$i]) ? $otherData['description'][$i] : $option->description,
                                    'item_number' => isset($otherData['item_number'][$i]) ? $otherData['item_number'][$i] : $option->item_number,
                                    'use' => isset($otherData['used'][$i]) ? $otherData['used'][$i] : $option->used,
                                    'format' => isset($otherData['format'][$i]) ? $otherData['format'][$i] : $option->format,
                                    'surface' => isset($otherData['surface'][$i]) ? $otherData['surface'][$i] : $option->surface,
                                    'edge' => isset($otherData['edge'][$i]) ? $otherData['edge'][$i] : $option->edge,
                                    'weight_per_unit' => isset($otherData['weight_per_unit'][$i]) ? $otherData['weight_per_unit'][$i] : $option->weight_per_unit,
                                    'box_contains' => isset($otherData['box_contains'][$i]) ? $otherData['box_contains'][$i] : $option->box_contains,
                                    'variable_quantity' => isset($otherData['variable_quantity'][$i]) ? $otherData['variable_quantity'][$i] : $option->variable_quantity,
                                    'frost_resistance' => isset($otherData['frost_resistance'][$i]) ? $otherData['frost_resistance'][$i] : $option->frost_resistance,
                                    'synonyms' => isset($otherData['synonyms'][$i]) ? $otherData['synonyms'][$i] : $option->synonyms,

                                ]);

                                    $file = isset($otherData['image'][$i]) ? $otherData['image'][$i] : NULL;
                                    if(!empty($file)){
                                        $photo = time() . $file->getClientOriginalName();
                                        $file->move(public_path() . '/assets/images/products/'.$item->id, $photo);

                                        $option->image = $photo;
                                        $option->save();
                                    }


                                    $saveWarehouseAvailability = WarehouseAvailability::where('attribute_options_id',$option->id)->first();
                                    // if(!empty($saveWarehouseAvailability)){
                                        if(!empty($otherData['availability'][$i])){
                                            $payload = [
                                                'attribute_options_id' => $option->id,
                                                'availability' => $otherData['availability'][$i],
                                            ];
                                            if(!empty($saveWarehouseAvailability)){
                                                $saveWarehouseAvailability->update($payload);
                                                // dd($saveWarehouseAvailability);
                                                $option->quantity = $saveWarehouseAvailability->availability;
                                                $option->save();
                                            }else{
                                                $saveWarehouseAvailability = WarehouseAvailability::create($payload);
                                                // dd($saveWarehouseAvailability);
                                                $option->quantity = $otherData['availability'][$i];
                                                $option->save();
                                            }

                                        }


                            }else{

                                $attributeOption = AttributeOption::create([

                                    'attribute_id' => $attribute_id,
                                    'item_id' => $item->id,
									'material' => isset($otherData['material'][$i]) ? $otherData['material'][$i] : NULL,
                                    'price' => isset($otherData['price'][$i]) ? $otherData['price'][$i] : NULL,
                                    'length' => isset($otherData['length'][$i]) ? $otherData['length'][$i] : NULL,
                                    'broad' => isset($otherData['broad'][$i]) ? $otherData['broad'][$i] : NULL,
                                    'height' => isset($otherData['height'][$i]) ? $otherData['height'][$i] : NULL,
                                    'description' => isset($otherData['description'][$i]) ? $otherData['description'][$i] : NULL,
                                    'item_number' => isset($otherData['item_number'][$i]) ? $otherData['item_number'][$i] : NULL,
                                    'use' => isset($otherData['used'][$i]) ? $otherData['used'][$i] : NULL,
                                    'format' => isset($otherData['format'][$i]) ? $otherData['format'][$i] : NULL,
                                    'surface' => isset($otherData['surface'][$i]) ? $otherData['surface'][$i] : NULL,
                                    'edge' => isset($otherData['edge'][$i]) ? $otherData['edge'][$i] : NULL,
                                    'weight_per_unit' => isset($otherData['weight_per_unit'][$i]) ? $otherData['weight_per_unit'][$i] : NULL,
                                    'box_contains' => isset($otherData['box_contains'][$i]) ? $otherData['box_contains'][$i] : NULL,
                                    'variable_quantity' => isset($otherData['variable_quantity'][$i]) ? $otherData['variable_quantity'][$i] : NULL,
                                    'frost_resistance' => isset($otherData['frost_resistance'][$i]) ? $otherData['frost_resistance'][$i] : NULL,
                                    'synonyms' => isset($otherData['synonyms'][$i]) ? $otherData['synonyms'][$i] : NULL,

                                ]);

                                    $file = $otherData['image'][$i];
                                    if(!empty($file)){
                                        $photo = time() . $file->getClientOriginalName();
                                        $file->move(public_path() . '/assets/images/products/'.$item->id, $photo);

                                        $attributeOption->image = $photo;
                                        $attributeOption->save();
                                    }



                                    if(!empty($otherData['availability_new'][$i])){
                                        $payload = [
                                            'attribute_options_id' => $attributeOption->id,
                                            'availability' => $otherData['availability_new'][$i],
                                        ];
                                        $saveWarehouseAvailability = WarehouseAvailability::create($payload);

                                        $attributeOption->quantity = $otherData['availability_new'][$i];
                                        $attributeOption->save();
                                    }

                            }



                        }
                    }
                }else{
                    if(!empty($otherData['descriptionnn']) && !empty($otherData['quantityyy']) && !empty($otherData['priceee'])){

                        $option = $item->attributeOptions->first();
                        $attributeOption = $option->update([
                            'attribute_id' => $attribute_id,
                            'item_id' => $item->id,
                            'price' => isset($otherData['priceee']) ? $otherData['priceee'] : $option->price,
                            'description' => isset($otherData['descriptionnn']) ? $otherData['descriptionnn']: $option->description,
                            'quantity' => isset($otherData['quantityyy']) ? $otherData['quantityyy'] : $option->quantity,
                        ]);


                    }
                }
            }
            $phot = $request->file('photo');
            

            if ($phot) {
                $ex = $phot->getClientOriginalExtension();
                // dd($ex);
                if($ex == 'png' || $ex == 'jpg' || $ex == 'jpeg'){
                    // dd('yahan');
                    $images_name = $this->ItemhandleUpdatedUploadedImage($request->photo, 'assets/images/products/'.$item->id , $item, 'assets/images/products/'.$item->id, 'photo');
                    $item->photo = $images_name[0];
    
                    $item->thumbnail = $images_name[1];
                    $item->save();
                }
                
            }


            return true;
        }catch(\Exception $e){
            // dd($e);
            return $e;
        }



    }

    public static function ItemhandleUploadedImage($file, $item, $delete = null)
    {
        // dd($path);
        $path = 'assets/images/products/'. $item->id;
        // $thum_path = 'assets/images/'; //added by adnan

        // dd(public_path() . '/' . $path);
        if ($file) {
            if ($delete) {
                if (file_exists(public_path() . '/' . $path . '/' . $delete)) {
                    unlink(public_path() . '/' . $path . '/' . $delete);
                }
            }
            // dd('here');
            $thum = Str::random(8) . '.' . $file->getClientOriginalExtension();
            //$image = \Image::make($file)->resize(230, 230);

            // $file->save(public_path() . '/' . $path . '/' . $thum);

            $photo = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/' .$path, $photo);
            // $file->move(public_path() . '/' .$thum_path, $thum); //added by adnan

            return [$photo, $thum];
        }
    }

    public static function ItemhandleUpdatedUploadedImage($file, $path, $data, $delete_path, $field)
    {
        $photo = time() . $file->getClientOriginalName();
        $thum = Str::random(8) . '.' . $file->getClientOriginalExtension();

        // $image = \Image::make($file)->resize(230, 230);
        // // dd(public_path() .'/'. $path);
        // $image->save(public_path() . '/' . $path . '/' . $thum);

        $file->move(public_path() . '/' . $path, $photo);

        if ($data['thumbnail'] != null) {
            if (file_exists(public_path() . '/' . $delete_path . $data['thumbnail'])) {
                unlink(public_path() . '/' . $delete_path . $data['thumbnail']);
            }
        }
        if ($data[$field] != null) {
            if (file_exists(public_path() . '/' . $delete_path . $data[$field])) {
                unlink(public_path() . '/' . $delete_path . $data[$field]);
            }
        }
        return [$photo, $thum];
    }

    public function highlight($item, $request)
    {
        $input = $request->all();
        if ($request->is_type != 'flash_deal') {
            $input['date'] = null;
        }
        $item->update($input);
    }

    /**
     * Delete item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($item)
    {
        if ($item->galleries()->count() > 0) {
            foreach ($item->galleries as $gallery) {
                $this->galleryDelete($gallery);
            }
        }

        if ($item->campaigns->count() > 0) {
            $item->campaigns()->delete();
        }
        if ($item->reviews->count() > 0) {
            $item->reviews()->delete();
        }

        // dd($item->attributeOptions->count());
        /** @todo fix this asap */ /* Fixed now */
       if ($item->attributeOptions->count() > 0) {
           foreach ($item->attributeOptions as $option) {
               $option->delete();
           }

       }

        ImageHelper::handleDeletedImage($item, 'photo', 'assets/images/');
        ImageHelper::handleDeletedImage($item, 'thumbnail', 'assets/images/');
        if ($item->item_type == 'digital' && $item->file) {
            ImageHelper::handleDeletedImage($item, 'file', 'assets/files/');
        }
        $item->delete();

        return true;
    }

    /**
     * Update gallery.
     *
     * @param  \App\Http\Requests\GalleryRequest  $request
     * @return void
     */

    public function galleriesUpdate($request, $item_id = null)
    {
        Gallery::insert($this->storeImageData($request, $item_id));
    }

    /**
     * Delete gallery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function galleryDelete($gallery)
    {
        ImageHelper::handleDeletedImage($gallery, 'photo', '/assets/images/');
        $gallery->delete();
    }

    /**
     * Custom Function.
     * @return void
     */

    public function storeImageData($request, $item_id = null)
    {
        $storeData = [];
        if ($galleries = $request->file('galleries')) {
            foreach ($galleries as $key => $gallery) {
                $storeData[$key] = [
                    'photo' =>  ImageHelper::handleUploadedImage($gallery, 'assets/images'),
                    'item_id' => $item_id ? $item_id : $request['item_id'],
                ];
            }
        }
        return $storeData;
    }
}