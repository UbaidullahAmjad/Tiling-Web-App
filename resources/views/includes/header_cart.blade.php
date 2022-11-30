@php
$grandSubtotal = 0;
$qty = 0;
$option_price = 0;
@endphp
@if (Session::has('cart'))
    @foreach (Session::get('cart') as $key => $cart)
        @php
            //   
             $split=explode(',',$cart['attribute_price']);                            
            $itemprice=($split[0].".".$split[1] );                        
            // dd( $itemprice);
           
            $grandSubtotal = ($cart['main_price'] + $grandSubtotal + $itemprice) * $cart['qty'];
          
        @endphp
        <div class="entry">
            <div class="entry-thumb"><a href="{{ route('front.product', $cart['slug']) }}">
                @php
                    $cartImage = 'assets/images/products/' . $cart['id'] . '/'. $cart['photo'];
                @endphp
                    <img
                        src="{{ file_exists(public_path($cartImage)) ? asset($cartImage) : asset('assets/default/no-image.png') }}" alt="Product"></a></div>
            <div class="entry-content">
                <h4 class="entry-title"><a href="{{ route('front.product', $cart['slug']) }}">
                        {{ strlen(strip_tags($cart['name'])) > 35? substr(strip_tags($cart['name']), 0, 35) . '...': strip_tags($cart['name']) }}
                    </a></h4>
                <span class="entry-meta">{{ $cart['qty'] }} x
                    {{ $cart['price'] }}</span>

            </div>
            <div class="entry-delete"><a href="{{ route('front.cart.destroy', [$key, $cart['attributeOption']['id']]) }}"><i
                        class="icon-x"></i></a></div>
        </div>
    @endforeach
    <div class="text-right">
        <p class="text-gray-dark py-2 mb-0"><span class="text-muted">{{ __('Subtotal') }}:</span>
            {{ App\Helpers\PriceHelper::setCurrencyPrice($grandSubtotal) }}</p>
    </div>
    <div class="d-flex justify-content-between">
        <div class="w-50 d-block"><a class="btn btn-primary btn-sm  mb-0"
                href="{{ route('front.cart') }}"><span>{{ __('Cart') }}</span></a></div>
        <div class="w-50 d-block text-end"><a class="btn btn-primary btn-sm  mb-0"
                href="{{ route('front.checkout.billing') }}"><span>{{ __('Checkout') }}</span></a></div>
    @else
        {{ __('Cart empty') }}
@endif
</div>
