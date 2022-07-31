<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{

    public function store(Request $request)
    {
        return $request;
        request()->validate([
            "code" => ["required","unique:coupons,code"],
            "type" => ["required"],
            "value" => ["required","numeric"],
            "cart_value" => ["required","numeric"],
        ]);

        $coupons = new Coupon();
        $coupons->code = $request->code;
        $coupons->type = $request->type;
        $coupons->value = $request->value;
        $coupons->cart_value = $request->cart_value;
        $coupons->expiry_date = $request->date;
        $coupons->save();
        return to_route("admin.coupons");
    }

    public function update(Coupon $coupon, Request $request)
    {
        request()->validate([
            "code" => ["required","unique:coupons,code"],
            "type" => ["required"],
            "value" => ["required","numeric"],
            "cart_value" => ["required","numeric"],
        ]);

        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->date;
        $coupon->update();
        return to_route("admin.coupons");
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back();
    }
}
