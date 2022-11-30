<?php

namespace App\Http\Controllers\Front;

use App\{
    Models\Order,
    Models\PaymentSetting,
    Traits\StripeCheckout,
    Traits\MollieCheckout,
    Traits\PaypalCheckout,
    Traits\PaystackCheckout,
    Http\Controllers\Controller,
    Http\Requests\PaymentRequest,
    Traits\CashOnDeliveryCheckout,
    Traits\BankCheckout,
};
use App\Helpers\PriceHelper;
use App\Helpers\SmsHelper;
use App\Models\Currency;
use App\Models\Item;
use App\Models\Setting;
use App\Models\ShippingService;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mollie\Laravel\Facades\Mollie;

class CheckoutController extends Controller
{

    use StripeCheckout {
        StripeCheckout::__construct as private __stripeConstruct;
    }
    use PaypalCheckout {
        PaypalCheckout::__construct as private __paypalConstruct;
    }
    use MollieCheckout {
        MollieCheckout::__construct as private __MollieConstruct;
    }

    use BankCheckout;
    use PaystackCheckout;
    use CashOnDeliveryCheckout;

    public function __construct()
    {
        $setting = Setting::first();
        if($setting->is_guest_checkout != 1){
            $this->middleware('auth');
        }
        $this->__stripeConstruct();
        $this->__paypalConstruct();
    }


    public function checkoutPage(){
        if (!Session::has('cart')) {
            return redirect(route('front.cart'));
        }
        if(Session::get('billing_address') || Session::get('shipping_address')) {
            return redirect(route('front.checkout.payment'));
        }
        $data['user'] = Auth::user() ? Auth::user() : null;
        $cart = Session::get('cart');
        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        foreach($cart as $key => $item){

            $total += ($item['main_price'] + $item['attribute_price']) * $item['qty'];
            $cart_total = $total;
            $item = Item::findOrFail($key);
            if($item->tax){
                $total_tax += $item::taxCalculate($item);
            }
        }
        
        $shipping = [];
        if(ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->exists()){
            $shipping = ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->first();
            if($cart_total >= $shipping->minimum_price){
                $shipping = $shipping;
            }else{
                $shipping = [];
            }
        }

        if(!$shipping){
            $shipping = ShippingService::whereStatus(1)->where('id','!=',1)->first();
        }
        $discount = [];
        if(Session::has('coupon')){
            $discount = Session::get('coupon');
        }
        
        $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
        $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        $state_tax = Auth::check() && Auth::user()->state_id ? Auth::user()->state->price : 0;
        $total_amount = $grand_total + $state_tax;
 
        $data['cart'] = $cart;
        $data['cart_total'] = $cart_total;
        $data['grand_total'] = $total_amount;
        $data['discount'] = $discount;
        $data['shipping'] = $shipping;
        $data['tax'] = $total_tax;
        $data['payments'] = PaymentSetting::whereStatus(1)->get();
        return view('front.checkout.get_checkout_page',$data);
    }

	public function ship_address()
	{
        // dd('gg');
        if (!Session::has('cart')) {
            return redirect(route('front.cart'));
        }
        // if(Session::get('billing_address') || Session::get('shipping_address')) {
        //     return redirect(route('front.checkout.payment'));
        // }
        $data['user'] = Auth::user() ? Auth::user() : null;
        $cart = Session::get('cart');
        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        foreach($cart as $key => $item){
            
             $split=explode(',',$item['attribute_price']);                            
            $itemprice=($split[0].".".$split[1] );     
            $total += ($item['main_price'] +$itemprice) * $item['qty'];
            $cart_total = $total;
            $item = Item::findOrFail($key);
            if($item->tax){
                $total_tax += $item::taxCalculate($item);
            }
        }
        
        $shipping = [];
        if(ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->exists()){
            $shipping = ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->first();
            if($cart_total >= $shipping->minimum_price){
                $shipping = $shipping;
            }else{
                $shipping = [];
            }
        }

        if(!$shipping){
            $shipping = ShippingService::whereStatus(1)->where('id','!=',1)->first();
        }
        $discount = [];
        if(Session::has('coupon')){
            $discount = Session::get('coupon');
        }
        
        $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
        $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        $state_tax = Auth::check() && Auth::user()->state_id ? Auth::user()->state->price : 0;
        $total_amount = $grand_total + $state_tax;
 
        $data['cart'] = $cart;
        $data['cart_total'] = $cart_total;
        $data['grand_total'] = $total_amount;
        $data['discount'] = $discount;
        $data['shipping'] = $shipping;
        $data['tax'] = $total_tax;
        $data['payments'] = PaymentSetting::whereStatus(1)->get();
        return view('front.checkout.billing',$data);

    }



    public function billingStore(Request $request)
    {
       
        if($request->same_ship_address == "true"){
            // dd('lll');
            Session::put('billing_address',$request->all());
            
            if(PriceHelper::CheckDigital()){
                $shipping = [
                    "ship_first_name" => $request->bill_first_name,
                    "ship_last_name" => $request->bill_last_name,
                    "ship_email" => $request->bill_email,
                    "ship_phone" => $request->bill_phone,
                    "ship_company" => $request->bill_company,
                    "ship_address1" => $request->bill_address1,
                    "ship_address2" => $request->bill_address2,
                    "ship_zip" => $request->bill_zip,
                    "ship_city" => $request->bill_city,
                    "ship_country" => $request->bill_country,
                ];
            }else{
                $shipping = [
                    "ship_first_name" => $request->bill_first_name,
                    "ship_last_name" => $request->bill_last_name,
                    "ship_email" => $request->bill_email,
                    "ship_phone" => $request->bill_phone,
                ];
            }
            
            Session::put('shipping_address',$shipping);
            $response = [
                'shipping_add' => "true",
                'ship' => Session::get('shipping_address')
                // ''
            ];
            return response()->json($response);
            
        }else{
            // dd($request->all());
            Session::put('billing_address',$request->all());
            Session::forget('shipping_address');
            $response = [
                'shipping_add' => "false",
                'bill' => Session::get('billing_address')
                // ''
            ];
            return response()->json($response);
        }

        

    }


    public function shipping()
    {
        
        if(Session::has('shipping_address')){
            return redirect(route('front.checkout.payment'));
        }

        if (!Session::has('cart')) {
            return redirect(route('front.cart'));
        }
        $data['user'] = Auth::user();
        $cart = Session::get('cart');

        $total_tax = 0;
        $cart_total = 0;
        $total = 0;

        foreach($cart as $key => $item){

            $total += ($item['main_price'] + $item['attribute_price']) * $item['qty'];
            $cart_total = $total;
            $item = Item::findOrFail($key);
            if($item->tax){
                $total_tax += $item::taxCalculate($item);
            }
        }
        $shipping = [];
        if(ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->exists()){
            $shipping = ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->first();
            if($cart_total >= $shipping->minimum_price){
                $shipping = $shipping;
            }else{
                $shipping = [];
            }
        }

        if(!$shipping){
            $shipping = ShippingService::whereStatus(1)->where('id','!=',1)->first(); 
        }
        $discount = [];
        if(Session::has('coupon')){
            $discount = Session::get('coupon');
        }
        
        $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
        $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        $state_tax = Auth::check() && Auth::user()->state_id ? Auth::user()->state->price : 0;
        $grand_total = $grand_total + $state_tax;
 
        $total_amount = $grand_total;
        $data['cart'] = $cart;
        $data['cart_total'] = $cart_total;
        $data['grand_total'] = $total_amount;
        $data['discount'] = $discount;
        $data['shipping'] = $shipping;
        $data['tax'] = $total_tax;
        $data['payments'] = PaymentSetting::whereStatus(1)->get();
        // return view('front.checkout.shipping',$data);
    }

    public function shippingStore(Request $request)
    {
        // dd($request->all());
        Session::put('shipping_address',$request->all());
        // return redirect(route('front.checkout.payment'));
        $ship = Session::get('shipping_address');
        $bill = Session::get('billing_address');
        $response = [
            'ship' => $ship,
            'bill' => $bill
        ];
        return response()->json($response);
    }



    public function payment()
    {   
        if(!Session::has('billing_address')){
            return redirect(route('front.checkout.billing'));
        }

        if(!Session::has('shipping_address')){
            return redirect(route('front.checkout.shipping'));
        }
       

        if (!Session::has('cart')) {
            return redirect(route('front.cart'));
        }
        $data['user'] = Auth::user();
        $cart = Session::get('cart');

        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
 
        foreach($cart as $key => $item){

            $total += ($item['main_price'] + $item['attribute_price']) * $item['qty'];
            $cart_total = $total;
            $item = Item::findOrFail($key);
            if($item->tax){
                $total_tax += $item::taxCalculate($item);
            }
        }
        $shipping = [];
        if(ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->exists()){
            $shipping = ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->first();
            if($cart_total >= $shipping->minimum_price){
                $shipping = $shipping;
            }else{
                $shipping = [];
            }
        }

        if(!$shipping){
            $shipping = ShippingService::whereStatus(1)->where('id','!=',1)->first(); 
        }
        $discount = [];
        if(Session::has('coupon')){
            $discount = Session::get('coupon');
        }
        
        $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
        $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        $state_tax = Auth::check() && Auth::user()->state_id ? Auth::user()->state->price : 0;
        $grand_total = $grand_total + $state_tax;
 
      
        $total_amount = $grand_total;
 
        $data['cart'] = $cart;
        $data['cart_total'] = $cart_total;
        $data['grand_total'] = $total_amount;
        $data['discount'] = $discount;
        $data['shipping'] = $shipping;
        $data['tax'] = $total_tax;
        $data['payments'] = PaymentSetting::whereStatus(1)->get();
        return view('front.checkout.payment',$data);
    }

    public function stripeView(Request $request){
        // dd($request->all());
        $method = $request->payment_method;
        $state_id = $request->state_id;
        if(empty($state_id) || empty($method) ){
            Session::flash('error','Please select the state');
            return redirect()->route('front.checkout.payment');
        }
        return view('front.checkout.stripe_view',compact('method','state_id'));
    }
    
	public function checkout(PaymentRequest $request)
	{
      
        
        $input = $request->all();
        // dd($input);
        $checkout = false;
        $payment_redirect = false;
        $payment = null;
    
        if(Session::has('currency')){
            $currency = Currency::findOrFail(Session::get('currency'));
        }else{
            $currency = Currency::where('is_default',1)->first();
        }

        // use currency check
        $usd_supported = ['USD','EUR'];
        $paystack_supported = ['NGN'];
        switch ($input['payment_method']) {
           
            case 'Stripe':
                if(!in_array($currency->name,$usd_supported)){
                    Session::flash('error',__('Currency Not Supported'));
                    return redirect()->back();
                }
                $checkout = true;
                $payment = $this->stripeSubmit($input);
                // dd($payment);
            break;

            case 'Paypal':
                if(!in_array($currency->name,$usd_supported)){
                    Session::flash('error',__('Currency Not Supported'));
                    return redirect()->back();
                }
                $checkout = true;
                $payment_redirect = true;
                $payment = $this->paypalSubmit($input);
            break;


            case 'Mollie':
                if(!in_array($currency->name,$usd_supported)){
                    Session::flash('error',__('Currency Not Supported'));
                    return redirect()->back();
                }
                $checkout = true;
                $payment_redirect = true;
                $payment = $this->MollieSubmit($input);
            break;

            case 'Paystack':
                if(!in_array($currency->name,$paystack_supported)){
                    Session::flash('error',__('Currency Not Supported'));
                    return redirect()->back();
                }
                $checkout = true;
                $payment = $this->PaystackSubmit($input);

            break;
                
            case 'Bank':
                $checkout = true;
                $payment = $this->BankSubmit($input);
            break;

            case 'Cash On Delivery':
                $checkout = true;
                $payment = $this->cashOnDeliverySubmit($input);
            break;

        }

      
      
        if($checkout){
            if($payment_redirect){
                
                if($payment['status']){
                    return redirect()->away($payment['link']);
                }else{
                    Session::put('message',$payment['message']);
                    return redirect()->route('front.checkout.cancle');
                }
            }else{
                if($payment['status']){
                    return redirect()->route('front.checkout.success');
                }else{
                    Session::put('message',$payment['message']);
                    return redirect()->route('front.checkout.cancle');
                }
            }
        }else{
            return redirect()->route('front.checkout.cancle');
        }

	}

	public function paymentRedirect(Request $request)
	{
        $responseData = $request->all();
        if(Session::has('order_payment_id')){
            $payment = $this->paypalNotify($responseData);
            if($payment['status']){
                return redirect()->route('front.checkout.success');
            }else{
                Session::put('message',$payment['message']);
                return redirect()->route('front.checkout.cancle');
            }
        }else{
            return redirect()->route('front.checkout.cancle');
        }
    }

	public function mollieRedirect(Request $request)
	{
       
        $responseData = $request->all();
        
        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));
        $responseData['payment_id'] = $payment->id;
        if($payment->status == 'paid'){
            $payment = $this->mollieNotify($responseData);
            if($payment['status']){
                return redirect()->route('front.checkout.success');
            }else{
                Session::put('message',$payment['message']);
                return redirect()->route('front.checkout.cancle');
            }
        }else{
            return redirect()->route('front.checkout.cancle'); 
        }
        
    }

	public function paymentSuccess()
	{
        if(Session::has('order_id')){
            $order_id = Session::get('order_id');
            $order = Order::find($order_id);
            $cart = json_decode($order->cart, true);
            $setting = Setting::first();
            if($setting->is_twilio == 1){
                // message
                $sms = new SmsHelper();
                $user_number = $order->user->phone;
                if($user_number){
                    $sms->SendSms($user_number,"'purchase'");
                }
            }
            return view('front.checkout.success',compact('order','cart'));
        }
        return redirect()->route('front.index');

	}



	public function paymentCancle()
	{
        $message = '';
        if(Session::has('message')){
            $message = Session::get('message');
            Session::forget('message');
        }else{
            $message = __('Payment Failed!');
        }
        Session::flash('error',$message);
        return redirect()->route('front.checkout.payment');
	}

    public function stateSetUp($state_id)
	{
        
        if (!Session::has('cart')) {
            return redirect(route('front.cart'));
        }
        
        $cart = Session::get('cart');
        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        foreach($cart as $key => $item){

            $total += ($item['main_price'] + $item['attribute_price']) * $item['qty'];
            $cart_total = $total;
            $item = Item::findOrFail($key);
            if($item->tax){
                $total_tax += $item::taxCalculate($item);
            }
        }
        
        $shipping = [];
        if(ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->exists()){
            $shipping = ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->first();
            if($cart_total >= $shipping->minimum_price){
                $shipping = $shipping;
            }else{
                $shipping = [];
            }
        }

        if(!$shipping){
            $shipping = ShippingService::whereStatus(1)->where('id','!=',1)->first();
        }
        $discount = [];
        if(Session::has('coupon')){
            $discount = Session::get('coupon');
        }
        
        $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
        $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        
        $state_price = 0;
        if($state_id){
            $state = State::findOrFail($state_id);
            if($state->type == 'fixed'){
                $state_price = $state->price;
            }else{
                $state_price = ($cart_total * $state->price) / 100;
            }

        }else{
            if(Auth::check() && Auth::user()->state_id){
                $state = Auth::user()->state;
                if($state->type == 'fixed'){
                    $state_price = $state->price;
                }else{
                    $state_price = ($cart_total * $state->price) / 100;
                }
            }else{
                $state_price = 0;
            }
        }
       
        $total_amount = $grand_total + $state_price;

        $data['state_price'] = PriceHelper::setCurrencyPrice($state_price);
        $data['grand_total'] = PriceHelper::setCurrencyPrice($total_amount);

        return response()->json($data);

    }

}
