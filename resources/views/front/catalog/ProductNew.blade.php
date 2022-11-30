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
        return $html;
    }
@endphp

{{-- {{dd($items)}} --}}

<div class="row g-3" id="main_div">
    @if (count($items) > 0)
        @if ($checkType != 'list')
            @foreach ($new_items as $item)

            <div class="col-xxl-3 col-md-4 col-6">
                    <div class="product-card ">
                        @if ($item->previous_price && $item->previous_price != 0)
                            <div class="product-badge product-badge2 bg-info">
                                -{{ App\Helpers\PriceHelper::DiscountPercentage($item) }}</div>
                        @endif
                        @php
                                        $featureImage = 'assets/images/products/'. $item->id . '/' . $item->photo;
                                        
                                    @endphp
                        <div class="product-thumb">
                            <img class="lazy" data-src="{{ file_exists(public_path($featureImage)) ? asset($featureImage) : asset('assets/default/no-image.png') }}"
                                alt="Product" src="{{ file_exists(public_path($featureImage)) ? asset($featureImage) : asset('assets/default/no-image.png') }}">
                            <div class="product-button-group">
                                <a class="product-button wishlist_store"
                                    href="{{ route('user.wishlist.store', $item->id) }}" title="{{ __('Wishlist') }}"><i
                                        class="icon-heart"></i></a>
                                <a class="product-button product_compare" href=""
                                    data-target="{{ route('fornt.compare.product', $item->id) }}"
                                    title="{{ __('Compare') }}"><i class="icon-repeat"></i></a>
                                @include('includes.item_footer', ['sitem' => $item])
                            </div>
                        </div>
                        <div class="product-card-body">
                            <!-- <div class="product-category">
                                <a
                                    href="{{ route('front.catalog') . '?category=' . $item->category->slug }}">{{ $item->category->name }}</a>
                            </div> -->
                            <h3 class="product-title"><a href="{{ route('front.product', $item->slug) }}">{{ucwords(str_replace('-',' ',$item->slug)) }}
                                </a></h3>
                                <h3 class="product-price text-center">
                                    <a href="{{ route('front.product', $item->slug) }}">
                                        {{-- @dd($item->price) --}}
                                        {{-- @dd(App\Helpers\PriceHelper::grandCurrencyPrice($item) ) --}}
                                        {{ isset($item->price) ? '$'.$item->price : App\Helpers\PriceHelper::grandCurrencyPrice($item) }}
                                        {{-- {{ $item->price }} --}}
                                    </a>
                                </h3>

                        </div>

                    </div>
                </div>

            @endforeach
        @else
            @foreach ($new_items as $item)
            @php
           
                                        $featureImage = 'assets/images/products/'. $item->id . '/' . $item->photo;
                                       
                                        
                                    @endphp
            <div class="col-lg-12">
                <div class="product-card product-list">
                    <div class="product-button-group">
                        <a class="product-button wishlist_store"
                            href="{{ route('user.wishlist.store', $item->id) }}"
                            title="{{ __('Wishlist') }}"><i class="icon-heart"></i></a>
                        <a data-target="{{ route('fornt.compare.product', $item->id) }}"
                            class="product-button product_compare" href=""
                            title="{{ __('Compare') }}"><i class="icon-repeat"></i></a>
                        @include('includes.item_footer', ['sitem' => $item])
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <img class="lazy" data-src="{{ file_exists(public_path($featureImage)) ? asset($featureImage) : asset('assets/default/no-image.png') }}"
                                 alt="Product" style="height: 150px;width: 150px" src="{{ file_exists(public_path($featureImage)) ? asset($featureImage) : asset('assets/default/no-image.png') }}">
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="product-card-inner">
                                <div class="product-card-body">
                                    <div class="product-category"><a
                                            href="{{ route('front.catalog') . '?category=' . $item->category->slug }}">{{ $item->category->name }}</a>
                                    </div>
                                    <h3 class="product-title"><a href="{{ route('front.product', $item->slug) }}">{{ $item->slug }}
                                        </a></h3>
                                    <h3 class="product-price text-center">
                                        <a href="{{ route('front.product', $item->slug) }}">
                                            {{ isset($item->price) ? '$'.$item->price : App\Helpers\PriceHelper::grandCurrencyPrice($item) }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
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