<?php

namespace App\Http\Controllers\Front;

use App\{
    Models\Item,
    Models\AttributeOption,
    Models\Attribute,
    Models\CrossSellingProduct,

    Http\Controllers\Controller,
    Repositories\Front\CartRepository
};
use App\Helpers\PriceHelper;
use App\Models\ShippingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Constructor Method.
     *
     * @param  \App\Repositories\Front\CartRepository $repository
     *
     */
    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

	public function index()
	{
        if(Session::has('cart')){
            $cart = Session::get('cart');
            // dd($cart);
        }else{
            $cart = [];
        }
        $cross_sell = [];
        if(count($cart) > 0){
            foreach($cart as $c){
                $cross = CrossSellingProduct::where('parent_product', $c['id'])->get();
                if(count($cross) > 0){
                    foreach($cross as $cr){
                        $p = Item::find($cr->child_product);
                        
                        if(!empty($p) && !in_array($p->id,$cross_sell)){
                            array_push($cross_sell, $p->id);
                        }
                    }
                }
                
            }
        }
        $cross_sell_products = [];
        if(count($cross_sell) > 0){
            foreach($cross_sell as $cros){
                $pr = Item::find($cros);
                if($pr){
                    array_push($cross_sell_products, $pr);
                }
            }
        }
        // dd($cross_sell_products);
        return view('front.catalog.cart',[
            'cart' => $cart,
            'cross_sell_products' => $cross_sell_products
        ]);
    } 
    

    public function addToCart(Request $request)
    {
        // dd(isset($request->reload));
        $msg = $this->repository->store($request);
        if($request->ajax()){
            return response()->json(['message' => $msg , 'qty' => count(Session::get('cart'))]); 
        }elseif(isset($request->reload)){
            return redirect('cart')->with('success','Product Added Successfully');
        }else{
            return back()->with('success','Product Added Successfully');
        }
        
        
    }

	public function store(Request $request)
	{
        $msg = $this->repository->store($request);
        if(isset($request->addtocart)){
           Session::flash('success_message',__('Cart Added Successfully'));
           return back();
        }
        return redirect()->route('front.cart')->withSuccess($msg);
	}

    public function destroy($id,$var_id=null)
    {
        
        $cart = Session::get('cart');
        // dd($cart[$id]['qty']);

        $variant = AttributeOption::find($var_id);
        if($variant){
            $attr = Attribute::find($variant->attribute_id);
            if($attr->abbrivation =! "liter" && $attr->abbrivation =! "piece"){
                $variant->quantity = $variant->quantity + $cart[$id]['qty'];
                $variant->save();
            }
        }
       
        
        unset($cart[$id]);
        if(count($cart) > 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        Session::flash('success',__('Cart item removed successfully.'));
        return back();
    }

	public function promoStore(Request $request)
	{
        return response()->json($this->repository->promoStore($request));
	}

    public function shippingStore(Request $request)
    {
        return redirect()->route('front.checkout');
    }
	
    
    public function update($id)
    {
        return view('front.catalog.cart_form',[
            'item' => Item::findOrFail($id),
            'attributes' => Item::findOrFail($id)->attributes,
            'cart_item' => Session::get('cart')[$id],
        ]);
    }


    public function shippingCharge(Request $request)
    {   
       
        $charges = [];
        $items = [];
        foreach($request->user_id as $data){
            $check = explode('|',$data);
            $charges[] = $check[0];
            $items[] = $check[1];
        }
        $cart = Session::get('cart');
        $delivery_amount = 0;
        foreach($charges as $index => $charge){
            if($charge != 0){
                 $vendor_charge = Item::findOrFail($items[$index])->user->shipping->price;
                $delivery_amount += $vendor_charge;
                $cart[$items[$index]]['delivery_charge'] = $vendor_charge;
            }else{
                $cart[$items[$index]]['delivery_charge'] = 0;
            }
        }
            
        Session::put('cart',$cart);
    
        return response()->json(['delivery' => PriceHelper::setPrice($delivery_amount),'main' => $delivery_amount]);
        
    }


    public function headerCartLoad()
    {
        return view('includes.header_cart');
    }
    public function CartLoad()
    {
        return view('includes.cart');
    }

    public function cartClear()
    {
        Session::forget('cart');
        Session::flash('success',__('Cart cleared successfully'));
        return back();
    }

}


