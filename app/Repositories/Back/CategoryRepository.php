<?php

namespace App\Repositories\Back;

use App\{
    Models\Category,
    Models\SubCategory,
    Models\SubcategoryGallery,
    Models\Item,

    Models\CategoryImage,

    Helpers\ImageHelper
};
use App\Models\HomeCutomize;

class CategoryRepository
{

    /**
     * Store category.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return void
     */

    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'),'assets/images');
        $cat = Category::create($input);
        if(isset($request->cat_images) && count($request->cat_images) > 0){
            foreach($request->cat_images as $file){
                $photo = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/assets/images/Category/', $photo);
                $cat_image = new CategoryImage();
                $cat_image->category_id = $cat->id;
                $cat_image->image = $photo;
                $cat_image->save();
            }
            
        }
        
    }

    /**
     * Update category.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return void
     */

    public function update($category, $request)
    {
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/assets/images/',$category,'/assets/images/','photo');
        }
        $category->update($input);
        if(isset($request->cat_images) && count($request->cat_images) > 0){
            foreach($request->cat_images as $file){
                $photo = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/assets/images/Category/', $photo);
                $cat_image = new CategoryImage();
                $cat_image->category_id = $category->id;
                $cat_image->image = $photo;
                $cat_image->save();
            }
            
        }
    }

    /**
     * Delete category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($category)
    {
        // dd($category->id);
        $home = HomeCutomize::first();
        $popular_category = json_decode($home['popular_category'],true);
        $feature_category = json_decode($home['feature_category'],true);
        $two_column_category = json_decode($home['two_column_category'],true);
        $home_4_popular_category = json_decode($home['home_4_popular_category'],true);
        $check = false;
      
        for($i=1;$i<5;$i++){
            if($popular_category['category_id'.$i] == $category->id){
                $check = true;
            }
        }

        for($i=1;$i<5;$i++){
           
            if($feature_category['category_id'.$i] == $category->id){
                $check = true;
            }

        }
        for($i=1;$i<3;$i++){
           
            if($two_column_category['category_id'.$i] == $category->id){
                $check = true;
            }

        }

        if(isset($home_4_popular_category)){
            if(in_array($category->id,$home_4_popular_category)){
                $check =  true;
            }
        }
       

       if($check){
           return ['message' => __('This Category allready used Home page section . Please change this category then delete this category') , 'status' => 0];
       }else{
        ImageHelper::handleDeletedImage($category,'photo','assets/images/');
        $subcategories = SubCategory::where('category_id',$category->id)->get();
        if(count($subcategories)>0)
        {
            foreach($subcategories as $subcategory)
            {
                $items = Item::where('subcategory_id',$subcategory->id)->get();
                if(count($items)>0)
                    {
                        foreach($items as $item)
                        {
                            $item->delete();
                        }
                    }
                $subcategory->delete();
            }
        }
        $category->delete();
        return ['message' => __('Category Deleted Successfully.'),'status' => 1];
       }
    
    }

}
