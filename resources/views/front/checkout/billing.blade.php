@extends('master.front')

@section('title')
    {{ __('Billing') }}
@endsection

@section('content')
    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                
            </div>
        </div>
    </div>
    @php $bill = Session::get('billing_address'); 
     $billing_address = Session::get('billing_address');
     $ship = Session::get('shipping_address');
    @endphp
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1 checkut-page">
        <div class="row">
            <!-- Billing Adress-->
            <div class="col-xl-9 col-lg-8" id="bill_ship_payment_section">

                <div class="steps flex-sm-nowrap mb-5"><span id="billing_step" class="step active">
                        <h4 class="step-title">1. {{ __('Billing Address') }}:</h4>
</span><span class="step" id="shipping_step">
                        <h4 class="step-title">2. {{ __('Shipping Address') }}:</h4>
</span><span class="step" id="payment_step">
                        <h4 class="step-title">3. {{ __('Review and pay') }}</h4>
                    </span>
                </div>
                @php $user = auth()->user(); @endphp
                
                <div class="card" id="logged-in-billing" style="display:none;">
                    <div class="card-body">
                        <h6>{{ __('Billing Address') }}</h6>

                        <!-- <form id="checkoutBilling" action="#" method="POST"> -->
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-fn">{{ __('First Name') }} *</label>
                                        <input class="form-control" name="bill_first_name" type="text" required
                                            id="checkout-fnb" value="{{ isset($user) ? $user->first_name : ($bill ? $bill['bill_first_name'] : '') }}">
                                            <p style="display:none;color:red;" id="b_f_l_name">Name is required</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-ln">{{ __('Last Name') }}</label>
                                        <input class="form-control" name="bill_last_name" type="text" required
                                            id="checkout-lnb" value="{{ isset($user) ? $user->last_name : ($bill ? $bill['bill_last_name'] : '') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout_email_billing">{{ __('E-mail Address') }} *</label>
                                        <input class="form-control" name="bill_email" type="email" required
                                            id="checkout_email_billingb" value="{{ isset($user) ? $user->email : ($bill ? $bill['bill_email'] : '') }}">
                                            <p style="display:none;color:red;" id="b_f_l_email">Email is required</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-phone">{{ __('Phone Number') }} *</label>
                                        <input class="form-control" name="bill_phone" type="text" id="checkout-phoneb"
                                            required value="{{ isset($user) ? $user->phone : ($bill ? $bill['bill_phone'] : '') }}">
                                            <p style="display:none;color:red;" id="b_f_l_phone">Phone number is required</p>
                                    </div>
                                </div>
                            </div>
                            @if (App\Helpers\PriceHelper::CheckDigital())
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checkout-company">{{ __('Company') }}</label>
                                            <input class="form-control" name="bill_company" type="text"
                                                id="checkout-companyb"
                                                value="{{ isset($user) ? $user->bill_company : ($bill ? $bill['bill_company'] : '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-address1">{{ __('Address') }} 1 *</label>
                                            <input class="form-control" name="bill_address1" required type="text"
                                                id="checkout-address1b"
                                                value="{{ isset($user) ? $user->bill_address1 : ($bill ? $bill['bill_address1'] : '') }}">
                                                <p style="display:none;color:red;" id="b_f_l_address">Address is required</p>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-zip">{{ __('Zip Code') }} *</label>
                                            <input class="form-control" name="bill_zip" type="text" id="checkout-zipb"
                                                value="{{ isset($user) ? $user->bill_zip : ($bill ? $bill['bill_zip']: '') }}">
                                                <p style="display:none;color:red;" id="b_f_l_zip">Zip is required</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-city">{{ __('City') }}</label>
                                            <input class="form-control" name="bill_city" type="text" required
                                                id="checkout-cityb" value="{{ isset($user) ? $user->bill_city : ($bill ? $bill['bill_city'] : '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checkout-country">{{ __('Country') }} *</label>
                                            <select class="form-control" required name="bill_country"
                                                id="billing-countryb">
                                                <option selected>{{ __('Choose Country') }}</option>
                                                @foreach (DB::table('countries')->get() as $country)
                                                    <option value="{{ $country->name }}"
                                                        {{ isset($user) && $user->bill_country == $country->name ? 'selected' : ($bill && $bill['bill_country'] == $country->name ? 'selected' : '') }}>
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <p style="display:none;color:red;" id="b_f_l_country">Country is required</p>
                                        </div>
                                    </div>
                                </div>
                            @endif




                            

                            @if ($setting->is_privacy_trams == 1)
                                <!-- <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="trams__condition">
                                        <label class="custom-control-label" for="trams__condition">This site is protected by
                                            reCAPTCHA and the <a href="{{ $setting->policy_link }}" target="_blank">Privacy
                                                Policy</a> and <a href="{{ $setting->terms_link }}" target="_blank">Terms
                                                of Service</a> apply.</label>
                                    </div>
                                </div> -->
                            @endif

                            <div class="d-flex justify-content-between paddin-top-1x mt-4">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                
                                    @if(($bill && $bill['same_ship_address'] == "true") || (session()->get('is_it_checked') == 1))
                                    <input class="custom-control-input" type="checkbox" id="same_addressb"
                                        name="same_ship_address" checked>
                                    @else
                                    <input class="custom-control-input" type="checkbox" id="same_addressb"
                                        name="same_ship_address">
                                    @endif
                                    <label class="custom-control-label"
                                        for="same_address">{{ __('Shipping address same as billing address') }}</label><br><br>
                                        <a href="{{ url('cart') }}" class="btn btn-primary  btn-sm"
                                        ><i class="icon-arrow-left"></i><span class="hidden-xs-down">{{ __('Back to Cart') }}</span></a>
                                        <button id="go_to_shippp_payement" class="btn btn-primary  btn-sm"
                                        type="button"><span class="hidden-xs-down">{{ __('Continue') }}</span><i
                                            class="icon-arrow-right"></i></button>
                                </div>
                            </div>
                                <!-- @if ($setting->is_privacy_trams == 1) -->
                                
                                    
                                <!-- @else
                                    <button class="btn btn-primary btn-sm" type="submit"><span
                                            class="hidden-xs-down">{{ __('Continue') }}</span><i
                                            class="icon-arrow-right"></i></button>
                                @endif -->
                            </div>
                        <!-- </form> -->
                    </div>
                </div>
               
                @if(!auth()->user())
               
                
               
                    <div id="login_reg_guest">
                        @include('front.checkout.get_checkout_page')
                    </div>
                 
                 <div class="card" id="billing_page_info" style="display:none">
                    <div class="card-body">
                        <h6>{{ __('Billing Address') }}</h6>

                        <!-- <form> -->
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-fn">{{ __('First Name') }} *</label>
                                        <input class="form-control" name="bill_first_name" type="text" required
                                            id="checkout-fn" value="{{ isset($user) ? $user->first_name : ($bill ? $bill['bill_first_name'] : '') }}">
                                            <p style="display:none;color:red;" id="b_f_name">Name is required</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-ln">{{ __('Last Name') }}</label>
                                        <input class="form-control" name="bill_last_name" type="text" required
                                            id="checkout-ln" value="{{ isset($user) ? $user->last_name : ($bill ? $bill['bill_last_name'] : '') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout_email_billing">{{ __('E-mail Address') }} *</label>
                                        <input class="form-control" name="bill_email" type="email" required
                                            id="checkout_email_billing" value="{{ isset($user) ? $user->email : ($bill ? $bill['bill_email'] : '') }}">
                                            <p style="display:none;color:red;" id="b_f_email">Email is required</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-phone">{{ __('Phone Number') }} *</label>
                                        <input class="form-control" name="bill_phone" type="text" id="checkout-phone"
                                            required value="{{ isset($user) ? $user->phone : ($bill ? $bill['bill_phone'] : '') }}">
                                            <p style="display:none;color:red;" id="b_f_phone">Phone Number is required</p>
                                    </div>
                                </div>
                            </div>
                            @if (App\Helpers\PriceHelper::CheckDigital())
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checkout-company">{{ __('Company') }}</label>
                                            <input class="form-control" name="bill_company" type="text"
                                                id="checkout-company"
                                                value="{{ isset($user) ? $user->bill_company : ($bill ? $bill['bill_company'] : '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-address1">{{ __('Address') }} 1 *</label>
                                            <input class="form-control" name="bill_address1" required type="text"
                                                id="checkout-address1"
                                                value="{{ isset($user) ? $user->bill_address1 : ($bill ? $bill['bill_address1'] : '') }}">
                                                <p style="display:none;color:red;" id="b_f_address">Address is required</p>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-zip">{{ __('Zip Code') }} *</label>
                                            <input class="form-control" name="bill_zip" type="text" id="checkout-zip"
                                                value="{{ isset($user) ? $user->bill_zip : ($bill ? $bill['bill_zip'] : '') }}">
                                                <p style="display:none;color:red;" id="b_f_zip">Zip Code is required</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-city">{{ __('City') }} </label>
                                            <input class="form-control" name="bill_city" type="text" required
                                                id="checkout-city" value="{{ isset($user) ? $user->bill_city : ($bill ? $bill['bill_city'] : '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checkout-country">{{ __('Country') }} *</label>
                                            <select class="form-control" required name="bill_country"
                                                id="billing-country">
                                                <option selected>{{ __('Choose Country') }}</option>
                                                @foreach (DB::table('countries')->get() as $country)
                                                    <option value="{{ $country->name }}"
                                                        {{ isset($user) && $user->bill_country == $country->name ? 'selected' : ($bill && $bill['bill_country'] == $country->name ? 'selected' : '') }}>
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <p style="display:none;color:red;" id="b_f_country">Country is required</p>
                                        </div>
                                    </div>
                                </div>
                            @endif




                            

                            @if ($setting->is_privacy_trams == 1)
                                <!-- <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="trams__condition">
                                        <label class="custom-control-label" for="trams__condition">This site is protected by
                                            reCAPTCHA and the <a href="{{ $setting->policy_link }}" target="_blank">Privacy
                                                Policy</a> and <a href="{{ $setting->terms_link }}" target="_blank">Terms
                                                of Service</a> apply.</label>
                                    </div>
                                </div> -->
                            @endif
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                
                                
                               
                                    @if(($bill && $bill['same_ship_address'] == "true") || (session()->get('is_it_checked') == 1) )
                                    <input class="custom-control-input" value type="checkbox" id="same_address"
                                        name="same_ship_address" checked>
                                    @else
                                    <input class="custom-control-input" type="checkbox" id="same_address"
                                        name="same_ship_address">
                                    @endif
                                    <label class="custom-control-label"
                                        for="same_address">{{ __('Shipping address same as billing address') }}</label><br><br>
                                        <a href="{{ url('cart') }}" class="btn btn-primary  btn-sm"
                                        type="button"><i class="icon-arrow-left"></i><span class="hidden-xs-down">{{ __('Back to Cart') }}</span></a>
                                    <button id="go_to_shipp_payement" class="btn btn-primary  btn-sm"
                                        type="button"><span class="hidden-xs-down">{{ __('Continue') }}</span><i
                                            class="icon-arrow-right"></i></button>

                                </div>
                            </div>
                            <div class="d-flex justify-content-between paddin-top-1x mt-4">
                               
                            </div>
                        <!-- </form> -->
                    </div>
                 </div>

                 @endif
                <!-- ============================FOR SHIPPING ADDDRESS================== -->
                <div class="card" style="display:none;" id="shipping_page_info">
                    <div class="card-body">
                    
                        <h6>{{__('Shipping Address')}}</h6>

                        <!-- <form id="checkoutShipping" action="#" method="POST"> -->
                        @csrf
                    
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="checkout-fn">{{__('First Name')}} *</label>
                            <input class="form-control" name="ship_first_name" type="text" id="checkout-fnn" value="{{ isset($ship) ? $ship['ship_first_name'] : ''}}" >
                            <p style="display:none;color:red;" id="s_f_name">Name is required</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="checkout-ln">{{__('Last Name')}}</label>
                            <input class="form-control" name="ship_last_name" type="text" id="checkout-lnn" value="{{ isset($ship) ? $ship['ship_last_name'] : ''}}" >
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="checkout-email">{{__('E-mail Address')}} *</label>
                            <input class="form-control" name="ship_email" type="email" id="checkout-emaill" value="{{ isset($ship) ? $ship['ship_email'] : ''}}" >
                            <p style="display:none;color:red;" id="s_f_email">Email is required</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="checkout-phone">{{__('Phone Number')}} *</label>
                            <input class="form-control" name="ship_phone" type="text" id="checkout-phonee" value="{{ isset($ship) ? $ship['ship_phone']: ''}}" >
                            <p style="display:none;color:red;" id="s_f_phone">Phone Number is required</p>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label for="checkout-company">{{__('Company')}}</label>
                            <input class="form-control" name="ship_company" type="text" id="checkout-companyy" value="{{isset($ship) ? $ship['ship_company'] : ''}}">
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="checkout-address1">{{__('Address')}} 1 *</label>
                            <input class="form-control" name="ship_address1" required type="text" id="checkout-address11" value="{{isset($ship) ? $ship['ship_address1'] : ''}}" >
                            <p style="display:none;color:red;" id="s_f_address">Address is required</p>
                            </div>
                        </div>
                        
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="checkout-zip">{{__('Zip Code')}} *</label>
                            <input class="form-control" name="ship_zip" type="text" id="checkout-zipp" value="{{isset($ship) ? $ship['ship_zip'] : ''}}" >
                            <p style="display:none;color:red;" id="s_f_zip">Zip Code is required</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="checkout-city">{{__('City')}}</label>
                            <input class="form-control" name="ship_city" required type="text" id="checkout-cityy" value="{{isset($ship) ? $ship['ship_city'] : ''}}" >
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label for="checkout-country">{{ __('Country') }} *</label>
                            <select class="form-control" name="ship_country" required id="billing-countryy">
                                <option selected>{{__('Choose Country')}}</option>
                                @foreach (DB::table('countries')->get() as $country)
                                    <option value="{{$country->name}}" {{isset($user) && $user->ship_country == $country->name ? 'selected' :($ship && $ship['ship_country'] == $country->name ? 'selected' : '')}} >{{$country->name}}</option>
                                @endforeach
                            </select>
                            <p style="display:none;color:red;" id="s_f_country">Country is required</p>
                            </div>
                        </div>
                        </div>
                    


                        <div class="d-flex justify-content-between paddin-top-1x mt-4">
                        <div>
                        <input class="custom-control-input" type="checkbox" id="same_addressb"
                                        name="same_ship_address" onclick="SetShippingData(this)">
                        <label class="custom-control-label"
                        for="same_address">{{ __('Shipping address same as billing address') }}</label><br><br>
                        </div><br>
                        
                        </a><button class="btn btn-primary  btn-sm" id="back_to_billing" type="button"><i class="icon-arrow-left"></i><span class="hidden-xs-down">{{__('Back')}}</span></button>
                        <button class="btn btn-primary  btn-sm" id="go_to_payment_page" type="button"><span class="hidden-xs-down">{{__('Continue')}}</span><i class="icon-arrow-right"></i></button></div>
                        <!-- </form> -->
                    </div>
                </div>
                <!-- ===========================SHIpping End ==================== -->

                <!-- ================= Payment place ================== -->
                @php

                                    $ship = Session::get('shipping_address');
                                    $bill = Session::get('billing_address');
                                @endphp
                   
                    <div class="card" style="display:none;" id="payment_page_info">
                        <div class="card-body">
                            <h6 class="pb-2">{{ __('Review Your Order') }} :</h6>
                            <hr>
                            <div class="row padding-top-1x  mb-4">
                                <div class="col-sm-6">
                                <div class="row">
                                        <div class="col-sm-9">
                                            <h6>{{ __('Shipping Address') }} :</h6>
                                        </div>
                                        <div class="col-sm-1 mt-1">
                                            <span><i id="edit-shipping" style="display:block" class="fa fa-edit"></i></span>
                                        </div>
                                    </div>
                                    
                                    <ul class="list-unstyled">
                                        <li><span class="text-muted">{{ __('Name') }}:
                                            </span><span id="shipp_name"></span></li>
                                        @if (App\Helpers\PriceHelper::CheckDigital())
                                            <li><span class="text-muted">{{ __('Address') }}:
                                                </span><span id="shipp_add"></span> </li>
                                        @endif
                                        <li><span class="text-muted">{{ __('Phone') }}: </span><span id="shipp_ph"></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <h6>{{ __('Billing address') }} : </h6>
                                    <ul class="list-unstyled">
                                        <li><span class="text-muted">{{ __('Name') }}:
                                            </span><span id="billl_name"></span></li>
                                        @if (App\Helpers\PriceHelper::CheckDigital())
                                            <li><span class="text-muted">{{ __('Address') }}:
                                                </span><span id="bill_add"></span></li>
                                        @endif
                                        <li><span class="text-muted">{{ __('Phone') }}: </span><span id="bill_ph"></span>
                                        </li>
                                    </ul>

                                    @if (DB::table('states')->count() > 0)
                                        <select name="state_id" class="form-control" id="state_id_select" required>
                                            <option value="" selected disabled>{{ __('Select Shipping State') }}</option>
                                            @foreach (DB::table('states')->whereStatus(1)->get()
                                                    as $state)
                                                <option value="{{ $state->id }}"
                                                    data-href="{{ route('front.state.setup', $state->id) }}"
                                                    {{ Auth::check() && Auth::user()->state_id == $state->id ? 'selected' : '' }}>
                                                    {{ $state->name }}
                                                    @if ($state->type == 'fixed')
                                                        ({{ App\Helpers\PriceHelper::setCurrencyPrice($state->price) }})
                                                    @else
                                                        ({{ $state->price }}%)
                                                    @endif

                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- <small class="text-primary">{{ __('please select shipping state ') }}</small> -->
                                        @error('state_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    @endif


                                </div>


                            </div>

                            <h6>{{ __('Pay with') }} :</h6>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="payment-methods">
                                        @php
                                            $gateways = DB::table('payment_settings')
                                                ->whereStatus(1)
                                                ->get();
                                        @endphp
                                        @foreach ($gateways as $gateway)
                                            @if (App\Helpers\PriceHelper::CheckDigitalPaymentGateway())
                                                @if ($gateway->unique_keyword != 'cod')
                                                    <div class="single-payment-method">
                                                        <a class="text-decoration-none " href="#" data-bs-toggle="modal"
                                                            data-bs-target="#{{ $gateway->unique_keyword }}">
                                                            <img class=""
                                                                src="{{ asset('assets/images/' . $gateway->photo) }}"
                                                                alt="{{ $gateway->name }}" title="{{ $gateway->name }}">
                                                            <p>{{ $gateway->name }}</p>
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="single-payment-method">
                                                    <a class="text-decoration-none" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#{{ $gateway->unique_keyword }}">
                                                        <img class=""
                                                            src="{{ asset('assets/images/' . $gateway->photo) }}"
                                                            alt="{{ $gateway->name }}" title="{{ $gateway->name }}">
                                                        <p>{{ $gateway->name }}</p>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary  btn-sm" id="back_to_shipping" type="button"><i class="icon-arrow-left"></i><span class="hidden-xs-down">{{__('Back')}}</span></button>

                        </div>
                    </div>

                    @include('includes.checkout_modal')
                   
                <!-- =============== End Payment ================== -->
                
            </div>
            <!-- REGISTER Page -->
           @php  $setting = App\Models\Setting::first();
                if($setting->recaptcha == 1){
                    Config::set('captcha.sitekey', $setting->google_recaptcha_site_key);
                    Config::set('captcha.secret', $setting->google_recaptcha_secret_key);
                }
        @endphp
            <div class="col-xl-9 col-lg-8" id="regis_page" style="display:none">
                    <div class="">
                    <div class="card register-area">
                        <div class="card-body ">
                            <h4 class="margin-bottom-1x text-center">{{__('Register')}}</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="reg-fn">{{__('First Name')}} *</label>
                                    <input class="form-control" type="text" name="first_name" placeholder="{{__('First Name')}}" id="reg-fn" value="{{old('first_name')}}">
                                    <p style="display:none;color:red;" id="r_f_name">Name is required</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="reg-ln">{{__('Last Name')}}</label>
                                    <input class="form-control" type="text" name="last_name" placeholder="{{__('Last Name')}}" id="reg-ln" value="{{old('last_name')}}">
                                    
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="reg-email">{{__('E-mail Address')}} *</label>
                                    <input class="form-control" type="email" name="email" placeholder="{{__('E-mail Address')}}" id="reg-email" value="{{old('email')}}">
                                    <p style="display:none;color:red;" id="r_f_email">Email is required</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="reg-phone">{{__('Phone Number')}} *</label>
                                    <input class="form-control" name="phone" type="text" placeholder="{{__('Phone Number')}}" id="reg-phone" value="{{old('phone')}}">
                                    <p style="display:none;color:red;" id="r_f_phone">Phone is required</p>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="reg-pass">{{__('Password')}} *</label>
                                    <input class="form-control" type="password" name="password" placeholder="{{__('Password')}}" id="reg-pass">
                                    <p style="display:none;color:red;" id="r_f_password">Password is required</p>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="reg-pass-confirm">{{__('Confirm Password')}} *</label>
                                    <input class="form-control" type="password" name="password_confirmation" placeholder="{{__('Confirm Password')}}" id="reg-pass-confirm">
                                    <p style="display:none;color:red;" id="r_f_confirm">Confirm Password is required</p>
                                    <p style="display:none;color:red;" id="r_f_not_match">Passwords does not match</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="reg-pass">{{__('Zip Code')}} *</label>
                                    <input class="form-control" type="text" name="bill_zip" placeholder="{{__('Zip Code')}}" id="reg-zip">
                                    <p style="display:none;color:red;" id="r_f_zip">Zip Code is required</p>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="reg-pass">{{__('Address')}} *</label>
                                    <input class="form-control" type="text" name="bill_address1" placeholder="{{__('Address')}}" id="reg-address1">
                                    <p style="display:none;color:red;" id="r_f_address">Address is required</p>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-country">{{ __('Country') }} *</label>
                                        <select class="form-control" required name="bill_country"
                                            id="reg-country">
                                            <option selected>{{ __('Choose Country') }}</option>
                                            @foreach (DB::table('countries')->get() as $country)
                                                <option value="{{ $country->name }}"
                                                    {{ isset($user) && $user->bill_country == $country->name ? 'selected' : '' }}>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        <p style="display:none;color:red;" id="r_f_country">Country is required</p>
                                    </div>
                                </div>

                                @if ($setting->recaptcha == 1)
                                <div class="col-lg-12 mb-4">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                    @php
                                        $errmsg = $errors->first('g-recaptcha-response');
                                    @endphp
                                    <p class="text-danger mb-0">{{__("$errmsg")}}</p>
                                    @endif
                                </div>
                                @endif

                                <div class="col-12 text-center">
                                    <button class="btn btn-primary margin-bottom-none" id="regis_go_back" type="button"><i class="icon-arrow-left"></i><span>{{__('Back')}}</span></button>
                                    <button class="btn btn-primary margin-bottom-none" id="do_register" type="button"><span>{{__('Register')}}</span></button>
                                </div>
                            </div>
                    <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar          -->
            @include('includes.checkout_sitebar', $cart)
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            var user = "{{ auth()->user() }}";
            if(user){
                document.getElementById('logged-in-billing').style.display = 'block';
            }
        });

        function SetShippingData(chk) {
            var arr = '<?php echo json_encode($bill); ?>'; 
            var bill = JSON.parse("[" + arr + "]");
            console.log(bill)
            if(bill){
                if(chk.checked){

                    document.getElementById('checkout-fnn').value = bill[0]['bill_first_name'];
                    document.getElementById('checkout-lnn').value = bill[0]['bill_last_name'];
                    document.getElementById('checkout-emaill').value= bill[0]['bill_email'];
                    document.getElementById('checkout-phonee').value = bill[0]['bill_phone'];
                    document.getElementById('checkout-companyy').value = bill[0]['bill_company'];
                    document.getElementById('checkout-address11').value = bill[0]['bill_address1'];
                    document.getElementById('checkout-zipp').value = bill[0]['bill_zip'];
                    document.getElementById('checkout-cityy').value = bill[0]['bill_city'];
                    document.getElementById('billing-countryy').value = bill[0]['bill_country'];
                    document.getElementById('edit-shipping').style.display = "block";
                   
                    sessionStorage.setItem("ischecked", "yes");
                    console.log(sessionStorage.getItem("ischecked"))

                   

                }else{
                    document.getElementById('checkout-fnn').value = '';
                    document.getElementById('checkout-lnn').value = '';
                    document.getElementById('checkout-emaill').value= '';
                    document.getElementById('checkout-phonee').value = '';
                    document.getElementById('checkout-companyy').value = '';
                    document.getElementById('checkout-address11').value = '';
                    document.getElementById('checkout-zipp').value = '';
                    document.getElementById('checkout-cityy').value = '';
                    document.getElementById('billing-countryy').value = '';
                    document.getElementById('edit-shipping').style.display = "block";
                   
                    sessionStorage.setItem("ischecked", "no");
                    console.log(sessionStorage.getItem("ischecked"))
                    
                }
            }
            
        }

        // FOR Guest
        $("#continue__button_guest").click(function(){
            document.getElementById('login_reg_guest').style.display = 'none';
            document.getElementById('billing_page_info').style.display = 'block';

        });

        $("#go_to_shipp_payement").click(function(){
                var bill_first_name = document.getElementById('checkout-fn').value;
                var bill_last_name = document.getElementById('checkout-ln').value;
                var bill_email = document.getElementById('checkout_email_billing').value;
                var bill_phone = document.getElementById('checkout-phone').value;
                var bill_company = document.getElementById('checkout-company').value;
                var bill_address1 = document.getElementById('checkout-address1').value;
                
                var bill_zip = document.getElementById('checkout-zip').value;
                var bill_city = document.getElementById('checkout-city').value;
                var bill_country = document.getElementById('billing-country').value;
                var same_ship_address = document.getElementById('same_address').checked;

                document.getElementById('b_f_name').style.display = "none";
                document.getElementById('b_f_email').style.display = "none";
                document.getElementById('b_f_phone').style.display = "none";
                document.getElementById('b_f_address').style.display = "none";
                document.getElementById('b_f_zip').style.display = "none";
                document.getElementById('b_f_country').style.display = "none";

                if(!bill_first_name){  
                    document.getElementById('b_f_name').style.display = "block";
                    const element = document.getElementById("checkout-fn");
                        element.scrollIntoView();
                    exit();
                }
                if(!bill_email){  
                    document.getElementById('b_f_email').style.display = "block";
                    const element = document.getElementById("checkout_email_billing");
                        element.scrollIntoView();
                    exit();
                }
                if(!bill_phone){  
                    document.getElementById('b_f_phone').style.display = "block";
                    const element = document.getElementById("checkout-phone");
                        element.scrollIntoView();
                    exit();
                }
                if(!bill_address1){
                    document.getElementById('b_f_address').style.display = "block";
                    const element = document.getElementById("checkout-address1");
                        element.scrollIntoView();
                    exit();
                }
                if(!bill_zip){
                    document.getElementById('b_f_zip').style.display = "block";
                    const element = document.getElementById("checkout-zip");
                        element.scrollIntoView();
                    exit();
                }
                if(bill_country == "Choose Country"){
                    document.getElementById('b_f_country').style.display = "block";
                    const element = document.getElementById("billing-country");
                        element.scrollIntoView();
                    exit();
                }
                
                // exit();
            $.ajax({
                url : "{{ route('front.checkout.store') }}",
                type: "json",
                method: "post",
                data : {
                    "_token": "{{ csrf_token() }}",
                    bill_first_name : bill_first_name,
                    bill_last_name : bill_last_name,
                    bill_email : bill_email,
                    bill_phone : bill_phone,
                    bill_company : bill_company,
                    bill_address1 : bill_address1,
                    bill_zip : bill_zip,
                    bill_city : bill_city,
                    bill_country : bill_country,
                    same_ship_address: same_ship_address
                },
                success: function(data){
                    if(data.shipping_add == "false"){
                        document.getElementById('billing_page_info').style.display = 'none';
                        console.log('here')
                            $('#billing_step').removeClass('active');
                        // $('#billing_step').css('background','#f3f5f6');
                            // $('#payment_step').css('cursor','none');
                            $('#shipping_step').css('cursor','none');
                            $('#shipping_step').addClass('active');
                            if(data.bill){
                                var bill = data.bill;
                                if(bill.ship_same_address == "true"){
                                    document.getElementById('edit-shipping').style.display = "block";
                                }else{
                                    document.getElementById('edit-shipping').style.display = "none";
                                }
                            }
                            document.getElementById('shipping_page_info').style.display = 'block';
                            const element = document.getElementById("shipping_step");
                            element.scrollIntoView();
                        
                    }else{
                        console.log('here3333')
                        if(document.getElementById('payment_page_info') != null){
                            document.getElementById('billing_page_info').style.display = 'none';
                            document.getElementById('shipping_page_info').style.display = 'none';
                            $('#billing_step').removeClass('active');
                            $('#shipping_step').removeClass('active');
                            // $('#billing_step').css('background','#f3f5f6');
                            // $('#shipping_step').css('background','#f3f5f6');
                            document.getElementById('payment_page_info').style.display = 'block';
                            $('#payment_step').addClass('active');
                            // console.log(document.getElementById('payment_page_info'))
                            if(data.ship){
                                var ship = data.ship;
                                document.getElementById('checkout-fnn').value = ship['ship_first_name'];
                                document.getElementById('checkout-lnn').value = ship['ship_last_name'];
                                document.getElementById('checkout-emaill').value= ship['ship_email'];
                                document.getElementById('checkout-phonee').value = ship['ship_phone'];
                                document.getElementById('checkout-companyy').value = ship['ship_company'];
                                document.getElementById('checkout-address11').value = ship['ship_address1'];
                                document.getElementById('checkout-zipp').value = ship['ship_zip'];
                                document.getElementById('checkout-cityy').value = ship['ship_city'];
                                document.getElementById('billing-countryy').value = ship['ship_country'];

                                $('#shipp_name').html(ship['ship_first_name']+ ' '+ ship['ship_last_name']);
                                $('#shipp_add').html(ship['ship_address1']);
                                $('#shipp_ph').html(ship['ship_phone']);
                                $('#billl_name').html(ship['ship_first_name']+ ' '+ ship['ship_last_name']);
                                $('#bill_add').html(ship['ship_address1']);
                                $('#bill_ph').html(ship['ship_phone']);

                            }
                            document.getElementById('edit-shipping').style.display = "block";
                            const element = document.getElementById("payment_step");
                            element.scrollIntoView();
                        }else{
                            alert('Some thing went wrong');
                            exit();
                        }
                        

                        
                    }
                }
                    
            });

        });

        // back to billing
        
        $("#back_to_shipping").click(function(){
                
            document.getElementById('payment_page_info').style.display = 'none';

                        var bill = null;
                        if(document.getElementById('logged-in-billing')){
                            var bill = document.getElementById('same_addressb').checked;
                        }else if(document.getElementById('billing_page_info')){
                            var bill = document.getElementById('same_address').checked;
                        }
                        
                        
                        if(bill){
                            $('#payment_step').removeClass('active');
                            $('#shipping_step').removeClass('active');
                            $('#payment_step').css('cursor','none');
                            $('#shipping_step').css('cursor','none');
                            // $('#shipping_step').css('background','#f3f5f6');
                            // $('#payment_step').css('background','#f3f5f6');

                            if(document.getElementById('logged-in-billing')){
                                document.getElementById('logged-in-billing').style.display = 'block';
                                $('#billing_step').addClass('active');
                                // $('#billing_step').css('background','white');
                                const element = document.getElementById("billing_step");
                                element.scrollIntoView();
                            }else if(document.getElementById('billing_page_info')){
                                document.getElementById('billing_page_info').style.display = 'block';
                                $('#billing_step').addClass('active');
                                // $('#billing_step').css('background','white');
                                const element = document.getElementById("billing_step");
                                element.scrollIntoView();
                            }
                            
                            
                        }else{
                            console.log(bill);
                            console.log('jjjjjjjhj');

                            document.getElementById('shipping_page_info').style.display = 'block';
                        // document.getElementById('billing_page_info').style.display = 'block';
                            $('#payment_step').removeClass('active');
                            $('#shipping_step').addClass('active');
                            // $('#shipping_step').css('background','white');
                            // $('#payment_step').css('background','#f3f5f6');
                            
                            
                            const element = document.getElementById("shipping_step");
                            element.scrollIntoView();
                        }
                        
        });
        $("#back_to_billing").click(function(){
                

                document.getElementById('shipping_page_info').style.display = 'none';
                if(document.getElementById('billing_page_info') != null){
                    document.getElementById('billing_page_info').style.display = 'block';
                }else if(document.getElementById('logged-in-billing') != null){
                    document.getElementById('logged-in-billing').style.display = 'block';
                }
                var aa = sessionStorage.getItem("ischecked");
                
                if(document.getElementById('logged-in-billing')){
                            document.getElementById('same_addressb').checked = !document.getElementById('same_addressb').checked;
                        }else if(document.getElementById('billing_page_info')){
                            document.getElementById('same_address').checked = !document.getElementById('same_address').checked;
                        }
                        console.log("BILINNG============",aa);
                        if(aa == "yes"){
                            document.getElementById('same_address').checked = true;
                            document.getElementById('same_addressb').checked = true;
                        }else if(aa == "no"){
                            document.getElementById('same_address').checked = false;
                            document.getElementById('same_addressb').checked = false; 
                        }
                
                $('#shipping_step').removeClass('active');
                $('#billing_step').addClass('active');
                // $('#billing_step').css('background','white');
                // $('#shipping_step').css('background','#f3f5f6');
                
                const element = document.getElementById("billing_step");
                element.scrollIntoView();

        });



        $("#go_to_payment_page").click(function(){
                var ship_first_name = document.getElementById('checkout-fnn').value;
                var ship_last_name = document.getElementById('checkout-lnn').value;
                var ship_email = document.getElementById('checkout-emaill').value;
                var ship_phone = document.getElementById('checkout-phonee').value;
                var ship_company = document.getElementById('checkout-companyy').value;
                var ship_address1 = document.getElementById('checkout-address11').value;
                
                var ship_zip = document.getElementById('checkout-zipp').value;
                var ship_city = document.getElementById('checkout-cityy').value;
                var ship_country = document.getElementById('billing-countryy').value;
                
                document.getElementById('s_f_name').style.display = "none";
                document.getElementById('s_f_email').style.display = "none";
                document.getElementById('s_f_phone').style.display = "none";
                document.getElementById('s_f_address').style.display = "none";
                document.getElementById('s_f_zip').style.display = "none";
                document.getElementById('s_f_country').style.display = "none";

                if(!ship_first_name){  
                    document.getElementById('s_f_name').style.display = "block";
                    const element = document.getElementById("checkout-fnn");
                        element.scrollIntoView();
                    exit();
                }
                if(!ship_email){  
                    document.getElementById('s_f_email').style.display = "block";
                    const element = document.getElementById("checkout-email");
                        element.scrollIntoView();
                    exit();
                }
                if(!ship_phone){  
                    document.getElementById('s_f_phone').style.display = "block";
                    const element = document.getElementById("checkout-phonee");
                        element.scrollIntoView();
                    exit();
                }
                if(!ship_address1){
                    document.getElementById('s_f_address').style.display = "block";
                    const element = document.getElementById("checkout-address11");
                        element.scrollIntoView();
                    exit();
                }
                if(!ship_zip){
                    document.getElementById('s_f_zip').style.display = "block";
                    const element = document.getElementById("checkout-zipp");
                        element.scrollIntoView();
                    exit();
                }
                if(ship_country == "Choose Country"){
                    document.getElementById('s_f_country').style.display = "block";
                    const element = document.getElementById("billing_countryy");
                        element.scrollIntoView();
                    exit();
                }


            $.ajax({
                url : "{{route('front.checkout.shipping.store')}}",
                type: "json",
                method: "post",
                data : {
                    "_token": "{{ csrf_token() }}",
                    ship_first_name : ship_first_name,
                    ship_last_name : ship_last_name,
                    ship_email : ship_email,
                    ship_phone : ship_phone,
                    ship_company : ship_company,
                    ship_address1 : ship_address1,
                    ship_zip : ship_zip,
                    ship_city : ship_city,
                    ship_country : ship_country,
                    // same_ship_address: same_ship_address
                },
                success: function(data){
                    
                        if(document.getElementById('billing_page_info')){
                            document.getElementById('billing_page_info').style.display = 'none';
                        }else if(document.getElementById('logged-in-billing')){
                            document.getElementById('logged-in-billing').style.display = 'none';
                        }
                        if(data.bill && data.ship){
                            var ship = data.ship;
                            var bill = data.bill;
                            $('#shipp_name').html(ship['ship_first_name']+ ' '+ ship['ship_last_name']);
                                $('#shipp_add').html(ship['ship_address1']);
                                $('#shipp_ph').html(ship['ship_phone']);
                                $('#billl_name').html(bill['bill_first_name']+ ' '+ bill['bill_last_name']);
                                $('#bill_add').html(bill['bill_address1']);
                                $('#bill_ph').html(bill['bill_phone']);
                        }
                        document.getElementById('shipping_page_info').style.display = 'none';
                        document.getElementById('payment_page_info').style.display = 'block';

                        $('#billing_step').removeClass('active');
                        $('#shipping_step').removeClass('active');
                        // $('#shipping_step').css('background','#f3f5f6');
                        $('#payment_step').addClass('active');
                        const element = document.getElementById("payment_step");
                        element.scrollIntoView();

                        
                    
                }
                    
            });

        });


        // FOR Logged In User
        $("#login-checkout-button").click(function(){
            var email = document.getElementById('login-checkout-email').value;
            var password = document.getElementById('login-checkout-password').value;
            document.getElementById('log_email').style.display = "none";
            document.getElementById('log_password').style.display = "none";

            if(!email){
                document.getElementById('log_email').style.display = "block";
                exit();
            }
            if(!password){
                document.getElementById('log_password').style.display = "block";
                exit();
            }

            $.ajax({
                url : "{{route('user.login.checkout.submit')}}",
                type: "json",
                method: "post",
                data : {
                    "_token": "{{ csrf_token() }}",
                    login_email : email,
                    login_password : password,
                    
                    // same_ship_address: same_ship_address
                },
                success: function(data){
                    if(data != "false"){
                        $('#checkout-fnb').val(data.first_name);
                        $('#checkout-lnb').val(data.last_name);
                        $('#checkout_email_billingb').val(data.email);
                        $('#checkout-phoneb').val(data.phone);
                        $('#checkout-companyb').val(data.bill_company);
                        $('#checkout-address1b').val(data.bill_address1);
                        $('#checkout-zipb').val(data.bill_zip);
                        $('#checkout-cityb').val(data.bill_city);
                        $('#billing-countryb').val(data.bill_country);
                    
                        document.getElementById('login_reg_guest').style.display = 'none';
                        document.getElementById('logged-in-billing').style.display = 'block';
                    }else{
                        alertify.set('notifier', 'position', 'top-right', 'delay', 80);
                        alertify.error('please use correct credentials');
                        exit();
                    }
                    


                        

                        
                    
                }
                    
            });

        });


        $("#go_to_shippp_payement").click(function(){
                var bill_first_name = document.getElementById('checkout-fnb').value;
                var bill_last_name = document.getElementById('checkout-lnb').value;
                var bill_email = document.getElementById('checkout_email_billingb').value;
                var bill_phone = document.getElementById('checkout-phoneb').value;
                var bill_company = document.getElementById('checkout-companyb').value;
                var bill_address1 = document.getElementById('checkout-address1b').value;
                
                var bill_zip = document.getElementById('checkout-zipb').value;
                var bill_city = document.getElementById('checkout-cityb').value;
                var bill_country = document.getElementById('billing-countryb').value;
                var same_ship_address = document.getElementById('same_addressb').checked;

                document.getElementById('b_f_l_name').style.display = "none";
                document.getElementById('b_f_l_email').style.display = "none";
                document.getElementById('b_f_l_phone').style.display = "none";
                document.getElementById('b_f_l_address').style.display = "none";
                document.getElementById('b_f_l_zip').style.display = "none";
                document.getElementById('b_f_l_country').style.display = "none";

                if(!bill_first_name){  
                    document.getElementById('b_f_l_name').style.display = "block";
                    const element = document.getElementById("checkout-fnb");
                        element.scrollIntoView();
                    exit();
                }
                if(!bill_email){  
                    document.getElementById('b_f_l_email').style.display = "block";
                    const element = document.getElementById("checkout_email_billingb");
                        element.scrollIntoView();
                    exit();
                }
                if(!bill_phone){  
                    document.getElementById('b_f_l_phone').style.display = "block";
                    const element = document.getElementById("checkout-phoneb");
                        element.scrollIntoView();
                    exit();
                }
                if(!bill_address1){
                    document.getElementById('b_f_l_address').style.display = "block";
                    const element = document.getElementById("checkout-address1b");
                        element.scrollIntoView();
                    exit();
                }
                if(!bill_zip){
                    document.getElementById('b_f_l_zip').style.display = "block";
                    const element = document.getElementById("checkout-zipb");
                        element.scrollIntoView();
                    exit();
                }
                if(bill_country == "Choose Country"){
                    document.getElementById('b_f_l_country').style.display = "block";
                    const element = document.getElementById("billing-countryb");
                        element.scrollIntoView();
                    exit();
                }



            $.ajax({
                url : "{{ route('front.checkout.store') }}",
                type: "json",
                method: "post",
                data : {
                    "_token": "{{ csrf_token() }}",
                    bill_first_name : bill_first_name,
                    bill_last_name : bill_last_name,
                    bill_email : bill_email,
                    bill_phone : bill_phone,
                    bill_company : bill_company,
                    bill_address1 : bill_address1,
                    bill_zip : bill_zip,
                    bill_city : bill_city,
                    bill_country : bill_country,
                    same_ship_address: same_ship_address
                },
                success: function(data){
                    if(data.shipping_add == "false"){
                        document.getElementById('logged-in-billing').style.display = 'none';
                        $('#billing_step').removeClass('active');
                        $('#shipping_step').addClass('active');
                        if(data.bill){
                                var bill = data.bill;
                                if(bill.ship_same_address == "true"){
                                    document.getElementById('edit-shipping').style.display = "block";
                                }else{
                                    document.getElementById('edit-shipping').style.display = "none";
                                }
                            }
                        document.getElementById('shipping_page_info').style.display = 'block';
                        const element = document.getElementById("shipping_step");
                        element.scrollIntoView();
                        
                    }else{
                        document.getElementById('logged-in-billing').style.display = 'none';
                        document.getElementById('shipping_page_info').style.display = 'none';
                        $('#billing_step').removeClass('active');
                        $('#shipping_step').removeClass('active');
                        $('#payment_step').addClass('active');
                        if(data.ship){
                                var ship = data.ship;
                                document.getElementById('checkout-fnb').value = ship['ship_first_name'];
                                document.getElementById('checkout-lnb').value = ship['ship_last_name'];
                                document.getElementById('checkout_email_billingb').value= ship['ship_email'];
                                document.getElementById('checkout-phoneb').value = ship['ship_phone'];
                                document.getElementById('checkout-companyb').value = ship['ship_company'];
                                document.getElementById('checkout-address1b').value = ship['ship_address1'];
                                document.getElementById('checkout-zipb').value = ship['ship_zip'];
                                document.getElementById('checkout-cityb').value = ship['ship_city'];
                                document.getElementById('billing-countryb').value = ship['ship_country'];

                                $('#shipp_name').html(ship['ship_first_name']+ ' '+ ship['ship_last_name']);
                                $('#shipp_add').html(ship['ship_address1']);
                                $('#shipp_ph').html(ship['ship_phone']);
                                $('#billl_name').html(ship['ship_first_name']+ ' '+ ship['ship_last_name']);
                                $('#bill_add').html(ship['ship_address1']);
                                $('#bill_ph').html(ship['ship_phone']);

                            }
                        // console.log(document.getElementById('payment_page_info'))
                        document.getElementById('edit-shipping').style.display = "block";
                        document.getElementById('payment_page_info').style.display = 'block';
                        const element = document.getElementById("payment_step");
                        element.scrollIntoView();

                        
                    }
                }
                    
            });

        });


        $("#join_now_button").click(function(){
            document.getElementById('bill_ship_payment_section').style.display = 'none';
            document.getElementById('regis_page').style.display = 'block';

        });
        $("#regis_go_back").click(function(){
            document.getElementById('regis_page').style.display = 'none';
            document.getElementById('bill_ship_payment_section').style.display = 'block';


        });

        $("#do_register").click(function(){
            var first_name = document.getElementById('reg-fn').value;
            var last_name = document.getElementById('reg-ln').value;
            var email = document.getElementById('reg-email').value;
            var bill_address1 = document.getElementById('reg-address1').value;
            var bill_zip = document.getElementById('reg-zip').value;
            var bill_country = document.getElementById('reg-country').value;
            var phone = document.getElementById('reg-phone').value;
            var password = document.getElementById('reg-pass').value;
            var password_confirmation = document.getElementById('reg-pass-confirm').value;

            document.getElementById('r_f_name').style.display = "none";
                document.getElementById('r_f_email').style.display = "none";
                document.getElementById('r_f_phone').style.display = "none";
                document.getElementById('r_f_address').style.display = "none";
                document.getElementById('r_f_zip').style.display = "none";
                document.getElementById('r_f_country').style.display = "none";
                document.getElementById('r_f_password').style.display = "none";
                document.getElementById('r_f_confirm').style.display = "none";
                document.getElementById('r_f_not_match').style.display = "none";

                if(!first_name){  
                    document.getElementById('r_f_name').style.display = "block";
                    const element = document.getElementById("reg-fn");
                        element.scrollIntoView();
                    exit();
                }
                if(!email){  
                    document.getElementById('r_f_email').style.display = "block";
                    document.getElementById('r_f_email').innerHTML = 'Email is required';
                    const element = document.getElementById("reg-email");
                        element.scrollIntoView();
                    exit();
                }
                if(!phone){  
                    document.getElementById('r_f_phone').style.display = "block";
                    const element = document.getElementById("reg-phone");
                        element.scrollIntoView();
                    exit();
                }
                if(!password){
                    document.getElementById('r_f_password').style.display = "block";
                    const element = document.getElementById("reg-pass");
                        element.scrollIntoView();
                    exit();
                }
                if(!password_confirmation){
                    document.getElementById('r_f_confirm').style.display = "block";
                    const element = document.getElementById("reg-pass-confirm");
                        element.scrollIntoView();
                    exit();
                }
                if(password != password_confirmation){
                    document.getElementById('r_f_confirm').style.display = "none";
                    document.getElementById('r_f_not_match').style.display = "block";
                    const element = document.getElementById("reg-pass-confirm");
                        element.scrollIntoView();
                    exit();
                }
                if(!bill_address1){
                    document.getElementById('r_f_address').style.display = "block";
                    const element = document.getElementById("reg-address1");
                        element.scrollIntoView();
                    exit();
                }
                if(!bill_zip){
                    document.getElementById('r_f_zip').style.display = "block";
                    const element = document.getElementById("reg-zip");
                        element.scrollIntoView();
                    exit();
                }
                if(bill_country == "Choose Country"){
                    document.getElementById('r_f_country').style.display = "block";
                    const element = document.getElementById("reg-country");
                        element.scrollIntoView();
                    exit();
                }
            
                
               

            $.ajax({
                url: "{{route('user.register.submit.ajax')}}",
                type: "json",
                method: "post",
                data : {
                    "_token": "{{ csrf_token() }}",
                    first_name : first_name,
                    last_name : last_name,
                    email : email,
                    phone : phone,
                    bill_country : bill_country,
                    bill_address1 : bill_address1,
                    bill_zip : bill_zip,
                    password : password,
                    password_confirmation : password_confirmation
                   
                   
                },
                success: function(data){
                    if(data == 'exist'){
                        document.getElementById('r_f_email').style.display = "block";
                        document.getElementById('r_f_email').innerHTML = 'Email already exists';
                        const element = document.getElementById("reg-email");
                            element.scrollIntoView();
                        exit();
                    }
                    if(data){
                        document.getElementById('regis_page').style.display = 'none';
                        document.getElementById('login_reg_guest').style.display = 'none';

                        

                        $('#checkout-fnb').val(data.first_name);
                        $('#checkout-lnb').val(data.last_name);
                        $('#checkout_email_billingb').val(data.email);
                        $('#checkout-phoneb').val(data.phone);
                        $('#checkout-companyb').val(data.bill_company);
                        $('#checkout-address1b').val(data.bill_address1);
                        $('#checkout-zipb').val(data.bill_zip);
                        $('#checkout-cityb').val(data.bill_city);
                        $('#billing-countryb').val(data.bill_country);
                        document.getElementById('bill_ship_payment_section').style.display = 'block';
                        document.getElementById('logged-in-billing').style.display = 'block';
                    }else if(data == 'false'){
                        alertify.set('notifier', 'position', 'top-right', 'delay', 80);
                        alertify.error('Something went wrong');
                    }
                    

                    
                }
            });


        });

        $("#edit-shipping").click(function(){
            document.getElementById('payment_page_info').style.display = 'none';
            document.getElementById('shipping_page_info').style.display = 'block';
            $('#payment_step').removeClass('active');
            // $('#payment_step').css('background','#f3f5f6');
            $('#shipping_step').addClass('active');
            // $('#shipping_step').css('background','white');

        });
        
        
    </script>
@endsection
