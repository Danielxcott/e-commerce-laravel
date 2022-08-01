<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function destroy(Order $order)
    {
        $order->delete();
        return back();
    }

    public function userOrderDestroy(Order $order)
    {
        $order->delete();
        return back();
    }

    public function updateOrderStatus(Order $order,Request $request)
    {
        $order->status = $request->status;
        if($request->status == "delivered")
        {
            $order->delivered_date = DB::raw("CURRENT_DATE");
        }else if($request->status == "canceled")
        {
            $order->canceled_date = DB::raw("CURRENT_DATE");
        }
        $order->update();
        return back();
    }

    public function orderCancelStatus(Order $order,Request $request)
    {
        $order->status = $request->status;
        if($request->status == "canceled")
        {
            $order->canceled_date = DB::raw("CURRENT_DATE");
        }
        $order->update();
        return back();
    }
}
