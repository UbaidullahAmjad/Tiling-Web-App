<?php

namespace App\Repositories\Back;


use App\Models\Subcategory;
use App\Models\Item;
use App\Models\SubcategoryGallery;
use App\Helpers\ImageHelper;

class SubCategoryRepository
{

    private $img_path;

    /**
     * Constructor Method.
     *
     * @param  $img_path
     *
     */
    public function __construct()
    {
        $this->img_path = 'assets/images/subcategory';
    }

    /**
     * Store category.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return void
     */

    public function store($request)
    {
        // dd( $request->all());
        $payload = $request->all();
        
        if ($request->has('navigation_img')) {
            $image_name = ImageHelper::ItemhandleUploadedImage($request->file('navigation_img'), $this->img_path);

            $payload['navigation_img'] = $image_name[0];
        }

        if ($request->has('header_img')) {
            $image_name = ImageHelper::ItemhandleUploadedImage($request->file('header_img'), $this->img_path);

            $payload['header_img'] = $image_name[0];
        }

        $subcategory_id =  Subcategory::create($payload)->id;

        if (isset($payload['gallery_imgs'])) {
            $this->uploadGalleryImages($request, $subcategory_id);
        }
    }

    /**
     * Update category.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return void
     */

    public function update($subcategory, $request)
    {
        $payload = $request->all();

        if ($request->has('navigation_img')) {

            $image_name = ImageHelper::ItemhandleUpdatedUploadedImage($request->navigation_img, $this->img_path, $subcategory, $this->img_path, 'navigation_img');
            
            $payload['navigation_img'] = $image_name[0];
        }

        if ($request->has('header_img')) {

            $image_name = ImageHelper::ItemhandleUpdatedUploadedImage($request->header_img, $this->img_path, $subcategory, $this->img_path, 'header_img');
            
            $payload['header_img'] = $image_name[0];
        }
        
        $subcategory->update($payload);
        if (isset($payload['gallery_imgs'])) {
            $this->uploadGalleryImages($request, $subcategory->id);
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
        if ($category->galleryImages()->count() > 0) {
            foreach ($category->galleryImages as $gallery) {
                $this->galleryDelete($gallery);
            }
        }

        ImageHelper::handleDeletedImage($category, 'image', $this->img_path);
        $items = Item::where('subcategory_id',$category->id)->get();
        if(count($items)>0)
        {
            foreach($items as $item)
            {
                $item->delete();
            }
        }
            
        $category->delete();
    }

    /**
     * Update gallery.
     *
     * @param  \App\Http\Request  $request
     * @return void
     */

    public function uploadGalleryImages($request, $subcategory_id = null)
    {
        SubcategoryGallery::insert($this->storeImageData($request, $subcategory_id));
    }

    /**
     * Delete gallery images.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function galleryDelete($SubcategoryGallery)
    {
        ImageHelper::handleDeletedImage($SubcategoryGallery, 'image', $this->img_path);
        $SubcategoryGallery->delete();
    }

    /**
     * Custom Function.
     * @return void
     */

    public function storeImageData($request, $subcategory_id = null)
    {
        $storeData = [];
        if ($gallery_imgs = $request->file('gallery_imgs')) {
            foreach ($gallery_imgs as $key => $gallery_img) {
                $storeData[$key] = [
                    'image' =>  ImageHelper::handleUploadedImage($gallery_img, $this->img_path),
                    'subcategory_id' => $subcategory_id ? $subcategory_id : $request['subcategory_id'],
                ];
            }
        }
        
        return $storeData;
    }

}
