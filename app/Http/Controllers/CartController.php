<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function store(Request $request)
    {
        Cart::add($request->id,$request->name,number_format($request->qty),$request->price)->associate('App\Models\Product');
        return redirect()->route('cart')->with('success_message','Item added in the cart');
    }

    public function increaseQty($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId,$qty);
        return back();
    }

    public function decreaseQty($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId,$qty);
        return back();
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return back();
    }

    public function destroyAll()
    {
        Cart::destroy();
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
}
