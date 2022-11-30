@extends('master.back')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h3 class="mb-0 bc-title"><b>{{ __('Update Product') }}</b> </h3>
                    <a class="btn btn-primary   btn-sm" href="{{ route('back.item.index') }}"><i
                            class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                @include('alerts.alerts')
            </div>
        </div>
        <!-- Nested Row within Card Body -->

        <form class="admin-form" action="{{ route('back.item.update', $item->id) }}" method="POST"
            enctype="multipart/form-data">

            @csrf

            @method('PUT')
            <div class="row">

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                        <div class="form-group">
                                <label for="name">{{ __('Item ID') }}</label>
                                <input type="text" class="form-control item-name" id=""
                                     value="{{ $item->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('Name') }} *</label>
                                <input type="text" name="name" class="form-control item-name" id="name"
                                    placeholder="{{ __('Enter Name') }}" value="{{ $item->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="slug">{{ __('Slug') }} *</label>
                                <input type="text" name="slug" class="form-control" id="slug"
                                    placeholder="{{ __('Enter Slug') }}" value="{{ $item->slug }}" required>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group pb-0  mb-0">
                                <label class="d-block">{{ __('Featured Image') }} *</label>
                            </div>
                            <div class="form-group pb-0 pt-0 mt-0 mb-0">
                                <img class="admin-img lg"
                                    src="{{ $item->photo ? asset('assets/images/products/' . $item->id . '/' . $item->photo) : asset('assets/images/placeholder.png') }}">
                            </div>
                            <div class="form-group position-relative ">
                                <label class="file">
                                    <input type="file" accept="image/*" class="upload-photo" name="photo" id="file"
                                        aria-label="File browser example">
                                    <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                </label>
                                <br>
                                <span
                                    class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group pb-0  mb-0">
                                <label>{{ __('Gallery Images') }} </label>
                            </div>
                            <div class="form-group pb-0 pt-0 mt-0 mb-0">
                                <div id="gallery-images">
                                    <div class="d-block">

                                        @forelse($item->galleries as $gallery)
                                            <div class="single-g-item d-inline-block m-2">
                                                <span data-toggle="modal" data-target="#confirm-delete" href="javascript:;"
                                                    data-href="{{ route('back.item.gallery.delete', $gallery->id) }}"
                                                    class="remove-gallery-img">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <a class="popup-link"
                                                    href="{{ $gallery->photo ? asset('assets/images/' . $gallery->photo) : asset('assets/images/placeholder.png') }}">
                                                    <img class="admin-gallery-img"
                                                        src="{{ $gallery->photo ? asset('assets/images/' . $gallery->photo) : asset('assets/images/placeholder.png') }}"
                                                        alt="No Image Found">
                                                </a>
                                            </div>
                                        @empty
                                            <h6><b>{{ __('No Images Added') }}</b></h6>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative ">
                                <label class="file">
                                    <input type="file" accept="image/*" name="galleries[]" id="file"
                                        aria-label="File browser example" accept="image/*" multiple>
                                    <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                </label>
                                <br>
                                <span
                                    class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group" id ="pro_feature_card">
                                <label for="product_features">{{ __('Product Features') }} *</label>
                                <span class="text-danger pl-2" id="prod_feature_error" style="display:none"><small>Please Fill Out this Field</small></span>
                                <textarea name="product_features" id="product_features" class="form-control text-editor"
                                    placeholder="{{ __('Product Features') }}" required>{{ $item->product_features }}</textarea>
                            </div>

                            <div class="form-group" id ="pro_description_card">
                                <label for="description">{{ __('Description') }} *</label>
                                <span class="text-danger pl-2" id="prod_description_error" style="display:none"><small>Please Fill Out this Field</small></span>
                                <textarea name="product_description" id="description" class="form-control text-editor" rows="6"
                                    placeholder="{{ __('Enter Description') }}" required>{!! html_entity_decode($item->product_description, ENT_QUOTES, 'UTF-8') !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="product_features">{{ __('Up Selling') }}</label>
                                <select name="up_selling[]" id="choices-multiple-remove-button" class="form-control" multiple>
                                    @foreach($items as $item)
                                        @if(count($up_sell_array) > 0 && in_array($item->id,$up_sell_array))
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="product_features">{{ __('Cross Selling') }}</label>
                                <select name="cross_selling[]" id="choices-multiple-remove-button" class="form-control" multiple>
                                    @foreach($items as $item)
                                        @if(count($cross_sell_array) > 0 && in_array($item->id,$cross_sell_array))
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tags">{{ __('Product Tags') }}
                                </label>
                                <input type="text" name="tags" class="tags" id="tags"
                                    placeholder="{{ __('Tags') }}" value="{{ $item->tags }}">
                            </div>
                            <!-- <div class="form-group">
                            <label class="switch-primary">
                                <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_specification" value="1" {{ $item->is_specification == 1 ? 'checked' : '' }}>
                                <span class="switch-body"></span>
                                <span class="switch-text">{{ __('Specifications') }}</span>
                            </label>
                        </div> -->


                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group" id="prod_keywords_card">
                                
                                <label for="meta_keywords">{{ __('Meta Keywords') }} *</label>
                                <span class="text-danger pl-2" id="prod_keywords_error" style="display:none"><small>Please Fill Out this Field</small></span>
                                <input type="text" name="meta_keywords" class="tags" id="meta_keywords"
                                    placeholder="{{ __('Enter Meta Keywords') }}" value="{{ $our_item->meta_keywords }}" required>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">{{ __('Meta Description') }}
                                </label>
                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                    placeholder="{{ __('Enter Meta Description') }}">{{ $item->meta_description }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Attribute Name') }} </label>
                                        <select name="att_name" id="att_name" class="form-control" required>
                                            <option>---- Select Attribute ----</option>
                                            @foreach ($attributes as $attribute)
                                                @if ($attribute->abbrivation == 'liter' || $attribute->abbrivation == 'piece' || $attribute->abbrivation == 'm²')
                                                    @if (!empty($selected_attribute))
                                                        <option
                                                            value="{{ $attribute->abbrivation }}_{{ $attribute->id }}"
                                                            {{ $attribute->id == $selected_attribute->id ? 'selected' : '' }}>
                                                            {{ $attribute->name }}</option>
                                                    @else
                                                        <option
                                                            value="{{ $attribute->abbrivation }}_{{ $attribute->id }}">
                                                            {{ $attribute->name }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="attr_abbr">{{ __('Abbrivation') }} *</label>

                                        <input type="text" id="abbrivation" name="abbrivation"
                                            value="{{ $selected_attribute ? $selected_attribute->abbrivation : '' }}"
                                            readonly class="form-control">
                                        <input type="hidden" id="sq_sym" value="&#13217;">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="editdata">
                                <div class="col-lg-12">
                                    @if ($selected_attribute && $selected_attribute->abbrivation == 'm²')
                                        @php $options = $item->attributeOptions;@endphp
                                        
                                        <div id="square">
                                            @foreach ($attribute_options as $op)
                                                <input type="hidden" name="option_ids[]" value="{{ $op->id }}">
                                                <div id="var_{{$op->id}}">
                                                    <div class="row mt-2 mb-2">
                                                        <div class="col-lg-6">
                                                            <h3>Variant</h3>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <button type="button" id="variant_{{ $op->id }}" class="btn btn-danger float-right"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="card-body">
                                                                <div class="form-group pb-0  mb-0">
                                                                    <label class="d-block">{{ __('Featured Image') }}
                                                                        *</label>
                                                                </div>
                                                                <div class="form-group pb-0 pt-0 mt-0 mb-0">
                                                                    <img class="admin-img lg" style="margin-top: -60px"
                                                                        src="{{ $op->image ? asset('assets/images/products/' . $item->id . '/' . $op->image) : asset('assets/default/no-image.png') }}">
                                                                </div>
                                                                <div class="form-group position-relative ">
                                                                    <label class="file">
                                                                        <input type="file" accept="image/*"
                                                                            class="upload-photo" name="image[]" id="file"
                                                                            aria-label="File browser example">
                                                                        <span
                                                                            class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                    </label>
                                                                    <br>
                                                                    <span
                                                                        class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-lg-6 mt-5"> --}}
                                                        {{-- <div class="form-group position-relative "> --}}
                                                        {{-- <label class="file"> --}}
                                                        {{-- <div class="form-group pb-0 pt-0 mt-0 mb-0"> --}}
                                                        {{-- <img class="admin-img lg" style="margin-top: -108px" src="{{ $op->image ? asset('assets/images/'.$op->image) : asset('assets/images/placeholder.png') }}" > --}}
                                                        {{-- </div> --}}
                                                        {{-- <input type="file" accept="image/*" class="upload-photo" name="image[]" id="file" --}}
                                                        {{-- aria-label="File browser example" > --}}
                                                        {{-- <span class="file-custom text-left">{{ __('Upload Image...') }}</span> --}}
                                                        {{-- </label> --}}
                                                        {{-- <br> --}}
                                                        {{-- <span --}}
                                                        {{-- class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span> --}}
                                                        {{-- </div> --}}
                                                        {{-- </div> --}}
                                                        <div class="col-lg-6">
                                                            <div class="form-group" id="prod_details_card">
                                                                <label for="details">{{ __('Description') }} *</label>
                                                                <span class="text-danger pl-2" id="prod_details_error" style="display:none"><small>Please Fill Out this Field</small></span>
                                                                <textarea name="description[]" id="details" class="form-control text-editor" rows="6"
                                                                    placeholder="{{ __('Enter Description') }}" required>{!! $op->description !!}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">

                                                                <label for="stock">{{ __('Warehouse Availability') }}
                                                                    *</label>
                                                                <input type="number" name="availability[]"
                                                                    class="form-control" id="availability"
                                                                    placeholder="{{ __('Enter Stock') }}"
                                                                    value="{{ $op->warehouseAvailability ? $op->warehouseAvailability->first()->availability : '' }}">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="price">{{ __('+ Price') }} *</label>
                                                                <!-- <small>({{ __('Set 0 to make it free') }})</small> -->
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $curr->sign }}
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" pattern="^[0-9,]*$" id="price" name="price[]"
                                                                        class="form-control"
                                                                        placeholder="{{ __('Enter Price') }}"
                                                                        value="{{ $op->price }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Length') }} </label>
                                                                <input type="text" pattern="^[0-9,]*$" step="any" name="length[]"
                                                                    class="form-control" id="attr_name"
                                                                    placeholder="{{ __('Enter Length') }}"
                                                                    value="{{ $op->length }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Height') }} </label>
                                                                <input type="text" pattern="^[0-9,]*$" step="any" name="height[]"
                                                                    class="form-control" id="attr_name"
                                                                    placeholder="{{ __('Enter Height') }}"
                                                                    value="{{ $op->height }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Broad') }} </label>
                                                                <input type="text" pattern="^[0-9,]*$" step="any" name="broad[]"
                                                                    class="form-control" id="attr_name"
                                                                    placeholder="{{ __('Enter Broad') }}"
                                                                    value="{{ $op->broad }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Box Size (㎡)') }} *</label>
                                                                <input type="text" pattern="^[0-9,]*$" name="variable_quantity[]"
                                                                    class="form-control" id="variable_quantity"
                                                                    placeholder="{{ __('Enter Box Size') }}"
                                                                    value="{{ $op->variable_quantity }}" step="any">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Item Number') }} *</label>
                                                                <input type="text" name="item_number[]"
                                                                    class="form-control" id="item_number"
                                                                    placeholder="{{ __('Enter Item Number') }}"
                                                                    value="{{ $op->item_number }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Material') }} </label>
                                                                <input type="text" name="material[]" class="form-control"
                                                                    id="material" placeholder="{{ __('Enter Material') }}"
                                                                    value="{{ $op->material }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Use') }} </label>
                                                                <input type="text" name="used[]" class="form-control"
                                                                    id="used" placeholder="{{ __('Enter Use') }}"
                                                                    value="{{ $op->use }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Format') }} *</label>
                                                                <input type="text" name="format[]" class="form-control"
                                                                    id="format" placeholder="{{ __('Enter Format') }}"
                                                                    value="{{ $op->format }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Surface') }} </label>
                                                                <input type="text" name="surface[]" class="form-control"
                                                                    id="surface" placeholder="{{ __('Enter Surface') }}"
                                                                    value="{{ $op->surface }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Edge') }} </label>
                                                                <input type="text" name="edge[]" class="form-control"
                                                                    id="edge" placeholder="{{ __('Enter Edge') }}"
                                                                    value="{{ $op->edge }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Weight (per unit)') }} </label>
                                                                <input type="number" name="weight_per_unit[]"
                                                                    class="form-control" id="weight_per_unit"
                                                                    placeholder="{{ __('Enter Weight') }}"
                                                                    value="{{ $op->weight_per_unit }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Synonyms') }} </label>
                                                                <input type="text" name="synonyms[]" class="form-control"
                                                                    id="synonyms" placeholder="{{ __('Enter Synonyms') }}"
                                                                    value="{{ $op->synonyms }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="attr_name">{{ __('Frost Resistance') }} </label>
                                                                <input type="text" name="frost_resistance[]"
                                                                    class="form-control" id="frost_resistance"
                                                                    placeholder="{{ __('Enter Frost Resistance') }}"
                                                                    value="{{ $op->frost_resistance }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    $("#variant_"+{{$op->id}}).click(function(){
                                                        $.ajax({
                                                            url: "{{ route('removeVariant') }}",
                                                            method: "GET",
                                                            data: {
                                                                item_id : "{{ $item->id }}",
                                                                var_id: "{{$op->id}}",
                                                            },
                                                            success: function(data){
                                                                $('#var_'+data.var_id).remove();
                                                            }
                                                        });
                                                    });
                                                        
                                                </script>
                                            @endforeach
                                        </div>

                                        <div id="newRow">

                                        </div>
                                        <div class="row" id="al-add-more">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="addMoreVariant()"><i class="fa fa-plus"></i> Add More
                                                        Variant</button>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($selected_attribute)
                                        @php $option = $attribute_option;@endphp
                                        <div id="other">
                                            <h2><b>Variant<b></h2>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group" id="prod_details_card">
                                                        <label for="details">{{ __('Description') }} *</label>
                                                        <span class="text-danger pl-2" id="prod_details_error" style="display:none"><small>Please Fill Out this Field</small></span>
                                                        <textarea name="descriptionnn" id="details" class="form-control text-editor" rows="6"
                                                            placeholder="{{ __('Enter Description') }}" required>{!! $option ? html_entity_decode($option->description) : '' !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="price">{{ __('+ Price') }} *</label>
                                                        <!-- <small>({{ __('Set 0 to make it free') }})</small> -->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">{{ $curr->sign }}
                                                                </span>
                                                            </div>
                                                            <input type="text" pattern="^[0-9,]*$" id="price" name="priceee"
                                                                class="form-control"
                                                                placeholder="{{ __('Enter Price') }}"
                                                                value="{{ $option ? $option->price : '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="attr_name">{{ __('Quantity') }}</label>
                                                        <input type="number" name="quantityyy" class="form-control"
                                                            id="attr_name" placeholder="{{ __('Enter Quantity') }}"
                                                            value="{{ $option ? $option->quantity : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- ==========================   FOR NEWLY ENTERED DATA =============== -->

                                    <div class="row">
                                        <div class="col-lg-12">
                                            
                                            <div id="newRoww">

                                            </div>
                                            

                                            

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <!-- <div class="form-group"> -->
                                                    <button type="button" style="display:none;" id="new-add-more" class="btn btn-primary"
                                                        onclick="addMoreVariantt()"><i class="fa fa-plus"></i> Add More
                                                        Variant</button>
                                                    <!-- </div> -->
                                                </div>
                                                <div class="col-lg-5"></div>
                                                <div class="col-lg-2">
                                                    <button class="btn btn-primary" id="submit" type="submit">Update</button>
                                                    <!-- <div class="form-group"> -->
                                                    <!-- <button type="button" class="btn btn-success" onclick="addMoreVariantt()"><i class="fa fa-plus"></i> Add More Variant</button> -->
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ================= New Data End ========================= --->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <!-- <div class="card right-card">
                    <div class="card-body">
                        <div class="form-group">
                        </div>
                    </div>
                </div> -->
                    <div class="card right-card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_id">{{ __('Select Category') }} *</label>
                                <select name="category_id" id="category_id"
                                    data-href="{{ route('back.get.subcategory') }}" class="form-control" required>
                                    @foreach (DB::table('categories')->whereStatus(1)->get()
        as $cat)
                                        @php $subcats = App\Models\Subcategory::where('category_id',$cat->id)->get(); @endphp
                                        @if (isset($subcats) && count($subcats) > 0)
                                            <option value="{{ $cat->id }}"
                                                {{ $cat->id == $our_item->category_id ? 'selected' : '' }}>
                                                {{ $cat->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subcategory_id">{{ __('Select Sub Category') }} *</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control"
                                    data-href="{{ route('back.get.childcategory') }}" required>
                                    <option value="">{{ __('Select one') }}</option>
                                    @foreach (DB::table('subcategories')->where('category_id', $our_item->category_id)->whereStatus(1)->get()
        as $subcat)
                                        
                                        <option value="{{ $subcat->id }}"
                                            {{ $subcat->id == $our_item->subcategory_id ? 'selected' : '' }}>
                                            {{ $subcat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="warehouse_id" value="{{ $warehouses->id }}">
                </div>
                <!-- Select warehouse -->


            </div>
        </form>
    </div>
    {{-- DELETE MODAL --}}

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm Delete?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    {{ __('You are going to delete this image from gallery.') }}
                    {{ __('Do you want to delete it?') }}
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <form action="" class="d-inline btn-ok" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- DELETE MODAL ENDS --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>


var new_html = '';
        new_html +=
                '<div id="removeVarianttRow"><div class="row"><div class="col-lg-6"><h3>Variant</h3></div><div class="col-lg-6"><button type="button" id="removeVariantt" class="btn btn-danger float-right"><i class="fa fa-minus"></i></button></div></div>';
                new_html +=
                '<div class="row"><div class="col-lg-6"> <div class="card-body"> <div class="form-group pb-0 mb-0"> <label class="d-block">{{ __('Featured Image') }}*</label> </div><div class="form-group pb-0 pt-0 mt-0 mb-0"> <img class="admin-img lg" style="margin-top: -60px" src=""> </div><div class="form-group position-relative "> <label class="file"> <input type="file" accept="image/*" class="upload-photo" name="image[]" id="file" aria-label="File browser example" required> <span class="file-custom text-left">{{ __('Upload Image...') }}</span> </label> <br><span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span> </div></div></div><div class="col-lg-6"><div class="form-group" id="prod_details_card"><label for="details">{{ __('Description') }} *</label><span class="text-danger pl-2" id="prod_details_error" style="display:none"><small>Please Fill Out this Field</small></span><textarea name="description[]" id="details" class="form-control text-editor" rows="6" placeholder="{{ __('Enter Description') }}" required>{{ old('details') }}</textarea></div></div></div>';
                new_html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="stock">{{ __('Warehouse Availability') }} *</label><input type="number" name="availability_new[]" class="form-control" id="availability" placeholder="{{ __('Enter Stock') }}" required> </div></div><div class="col-lg-6"><div class="form-group"><label for="price">{{ __('+ Price') }} *</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">{{ $curr->sign }}</span></div><input type="number" id="price" name="price_new[]" class="form-control" placeholder="{{ __('Enter Price') }}" required></div></div></div></div>';
                new_html +=
                '<div class="row"><div class="col-lg-4"><div class="form-group"><label for="attr_name">{{ __('Length') }} </label><input type="text" pattern="^[0-9,]*$" step="any" name="length_new[]" class="form-control" id="attr_name" placeholder="{{ __('Enter Length') }}"></div></div><div class="col-lg-4"><div class="form-group"><label for="attr_name">{{ __('Height') }} *</label><input type="text" pattern="^[0-9,]*$" step="any" name="height_new[]" class="form-control" id="attr_name" placeholder="{{ __('Enter Height') }}"></div></div><div class="col-lg-4"><div class="form-group"><label for="attr_name">{{ __('Broad') }} *</label><input type="text" pattern="^[0-9,]*$" step="any" name="broad_new[]" class="form-control" id="attr_name" placeholder="{{ __('Enter Broad') }}"></div></div></div>';
                new_html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Box Size (㎡)') }} *</label><input type="text" pattern="^[0-9,]*$" name="variable_quantity_new[]" class="form-control" id="variable_quantity" placeholder="{{ __('Enter Box Size') }}"  step="any" required></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Item Number') }} *</label><input type="text" pattern="^[0-9,]*$" name="item_number_new[]" class="form-control" id="item_number" placeholder="{{ __('Enter Item Number') }}" ></div></div></div>';
                new_html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Material') }} </label><input type="text" name="material_new[]" class="form-control" id="material" placeholder="{{ __('Enter Material') }}"></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Use') }}</label><input type="text" name="used_new[]" class="form-control" id="used"placeholder="{{ __('Enter Use') }}"></div></div></div>';
                new_html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Format') }} *</label><input type="text" name="format_new[]" class="form-control" id="format" placeholder="{{ __('Enter Format') }}" required></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Surface') }}</label><input type="text" name="surface_new[]" class="form-control" id="surface" placeholder="{{ __('Enter Surface') }}"></div></div></div>';
                new_html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Edge') }} </label><input type="text" name="edge_new[]" class="form-control" id="edge" placeholder="{{ __('Enter Edge') }}"></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Weight (per unit)') }}</label><input type="text" pattern="^[0-9,]*$" name="weight_per_unit_new[]" class="form-control" id="weight_per_unit" placeholder="{{ __('Enter Weight') }}"></div></div></div>';
                new_html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Synonyms') }} </label><input type="text" name="synonyms_new[]" class="form-control" id="synonyms" placeholder="{{ __('Enter Synonyms') }}"></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Frost Resistance') }}</label><input type="text" name="frost_resistance_new[]" class="form-control" id="frost_resistance" placeholder="{{ __('Enter Frost Resistance') }}"></div></div></div></div>';


                var html_other = '';
            html_other += '<h3>Variant</h3><div class="row"><div class="col-lg-12"><div class="form-group" id="prod_details_card"><label for="details">{{ __('Description') }} *</label><span class="text-danger pl-2" id="prod_details_error" style="display:none"><small>Please Fill Out this Field</small></span><textarea name="descriptionn" id="details" class="form-control text-editor" rows="6" placeholder="{{ __('Enter Description') }}" required></textarea></div></div></div>';
            html_other += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="price">{{ __('+ Price') }} *</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">{{ $curr->sign }}</span></div><input type="text" pattern="^[0-9,]*$" id="pricee" name="pricee" class="form-control" placeholder="{{ __('Enter Price') }}" required></div></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Quantity') }} *</label><input type="number" name="quantityy" class="form-control" id="attr_name" placeholder="{{ __('Enter Quantity') }}" value="1" required></div></div></div>';



        $('#att_name').on('change', function() {
            var val2 = this.value;
            var vall = val2.split('_');
            var val = vall[1];
            var item_id = '{{ $item->id }}';
            Swal.fire({
                title: 'Do you want to change the attribute?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Change',
                denyButtonText: `Don't save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('change-attribute') }}",
                        method: 'GET',
                        data: {
                            id: val,
                            item_id,
                            item_id
                        },
                        success: function(data) {
                            
                            if (data.abbrivation == "m²") {
                                $('#abbrivation').val(data.abbrivation);
                                // document.getElementById('other').style.display = "none";
                                // alert('gggg')
                                document.getElementById('editdata').style.display = "none";
                                // document.getElementById('otherr').style.display = "none";
                                // document.getElementById('squaree').style.display = "block";
                                
                                $('#newRoww').empty();
                                $('#newRoww').append(new_html);
                                $('.text-editor').summernote({
                                    toolbar: [
                                        ['style', ['style']],
                                        ['font', ['bold', 'underline', 'clear']],
                                        ['fontname', ['fontname']],
                                        ['color', ['color']],
                                        ['para', ['ul', 'ol', 'paragraph']],
                                        ['table', ['table']],
                                        ['insert', ['link', 'picture', 'video']],
                                        ['view', ['fullscreen']],
                                    ]
                                });

                                document.getElementById('new-add-more').style.display = "block";
                            } else {
                                $('#abbrivation').val(data.abbrivation);
                                // document.getElementById('other').style.display = "none";
                                document.getElementById('editdata').style.display = "none";
                                // document.getElementById('newRoww').style.display = "none";
                                // document.getElementById('squaree').style.display = "none";
                                document.getElementById('new-add-more').style.display = "none";
                                
                                $('#newRoww').empty();
                                $('#newRoww').append(html_other);
                                $('.text-editor').summernote({
                                    toolbar: [
                                        ['style', ['style']],
                                        ['font', ['bold', 'underline', 'clear']],
                                        ['fontname', ['fontname']],
                                        ['color', ['color']],
                                        ['para', ['ul', 'ol', 'paragraph']],
                                        ['table', ['table']],
                                        ['insert', ['link', 'picture', 'video']],
                                        ['view', ['fullscreen']],
                                    ]
                                });
                                // document.getElementById('otherr').style.display = "block";
                            }
                        }
                    });
                }
            });
        });
        function addMoreVariant() {
            var html = '';
            html +=
                '<div id="removeVariantRow"><div class="row"><div class="col-lg-6"><h3>Variant</h3></div><div class="col-lg-6"><button type="button" id="removeVariant" class="btn btn-danger float-right"><i class="fa fa-minus"></i></button></div></div>';
            html +=
                '<div class="row"><div class="col-lg-6"> <div class="card-body"> <div class="form-group pb-0 mb-0"> <label class="d-block">{{ __('Featured Image') }}*</label> </div><div class="form-group pb-0 pt-0 mt-0 mb-0"> <img class="admin-img lg" style="margin-top: -60px" src=""> </div><div class="form-group position-relative "> <label class="file"> <input type="file" accept="image/*" class="upload-photo" name="image[]" id="file" aria-label="File browser example" required> <span class="file-custom text-left">{{ __('Upload Image...') }}</span> </label> <br><span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span> </div></div></div><div class="col-lg-6"><div class="form-group"><label for="details">{{ __('Description') }} *</label><textarea name="description[]" id="details" class="form-control text-editor" rows="6" placeholder="{{ __('Enter Description') }}" required>{{ old('details') }}</textarea></div></div></div>';
            html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="stock">{{ __('Warehouse Availability') }} *</label><input type="number" name="availability[]" class="form-control" id="availability" placeholder="{{ __('Enter Stock') }}" required> </div></div><div class="col-lg-6"><div class="form-group"><label for="price">{{ __('+ Price') }} *</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">{{ $curr->sign }}</span></div><input type="text" pattern="^[0-9,]*$" id="price" name="price[]" class="form-control" placeholder="{{ __('Enter Price') }}" required></div></div></div></div>';
            html +=
                '<div class="row"><div class="col-lg-4"><div class="form-group"><label for="attr_name">{{ __('Length') }} </label><input type="text" pattern="^[0-9,]*$" step="any" name="length[]" class="form-control" id="attr_name" placeholder="{{ __('Enter Length') }}"></div></div><div class="col-lg-4"><div class="form-group"><label for="attr_name">{{ __('Height') }} </label><input type="text" pattern="^[0-9,]*$" step="any" name="height[]" class="form-control" id="attr_name" placeholder="{{ __('Enter Height') }}"></div></div><div class="col-lg-4"><div class="form-group"><label for="attr_name">{{ __('Broad') }} </label><input type="text" pattern="^[0-9,]*$" step="any" name="broad[]" class="form-control" id="attr_name" placeholder="{{ __('Enter Broad') }}" ></div></div></div>';
            html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Box Size (㎡)') }} *</label><input type="text" pattern="^[0-9,]*$" name="variable_quantity[]" class="form-control" id="variable_quantity" placeholder="{{ __('Enter Box Size') }}" step="any" required></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Item Number') }} *</label><input type="number" name="item_number[]" class="form-control" id="item_number" placeholder="{{ __('Enter Item Number') }}" required></div></div></div>';
            html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Material') }} </label><input type="text" name="material[]" class="form-control" id="material" placeholder="{{ __('Enter Material') }}"></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Use') }} </label><input type="text" name="used[]" class="form-control" id="used"placeholder="{{ __('Enter Use') }}"></div></div></div>';
            html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Format') }} *</label><input type="text" name="format[]" class="form-control" id="format" placeholder="{{ __('Enter Format') }}" required></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Surface') }} </label><input type="text" name="surface[]" class="form-control" id="surface" placeholder="{{ __('Enter Surface') }}"></div></div></div>';
            html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Edge') }} </label><input type="text" name="edge[]" class="form-control" id="edge" placeholder="{{ __('Enter Edge') }}"></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Weight (per unit)') }} </label><input type="text" pattern="^[0-9,]*$" name="weight_per_unit[]" class="form-control" id="weight_per_unit" placeholder="{{ __('Enter Weight') }}"></div></div></div>';
            html +=
                '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Synonyms') }} </label><input type="text" name="synonyms[]" class="form-control" id="synonyms" placeholder="{{ __('Enter Synonyms') }}"></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Frost Resistance') }} *</label><input type="text" name="frost_resistance[]" class="form-control" id="frost_resistance" placeholder="{{ __('Enter Frost Resistance') }}"></div></div></div></div>';
            // html += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Frost Resistance') }} </label><input type="text" name="frost_resistance[]" class="form-control" id="frost_resistance" placeholder="{{ __('Enter Frost Resistance') }}"></div></div></div>';
            //html += '<div class="row"><div class="col-lg-12"></div></div>';
            $('#newRow').append(html);
            // $('#al-add-more').css();
            document.getElementById('al-add-more').style.display = "none";
            document.getElementById('new-add-more').style.display = "block";
            $('.text-editor').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen']],
                ]
            });
        }
        function addMoreVariantt() {
           
            //html += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Frost Resistance') }} </label><input type="text" name="frost_resistance[]" class="form-control" id="frost_resistance" placeholder="{{ __('Enter Frost Resistance') }}"></div></div></div>';
            //html += '<div class="row"><div class="col-lg-12"></div></div>';
            $('#newRoww').append(new_html);
            $('.text-editor').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen']],
                ]
            });
        }
        $(document).on('click', '#removeVariantt', function() {
            $(this).closest('#removeVarianttRow').remove();
            console.log('click')
        });
        $(document).on('click', '#removeVariant', function() {
            $(this).closest('#removeVariantRow').remove();
            console.log('click')
        });

        $(document).ready(function(){
    
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        maxItemCount:5,
        searchResultLimit:5,
        renderChoiceLimit:5
        }); 
        
        
    });
    </script>
    <script>
        $('#submit').click(function(){
            var prod_name = $("#name").val();
            var prod_slug = $("#slug").val();
            var prod_category = $("#category_id").val();
            var prod_subcategory = $("#subcategory_id").val();

            var prod_feactures = $("textarea#product_features").val();
            var prod_description = $("textarea#description").val();
            var keywords = JSON.parse($("#meta_keywords").val());
            var prod_details = $("textarea#details").val();

            console.log("prod_name ----", prod_name.length);
            console.log("prod_slug ----", prod_slug.length);
            console.log("prod_category ----", prod_category.length);
            console.log("prod_subcategory ----", prod_subcategory.length);
            console.log("prod_feactures ----", prod_feactures.length);
            console.log("prod_description ----", prod_description.length);
            console.log("keywords ----", keywords.length);
            console.log("prod_details ----", prod_details.length);




            if (prod_feactures.length <= 0) {
                if(prod_name.length != 0 && prod_slug.length != 0  && prod_category != null  && prod_subcategory.length != 0 )
                {
                    $("html, body").animate({scrollTop:$("#pro_feature_card").offset().top - 90},1000);
                }
                $('#prod_feature_error').show();
                $('#prod_feature_error').delay(3000);
                $('#prod_feature_error').hide(1000);
            }
            if(prod_description.length <= 0){
                
                if(prod_name.length != 0 && prod_slug.length != 0  && prod_category != null  && prod_subcategory.length != 0 && prod_feactures.length > 0){
                    $("html, body").animate({scrollTop:$("#pro_description_card").offset().top - 90},1000);
                }
                $('#prod_description_error').show();
                $('#prod_description_error').delay(3000);
                $('#prod_description_error').hide(1000);
                
            }
            if(keywords.length <= 0){
                if(prod_name.length != 0 && prod_slug.length != 0  && prod_category != null  && prod_subcategory.length != 0 && prod_feactures.length > 0 && prod_description.length > 0){
                    $("html, body").animate({scrollTop:$("#prod_keywords_card").offset().top - 100},1000);
                }
                $("#meta_keywords").val('[]');
                $('#prod_keywords_error').show();
                $('#prod_keywords_error').delay(3000);
                $('#prod_keywords_error').hide(1000);


            }
            if(prod_details.length <= 0){
                if(prod_name.length != 0 && prod_slug.length != 0  && prod_category != null  && prod_subcategory.length != 0 && prod_feactures.length > 0 && prod_description.length > 0 && keywords.length >2){
                    $("html, body").animate({scrollTop:$("#prod_details_card").offset().top - 100},1000);
                }
                $('#prod_details_error').show();
                $('#prod_details_error').delay(3000);
                $('#prod_details_error').show(1000);


            }
            
            
            
        });
    </script>
@endsection