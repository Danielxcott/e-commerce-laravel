<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
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
        Cart::instance('wishlist')->add($request->id,$request->name,1,$request->price)->associate('Product');
        return back();
    }

    public function removewishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $item )
        {
            if($item->id == $product_id)
            {
                Cart::instance('wishlist')->remove($item->rowId);
                return back();
            }
        }
    }
}
