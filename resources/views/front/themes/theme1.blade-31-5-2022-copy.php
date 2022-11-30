@extends('master.front')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection

@section('content')

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


    @if ($setting->is_slider == 1)
        <div class="slider-area-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Main Slider-->
                        <div class="hero-slider">
                            <div class="hero-slider-main owl-carousel dots-inside">
                                @foreach ($sliders as $slider)
                                    <div class="item
                                    @if (DB::table('languages')->where('is_default', 1)->first()->rtl == 1) d-flex justify-content-end @endif
                                    "
                                        style="background: url('{{ asset('assets/images/' . $slider->photo) }}');width: 100%;display: inline-block;-o-object-fit: cover;object-fit: cover;">
{{--                                        <div class="item-inner">--}}
{{--                                            <div class="from-bottom">--}}
{{--                                                @if ($slider->logo)--}}
{{--                                                    <img class="d-inline-block brand-logo"--}}
{{--                                                        src="{{ asset('assets/images/' . $slider->logo) }}" alt="logo">--}}
{{--                                                @endif--}}
{{--                                                <div class="title text-body">{{ $slider->title }}</div>--}}
{{--                                                <div class="subtitle text-body">{{ $slider->details }}</div>--}}
{{--                                            </div>--}}
{{--                                            <a class="btn btn-primary scale-up delay-1" href="{{ $slider->link }}">--}}
{{--                                                <span>{{ __('Buy Now') }}</span>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

{{--                    @if (isset($hero_banner))--}}
{{--                        <div class="col-lg-4 d-none d-lg-block">--}}
{{--                            <a href="{{ $hero_banner['url1'] }}" class="sright-image">--}}
{{--                                <img src="{{ asset('assets/images/' . $hero_banner['img1']) }}" alt="">--}}
{{--                                <div class="inner-content">--}}

{{--                                    @if (isset($hero_banner['subtitle1']))--}}
{{--                                        <p>{{ $hero_banner['subtitle1'] }}</p>--}}
{{--                                    @endif--}}

{{--                                    @if (isset($hero_banner['title1']))--}}
{{--                                        <h4>{{ $hero_banner['title1'] }}</h4>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="{{ $hero_banner['url2'] }}" class="sright-image mb-0">--}}
{{--                                <img src="{{ asset('assets/images/' . $hero_banner['img2']) }}" alt="">--}}
{{--                                <div class="inner-content">--}}
{{--                                    @if (isset($hero_banner['subtitle2']))--}}
{{--                                        <p>{{ $hero_banner['subtitle2'] }}</p>--}}
{{--                                    @endif--}}
{{--                                    @if (isset($hero_banner['title2']))--}}
{{--                                        <h4>{{ $hero_banner['title2'] }}</h4>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    @endif--}}

                </div>
            </div>
        </div>
    @endif


    @if ($setting->is_service == 1)
        <section class="service-section">
            <div class="container">
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-lg-3 col-sm-6 text-center mb-30">
                            <div class="single-service single-service2">
                                <img src="{{ asset('assets/images/' . $service->photo) }}" alt="Shipping">
                                <div class="content">
                                    <h6 class="mb-2">{{ $service->title }}</h6>
                                    <p class="text-sm text-muted mb-0">{{ $service->details }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif




    @if ($setting->is_popular_category == 1)
        <section class="newproduct-section popular-category-sec mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="h3">{{ $popular_category_title }}</h2>
                            <div class="links">
                                @foreach ($popular_categories as $key => $popular_categorie)
                                    <a class="category_get {{ $loop->first ? 'active' : '' }}"
                                        data-target="popular_category_view"
                                        data-href="{{ route('front.popular.category', [$popular_categorie->slug, 'popular_category', 'slider']) }}"
                                        href="javascript:;"
                                        class="{{ $loop->first ? 'active' : '' }}">{{ $popular_categorie->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popular_category_view d-none">
                    <img src="{{ asset('assets/images/ajax_loader.gif') }}" alt="">
                </div>

                <div class="row" id="popular_category_view">
                    <div class="col-lg-12">
                        <div class="popular-category-slider  owl-carousel">
                            @foreach ($popular_category_items as $popular_category_item)
                                <div class="slider-item">
                                    <div class="product-card">
                                        <div class="product-thumb">

                                            @if (!$popular_category_item->is_stock())
                                                <div
                                                    class="product-badge bg-secondary border-default text-body
                                            ">
                                                    {{ __('out of stock') }}</div>
                                            @endif
                                            @if ($popular_category_item->previous_price && $popular_category_item->previous_price != 0)
                                                <div class="product-badge product-badge2 bg-info">
                                                    -{{ App\Helpers\PriceHelper::DiscountPercentage($popular_category_item) }}
                                                </div>
                                            @endif
                                            <img class="lazy"
                                                data-src="{{ asset('assets/images/' . $popular_category_item->thumbnail) }}"
                                                alt="Product">
                                            <div class="product-button-group">
                                                <a class="product-button wishlist_store"
                                                    href="{{ route('user.wishlist.store', $popular_category_item->id) }}"
                                                    title="{{ __('Wishlist') }}"><i class="icon-heart"></i></a>
                                                <a data-target="{{ route('fornt.compare.product', $popular_category_item->id) }}"
                                                    class="product-button product_compare" href="javascript:;"
                                                    title="{{ __('Compare') }}"><i class="icon-repeat"></i></a>
                                                @include('includes.item_footer', [
                                                    'sitem' => $popular_category_item,
                                                ])
                                            </div>
                                        </div>
                                        <div class="product-card-body">
                                            <div class="product-category"><a
                                                    href="{{ route('front.catalog') . '?category=' . $popular_category_item->category->slug }}">{{ $popular_category_item->category->name }}</a>
                                            </div>
                                            <h3 class="product-title"><a
                                                    href="{{ route('front.product', $popular_category_item->slug) }}">
                                                    {{ strlen(strip_tags($popular_category_item->name)) > 35? substr(strip_tags($popular_category_item->name), 0, 35): strip_tags($popular_category_item->name) }}
                                                </a></h3>
                                            <div class="rating-stars">
                                                <i class="far fa-star filled"></i><i class="far fa-star filled"></i><i
                                                    class="far fa-star filled"></i><i class="far fa-star filled"></i><i
                                                    class="far fa-star filled"></i>
                                            </div>
                                            <h4 class="product-price">
                                                @if ($popular_category_item->previous_price != 0)
                                                    <del>{{ App\Helpers\PriceHelper::setPreviousPrice($popular_category_item->previous_price) }}</del>
                                                @endif
                                                {{ App\Helpers\PriceHelper::grandCurrencyPrice($popular_category_item) }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

{{--    @if ($setting->is_three_c_b_second == 1)--}}
{{--        <div class="bannner-section mt-60">--}}
{{--            <div class="container ">--}}
{{--                <div class="row gx-3">--}}
{{--                    <div class="col-md-4">--}}
{{--                        <a href="{{ $banner_secend['url1'] }}" class="genius-banner">--}}
{{--                            <img class="lazy" data-src="{{ asset('assets/images/' . $banner_secend['img1']) }}"--}}
{{--                                alt="">--}}
{{--                            <div class="inner-content">--}}
{{--                                @if (isset($banner_secend['subtitle1']))--}}
{{--                                    <p>{{ $banner_secend['subtitle1'] }}</p>--}}
{{--                                @endif--}}

{{--                                @if (isset($banner_secend['title1']))--}}
{{--                                    <h4>{{ $banner_secend['title1'] }}</h4>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <a href="{{ $banner_secend['url2'] }}" class="genius-banner">--}}
{{--                            <img class="lazy" data-src="{{ asset('assets/images/' . $banner_secend['img2']) }}"--}}
{{--                                alt="">--}}
{{--                            <div class="inner-content">--}}
{{--                                @if (isset($banner_secend['subtitle2']))--}}
{{--                                    <p>{{ $banner_secend['subtitle2'] }}</p>--}}
{{--                                @endif--}}

{{--                                @if (isset($banner_secend['title2']))--}}
{{--                                    <h4> {{ $banner_secend['title2'] }}</h4>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <a href="{{ $banner_secend['url3'] }}" class="genius-banner">--}}
{{--                            <img class="lazy" data-src="{{ asset('assets/images/' . $banner_secend['img3']) }}"--}}
{{--                                alt="">--}}
{{--                            <div class="inner-content">--}}
{{--                                @if (isset($banner_secend['subtitle3']))--}}
{{--                                    <p>{{ $banner_secend['subtitle3'] }} </p>--}}
{{--                                @endif--}}

{{--                                @if (isset($banner_secend['title3']))--}}
{{--                                    <h4>{{ $banner_secend['title3'] }}</h4>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}

    @if ($setting->is_highlighted == 1)
        <section class="selected-product-section speacial-product-sec mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <div class="links">
                                <a data-href="{{ route('front.get.product', 'feature') }}" data-target="type_product_view"
                                    href="javascript:;" class="product_get active">{{ __('Featured') }}</a>
                                <a data-href="{{ route('front.get.product', 'best') }}" data-target="type_product_view"
                                    class="product_get" href="javascript:;">{{ __('Best Seller') }}</a>
                                <a data-href="{{ route('front.get.product', 'top') }}" data-target="type_product_view"
                                    class="product_get" href="javascript:;">{{ __('Top Rated') }}</a>
                                <a data-href="{{ route('front.get.product', 'new') }}" data-target="type_product_view"
                                    class="product_get" href="javascript:;">{{ __('New Product') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="type_product_view d-none">
                        <img src="{{ asset('assets/images/ajax_loader.gif') }}" alt="">
                    </div>
                    <div class="col-lg-12" id="type_product_view">

                        <div class="features-slider  owl-carousel">
                            @foreach ($products->orderBy('id', 'DESC')->get() as $item)
                                @if ($item->is_type == 'feature')
                                    <div class="slider-item">
                                        <div class="product-card ">
                                            <div class="product-thumb">
                                                @if (!$item->is_stock())
                                                    <div
                                                        class="product-badge bg-secondary border-default text-body
                                                    ">
                                                        {{ __('out of stock') }}</div>
                                                @endif
                                                @if ($item->previous_price && $item->previous_price != 0)
                                                    <div class="product-badge product-badge2 bg-info">
                                                        -{{ App\Helpers\PriceHelper::DiscountPercentage($item) }}</div>
                                                @endif
                                                <img class="lazy"
                                                    data-src="{{ asset('assets/images/' . $item->thumbnail) }}"
                                                    alt="Product">
                                                <div class="product-button-group"><a class="product-button wishlist_store"
                                                        href="{{ route('user.wishlist.store', $item->id) }}"
                                                        title="{{ __('Wishlist') }}"><i class="icon-heart"></i></a>
                                                    <a data-target="{{ route('fornt.compare.product', $item->id) }}"
                                                        class="product-button product_compare" href="javascript:;"
                                                        title="{{ __('Compare') }}"><i class="icon-repeat"></i></a>
                                                    @include('includes.item_footer', [
                                                        'sitem' => $item,
                                                    ])
                                                </div>
                                            </div>
                                            <div class="product-card-inner">
                                                <div class="product-card-body">
                                                    <div class="product-category"><a
                                                            href="{{ route('front.catalog') . '?category=' . $item->category->slug }}">{{ $item->category->name }}</a>
                                                    </div>
                                                    <h3 class="product-title"><a
                                                            href="{{ route('front.product', $item->slug) }}">
                                                            {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
                                                        </a></h3>
                                                    <div class="rating-stars">
                                                        {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                    </div>
                                                    <h4 class="product-price">
                                                        @if ($item->previous_price != 0)
                                                            <del>{{ App\Helpers\PriceHelper::setPreviousPrice($item->previous_price) }}</del>
                                                        @endif
                                                        {{ App\Helpers\PriceHelper::grandCurrencyPrice($item) }}
                                                    </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

    @if ($extra_settings->is_t1_falsh == 1)
        <div class="flash-sell-new-section mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="section-title">
                            <h2 class="h3">{{ __('Flash Deal') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-content">
                            <div class="flash-deal-slider owl-carousel">
                                @foreach ($products->orderBy('id', 'DESC')->get() as $item)
                                    @if ($item->is_type == 'flash_deal' && $item->date != null)
                                        <div class="slider-item">
                                            <div class="product-card ">
                                                <div class="product-thumb">
                                                    @if (!$item->is_stock())
                                                        <div
                                                            class="product-badge bg-secondary border-default text-body
                                            ">
                                                            {{ __('out of stock') }}</div>
                                                    @endif
                                                    @if ($item->previous_price && $item->previous_price != 0)
                                                        <div class="product-badge product-badge2 bg-info">
                                                            -{{ App\Helpers\PriceHelper::DiscountPercentage($item) }}
                                                        </div>
                                                    @endif
                                                    <img class="lazy"
                                                        data-src="{{ asset('assets/images/' . $item->thumbnail) }}"
                                                        alt="Product">
                                                    <div class="product-button-group"><a class="product-button"
                                                            href="{{ route('user.wishlist.store', $item->id) }}"
                                                            title="{{ __('Wishlist') }}"><i
                                                                class="icon-heart"></i></a>
                                                        <a data-target="{{ route('fornt.compare.product', $item->id) }}"
                                                            class="product-button product_compare" href="javascript:;"
                                                            title="{{ __('Compare') }}"><i
                                                                class="icon-repeat"></i></a>
                                                        @include('includes.item_footer', [
                                                            'sitem' => $item,
                                                        ])
                                                    </div>
                                                </div>
                                                <div class="product-card-inner">
                                                    <div class="product-card-body">

                                                        <div class="product-category"><a
                                                                href="{{ route('front.catalog') . '?category=' . $item->category->slug }}">{{ $item->category->name }}</a>
                                                        </div>
                                                        <h3 class="product-title"><a
                                                                href="{{ route('front.product', $item->slug) }}">
                                                                {{ strlen(strip_tags($item->name)) > 50 ? substr(strip_tags($item->name), 0, 50) : strip_tags($item->name) }}
                                                            </a></h3>
                                                        <div class="rating-stars">
                                                            {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                        </div>
                                                        <h4 class="product-price">
                                                            @if ($item->previous_price != 0)
                                                                <del>{{ App\Helpers\PriceHelper::setPreviousPrice($item->previous_price) }}</del>
                                                            @endif

                                                            {{ App\Helpers\PriceHelper::grandCurrencyPrice($item) }}
                                                        </h4>
                                                        @if (date('d-m-y') != \Carbon\Carbon::parse($item->date)->format('d-m-y'))
                                                            <div class="countdown countdown-alt mb-3"
                                                                data-date-time="{{ $item->date }}">
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($setting->is_two_column_category == 1)
        <div class="flash-sell-area mt-50">
            <div class="container">
                <div class="row gx-3 justify-content-center">
                    @foreach ($two_column_categoriess as $two_column_key => $two_column_category)
                        <div class="col-xl-4 col-lg-6">
                            <div class="section-title">
                                <h2 class="h3">{{ $two_column_category['name']->name }}</h2>
                            </div>
                            <div class="main-content">
                                <div class="newproduct-slider owl-carousel">
                                    @foreach ($two_column_categoriess[$two_column_key]['items']->chunk(4) as $two_column_category_itemt)
                                        <div class="slider-item">
                                            @foreach ($two_column_category_itemt as $two_column_category_item)
                                                <div class="product-card p-col">
                                                    <a class="product-thumb"
                                                        href="{{ route('front.product', $two_column_category_item->slug) }}">
                                                        @if (!$two_column_category_item->is_stock())
                                                            <div
                                                                class="product-badge bg-secondary border-default text-body
                                                    ">
                                                                {{ __('out of stock') }}</div>
                                                        @endif

                                                        <img class="lazy"
                                                            data-src="{{ asset('assets/images/' . $two_column_category_item->thumbnail) }}"
                                                            alt="Product">
                                                    </a>
                                                    <div class="product-card-body">
                                                        <h3 class="product-title"><a
                                                                href="{{ route('front.product', $two_column_category_item->slug) }}">
                                                                {{ strlen(strip_tags($two_column_category_item->name)) > 40? substr(strip_tags($two_column_category_item->name), 0, 40): strip_tags($two_column_category_item->name) }}
                                                            </a></h3>
                                                        <div class="rating-stars">
                                                            {!! renderStarRating($two_column_category_item->reviews->avg('rating')) !!}
                                                        </div>
                                                        <h4 class="product-price">
                                                            @if ($two_column_category_item->previous_price != 0)
                                                                <del>{{ App\Helpers\PriceHelper::setPreviousPrice($two_column_category_item->previous_price) }}</del>
                                                            @endif
                                                            {{ App\Helpers\PriceHelper::grandCurrencyPrice($two_column_category_item) }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif

{{--    @if ($setting->is_two_c_b == 1)--}}
{{--        <div class="bannner-section mt-50">--}}
{{--            <div class="container ">--}}
{{--                <div class="row gx-3">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <a href="{{ $banner_third['url1'] }}" class="genius-banner">--}}
{{--                            <img class="lazy" data-src="{{ asset('assets/images/' . $banner_third['img1']) }}"--}}
{{--                                alt="">--}}
{{--                            <div class="inner-content">--}}
{{--                                @if (isset($banner_third['subtitle1']))--}}
{{--                                    <p>{{ $banner_third['subtitle1'] }}</p>--}}
{{--                                @endif--}}
{{--                                @if (isset($banner_third['title1']))--}}
{{--                                    <h4>{{ $banner_third['title1'] }}</h4>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <a href="{{ $banner_third['url2'] }}" class="genius-banner">--}}
{{--                            <img class="lazy" data-src="{{ asset('assets/images/' . $banner_third['img2']) }}"--}}
{{--                                alt="">--}}
{{--                            <div class="inner-content">--}}
{{--                                @if (isset($banner_third['subtitle2']))--}}
{{--                                    <p>{{ $banner_third['subtitle2'] }} </p>--}}
{{--                                @endif--}}
{{--                                @if (isset($banner_third['title2']))--}}
{{--                                    <h4>{{ $banner_third['title2'] }}</h4>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}

    @if ($setting->is_featured_category == 1)
        <section class="selected-product-section featured_cat_sec sps-two mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="h3">{{ $feature_category_title }}</h2>
{{--                            <div class="links">--}}
{{--                                @foreach ($feature_categories as $key => $feature_category)--}}
{{--                                    <a class="category_get {{ $loop->first ? 'active' : '' }}"--}}
{{--                                        data-target="feature_category_view"--}}
{{--                                        data-href="{{ route('front.popular.category', [$feature_category->slug, 'feature_category', 'normal']) }}"--}}
{{--                                        href="javascript:;"--}}
{{--                                        class="{{ $loop->first ? 'active' : '' }}">{{ $feature_category->name }}</a>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="feature_category_view d-none">
                    <img src="{{ asset('assets/images/ajax_loader.gif') }}" alt="">
                </div>
                @dd($feature_category_items)
                <div class="row g-3" id="feature_category_view">
                    @foreach ($feature_category_items as $feature_category_item)
                        <div class="col-gd">
                            <div class="product-card">
                                <div class="product-thumb">

{{--                                    @if (!$feature_category_item->is_stock())--}}
{{--                                        <div--}}
{{--                                            class="product-badge bg-secondary border-default text-body--}}
{{--                                    ">--}}
{{--                                            {{ __('out of stock') }}</div>--}}
{{--                                    @endif--}}
                                    @if ($feature_category_item->previous_price && $feature_category_item->previous_price != 0)
                                        <div class="product-badge product-badge2 bg-info">
                                            -{{ App\Helpers\PriceHelper::DiscountPercentage($feature_category_item) }}
                                        </div>
                                    @endif
                                    @php
                                        $featureImage = 'assets/images/products/'. $feature_category_item->id . '/' . $feature_category_item->photo;
                                    @endphp
                                    <img class="lazy"
                                        data-src="{{ file_exists(public_path($featureImage)) ? asset($featureImage) : asset('assets/default/no-image.png') }}"
                                        alt="Product">
                                    <div class="product-button-group"><a class="product-button wishlist_store"
                                            href="{{ route('user.wishlist.store', $feature_category_item->id) }}"
                                            title="{{ __('Wishlist') }}"><i class="icon-heart"></i></a>
                                        <a data-target="{{ route('fornt.compare.product', $feature_category_item->id) }}"
                                            class="product-button product_compare" href="javascript:;"
                                            title="{{ __('Compare') }}"><i class="icon-repeat"></i></a>

                                        @include('includes.item_footer', [
                                            'sitem' => $feature_category_item,
                                        ])

                                    </div>
                                </div>
                                <div class="product-card-body">
                                    <div class="product-category"><a
                                            href="{{ route('front.catalog') . '?category=' . $feature_category_item->category->slug }}">{{ $feature_category_item->category->name }}</a>
                                    </div>
                                    <h3 class="product-title"><a
                                            href="{{ route('front.product', $feature_category_item->slug) }}">
                                            {{ strlen(strip_tags($feature_category_item->name)) > 35? substr(strip_tags($feature_category_item->name), 0, 35): strip_tags($feature_category_item->name) }}
                                        </a></h3>
{{--                                    <div class="rating-stars">--}}
{{--                                        <i class="far fa-star filled"></i><i class="far fa-star filled"></i><i--}}
{{--                                            class="far fa-star filled"></i><i class="far fa-star filled"></i><i--}}
{{--                                            class="far fa-star filled"></i>--}}
{{--                                    </div>--}}
                                    <h4 class="product-price">
                                        @if ($feature_category_item->previous_price != 0)
                                            <del>{{ App\Helpers\PriceHelper::setPreviousPrice($feature_category_item->previous_price) }}</del>
                                        @endif
                                        {{ App\Helpers\PriceHelper::grandCurrencyPrice($feature_category_item) }}
                                    </h4>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    @if ($setting->is_blogs == 1)
        <div class="blog-section-h page_section mt-50 mb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="h3">{{ __('Our Blog') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="home-blog-slider owl-carousel">
                            @foreach ($posts as $post)
                                <div class="slider-item">
                                    <a href="{{ route('front.blog.details', $post->slug) }}" class="blog-post">
                                        <div class="post-thumb">
                                            <img class="lazy"
                                                data-src="{{ asset('assets/images/' . json_decode($post->photo, true)[array_key_first(json_decode($post->photo, true))]) }}"
                                                alt="Blog Post">
                                        </div>
                                        <div class="post-body">

                                            <h3 class="post-title">
                                                {{ strlen(strip_tags($post->title)) > 55 ? substr(strip_tags($post->title), 0, 55) : strip_tags($post->title) }}
                                            </h3>
                                            <ul class="post-meta">

                                                <li><i class="icon-user"></i>{{ __('Admin') }}</li>
                                                <li><i
                                                        class="icon-clock"></i>{{ date('jS F, Y', strtotime($post->created_at)) }}
                                                </li>
                                            </ul>
                                            <p>{{ strlen(strip_tags($post->details)) > 120? substr(strip_tags($post->details), 0, 120): strip_tags($post->details) }}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($setting->is_popular_brand == 1)
        <section class="brand-section mt-30 mb-60">
            <div class="container ">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="section-title">
                            <h2 class="h3">{{ __('Popular Brands') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="brand-slider owl-carousel">
                            @foreach ($brands as $brand)
                                <div class="slider-item">
                                    <a class="text-center"
                                        href="{{ route('front.catalog') . '?brand=' . $brand->slug }}">
                                        <img class="d-block hi-50 lazy"
                                            data-src="{{ asset('assets/images/' . $brand->photo) }}"
                                            alt="{{ $brand->name }}" title="{{ $brand->name }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
