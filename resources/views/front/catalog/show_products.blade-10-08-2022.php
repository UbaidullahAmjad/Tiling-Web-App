@extends('master.front')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection
@section('title')
    {{ __('Products') }}
@endsection

@section('content')
    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a> </li>
                        <li class="separator"></li>
                        <li>{{ __('Shop') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-top-filter-wrapper">
                    <div class="row">
                        <div class="col-md-10 gd-text-sm-center">
                            <div class="sptfl">
                                <div class="shop-sorting">
                                    <label for="sorting">{{ __('Sort by') }}:</label>
                                    <select class="form-control" id="sorting">
                                        <option value="">{{ __('All Products') }}</option>
                                        <option value="low_to_high"
                                            {{ request()->input('low_to_high') ? 'selected' : '' }}>
                                            {{ __('Low - High Price') }}</option>
                                        <option value="high_to_low"
                                            {{ request()->input('high_to_low') ? 'selected' : '' }}>
                                            {{ __('High - Low Price') }}</option>
                                    </select>
                                    <span class="text-muted">{{ __('Showing') }}:</span>
                                    <span>1 - {{ count($items) }} {{ __('items') }}</span>
{{--                                    <span>1 - {{ $setting->view_product }} {{ __('items') }}</span>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 gd-text-sm-center">
                            <div class="shop-view"><a
                                    class="list-view {{ Session::has('view_catalog') && Session::get('view_catalog') == 'grid' ? 'active' : '' }} "
                                    data-step="grid" href="javascript:;"
                                    data-href="{{ route('front.catalog.products',$id) . '?view_check=grid' }}"><i
                                        class="fas fa-th-large"></i></a>
                                <a class="list-view {{ Session::has('view_catalog') && Session::get('view_catalog') == 'list' ? 'active' : '' }}"
                                    href="javascript:;" data-step="list"
                                    data-href="{{ route('front.catalog.products',$id) . '?view_check=list' }}"><i
                                        class="fas fa-list"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
             <!-- Sidebar          -->
             <div class="col-lg-3 order-lg-1">
                <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
                <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i
                            class="icon-x"></i></span>
                    <!-- Widget Categories-->
{{--                    <section class="widget widget-categories card rounded p-4">--}}
{{--                        <h3 class="widget-title">{{ __('Shop Categories') }}</h3>--}}
{{--                        <ul id="category_list" class="category-scroll">--}}
{{--                            @foreach ($categories as $getcategory)--}}
{{--                                <li--}}
{{--                                    class="has-children  {{ isset($category) && $category->id == $getcategory->id ? 'expanded active' : '' }} ">--}}
{{--                                    <a class="category_search" href="javascript:;"--}}
{{--                                        data-href="{{ $getcategory->slug }}">{{ $getcategory->name }}</a>--}}

{{--                                    <ul id="subcategory_list">--}}
{{--                                        @foreach ($getcategory->subcategory as $getsubcategory)--}}
{{--                                            <li--}}
{{--                                                class="{{ isset($subcategory) && $subcategory->id == $getsubcategory->id ? 'active' : '' }}">--}}
{{--                                                <a class="subcategory" href="javascript:;"--}}
{{--                                                    data-href="{{ $getsubcategory->slug }}">{{ $getsubcategory->name }}</a>--}}

{{--                                                <ul id="childcategory_list">--}}
{{--                                                    @foreach ($getsubcategory->childcategory as $getchildcategory)--}}
{{--                                                        <li--}}
{{--                                                            class="{{ isset($childcategory) && $getchildcategory->id == $getchildcategory->id ? 'active' : '' }}">--}}
{{--                                                            <a class="childcategory" href="javascript:;"--}}
{{--                                                                data-href="{{ $getchildcategory->slug }}">{{ $getchildcategory->name }}</a>--}}

{{--                                                        </li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </section>--}}



                    @if ($setting->is_range_search == 1)
                        <!-- Widget Price Range-->
                        <section class="widget widget-categories card rounded p-4">
                            <h3 class="widget-title">{{ __('Filter by Price') }}</h3>
                            
                            <form id="price-range-slider" class="price-range-slider" method="post"
                                data-start-min="{{ request()->input('minPrice') ? request()->input('minPrice') : '0' }}"
                                data-start-max="{{ request()->input('maxPrice') ? request()->input('maxPrice') : $setting->max_price }}"
                                data-min="0" data-max="{{ $setting->max_price }}" data-step="5">
                                <div class="ui-range-slider"></div>
                                <footer class="ui-range-slider-footer" style="display:inline-block !important">
                                    
                                    <div class="column" style="width:100% !important;display:flex">
                                        <div class="ui-range-values col-md-12">
                                            <div class="ui-range-value-min col-md-5">
                                                {{ App\Helpers\PriceHelper::setCurrencySign() }}<span
                                                    class="min_price"></span>
                                                <input type="text" name="min_price_updated" id="min_price_updated" style="width:100px">
                                            </div> <span style="padding-left: 15px"> - </span>
                                            <div class="ui-range-value-max col-md-5" style="padding-left: 5px">
                                                {{ App\Helpers\PriceHelper::setCurrencySign() }}<span
                                                    class="max_price"></span>
                                                <input type="text" name="max_price_updated" id="max_price_updated" style="width:100px;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="column">
                                        <button class="btn btn-primary btn-sm" id="Filter by Price"
                                            type="button"><span>{{ __('Filter') }}</span></button>
                                    </div>
                                </footer>
                            </form>
                        </section>
                    @endif


                    <!-- Widget Brand Filter-->



                </aside>
            </div>
            <div class="col-lg-9 order-lg-2" id="list_view_ajax">
                @include('front.catalog.ProductNew')
            </div>



        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
          $("#search_form").click(function(event){
            event.preventDefault();
            // alert("The text has been changed.");
            var min_price_updated = $('#min_price_updated').val();
            var max_price_updated = $('#max_price_updated').val();
            // alert(min_price_updated);
            // alert(max_price_updated);

            $('#minPrice').val(min_price_updated);
            $('#maxPrice').val(max_price_updated);

            $('#min_price').val(min_price_updated);
            $('#max_price').val(max_price_updated);

            var form = $(this);
            var actionUrl = form.attr('action');
            // alert(actionUrl)
            $.ajax({
                type: "GET",
                url: actionUrl,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    $("#main_div").html(data);
                    // alert(data); // show response from the php script.
                }
            });
    
          });
        });
    </script>
    <form id="search_form" class="d-none" action="{{ route('front.catalog.products',$id) }}" method="GET">

        <input type="text" name="maxPrice" id="maxPrice"
            value="{{ request()->input('maxPrice') ? request()->input('maxPrice') : '' }}">
        <input type="text" name="minPrice" id="minPrice"
            value="{{ request()->input('minPrice') ? request()->input('minPrice') : '' }}">
        <input type="text" name="brand" id="brand" value="{{ isset($brand) ? $brand->slug : '' }}">
        <input type="text" name="brand" id="brand" value="{{ isset($brand) ? $brand->slug : '' }}">
        <input type="text" name="category" id="category" value="{{ isset($category) ? $category->slug : '' }}">
        <input type="text" name="quick_filter" id="quick_filter" value="">
        <input type="text" name="childcategory" id="childcategory"
            value="{{ isset($childcategory) ? $childcategory->slug : '' }}">
        <input type="text" name="page" id="page" value="{{ isset($page) ? $page : '' }}">
        <input type="text" name="attribute" id="attribute" value="{{ isset($attribute) ? $attribute : '' }}">
        <input type="text" name="option" id="option" value="{{ isset($option) ? $option : '' }}">
        <input type="text" name="subcategory" id="subcategory" value="{{ isset($subcategory) ? $subcategory->slug : '' }}">
        <input type="text" name="sorting" id="sorting" value="{{ isset($sorting) ? $sorting : '' }}">
        <input type="text" name="view_check" id="view_check" value="{{ isset($view_check) ? $view_check : '' }}">
        <input type="text" name="prod_check" id="prod_check" value="{{ isset($prod_check) ? $prod_check : '' }}">


        <button type="submit" id="search_button" class="d-none"></button>
    </form>
@endsection
