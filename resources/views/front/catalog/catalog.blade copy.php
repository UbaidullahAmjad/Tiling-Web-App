<!-- Shop Toolbar-->
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

<div class="row g-3" id="main_div">

    @if (count($subcategorys) > 0)
        @if ($checkType != 'list')
            @foreach ($subcategorys as $subcategory)
               
                <div class="col-xxl-3 col-md-4 col-6">
                    <div class="product-card ">
                      

                     
                        <div class="product-thumb">
                            <img class="lazy" data-src="{{ asset('assets/images/subcategory/' . $subcategory->navigation_img) }}"
                                alt="Product">
{{--                            <div class="product-button-group">--}}
{{--                                <a class="product-button wishlist_store"--}}
{{--                                    href="{{ route('user.wishlist.store', $subcategory->id) }}" title="{{ __('Wishlist') }}"><i--}}
{{--                                        class="icon-heart"></i></a>--}}
{{--                                <a class="product-button product_compare" href="javascript:;"--}}
{{--                                    data-target="{{ route('fornt.compare.product', $subcategory->id) }}"--}}
{{--                                    title="{{ __('Compare') }}"><i class="icon-repeat"></i></a>--}}
{{--                        --}}
{{--                            </div>--}}
                        </div>
                        <div class="product-card-body">
                            <div class="product-category">
                                <a
                                    href="{{url('products_subcategory',$subcategory->id) }}">{{ $subcategory->name }}</a>
                            </div>
                            <h3 class="product-title"><a href="{{ url('products_subcategory',$subcategory->id) }}">
                                    {{ strlen(strip_tags($subcategory->name)) > $name_string_count? substr(strip_tags($subcategory->name), 0, 38): strip_tags($subcategory->name) }}
                                </a></h3>
                            
                           
                        </div>

                    </div>
                </div>
              
            @endforeach
        @else
            @foreach ($subcategorys as $subcategory)
              
                <div class="col-lg-12">
                    <div class="product-card product-list">
                        <div class="product-thumb">
                           
                           
                            <img class="lazy" data-src="{{ asset('assets/images/subcategory/' . $subcategory->navigation_img) }}"
                                alt="Product">
{{--                            <div class="product-button-group">--}}
{{--                                <a class="product-button wishlist_store"--}}
{{--                                    href="{{ route('user.wishlist.store', $subcategory->id) }}"--}}
{{--                                    title="{{ __('Wishlist') }}"><i class="icon-heart"></i></a>--}}
{{--                                <a data-target="{{ route('fornt.compare.product', $subcategory->id) }}"--}}
{{--                                    class="product-button product_compare" href="javascript:;"--}}
{{--                                    title="{{ __('Compare') }}"><i class="icon-repeat"></i></a>--}}

{{--                            </div>--}}
                        </div>
                        <div class="product-card-inner">
                            <div class="product-card-body">
                                <div class="product-category"><a
                                        href="{{url('products_subcategory',$subcategory->id) }}">{{ $subcategory->category->name }}</a>
                                </div>
                                <h3 class="product-title"><a href="{{url('products_subcategory',$subcategory->id) }}">
                                        {{ strlen(strip_tags($subcategory->name)) > $name_string_count? substr(strip_tags($subcategory->name), 0, 52) . '...': strip_tags($subcategory->name) }}
                               
                               
                                <p class="text-sm sort_details_show  text-muted hidden-xs-down my-1">
                                    {{ strlen(strip_tags($subcategory->sort_details)) > 100? substr(strip_tags($subcategory->sort_details), 0, 100): strip_tags($subcategory->special_desc) }}
                                </p>
                            </div>


                        </div>
                    </div>
                </div>
               
            @endforeach
        @endif
    @else
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="h4 mb-0">{{ __('No Data Found') }}</h4>
                </div>
            </div>
        </div>
    @endif
</div>


<!-- Pagination-->
<!-- <div class="row mt-15" id="item_pagination">
    <div class="col-lg-12 text-center">
        
    </div>
</div> -->

<script type="text/javascript" src="{{ asset('assets/front/js/catalog.js') }}"></script>
