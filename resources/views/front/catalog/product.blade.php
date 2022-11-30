@extends('master.front')

@section('title')
    {{ $item->name }}
@endsection

@section('meta')
    <meta name="keywords" content="{{ $item->meta_keywords }}">
    <meta name="description" content="{{ $item->meta_description }}">
@endsection

@section('content')
<?php 

$Concatvalue= $attribute_options[0]->variable_quantity;


?>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="separator"></li>
                        <li><a href="{{ route('front.catalog') }}">{{ __('Shop') }}</a>
                        </li>
                        <li class="separator"></li>
                        <li>{{ $item->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-1x mb-1">
        @if ($item->attributeOptions->isEmpty())
            <div class="row">
                <div class="col-12">
                    <div class="details-page-top-right-content d-flex">
                        <div class="div w-100">
                            <h4 class="mb-2 p-title-main">Product not available</h4>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <input type="hidden" id="product_page" value="product_page">
            <div class="row">
                <!-- Poduct Gallery-->
                <div class="col-xxl-5 col-lg-6 col-md-6">
                    <div class="product-gallery">
                        @if ($item->video)
                            <div class="gallery-wrapper">
                                <div class="gallery-item video-btn text-center">
                                    <a href="{{ $item->video }}" title="Watch video"></a>
                                </div>
                            </div>
                        @endif


                        <div class="product-thumbnails insize">
                            <div class="product-details-slider owl-carousel">
                                <div class="item">
                                    @php
                                        $itemImage = 'assets/images/products/' . $item->id . '/' . $item->photo;
                                    @endphp
                                    <img src="{{ file_exists(public_path($itemImage)) ? asset($itemImage) : asset('assets/default/no-image.png') }}"
                                        alt="zoom" style="height:347px" />
                                </div>
                                @foreach ($galleries as $key => $gallery)
                                    @php
                                        $galleryImage = 'assets/images/' . $gallery->photo;
                                    @endphp
                                    <div class="item">
                                        <img src="{{ file_exists(public_path($galleryImage)) ? asset($galleryImage) : asset('assets/default/no-image.png') }}"
                                            alt="zoom" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @php $attribute_option = $item->attributeOptions->first();
                        $attach_attribute = App\Models\Attribute::find($attribute_option->attribute_id);
                    @endphp

                    @if ($attach_attribute->abbrivation != 'liter' && $attach_attribute->abbrivation != 'piece')
                        <div class="card variant_desc_top">
                            <h5 class="variant_desc_heading"><b>Variant Description</b></h5>
                            <span id="variant_desc">{!! html_entity_decode($attribute_option->description) !!}</span>
                        </div>
                        <div class="card variant_desc_top">
                            <h5 class="variant_desc_heading">Product Detail</h5>
                            <span id="prod_detail">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p><b>{{ $attribute_option->item_number ? 'Artikelnummer' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->material ? 'Material' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->use ? 'Verwendung' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->format ? 'Format' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->surface ? 'Oberfläche' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->edge ? 'Kanten' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->weight_per_unit ? 'Gewicht (pro Kg)' : '' }}</b></p>
                                        <!-- <p><b>1 Volle Kiste =</b></p> -->
                                        <p><b>{{ $attribute_option->frost_resistance ? 'Frostbeständigkeit' : '' }}</b>
                                        </p>
                                        <p><b>{{ $attribute_option->synonyms ? 'Synonyms' : '' }}</b></p>
                                    </div>
                                    <div class="col-lg-1">
                                        <p><b>{{ $attribute_option->item_number ? ':' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->material ? ':' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->use ? ':' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->format ? ':' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->surface ? ':' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->edge ? ':' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->weight_per_unit ? ':' : '' }}</b></p>
                                        <!-- <p><b>1 Volle Kiste =</b></p> -->
                                        <p><b>{{ $attribute_option->frost_resistance ? ':' : '' }}</b></p>
                                        <p><b>{{ $attribute_option->synonyms ? ':' : '' }}</b></p>
                                    </div>
                                    <div class="col-lg-7">
                                        <p>{{ $attribute_option->item_number ? $attribute_option->item_number : '' }}</p>
                                        <p>{{ $attribute_option->material ? $attribute_option->material : '' }}</p>
                                        <p>{{ $attribute_option->use ? $attribute_option->use : '' }}</p>
                                        <p>{{ $attribute_option->format ? $attribute_option->format : '' }}</p>
                                        <p>{{ $attribute_option->surface ? $attribute_option->surface : '' }}</p>
                                        <p>{{ $attribute_option->edge ? $attribute_option->edge : '' }}</p>
                                        <p>{{ $attribute_option->weight_per_unit ? $attribute_option->weight_per_unit . ' kg' : '' }}
                                        </p>
                                        <!-- <p>{{ $attribute_option->box_contains ? $attribute_option->box_contains : '' }} m²</p> -->
                                        <p>{{ $attribute_option->frost_resistance ? $attribute_option->frost_resistance : '' }}
                                        </p>
                                        <p>{{ $attribute_option->synonyms ? $attribute_option->synonyms : '' }}</p>
                                    </div>
                                </div>

                            </span>
                        </div>
                    @endif
                </div>

                @php
                    function renderStarRating($rating, $maxRating = 5)
                    {
                        $fullStar = "<i class = 'far fa-star filled'></i>";
                        $halfStar = "<i class = 'far fa-star-half filled'></i>";
                        $emptyStar = "<i class = 'far fa-star'></i>";
                        $rating = $rating <= $maxRating ? $rating : $maxRating;

                        $fullStarCount = (int) $rating;
                        $halfStarCount = ceil($rating) - $fullStarCount;
                        $emptyStarCount = $maxRating - $fullStarCount - $halfStarCount;

                        $html = str_repeat($fullStar, $fullStarCount);
                        $html .= str_repeat($halfStar, $halfStarCount);
                        $html .= str_repeat($emptyStar, $emptyStarCount);
                        $html = $html;
                        return $html;
                    }
                @endphp
                <!-- Product Info-->
                <div class="col-xxl-7 col-lg-6 col-md-6">
                    <div class="details-page-top-right-content d-flex">
                        <div class="div w-100">
                            <input type="hidden" id="item_id" value="{{ $item->id }}">
                            <input type="hidden" id="demo_price"
                                value="{{ App\Helpers\PriceHelper::setConvertPrice($item->discount_price) }}">
                            <input type="hidden" value="{{ App\Helpers\PriceHelper::setCurrencySign() }}"
                                id="set_currency">
                            <input type="hidden" value="{{ App\Helpers\PriceHelper::setCurrencyValue() }}"
                                id="set_currency_val">
                            <input type="hidden" value="{{ $setting->currency_direction }}" id="currency_direction">
                            <h4 class="mb-2 p-title-main">{{ $item->name }}</h4>
                            <div class="mb-3">
                                <!-- <div class="rating-stars d-inline-block gmr-3">
                                    {!! renderStarRating($item->reviews->avg('rating')) !!}
                                </div> -->

                            </div>


                            @if ($item->is_type == 'flash_deal')
                                @if (date('d-m-y') != \Carbon\Carbon::parse($item->date)->format('d-m-y'))
                                    <div class="countdown countdown-alt mb-3" data-date-time="{{ $item->date }}">
                                    </div>
                                @endif
                            @endif
                            @php
                                $at_o = $item->attributeOptions->first();
                                $attach_attribute = App\Models\Attribute::find($at_o->attribute_id);
                            @endphp
                            @if ($at_o != null && $attach_attribute->abbrivation != '㎡')
                                <span class="h3 d-block price-area" >

                                    <span id="main_price" class="main-price" style="color:black !important;">€ {{ $at_o->price }}</span><span class="main-price" style="color:black !important;">/{{ $attach_attribute->abbrivation }}</span>
                                </span>
                            @else
                                <span class="h3 d-block price-area">

                                    <span id="main_price" class="main-price">€ {{ $zt_o->price }}</span>/
                                </span>
                                <input type="hidden" id="optionPrice">
                            @endif
                            <div class="text-muted-div">
                                <p class="text-muted">{!! html_entity_decode($item->product_description) !!} </p>
                            </div>

                            <a href="#details" class="scroll-to">
                                @if (strlen($item->product_description) > 180)
                                    {{ __('Read more') }}
                                @endif
                            </a>
                            <div class="div">
                                <div class="t-c-b-area">
                                    @if ($item->brand_id)
                                        <div class="pt-1 mb-1"><span
                                                class="text-medium">{{ __('Brand') }}:</span>
                                            <a
                                                href="{{ route('front.catalog') . '?brand=' . $item->brand->slug }}">{{ $item->brand->name }}</a>
                                        </div>
                                    @endif

                                    <div class="pt-1 mb-1"><span
                                            class="text-medium">{{ __('Categories') }}:</span>
                                        <a
                                            href="{{ route('front.catalog') . '?category=' . $item->category->name }}">{{ $item->category->name }}</a>
                                        @if ($item->subcategory->name)
                                            /
                                        @endif
                                        <a
                                            href="{{ url('products_subcategory', $item->subcategory->id) }}">{{ $item->subcategory->name }}</a>
                                        @if ($item->childcategory->name)
                                            /
                                        @endif
                                        <a
                                            href="{{ route('front.catalog') . '?childcategory=' . $item->childcategory->slug }}">{{ $item->childcategory->name }}</a>
                                    </div>

                                    @if ($item->tags && count((array) $item->tags) > 0)
                                        <div class="pt-1 mb-1"><span
                                                class="text-medium">{{ __('Tags') }}:</span>

                                            @foreach (explode(',', $item->tags) as $tag)
                                                @if ($loop->last)
                                                    <span class="badge badge-success">{{ $tag }}</span>
                                                @else
                                                    <span class="badge badge-success">{{ $tag }}</span>
                                                @endif
                                            @endforeach

                                        </div>
                                    @endif
                                    {{-- @if ($item->item_type == 'normal')
                                    <div class="pt-1 mb-4"><span class="text-medium">{{ __('SKU') }}:</span>
                                        #{{ $item->sku }}</div>
                                @endif --}}
                                </div>

                                <div class="mt-4 p-d-f-area">
                                    <div class="left">
                                        <!-- <a class="btn btn-primary btn-sm wishlist_store wishlist_text"
                                            href="{{ route('user.wishlist.store', $item->id) }}"><span><i
                                                    class="icon-heart"></i></span>
                                            @if (Auth::check() &&
                                                App\Models\Wishlist::where('user_id', Auth::user()->id)->where('item_id', $item->id)->exists())
    <span>{{ __('Added To Wishlist') }}</span>
@else
    <span class="wishlist1">{{ __('Wishlist') }}</span>
                                                <span class="wishlist2 d-none">{{ __('Added To Wishlist') }}</span>
    @endif
                                        </a>
                                        <button class="btn btn-primary btn-sm  product_compare"
                                            data-target="{{ route('fornt.compare.product', $item->id) }}"><span><i
                                                    class="icon-repeat"></i>{{ __('Compare') }}</span></button> -->
                                    </div>

                                    <!-- <div class="d-flex align-items-center">
                                        <span class="text-muted mr-1">{{ __('Share') }}: </span>
                                        <div class="d-inline-block a2a_kit">
                                            <a class="facebook  a2a_button_facebook" href="">
                                                <span><i class="fab fa-facebook-f"></i></span>
                                            </a>
                                            <a class="twitter  a2a_button_twitter" href="">
                                                <span><i class="fab fa-twitter"></i></span>
                                            </a>
                                            <a class="linkedin  a2a_button_linkedin" href="">
                                                <span><i class="fab fa-linkedin-in"></i></span>
                                            </a>
                                            <a class="pinterest   a2a_button_pinterest" href="">
                                                <span><i class="fab fa-pinterest"></i></span>
                                            </a>
                                        </div>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                    </div> -->

                                </div>
                            </div>

                            @php
                                $at_o = $item->attributeOptions->first();
                                $attach_attribute = App\Models\Attribute::find($at_o->attribute_id);
                            @endphp
                            @if ($at_o != null && $attach_attribute->abbrivation != 'liter' && $attach_attribute->abbrivation != 'piece')
                                <label for="" class="mt-2"><b>Variants</b></label>
                                <div class="row margin-top-1x">


                                    @if ($item->attributeOptions->count() != 0)
                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <!-- <select class="form-control attribute_option" id="{{ $attribute->name }}"> -->
                                                <div class="row">
                                                    @php $ch = 0; @endphp

                                                    @foreach ($item->attributeOptions as $option)
                                                        @if ($ch == 0)
                                                            <div class="col-lg-3">
                                                                <input type="radio" name="emotion" id="{{ $option->id }}"
                                                                    class="input-hidden" checked />
                                                                <label for="{{ $option->id }}">
                                                                    <span id="optionLabel_{{ $option->id }}"
                                                                        class="mb-2">{{ $option->format }}</span>
                                                                    @php
                                                                        $optionImage = 'assets/images/products/' . $item->id . '/' . $option->image;
                                                                    @endphp
                                                                    <img id="option-check_{{ $option->id }}"
                                                                        class="attribute_option"
                                                                        onclick="optionCheck({{ $option->id }})"
                                                                        src="{{ file_exists(public_path($optionImage)) ? asset($optionImage) : asset('assets/default/no-image.png') }}"
                                                                        style="width:140px;height:120px">
                                                                </label>
                                                            </div>
                                                        @else
                                                            <div class="col-lg-3">
                                                                <input type="radio" name="emotion" id="{{ $option->id }}"
                                                                    class="input-hidden" />
                                                                <label for="{{ $option->id }}">
                                                                    <span id="optionLabel_{{ $option->id }}"
                                                                        class="mb-2">{{ $option->format }}</span>
                                                                    @php
                                                                        $optionImage = 'assets/images/products/' . $item->id . '/' . $option->image;
                                                                    @endphp

                                                                    <img id="option-check_{{ $option->id }}"
                                                                        class="attribute_option"
                                                                        onclick="optionCheck({{ $option->id }})"
                                                                        src="{{ file_exists(public_path($optionImage)) ? asset($optionImage) : asset('assets/default/no-image.png') }}"
                                                                        style="width:140px;height:120px">
                                                                </label>
                                                            </div>
                                                        @endif

                                                        @php $ch++; @endphp
                                                    @endforeach

                                                </div>

                                                <!-- </select> -->
                                            </div>
                                        </div>
                                    @endif


                                </div>
                                <div class="row align-items-end pb-4">
                                    <div class="col-sm-12">

                                        <!-- <div class="p-action-button">
                                        @if ($item->item_type != 'affiliate')
    <button class="btn btn-primary m-0" id="but_to_cart"><i
                                                        class="icon-bag"></i><span>{{ __('Buy Now') }}</span></button>
@else
    <a href="{{ $item->affiliate_link }}" target="_blank"
                                                class="btn btn-primary m-0"><span><i
                                                        class="icon-bag"></i>{{ __('Buy Now') }}</span></a>
    @endif

                                    </div> -->
                                        <div class="mt-4 mb-4">
                                            <div class="">
                                                <input id="variant_id" name="variant" type="hidden" class="form-control"
                                                    value="{{ $attribute_options[0]->id }}" />
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="" class="lead">Box Size (&#13217;) </label>
                                                         {{-- @dd($attribute_options[0]->variable_quantity)  --}}
                                                        <input type="number"

                                                            min="{{ $attribute_options[0]->variable_quantity }}"
                                                           
                                                            <?php

                                                               $split=explode(',',$attribute_options[0]->variable_quantity);
                                                               
                                                            ?> 
                                                               @if(count($split) > 2){
                
                                                                   <?php $Concatvalue= $split[0].".".$split[1] 
                                                                      ?>
                                                                    max="{{ $attribute_options[0]->quantity *  $Concatvalue  }}"
                                    
                                                                     }
                                                                    else{
               
                                                                   <?php   $Concatvalue= $item->attributeOptions[0]->variable_quantity;  ?>
                                                                      max="{{ $attribute_options[0]->quantity * $Concatvalue  }}"

                                                                      }

                                                               @endif
                                                                  {{-- @dd($Concatvalue)
                                                             --}}
                                                            {{-- max="{{ $attribute_options[0]->quantity * (explode(",",$attribute_options[0]->variable_quantity)[0].".".explode(",",$attribute_options[0]->variable_quantity)[1])  }}" --}}
                                                            step="{{ $attribute_options[0]->variable_quantity }}"
                                                            id="meter_square" name="meter_square"
                                                            value="{{ $Concatvalue  }}"
                                                            class="form-control" />
                                                        <input type="hidden" min="0" step="any" id="meter_square_value"
                                                            name="meter_square_value"
                                                            value="{{ $attribute_options[0]->variable_quantity }}"
                                                            class="form-control" />
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="" class="lead">Packets</label>
                                                        <div class="inner-addon left-addon">
                                                            <i class="fa fa-info-circle" data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="Einige Artikel im Sortiment liefern wir nur in vollen Verpackungseinheiten, dabei kannst Du hierüber die Anzahl der Pakete bestimmen."></i>
                                                            <input id="packet" name="packet" min="1"
                                                                max="{{ $attribute_options[0]->quantity ? $attribute_options[0]->quantity : 1 }}"
                                                                step="1" type="number" class="form-control" value="1" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button class="emz-quantity-decrease"><i class="fa fa-minus"
                                                                aria-hidden="true">    </i></button>
                                                        <button class="emz-quantity-increase"><i class="fa fa-plus"
                                                                aria-hidden="true"></i></button>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button class="btn btn-primary m-0 a-t-c-mr" id="add_to_cart"><i
                                                                class="icon-bag"></i><span>{{ __('Add to Cart') }}</span></button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="mt-4">
                                            <div class="warehouseDetail">
                                                @php

                                                    $opto = $item->attributeOptions->first();

                                                @endphp
                                                <!-- <div class="col">
                                                @if ($item->item_type == 'normal')
                                                 <p class="lead">Quantity: ( m² )</p>
                                                    <div class="qtySelector product-quantity">
                                                        <span class="decreaseQty subclick"><i class="fas fa-minus "></i></span>
                                                        <input type="number" class="qtyValue cart-amount" value="{{ $item->min_quantity }}" step="any" readonly>
                                                        <span class="increaseQty"><i class="fas fa-plus"></i></span>
                                                        <input type="hidden" value="3333" id="current_stock">
                                                        <input id="variable_quantity" type="hidden" value="{{ $opto->variable_quantity }}" step="any" />

                                                    </div>
                                                    Minimum Order Quantity: <p id="minOrderQuantity">{{ $item->min_quantity }}</p>
    @endif
                                            </div> -->

                                                <div class="col">
                                                    <p class="lead">Warehouse:</p>
                                                    <p>{{ $item->warehouse->name }}</p>
                                                </div>
                                                <div class="col">
                                                    <p class="lead">Availability: ( m² )</p>

                                                    <p id="availability">{{ $opto->quantity }}</p>
                                                </div>
                                                <div class="col">
                                                    <p class="lead">Delivery Time:</p>
                                                    @if ($item->warehouse && !empty($item->warehouse->delivery_time))
                                                        <p>{{ $item->warehouse->delivery_time }}</p>
                                                    @endif
                                                </div>

                                                <!-- <div class="col">
                                                <p class="lead">Minimum Order Quantity:</p>
                                                <p id="minOrderQuantity">{{ $item->warehouse->min_order_amount }}</p>
                                            </div> -->
                                            </div>

                                            <div class="seperator"></div>
                                            <div class="pricing">
                                                <div class="content d-flex mt-2">
                                                    <div class="col">
                                                        <p>Price per ㎡</p>
                                                        <h4>
                                                            € <span id="pricePerMeter">{{ $opto->price }}</span>/㎡
                                                        </h4>
                                                    </div>

                                                    <div class="col">
                                                        <p>Total price</p>
                                                        <h4>
                                                            € <span id="totalPrice">{{ $opto->price }}</span>
                                                        </h4>
                                                        <input type="hidden" name="sq-meter" value="sq">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            @else
                                <div class="row align-items-end pb-4">

                                    <div class="col-sm-12">
                                        @php

                                            $option = $item->attributeOptions->first();

                                        @endphp
                                        <div class="row mt-2">
                                            {{-- {{dd($option)}} --}}
                                            <input id="variant_id" name="variant" type="hidden" class="form-control"
                                                value="{{ $option->id }}" />

                                            <div class="col-lg-6">
                                                @if ($option != null)
                                                    <input type="hidden" id="op_price" name="op_price"
                                                        value="{{ $option->price }}">
                                                    <input type="hidden" id="op_qty" name="op_qty"
                                                        value="{{ $option->quantity }}">
                                                    <select name="option-quantity" id="option-quantity"
                                                        class="form-control mb-2">
                                                        @for ($i = 1; $i <= 10; $i++)
                                                            <option
                                                                value="{{ $option->quantity * $i }}_{{ $option->price }}">
                                                                {{ $option->quantity * $i }}</option>
                                                        @endfor
                                                    </select>
                                                @endif

                                            </div>
                                            @if ($option != null)
                                                <div class="col-lg-6">
                                                    <span id="option-qty-price">€
                                                        {{-- @dd($option->price); --}}
                                                        <?php

                                                        $split=explode(',',$option->price);
                                                        
                                                        $newvalue=($split[0].".".$split[1] );
                                                      
                                                             ?>
                                                            
                                                         @if(count($split) > 2){

                                                            {{ round($newvalue *$option->quantity) }}
                                                        

                                                         }
                                                         @else{
                                                           
                                                            {{ round($newvalue *$option->quantity, 2) }}
                                                         
                                                         }
                                                         @endif
                                                                
                                                                
                                                                
                                                                </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <!-- <div class="col-lg-1"></div> -->
                                            <div class="col-lg-6">
                                                <button class="btn btn-primary form-control" id="add_to_cart"><i
                                                        class="icon-bag"></i><span>{{ __('Add to Cart') }}</span></button>
                                            </div>
                                        </div>


                                        <!--- New added   -->


                                    </div>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>

                <div class=" padding-top-3x mb-3" id="details">
                    <div class="col-lg-12 ">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                    aria-selected="true">{{ __('Descriptions') }}</a>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="specification-tab" data-bs-toggle="tab"
                                    data-bs-target="#specification" type="button" role="tab" aria-controls="specification"
                                    aria-selected="false">{{ __('Specifications') }}</a>
                            </li> -->
                        </ul>
                        <div class="tab-content card">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                {!! $item->product_description !!}
                            </div>
                            <div class=" tab-pane fade show" id="specification" role="tabpanel"
                                aria-labelledby="specification-tab">
                                <div class="comparison-table">
                                    <table class="table table-bordered">
                                        <thead class="bg-secondary">
                                        </thead>
                                        <tbody>
                                            <tr class="bg-secondary">
                                                <th class="text-uppercase">{{ __('Specifications') }}</th>
                                                <td><span class="text-medium">{{ __('Descriptions') }}</span></td>
                                            </tr>
                                            @if ($sec_name)
                                                @foreach (array_combine($sec_name, $sec_details) as $sname => $sdetail)
                                                    <tr>
                                                        <th>{{ $sname }}</th>
                                                        <td>{{ $sdetail }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="text-center">
                                                    <td colspan="2">{{ __('No Specifications') }}</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @if(count($upselling) > 0)
        <div class="relatedproduct-section container padding-bottom-3x mb-1 s-pt-30">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="h3">{{ __('Upselling Products') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="relatedproductslider owl-carousel">
                        
                        @foreach ($upselling as $related)
                            <div class="slider-item">
                                <div class="product-card">

                                    
                                    @if ($related->previous_price && $related->previous_price != 0)
                                        <div class="product-badge product-badge2 bg-info">
                                            -{{ App\Helpers\PriceHelper::DiscountPercentage($related) }}</div>
                                    @endif

                                    @if ($related->previous_price && $related->previous_price != 0)
                                        <div class="product-badge product-badge2 bg-info">
                                            -{{ App\Helpers\PriceHelper::DiscountPercentage($related) }}</div>
                                    @endif
                                    <div class="product-thumb">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/images/products/'. $related->id . '/' . $related->photo) }}" alt="Product">
                                        <div class="product-button-group">
                                            <!-- <a class="product-button wishlist_store"
                                                href="{{ route('user.wishlist.store', $related->id) }}"
                                                title="{{ __('Wishlist') }}"><i class="icon-heart"></i></a>
                                            <a class="product-button product_compare" href="javascript:;"
                                                data-target="{{ route('fornt.compare.product', $related->id) }}"
                                                title="{{ __('Compare') }}"><i class="icon-repeat"></i></a> -->
                                            @include('includes.item_footer', [
                                                'sitem' => $related,
                                            ])
                                        </div>
                                    </div>
                                    <div class="product-card-body">
                                        <div class="product-category"><a
                                                href="{{ route('front.catalog') . '?category=' . $related->category->slug }}">{{ $related->category->name }}</a>
                                        </div>
                                        <h3 class="product-title"><a href="{{ route('front.product', $related->slug) }}">
                                                {{ strlen(strip_tags($related->name)) > 35? substr(strip_tags($related->name), 0, 35): strip_tags($related->name) }}
                                            </a></h3>
                                        <h4 class="product-price">
                                            @php $option = $related->attributeOptions->first(); @endphp
                                            € {{ isset($option) ? $option->price : 0 }} 
                                        </h4>
                                        <div class="row">
                                            <!-- <div class="col-lg-1"></div> -->
                                            <div class="col-lg-12">
                                            @php
                          $varient = App\Models\AttributeOption::where('item_id',$related->id)->first();
                          $attribute = App\Models\Attribute::find($varient->attribute_id);
                        @endphp
                    <form action="{{route('product.addcart')}}" method="get">
                      <input type="hidden" name="item_id" value="{{$related->id}}">
                      <input type="hidden" name="variant_id" value="{{$varient->id}}">
                      <input type="hidden" name="unit_price" value="{{$varient->price}}">
                      <input type="hidden" name="total_price" value="{{$varient->price}}">
                      <input type="hidden" name="reload" value="1">

                      <input type="hidden" name="packet" value="1">
                      @if($attribute->name == "square meter")
                      <input type="hidden" name="meter_square" value="2">
                      @else
                      <input type="hidden" name="meter_square" value=null>
                      @endif
                      <button class="btn btn-primary mb-1 " type="submit"><i class="icon-bag"></i><span>{{ __('Add to Cart') }}</span></button>
                    </form>
                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    
    @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (!$item->attributeOptions->isEmpty())
        <script type="text/javascript">
            //window.step_qty = {{ $attribute_options[0]->variable_quantity }};
            //window.available_qty = {{ $attribute_options[0]->quantity ? $attribute_options[0]->quantity : 1 }};

            var step_qty = $("#meter_square").val();
            var available_qty = $("#availability").text();

            var var_quantity = 0;

            console.log("STEP ATY ----", step_qty, " --- avail ---", available_qty);

            $("#meter_square").change(function() {
                var step_qty = $("#meter_square").val();
                var available_qty = $("#availability").text();
                if ($(this).val() < step_qty) {
                    $(this).val(step_qty.toFixed(2));
                }

                let this_max = parseFloat($('#meter_square').attr('max'));
                if ($(this).val() > this_max) {
                    $(this).val(this_max.toFixed(2));
                }
            });

            $("#packet").change(function() {

                if ($(this).val() < 1) {
                    $(this).val(1);
                }
                var var_quantity = $("#meter_square_value").val();
                console.log("VAR QUANTITY ----", var_quantity);
                if ($(this).val() <= available_qty) {
                    let price = $('#pricePerMeter').html();
                    let square_meters = 0;
                    square_meters = parseFloat(var_quantity * $(this).val());
                    $("#meter_square").val(square_meters.toFixed(2));
                    total = price * square_meters;
                    updateTotalPrice(total.toFixed(2));
                } else {
                    let price = $('#pricePerMeter').html();
                    $(this).val(available_qty);
                    let square_meters = 0;
                    square_meters = parseFloat(var_quantity * $(this).val());
                    $("#meter_square").val(square_meters.toFixed(2));
                    total = price * square_meters;
                    updateTotalPrice(total.toFixed(2));
                }

            });


            $("#meter_square").on('blur', function() {
                var var_quantity = $("#meter_square_value").val();
                console.log("VAR QUANTITY ----", var_quantity);
                var step_qty = $("#meter_square").val();
                var available_qty = $("#availability").text();
                let price = $('#pricePerMeter').html();

                let variable_quantity = 0;
                let changed_value = $(this).val();
                let remainder = $(this).val() % var_quantity;
                if (remainder !== 0) {
                    console.log("CV --", changed_value, " --- remain ---", remainder, " -- var_qty ---", var_quantity);
                    $(this).val(parseFloat(parseFloat(changed_value - remainder) + parseFloat(var_quantity)).toFixed(2));
                    variable_quantity = parseFloat(parseFloat(changed_value - remainder) + parseFloat(var_quantity));
                } else {
                    variable_quantity = parseFloat(changed_value);
                }

                $("#packet").val(parseFloat(parseFloat($(this).val()) / parseFloat(var_quantity)).toFixed(0));
                //updateTotalPrice( price * variable_quantity );

                total = parseFloat(price) * variable_quantity;
                updateTotalPrice(total.toFixed(2));
            });

            $("#formats").change(function() {
                var step_qty = $("#meter_square").val();
                var available_qty = $("#availability").text();
                console.log("FORMAT CHANGED");
                let price = $('#pricePerMeter').html();

                step_qty = parseFloat($(this).find(':selected').attr('data-format-variable'));
                available_qty = parseFloat($(this).find(':selected').attr('data-format-quantity'));

                $('#meter_square').attr('max', available_qty * step_qty);
                $('#packet').attr('max', available_qty);
                $("#availability").html(available_qty);

                $("#packet").val(1);
                $("#meter_square").val(step_qty.toFixed(2));


                setPricePerMeterSquare(price.toFixed(2));
                total = price * step_qty;
                updateTotalPrice(total.toFixed(2));
            });


            $('.emz-quantity-increase').click(function() {
                var step_qty = $("#meter_square").val();

                var available_qty = $("#availability").text();
                let packet = $('#packet');
                let packet_value = parseInt(packet.val());
                let packet_max = packet.attr('max');

                var var_quantity = $("#meter_square_value").val();
                console.log("VAR QUANTITY ----", var_quantity);
                // alert(packet_value + "===="+ available_qty)
                // if(packet_value  < available_qty){

                // }
                if (packet_value + 1 <= packet_max) {
                    $("#packet").val(parseFloat(packet.val()) + 1);
                    if (packet.val() <= parseFloat(available_qty)) {
                        let price = $('#pricePerMeter')
                    .html(); //parseFloat($('#formats').find(':selected').attr('data-format-price'));
                        let square_meters = 0;
                        console.log("STEP_QTY ---", step_qty, "--- packet ---", packet.val(), " --- packet_value ---",
                            packet_value);
                        square_meters = parseFloat(var_quantity * packet.val());

                        $("#meter_square").val(square_meters.toFixed(2));
                        total = price * square_meters;
                        updateTotalPrice(total.toFixed(2));
                    } else {

                        let price = $('#pricePerMeter')
                    .html(); //parseFloat($('#formats').find(':selected').attr('data-format-price'));
                        packet.val(available_qty);
                        let square_meters = 0;
                        square_meters = parseFloat(step_qty * packet.val());
                        $("#meter_square").val(square_meters.toFixed(2));
                        total = price * square_meters;
                        updateTotalPrice(total.toFixed(2));

                    }
                } else {
                    // alert('You cannot add more items')

                    alertify.set('notifier', 'position', 'top-right', 'delay', 80);
                    alertify.error('You can not add more items');


                }
            });

            $('.emz-quantity-decrease').click(function() {
                var step_qty = $("#meter_square").val();
                var available_qty = $("#availability").text();

                let packet = $('#packet');
                let packet_value = parseInt(packet.val());
                let packet_min = packet.attr('min');
                var var_quantity = $("#meter_square_value").val();
                console.log("VAR QUANTITY ----", var_quantity);
                console.log("PACKET VALUE ----", packet_value, "--- paack_min ---", packet_min);
                if (parseFloat(packet_value) - 1 >= packet_min) {

                    $("#packet").val(parseFloat(packet.val()) - 1);
                    console.log("PACKET VAL ---", packet.val(), " --- avl_qty -- ", available_qty);
                    if (packet.val() <= parseFloat(available_qty)) {
                        let price = $('#pricePerMeter')
                    .html(); //parseFloat($('#formats').find(':selected').attr('data-format-price'));
                        let square_meters = 0;
                        square_meters = parseFloat($("#meter_square").val() - (var_quantity));

                        console.log("STEP_QTY ---", step_qty, "--- packet ---", packet.val());
                        $("#meter_square").val(square_meters.toFixed(2));
                        total = price * square_meters;
                        updateTotalPrice(total.toFixed(2));
                    } else {
                        let price = $('#pricePerMeter')
                    .html(); //parseFloat($('#formats').find(':selected').attr('data-format-price'));
                        packet.val(available_qty);
                        let square_meters = 0;

                        console.log("STEP_QTY 222 ---", step_qty, "--- packet 222 ---", packet.val());
                        square_meters = parseFloat(step_qty * packet.val());
                        $("#meter_square").val(square_meters.toFixed(2));
                        total = price * square_meters;
                        updateTotalPrice(total.toFixed(2));
                    }
                }
            });

            function updateTotalPrice(price) {
                $('#totalPrice').html(price);
            }

            function setPricePerMeterSquare(price) {
                $('#pricePerMeter').html(price);
            }
        </script>
    @endif
@endsection
