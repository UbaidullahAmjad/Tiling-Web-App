@extends('master.front')
@section('title')
    {{__('Cart')}}
@endsection
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('content')
    <!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('Cart')}}</li>
                  </ul>
            </div>
        </div>
    </div>
  </div>

  @if(Session::has('cart') && count(Session::get('cart')) > 0)
  <div class="padding-bottom-3x mb-1">

    <!-- Shopping Cart-->
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <div id="view_cart_load">
            @include('includes.cart')
          </div>
        <!-- </div> -->
        
        <div class="col-lg-3 scroll-y-axis">
            
                  <h5 class="text-center">Cross Selling Products</h5>
                  @if(count($cross_sell_products) > 0)
                    @foreach($cross_sell_products as $product) 
                    <!-- @dump($product->id) -->
                    <div class="card mb-2">
                      <div class="card-body" >
                        <div class="product-thumb"  align="center">
                          <img class="lazy" style="height:100px;width:100px"
                              data-src="{{ file_exists(asset('assets/images/products/'. $product->id . '/' . $product->photo)) ? asset('assets/images/products/'. $product->id . '/' . $product->photo) : asset('assets/default/no-image.png') }}" alt="Product">
                        </div>
                        <div class="product-card-body">
                          <div class="product-category"><a
                                  href="{{ route('front.catalog') . '?category=' . $product->category->slug }}">{{ $product->category->name }}</a>
                          </div>
                        <h5 class="product-title"><a href="{{ route('front.product', $product->slug) }}">
                                {{ strlen(strip_tags($product->name)) > 35? substr(strip_tags($product->name), 0, 35): strip_tags($product->name) }}
                            </a></h5>
                        <h6 class="product-price">
                            @php $option = $product->attributeOptions->first(); @endphp
                            € {{ isset($option) ? $option->price : 0 }}
                            
                        </h6>
                        @php
                          $varient = App\Models\AttributeOption::where('item_id',$product->id)->first();
                          $attribute = App\Models\Attribute::find($varient->attribute_id);
                        @endphp
                      <form action="{{route('product.addcart')}}" method="get">
                        <input type="hidden" name="item_id" value="{{$product->id}}">
                        <input type="hidden" name="variant_id" value="{{$varient->id}}">
                        <input type="hidden" name="unit_price" value="{{$varient->price}}">
                        <input type="hidden" name="total_price" value="{{$varient->price}}">
                        <input type="hidden" name="packet" value="1">
                        @if($attribute->name == "square meter")
                          <input type="hidden" name="meter_square" value="2">
                        @else
                          <input type="hidden" name="meter_square" value=null>
                        @endif
                        <div align="center">
                          <button class="btn btn-primary mb-1 btn-sm " type="submit"><i class="icon-bag"></i><span>{{ __('Add to Cart') }}</span></button>
                        </div>
                        
                      </form>
                        
                    </div>
                    </div>
                    </div>
                    @endforeach
                  @endif 
              
        </div>
      </div>
    </div>
    
    

</div>
  @else
  <div class="padding-bottom-3x mb-1">
    <div class="card text-center">
      <div class="card-body padding-top-2x">
        <h3 class="card-title">{{__('Your shopping cart is empty.')}}</h3>
       <a class="btn btn-outline-primary m-4" href="{{route('front.index')}}"><i class="icon-package pr-2"></i>{{__('View our products')}}</a></div>
      </div>
    </div>
  @endif
  <!-- Page Content-->


@endsection

