<div class="col-xl-3 col-lg-4">
    <aside class="sidebar">
        <div class="padding-top-2x hidden-lg-up"></div>
        <!-- Order Summary Widget-->
        <section class="card widget widget-featured-posts widget-order-summary p-4">
            <h3 class="widget-title">{{ __('Order Summary') }}</h3>
            @php
                $free_shipping = DB::table('shipping_services')
                    ->whereStatus(1)
                    ->whereIsCondition(1)
                    ->first();
            @endphp

            @if ($free_shipping)
                @if ($free_shipping->minimum_price >= $cart_total)
                    <p class="free-shippin-aa"><em>{{ __('Free Shipping After order') }}
                            {{ App\Helpers\PriceHelper::setCurrencyPrice($free_shipping->minimum_price) }}</em></p>
                @endif
            @endif

            <table class="table">
                <tr>
                    <td>{{ __('Cart Subtotal') }}:</td>
                    <td class="text-gray-dark">{{ App\Helpers\PriceHelper::setCurrencyPrice($cart_total) }}</td>
                </tr>

                @if ($tax != 0)
                    <tr>
                        <td>{{ __('Estimated tax') }}:</td>
                        <td class="text-gray-dark">{{ App\Helpers\PriceHelper::setCurrencyPrice($tax) }}</td>
                    </tr>
                @endif

                @if (DB::table('states')->count() > 0)
                    <tr class="{{ Auth::check() && Auth::user()->state_id ? '' : 'd-none' }} set__state_price_tr">
                        <td>{{ __('State tax') }}:</td>
                        <td class="text-gray-dark set__state_price">
                            {{ App\Helpers\PriceHelper::setCurrencyPrice(Auth::check() && Auth::user()->state_id ? Auth::user()->state->price : 0) }}
                        </td>
                    </tr>
                @endif

                @if ($discount)
                    <tr>
                        <td>{{ __('Coupon discount') }}:</td>
                        <td class="text-danger">-
                            {{ App\Helpers\PriceHelper::setCurrencyPrice($discount ? $discount['discount'] : 0) }}</td>
                    </tr>
                @endif

                @if ($shipping)
                    <tr>
                        <td>{{ __('Shipping') }}:</td>
                        <td class="text-gray-dark">
                            {{ App\Helpers\PriceHelper::setCurrencyPrice($shipping ? $shipping->price : 0) }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="text-lg text-primary">{{ __('Order total') }}</td>
                    <td class="text-lg text-primary grand_total_set">
                        {{ App\Helpers\PriceHelper::setCurrencyPrice($grand_total) }}</td>
                </tr>
            </table>
        </section>
        <!-- Items in Cart Widget-->
        <section class="card widget widget-featured-posts widget-featured-products p-4">
            <h3 class="widget-title">{{ __('Items In Your Cart') }}</h3>

            @foreach ($cart as $key => $item)
                <div class="entry">
                    <div class="entry-thumb"><a href="{{ route('front.product', $item['slug']) }}"><img
                                src="{{ file_exists(public_path('assets/images/products/'. $item['id']. '/' . $item['photo'])) ? asset('assets/images/products/'. $item['id']. '/' . $item['photo']) : asset('assets/default/no-image.png') }}" alt="Product"></a></div>
                    <div class="entry-content">
                        <h4 class="entry-title"><a href="{{ route('front.product', $item['slug']) }}">
                                {{ strlen(strip_tags($item['name'])) > 45? substr(strip_tags($item['name']), 0, 45) . '...': strip_tags($item['name']) }}

                            </a></h4>
                        <span class="entry-meta">{{ $item['qty'] }} x
                            {{$item['price']}}</span>
                       
                    </div>
                </div>
            @endforeach

        </section>


    </aside>
</div>
