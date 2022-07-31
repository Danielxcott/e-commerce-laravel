<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{   
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;

    public function calculateDiscount ()
    {
       if(session()->has("coupon"))
       {
            if(session()->get('coupon')['type'] === "fixed")
            {
                $this->discount = session()->get('coupon')['value'];
            }else
            {
                $this->discount = (Cart::instance("cart")->subtotal() * session()->get('coupon')['value']/100);
            }
            $this->subtotalAfterDiscount = Cart::instance("cart")->subtotal() - $this->discount;
            $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax'))/100;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        
       }
    }

    public function setAmountForCheck()
    {
        if(session()->has('coupon'))
        {
            session()->put('checkout',[
                'discount'=> $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount,
            ]);
        }else
        {
            session()->put('checkout',[
                'discount'=> 0,
                'subtotal' =>Cart::instance("cart")->subtotal(),
                'tax' => Cart::instance("cart")->tax(),
                'total' => Cart::instance("cart")->total(),
            ]);
        }
    }

    public function render()
    {

        if(session()->has('coupon'))
        {
            if(Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value'])
            {
                session()->forget('coupon');
            }else
            {
                $this->calculateDiscount();
            }
        }

        $this->setAmountForCheck();

        return view('livewire.cart-component')->layout("layouts.base");
    }
}
