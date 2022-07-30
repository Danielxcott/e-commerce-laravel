<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','min:3'],
            'slug' => ['required','min:3'],
            'description' => "required",
            "regular_price" => ["required","min:1"],
            "sale_price" => "nullable",
            "sku" => "required",
            "stock" => "required",
            "feature" => "required",
            "category" => ["required",Rule::exists("categories","id")],
            "quantity" => "required",
            "image" => 'mimes:jpg,bmp,png',
        ]);
        $file = $request->file('image');
        $newName = uniqid().".".$file->getClientOriginalExtension();
        $file->storeAs("public/product",$newName);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->description = $request->description;
        $product->excerpt = Str::words($request->description,100);
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->sku;
        $product->stock_status = $request->stock;
        $product->featured = $request->feature;
        $product->quantity = $request->quantity;
        $product->image = $newName;
        $product->category_id = $request->category; 
        $product->save();
        return to_route("admin.products");
    }
}
