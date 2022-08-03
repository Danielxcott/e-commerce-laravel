<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function update(Category $category , Request $request)
    {
        request()->validate([
            "name" => "required|string|".Rule::unique("categories","name")->ignore($category->id),
            "slug" => "required|string|".Rule::unique("categories","slug")->ignore($category->id),
        ]);
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->update();
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
