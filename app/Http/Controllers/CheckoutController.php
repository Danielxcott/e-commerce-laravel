<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;

class CheckoutController extends Controller
{

    public function store(Request $request)
    {
        // request()->validate([
        //     'fname' => "required",
        //     "lname" =>  "required",
        //     "email" =>  "required|email:rfc,dns",
        //     "phone" =>  "required|regex:/(01)[0-9]{9}/",
        //     "line1" =>  "required",
        //     "line2" =>  "required",
        //     "add" =>  "required",
        //     "country" =>  "required",
        //     "province" =>  "required",
        //     "zipcode" =>  "required",
        //     "city" =>  "required",
        //     "payment_method" ="required",
        // ]);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->subtotal = session()->get("checkout")['subtotal'];
        $order->discount = session()->get("checkout")['discount'];
        $order->tax = session()->get("checkout")['tax'];
        $order->total = session()->get("checkout")['total'];
        $order->firstname = $request->fname;
        $order->lastname =  $request->lname;
        $order->email =  $request->email;
        $order->mobile =  $request->phone;
        $order->line1 =  $request->line1;
        $order->line2 =  $request->line2;
        $order->country =  $request->country;
        $order->province =  $request->province;
        $order->zipcode =  $request->zipcode;
        $order->city =  $request->city;
        $order->status = "ordered";
        $order->is_shipping_different = $request->ship_different == "check" ? 1 : 0;
        $order->save();
        
        foreach(Cart::instance("cart")->content() as $item){
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();
        }

        if($request->ship_different == "check")
        {
            $shipping = new Shipping();
            $shipping->order_id = $order->id;
            $shipping->firstname = $request->s_fname;
            $shipping->lastname =  $request->s_lname;
            $shipping->email =  $request->s_email;
            $shipping->mobile =  $request->s_phone;
            $shipping->line1 =  $request->s_line1;
            $shipping->line2 =  $request->s_line2;
            $shipping->country =  $request->s_country;
            $shipping->province =  $request->s_province;
            $shipping->zipcode =  $request->s_zipcode;
            $shipping->city =  $request->s_city;
            $shipping->save();
        }

        if($request->payment_method == "cod"){
            $this->transactionMaker($order->id,'pending','cod');
        }else if($request->payment_method == "card")
        {
            request()->validate([
                'card_num' => "required|numeric",
                'expiry_month' => "required|numeric",
                'expiry_year' => "required|numeric",
                'cvc' => "required|numeric",
            ]);
            $stripe = Stripe::make(env('STRIPE_KEY'));

            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                        "number" => $request->card_num,
                        "exp_month" => $request->expiry_month,
                        "exp_year" => $request->expiry_year,
                        "cvc" => $request->cvc,
                    ]
                    ]);
                 if(!isset($token['id']))
                 {
                    session()->flash("strip_error","The stripe token was not generated correctly.");
                    return back();
                 }   

                 $customer = $stripe->customers()->create([
                    "name" => $request->fname." ".$request->lname,
                    "email" => $request->email,
                    "phone" => $request->mobile,
                    "address" => [
                        "line1" => $request->line1,
                        "postal_code" => $request->zipcode,
                        "city"=> $request->city,
                        "state"=> $request->province,
                        "country" => $request->country,
                    ],
                    'shipping' => [
                        "name" => $request->fname." ".$request->lname,
                        "address" => [
                            "line1" => $request->line1,
                            "postal_code" => $request->zipcode,
                            "city"=> $request->city,
                            "state"=> $request->province,
                            "country" => $request->country,
                        ],
                    ],
                    'source' => $token['id']
                ]); 
                $charge = $stripe->charges()->create([
                    "customer" => $customer['id'],
                    "currency" => "USD",
                    "amount" => session()->get("checkout")["total"],
                    "description" => "Payment for order no ".$order->id
                ]);

                if($charge['status'] == "succeeded")
                {
                    $this->transactionMaker($order->id,"approved","card");
                    Cart::instance("cart")->destroy();
                    session()->forget("checkout");
                    return redirect()->route("thankyou");
                }
                else{
                    session()->flash("stripe_error","Error in Transaction!");
                    return back();
                }
            }catch(Exception $e)
            {
                session()->flash("stripe_error",$e->getMessage());
                return back();
            }
        }


        Cart::instance("cart")->destroy();

        if(!Auth::check())
        {
            return redirect()->route("login");

        }else if(!session()->get("checkout"))
        {
           return redirect()->route("cart");

        }else
        {
            return redirect()->route("thankyou");
            Cart::instance("cart")->destroy();
            session()->forget("checkout");
        }
}
    public function transactionMaker($order_id,$status,$mode){

    $transaction = new Transaction();
    $transaction->user_id = Auth::id();
    $transaction->order_id = $order_id;
    $transaction->mode = $mode;
    $transaction->status = $status;
    $transaction->save();
    }
}
