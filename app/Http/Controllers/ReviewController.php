<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        request()->validate([
            "rating" => "required",
            "comment" => "required"
        ]);
        $review = new Review();
        $orderItem = OrderItem::find($request->id);
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $orderItem->rstatus = true;
        $review->order_items_id = $request->id;
        $review->save();
        $orderItem->save();
        return back();
    }
}
