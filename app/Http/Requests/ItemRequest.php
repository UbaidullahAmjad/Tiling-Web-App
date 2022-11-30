<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

// dd('jkkkkkjkjkjkjkkjkhh');
        $type_required = $this->item_type == 'digital' || $this->item_type == 'license' ? '' : 'required';



        $check_link = $this->file_type == 'link' ? 'required' : '';
        if($this->item_type == 'digital'){
            if($this->item){
                $check_file = '';
            }else{
                $check_file = $this->item_type == 'digital' && $this->file_type == 'file' ? 'required' : '';
            }
        }elseif($this->item_type == 'license'){
            if($this->item){
                $check_file = '';
            }else{
                $check_file = $this->item_type == 'license' && $this->file_type == 'file' ? 'required' : '';
            }
        }else{
            $check_file = '';
        }
        $id = $this->item ? ',' . $this->item->id : '';
        $required = $this->item ? '' : 'required|';


        return [
            'name'            => 'required|max:100',
            'slug'            => 'required','unique:items,slug' . $id, 'regex:/^[a-zA-Z0-9-]+$/',
            'category_id'     => 'required',
            'subcategory_id'  => 'required',
            'att_name' => 'not_in:0',
            'meta_keywords' => 'required',
            
            // 'link'            => $check_link,
            // 'file'            => $check_file.'|file|mimes:zip',
            'product_features'    => 'required',
            'product_description'         => 'required',
            // 'discount_price'  => 'required|max:50',
            // 'previous_price'  => 'max:50',
            'stock'           => 'numeric|max:9999999999',
            // 'tax_id'          => 'required',
            'photo'           => $required, 'mimes:jpeg,jpg,png',
            // 'min_quantity'          => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'name.required'            =>  __('Name field is required.'),
            // 'tax_id.required'          =>  __('Tax field is required.'),
            'category_id.required'     =>  __('Category field is required.'),
            'subcategory_id.required'     =>  __('Sub-Category field is required.'),
            'product_features.required'     =>  __('Product Feature field is required.'),
            'product_description' =>  __('Product Description field is required.'),
            // 'brand_id.required'        =>  __('Brand field is required.'),
            'slug.required'            =>  __('Slug field is required.'),
            'slug.unique'              =>  __('This slug has already been taken.'),
            'details.required'         =>  __('Description field is required.'),
            'sort_details.required'    =>  __('Sort Description field is required.'),
            'discount_price.required'  =>  __('Current Price field is required.'),
            // 'stock.required'           =>  __('Stock field is required.'),
            'photo.required'           =>  __('Image field is required.'),
            'photo.mimes'              =>  __('Image type must be jpg,jpeg,png'),
            // 'min_quantity.required'           =>  __('Minimum Quantity field is required.'),
            'att_name.not_in' => __('Please Select one of the variants'),
            'meta_keywords.required' =>  __('Meta Keywords field is required.'),
        ];
    }

}
