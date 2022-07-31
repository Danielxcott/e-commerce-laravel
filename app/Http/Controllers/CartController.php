<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function store(Request $request)
    {
        Cart::instance('cart')->add($request->id,$request->name,1,$request->price)->associate('App\Models\Product');
        return redirect()->route('cart')->with('success_message','Item added in the cart');
    }

    public function increaseQty($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        return back();
    }

    public function decreaseQty($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        return back();
    }

    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return back();
    }

    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
        return back();
    }

    public function qtyincrease(Product $product, Request $request)
    {
        $product->quantity = $product->quantity + $request->qty;
        $product->update();
        return back();
    }

    public function qtydecrease(Product $product, Request $request)
    {
        request()->validate([
            'qty' => 'min:1'
        ]);
        if($request->qty <= 1){
            $product->quantity = 1;
            $product->update();
        }
        $product->quantity = $product->quantity - 1;
        $product->update();
        return back();
    }

    //wishlist
    public function addtowish(Request $request)
    {
        Cart::instance('wishlist')->add($request->id,$request->name,1,$request->price)->associate('App\Models\Product');
        return back();
    }

    public function removewishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem )
        {
            if($witem->id == $product_id)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                return back();
            }
        }
    }

    public function moveItemFromWishToCart($rowId)
    {
        $item = Cart::instance("wishlist")->get($rowId);
        Cart::instance("wishlist")->remove($rowId);
        Cart::instance("cart")->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        return back();
    }

    //save for later

    public function saveForLater($rowId)
    {
        $item = Cart::instance("cart")->get($rowId);
        Cart::instance("cart")->remove($rowId);
        Cart::instance("saveForLater")->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        return back();
    }

    public function moveToCart($rowId)
    {
        $item = Cart::instance("saveForLater")->get($rowId);
        Cart::instance("saveForLater")->remove($rowId);
        Cart::instance("cart")->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        return back();
    }

    public function deleteFromSaveForLater($rowId)
    {
        Cart::instance('saveForLater')->remove($rowId);
        return back();
    }

    //find Coupon code 
    public function getCoupon(Request $request)
    {
        $coupon = Coupon::where("code",$request->coupon_code)->where("expiry_date",">=",Carbon::today())->where("cart_value","<=",Cart::instance('cart')->subtotal())->first();
        if(!$coupon)
        {
            return back()->with("coupon_message","Coupon code is invalid");
        }
        session()->put('coupon',[
            'code' => $coupon->code,
            'type' =>$coupon->type,
            'value' => $coupon->value,
            'cart_value' =>$coupon->cart_value
        ]);
        return back();
    }

    //checkout 

    public function checkout()
    {
        if(Auth::check()){
            return redirect()->route('checkout');
        }else{
            return redirect()->route("login");
        }
    }

}
