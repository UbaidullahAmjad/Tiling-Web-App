@php
$cart = Session::has('cart') ? Session::get('cart') : [];
$total = 0;
$option_price = 0;
$cartTotal = 0;
@endphp

<div class="card">
    <div class="card-body">
        <div class="table-responsive shopping-cart">
            <table class="table table-bordered">
             @php
                 $itemprice=0;

             @endphp
                <thead>
                    <tr>
                        <th>{{ __('Product Name') }}</th>
                        <th class="text-center">{{ __('Variant') }}</th>
                        <th>{{ __('Product Price') }}</th>
                        <th class="text-center">{{ __('Quantity') }}</th>
                        <th class="text-center">{{ __('Subtotal') }}</th>
                        <th class="text-center"><a class="btn btn-sm btn-primary"
                                href="{{ route('front.cart.clear') }}"><span>{{ __('Clear Cart') }}</span></a></th>
                    </tr>
                </thead>

                <tbody id="cart_view_load" data-target="{{ route('cart.get.load') }}">

                    @foreach ($cart as $key => $item)
                        @php
                       
                       
                           $split=explode(',',$item['attribute_price']);                            
                            $newvalue=($split[0].".".$split[1] );
                            
                            $cartTotal = $cartTotal + (($item['main_price'] + $total + $newvalue) * $item['qty']);
                            // dd($cartTotal);
                        @endphp
                        

                        <tr>
                            <td>
                                <div class="product-item">
                                    <!-- <a class="product-thumb"
                                        href="{{ route('front.product', $item['slug']) }}">
                                    @php
                                        $itemImage = 'assets/images/products/' . $item['id'] . '/'. $item['photo'];
                                    @endphp
                                        <img
                                            class="cart-product-image" src="{{ !empty($item['photo']) && file_exists(public_path($itemImage)) ? asset($itemImage) : asset('assets/default/no-image.png') }}" alt="Product">
                                        </a> -->
                                    <div class="product-info">
                                        <h4 class="product-title"><a href="{{ route('front.product', $item['slug']) }}">
                                                {{ strlen(strip_tags($item['name'])) > 45? substr(strip_tags($item['name']), 0, 45) . '...': strip_tags($item['name']) }}

                                            </a></h4>


                                    </div>
                                </div>
                            </td>

                            <td class="text-left text-lg">

                            <input type="hidden" id="m_2_id_{{ $item['attributeOption']['item_id'] }}" name="m_2_id_{{ $item['attributeOption']['item_id'] }}" value="{{ $item['attributeOption']['id'] }}">             
                                @if($item['attribute']['abbrivation'] == 'm²')
                                    
                                    
                                    <input type="hidden" id="indication" name="indication" value="true">
                                    <div class="row">
                                        <div class="col-2">
                                            @php
                                                $attributeImage = 'assets/images/products/'. $item['id'] . '/' . $item['attributeOption']['image'];
                                                
                                            @endphp
                                            @if($item['attributeOption']['image'])
                                            <img src="{{ file_exists(public_path($attributeImage)) ? asset($attributeImage) : asset('assets/default/no-image.png') }}" alt="Product"></a>
                                            @else
                                            <img src="{{ asset('assets/default/no-image.png') }}" alt="Product"></a>
                                            @endif
                                        </div>
                                        <div class="col-10">
                                            {{ ( $item['attributeOption']['format'] ?? 0 ) }}
                                            <br>
                                            {{ 'Box Size: ' . $item['box_size'] . ' ' . $item['attribute']['abbrivation'] }}
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" id="lit" name="lit" value="true">
                                    <div class="row">
                                        <div class="col-8 offset-2">
                                            per liter
                                        </div>
                                    </div>
                                @endif
                            </td>
                           
                            <td class="text-center text-lg">
                               {{ $item['price'] }} <input type="hidden" id="un_price_{{ $item['attributeOption']['item_id'] }}" value="{{ $item['price'] }}"> </td>

                            <td class="text-center">

                                    <div class="qtySelector product-quantity w-100 justify-content-center">
                                        <span
                                            class="decreaseQtycart cartsubclick"
                                            data-id="{{ $key }}"
                                            data-interval="{{ $item['attributeOption']['quantity'] }}"
                                            data-attribute-abbrivation="{{ $item['attribute']['abbrivation'] }}"
                                            data-target="{{ App\Helpers\PriceHelper::GetItemId($key) }}">
                                            
                                            <i class="fas fa-minus"></i>
                                        </span>
                                        <input type="text" disabled class="qtyValue cartcart-amount" id="it_qty_{{ $item['attributeOption']['item_id'] }}" value="{{ $item['qty'] }}">
                                        <span
                                            class="increaseQtycart cartaddclick"
                                            data-id="{{ $key }}"
                                            data-interval="{{ $item['attributeOption']['quantity'] }}"
                                            data-attribute-abbrivation="{{ $item['attribute']['abbrivation'] }}"
                                            data-target="{{ App\Helpers\PriceHelper::GetItemId($key) }}">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <input type="hidden" value="3333" id="current_stock">
                                    </div>


                            </td>

                            <td class="text-center text-lg" id="tot_{{ $item['attributeOption']['item_id'] }}">
                                @php


                            $split=explode(',',$item['price']);                            
                            $itemprice=($split[0].".".$split[1] );                        
                            //    dd($itemprice) 
                            @endphp
                                
                                {{$itemprice * $item['qty'] }}

                            </td>
                             
                            <td class="text-center"><a class="remove-from-cart"
                                    href="{{ route('front.cart.destroy', [$key, $item['attributeOption']['id']]) }}" data-toggle="tooltip"
                                    title="Remove item"><i class="icon-x"></i></a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="card mt-4">
    <div class="card-body">
        <div class="shopping-cart-footer">
            <div class="text-right column text-lg"><span class="text-muted">{{ __('Subtotal') }}: </span><span
                    class="text-gray-dark">{{ App\Helpers\PriceHelper::setCurrencyPrice($cartTotal - (Session::has('coupon') ? round(Session::get('coupon')['discount'], 2) : 0)) }}</span>
            </div>


        </div>
        <div class="shopping-cart-footer">
            <div class="column"><a class="btn btn-primary " href="{{ route('front.index') }}"><span><i
                            class="icon-arrow-left"></i> {{ __('Back to Shopping') }}</span></a></div>
            <div class="column"><a class="btn btn-primary"
                    href="{{ route('front.checkout.billing') }}"><span>{{ __('Checkout') }}</span></a></div>
        </div>
    </div>
</div>
</div>
