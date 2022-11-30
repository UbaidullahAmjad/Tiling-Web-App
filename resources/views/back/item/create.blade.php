@extends('master.back')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
@section('content')
    <div class="container-fluid">
    
        <!-- Page Heading -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h3 class="mb-0 bc-title"><b>{{ __('Create Product') }}</b> </h3>
                    <a class="btn btn-primary   btn-sm" href="{{ route('back.item.index') }}"><i
                            class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                </div>
            </div>
        </div>

        <!-- Form -->


        <div class="row">
            <div class="col-lg-12">
            @include('alerts.alerts')
            </div>
        </div>
        <!-- Nested Row within Card Body -->
        <form class="admin-form tab-form" id="p_form" action="{{ route('back.item.store') }}" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" value="normal" name="item_type">
            @csrf

            <div class="row">

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }} *</label>
                                <input type="text" name="name" class="form-control item-name" id="name"
                                    placeholder="{{ __('Enter Name') }}" value="{{old('name')}}" required >
                            </div>
                            <div class="form-group">
                                <label for="slug">{{ __('Slug') }} *</label>
                                <input type="text" name="slug" class="form-control" id="slug"
                                    placeholder="{{ __('Enter Slug') }}" value="{{old('slug')}}" required>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group pb-0  mb-0">
                                <label class="d-block">{{ __('Featured Image') }} *</label>
                            </div>
                            <div class="form-group pb-0 pt-0 mt-0 mb-0">
                                <img class="admin-img lg" src="">
                            </div>
                            <div class="form-group position-relative ">
                                <label class="file">
                                    <input type="file" accept="image/*" class="upload-photo" name="photo" id="file"
                                        aria-label="File browser example" required >
                                    <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                </label>
                                <br>
                                <span
                                    class="mt-1 text-info">{{ __('Image Must Be In JPG,JPEG or PNG Format') }}</span>
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
                                    <div class="single-image">
                                        <img class="admin-img lg" src="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative col-8 ">
                                <input class="form-control" type="file" accept="image/*" name="galleries[]" id="file"
                                         accept="image/*" multiple>
                                <br>
                                <span
                                    class="mt-1 text-info">{{ __('Image Must Be In JPG,JPEG or PNG Format') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card" >
                        <div class="card-body">
                            <div class="form-group" id="pro_feature_card">
                                <label for="product_features">{{ __('Product Features') }} *</label>
                                <span class="text-danger pl-2" id="prod_feature_error" style="display:none"><small>Please Fill Out this Field</small></span>
                                
                                <textarea name="product_features" id="product_features" class="form-control text-editor"
                                    placeholder="{{ __('Product Features') }}" data-msg="Please enter your name" required>{{ old('product_features') }} </textarea>
                                    
                            </div>

                            <div class="form-group" id="pro_description_card">
                                <label for="description">{{ __('Description') }} *</label>
                                <span class="text-danger pl-2" id="prod_description_error" style="display:none"><small>Please Fill Out this Field</small></span>
                                <textarea name="product_description" id="description" class="form-control text-editor" rows="6"
                                    placeholder="{{ __('Enter Description') }}" required>{{ old('product_description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="z-index:3">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="product_features">{{ __('Up Selling') }}</label>
                                <select name="up_selling[]" id="choices-multiple-remove-button" class="form-control" multiple>
                                    @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="card" style="z-index:2">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="product_features">{{ __('Cross Selling') }}</label>
                                <select name="cross_selling[]" id="choices-multiple-remove-button" class="form-control" multiple>
                                    @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="card" >
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="tags">{{ __('Product Tags') }}
                                </label>
                                <input type="text" name="tags" class="tags" id="tags"
                                    placeholder="{{ __('Tags') }}" value="{{old('tags')}}">
                            </div>
                            <!-- <div class="form-group">
                                <label class="switch-primary">
                                    <input type="checkbox" class="switch switch-bootstrap status radio-check"
                                        name="is_specification" value="1" checked>
                                    <span class="switch-body"></span>
                                    <span class="switch-text">{{ __('Specifications') }}</span>
                                </label>
                            </div>
                            <div id="specifications-section">
                                <div class="d-flex">

                                    <div class="flex-grow-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="specification_name[]"
                                                placeholder="{{ __('Specification Name') }}" value="">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="specification_description[]"
                                                placeholder="{{ __('Specification description') }}" value="">
                                        </div>
                                    </div>
                                    <div class="flex-btn">
                                        <button type="button" class="btn btn-success add-specification"
                                            data-text="{{ __('Specification Name') }}"
                                            data-text1="{{ __('Specification Description') }}"> <i
                                                class="fa fa-plus"></i> </button>
                                    </div>
                                </div>

                            </div> -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group" id="prod_keywords_card">
                                <label for="meta_keywords">{{ __('Meta Keywords *') }}</label>
                                <span class="text-danger pl-2" id="prod_keywords_error" style="display:none"><small>Please Fill Out this Field</small></span>
                                <input type="text" name="meta_keywords" class="tags" id="meta_keywords"
                                    placeholder="{{ __('Enter Meta Keywords') }}" value="{{old('meta_keywords')}}" required>
                            </div>

                            <div class="form-group">
                                <label for="meta_description">{{ __('Meta Description') }}
                                </label>
                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                    placeholder="{{ __('Enter Meta Description') }}">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Attribute Name') }} </label>
                                        <select name="att_name" id="" class="form-control" required>
                                            <option value="" selected disabled>---- Select Attribute ----</option>
                                            @foreach($attributes as $attribute)

                                            @if($attribute->abbrivation == 'liter' || $attribute->abbrivation == 'piece' || $attribute->abbrivation == "m²")
                                            <option value="{{ $attribute->abbrivation }}_{{$attribute->id}}">{{ $attribute->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="attr_abbr">{{ __('Abbrivation') }} *</label>

                                        <input type="text" id="abbrivation" name="abbrivation" readonly class="form-control" required>
                                        <input type="hidden" id="sq_sym" value="&#13217;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    
                                    <div id="newRow">

                                    </div>
                                    
                                    
                                    
                                    <div class="row mt-5">
                                        
                                                <div class="col-lg-3">
                                                    
                                                        <button type="button" id="addmore" style="display:none" class="btn btn-secondary" onclick="addMoreVariant()"><i class="fa fa-plus"></i> Add More Variant</button>
                                                    
                                                </div>
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-2">
                                                    <button type="submit" id="submit" class="btn btn-success form-control">{{ __('Save') }}</button>
                                                </div>
                                                <div class="col-lg-2">
                                                    
                                                    <button type="button" id="submit" class="btn btn-success save__edit">{{ __('Save & Edit') }}</button>
                                                    <input type="hidden" class="check_button" name="is_button" value="0">
                                                </div>
                                                
                                                  
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    

                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="category_id">{{ __('Select Category') }} *</label>
                                <select name="category_id" id="category_id" data-href="{{ route('back.get.subcategory') }}"
                                    class="form-control" required>
                                    <option value="" selected disabled>{{ __('Select One') }}</option>
                                    
                                    
                                    @foreach (App\Models\Category::whereStatus(1)->get() as $cat)
                                        @if(count($cat->subcategory) > 0)
                                        
                                            @if (old('category_id') == $cat->id)
                                                <option value="{{ $cat->id }}" selected>{{ $cat->name }} </option>
                                            @else
                                                <option value="{{ $cat->id }}">{{ $cat->name }} </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subcategory_id">{{ __('Select Sub Category') }} *</label>
                                <select name="subcategory_id" id="subcategory_id"
                                    data-href="{{ route('back.get.childcategory') }}" class="form-control" required>
                                    <option value="" selected disabled>{{ __('Select One') }}</option>
                                </select>
                            </div>


                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="sku">{{ __('SKU') }} *</label>
                                <input type="text" name="sku" class="form-control" id="sku"
                                    placeholder="{{ __('Enter SKU') }}" value="{{ Str::random(10) }}">
                            </div>

                        </div>
                    </div> -->

                    <!-- Select warehouse -->
                    <input type="hidden" name="warehouse_id" value="{{ $warehouses->id }}">
                    
                </div>

            </div>
        </form>


    </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>



            var html = '';
            html += '<div id="inputformRow"><div class="row"><div class="col-lg-6"><h3>Variant</h3></div><div class="col-lg-6"><button type="button" id="removeVariant" class="btn btn-danger float-right"><i class="fa fa-minus"></i></button></div></div>';

            html += '<div class="row" id="prod_details_card"><div class="col-lg-6"><div class="card-body"><div class="form-group pb-0  mb-0"><label class="d-block">{{ __('Featured Image') }} *</label></div><div class="form-group pb-0 pt-0 mt-0 mb-0"><img class="admin-img lg" src=""></div><div class="form-group position-relative "><label class="file"><input type="file" required accept="image/*" class="upload-photo" name="image[]" id="file" aria-label="File browser example" ><span class="file-custom text-left">{{ __('Upload Image...') }}</span></label><br><span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span></div></div></div><div class="col-lg-6"><div class="form-group"><label for="details">{{ __("Description") }} *</label><span class="text-danger pl-2" id="prod_details_error" style="display:none"><small>Please Fill Out this Field</small></span><textarea name="description[]" id="details" class="form-control text-editor" rows="6" placeholder="{{ __("Enter Description") }}" >{{ old("details") }}</textarea></div></div></div>';

            html += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="stock">{{ __("Warehouse Availability") }} *</label><input type="number" required name="availability[]" class="form-control" id="availability" placeholder="{{ __("Enter Stock") }}" > </div></div><div class="col-lg-6"><div class="form-group"><label for="price">{{ __("+ Price") }} *</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">{{ $curr->sign }}</span></div><input type="text" required pattern="^[0-9,]*$" id="price" name="price[]" class="form-control" placeholder="{{ __("Enter Price") }}" ></div></div></div></div>';
            html += '<div class="row"><div class="col-lg-4"><div class="form-group"><label for="attr_name">{{ __("Length") }} </label><input type="text" step="any" pattern="^[0-9,]*$" name="length[]" class="form-control" id="attr_name" placeholder="{{ __("Enter Length") }}"></div></div><div class="col-lg-4"><div class="form-group"><label for="attr_name">{{ __("Height") }} </label><input type="text" pattern="^[0-9,]*$" step="any" name="height[]" class="form-control" id="attr_name" placeholder="{{ __("Enter Height") }}"></div></div><div class="col-lg-4"><div class="form-group"><label for="attr_name">{{ __("Broad") }}</label><input type="text" pattern="^[0-9,]*$" step="any" name="broad[]" class="form-control" id="attr_name" placeholder="{{ __("Enter Broad") }}"></div></div></div>';
            html += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Box Size (㎡)") }} *</label><input type="text" required pattern="^[0-9,]*$" min="0" name="variable_quantity[]" class="form-control" id="variable_quantity" placeholder="{{ __("Enter Box Size") }}" step="any" ></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Item Number") }} *</label><input type="text" required name="item_number[]" class="form-control" id="item_number" placeholder="{{ __("Enter Item Number") }}" ></div></div></div>';
            html += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Material") }}</label><input type="text" name="material[]" class="form-control" id="material" placeholder="{{ __("Enter Material") }}" ></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Use") }}</label><input type="text" name="used[]" class="form-control" id="used"placeholder="{{ __("Enter Use") }}" ></div></div></div>';
            html += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Format") }} *</label><input type="text" name="format[]" class="form-control" required id="format" placeholder="{{ __("Enter Format") }}" ></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Surface") }}</label><input type="text" name="surface[]" class="form-control" id="surface" placeholder="{{ __("Enter Surface") }}" ></div></div></div>';
            html += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Edge") }} </label><input type="text" name="edge[]" class="form-control" id="edge" placeholder="{{ __("Enter Edge") }}"></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Weight (per Kg)") }}</label><input type="text" pattern="^[0-9,]*$" name="weight_per_unit[]" class="form-control" id="weight_per_unit" placeholder="{{ __("Enter Weight") }}" ></div></div></div>';
            html += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Synonyms") }} </label><input type="text" name="synonyms[]" class="form-control" id="synonyms" placeholder="{{ __("Enter Synonyms") }}"></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Frost Resistance") }} *</label><input type="text" required name="frost_resistance[]" class="form-control" id="frost_resistance" placeholder="{{ __("Enter Frost Resistance") }}"></div></div></div></div>';
        
            var html_other = '';
            html_other += '<h3>Variant</h3><div class="row" id="prod_details_card"><div class="col-lg-12"><div class="form-group"><label for="details">{{ __('Description') }} *</label><span class="text-danger pl-2" id="prod_details_error" style="display:none"><small>Please Fill Out this Field</small></span><textarea name="descriptionn" id="details" class="form-control text-editor" rows="6" placeholder="{{ __('Enter Description') }}" required></textarea></div></div></div>';
            html_other += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="price">{{ __('+ Price') }} *</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">{{ $curr->sign }}</span></div><input type="text" required pattern="^[0-9,]*$" id="pricee" pattern="^[0-9,]*$" name="pricee" class="form-control" placeholder="{{ __('Enter Price') }}" ></div></div></div><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __('Quantity') }} *</label><input type="number" name="quantityy" class="form-control" id="attr_name" required placeholder="{{ __('Enter Quantity') }}" value="1" ></div></div></div>';


            
            
            
            $('select').on('change', function() {
            var val2 = this.value;
            var vall = val2.split('_');
            var val = vall[0];
            if(val == "m²"){
                $('#abbrivation').val($('#sq_sym').val());
                //$('#other').empty();
                // document.getElementById('other').style.display = "none";
                // document.getElementById('square').style.display = "block";
                $('#newRow').empty();
                $('#newRow').append(html);
                // document.getElementById('newRow').style.display = "block";

               var editor =  $('.text-editor').summernote({
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

               
                document.getElementById('addmore').style.display = "block";
            }else if(val == "liter"){
                $('#abbrivation').val('liter');
                // $('#square').empty();
                // $('#newRow').empty();

                // document.getElementById('square').style.display = "none";
                // document.getElementById('newRow').style.display = "none";
                document.getElementById('addmore').style.display = "none";
                // document.getElementById('other').style.display = "block";
                $('#newRow').empty();
                $('#newRow').append(html_other);
                    // document.getElementById('newRow').style.display = "block";

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

            }else if(val == "piece"){
                $('#abbrivation').val('piece');
                // $('#square').empty();
                // $('#newRow').empty();
                // document.getElementById('square').style.display = "none";
                // document.getElementById('newRow').style.display = "none";
                document.getElementById('addmore').style.display = "none";
                // document.getElementById('other').style.display = "block";
                $('#newRow').empty();
                $('#newRow').append(html_other);
                // document.getElementById('newRow').style.display = "block";

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

        });

        function addMoreVariant(){
            
            //html += '<div class="row"><div class="col-lg-6"><div class="form-group"><label for="attr_name">{{ __("Frost Resistance") }} </label><input type="text" name="frost_resistance[]" class="form-control" id="frost_resistance" placeholder="{{ __("Enter Frost Resistance") }}"></div></div></div>';
            
            //html += '<div class="row"><div class="col-lg-12"></div></div>';

            $('#newRow').append(html);
            document.getElementById('newRow').style.display = "block";

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
        $(document).on('click', '#removeVariant', function () {
            $(this).closest('#inputformRow').remove();
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
            var prod_image = $("#file").val();
            var prod_category = $("#category_id").val();
            var prod_subcategory = $("#subcategory_id").val();

            var prod_feactures = $("textarea#product_features").val();
            var prod_description = $("textarea#description").val();
            var keywords = $("#meta_keywords").val();
            var prod_details = $("textarea#details").val();

            console.log("VAL ----", prod_details);


            if (prod_feactures.length <= 1) {
                if(prod_name.length != 0 && prod_slug.length != 0 && prod_image.length != 0 && prod_category != null  && prod_subcategory.length != 0 )
                {
                    $("html, body").animate({scrollTop:$("#pro_feature_card").offset().top - 90},1000);
                }
                $('#prod_feature_error').show();
                $('#prod_feature_error').delay(3000);
                $('#prod_feature_error').hide(1000);
            }
            if(prod_description.length <= 1){
                
                if(prod_name.length != 0 && prod_slug.length != 0 && prod_image.length != 0 && prod_category != null  && prod_subcategory.length != 0 && prod_feactures.length > 1){
                    $("html, body").animate({scrollTop:$("#pro_description_card").offset().top - 90},1000);
                }
                $('#prod_description_error').show();
                $('#prod_description_error').delay(3000);
                $('#prod_description_error').hide(1000);
                
            }
            if(keywords.length == 0){
                if(prod_name.length != 0 && prod_slug.length != 0 && prod_image.length != 0 && prod_category != null  && prod_subcategory.length != 0 && prod_feactures.length > 1 && prod_description.length > 1){
                    $("html, body").animate({scrollTop:$("#prod_keywords_card").offset().top - 100},1000);
                }
                $('#prod_keywords_error').show();
                $('#prod_keywords_error').delay(3000);
                $('#prod_keywords_error').hide(1000);


            }
            if(prod_details.length <= 1){
                if(prod_name.length != 0 && prod_slug.length != 0 && prod_image.length != 0 && prod_category != null  && prod_subcategory.length != 0 && prod_feactures.length > 1 && prod_description.length > 1 && keywords.length >0){
                    $("html, body").animate({scrollTop:$("#prod_details_card").offset().top - 100},1000);
                }
                $('#prod_details_error').show();
                $('#prod_details_error').delay(3000);
                $('#prod_details_error').show(1000);


            }
            
            
            
        });
    </script>
@endsection
