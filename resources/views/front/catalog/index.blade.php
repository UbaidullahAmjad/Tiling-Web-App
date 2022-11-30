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
                        <!-- <div class="col-md-10 gd-text-sm-center">
                            <div class="sptfl">
                                <div class="quickFilter">
                                    <h4 class="quickFilter-title"><i class="fas fa-filter"></i>{{ __('Quick filter') }}
                                    </h4>
                                    <ul id="quick_filter">
                                        <li><a datahref=""><i class="icon-chevron-right pr-2"></i>{{ __('All products') }}
                                            </a></li>
                                        <li class=""><a href="javascript:;" data-href="feature"><i
                                                    class="icon-chevron-right pr-2"></i>{{ __('Featured products') }} </a>
                                        </li>
                                        <li class=""><a href="javascript:;" data-href="best"><i
                                                    class="icon-chevron-right pr-2"></i>{{ __('Best sellers') }} </a></li>
                                        <li class=""><a href="javascript:;" data-href="top"><i
                                                    class="icon-chevron-right pr-2"></i>{{ __('Top rated') }} </a></li>
                                        <li class=""><a href="javascript:;" data-href="new"><i
                                                    class="icon-chevron-right pr-2"></i>{{ __('New Arrival') }} </a></li>
                                    </ul>
                                </div>
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
                                    </select><span class="text-muted">{{ __('Showing') }}:</span><span>1 -
                                        {{ $setting->view_product }} {{ __('items') }}</span>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-12 gd-text-sm-center">
                            <div class="shop-view"><a
                                    class="list-view {{ Session::has('view_catalog') && Session::get('view_catalog') == 'grid' ? 'active' : '' }} "
                                    data-step="grid" href="javascript:;"
                                    data-href="{{ route('front.catalog') . '?view_check=grid' }}"><i
                                        class="fas fa-th-large"></i></a>
                                <a class="list-view {{ Session::has('view_catalog') && Session::get('view_catalog') == 'list' ? 'active' : '' }}"
                                    href="javascript:;" data-step="list"
                                    data-href="{{ route('front.catalog') . '?view_check=list' }}"><i
                                        class="fas fa-list"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">

            <div class="col-lg-9 order-lg-2" id="list_view_ajax">
                @include('front.catalog.catalog')
            </div>

            
            
        </div>
    </div>



    <form id="search_form" class="d-none" action="{{ route('front.catalog') }}" method="GET">

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
