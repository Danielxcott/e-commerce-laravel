<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function store(Request $request)
    {
        request()->validate([
            "name" => "required",
            "slug" => "required",
        ]);
        if($request->category_id)
        {
            $subcategory = new SubCategory();
            $subcategory->name = $request->name;
            $subcategory->slug = $request->slug;
            $subcategory->category_id = $request->category_id;
            $subcategory->save();
        }else{
            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->slug);
            $category->save();
        }
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

    public function subcategoryUpdate(SubCategory $subCategory, Request $request)
    {
        request()->validate([
            "name" => "required|string|".Rule::unique("sub_categories","name")->ignore($subCategory->id),
            "slug" => "required|string|".Rule::unique("sub_categories","slug")->ignore($subCategory->id),
        ]);
        $subCategory->name = $request->name;
        $subCategory->slug = $request->slug;
        $subCategory->category_id = $request->category_id;
        $subCategory->update();
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

    public function subCategoryDestroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return back();
    }
}
