<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function store(Request $request)
    {
        request()->validate([
            "name" => "required|unique|string",
            "slug" => "required|unique|string",
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->save();
        return to_route("admin.categories");
    }

    public function destroy(Category $category)
    {
        foreach($category->products as $product ){
            $product->delete();
        }
        $category->delete();

        return back();
    }
}
