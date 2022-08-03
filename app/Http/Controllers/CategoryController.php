<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function destroy(Category $category)
    {
        foreach($category->products as $product ){
            $product->delete();
        }
        $category->delete();

        return back();
    }
}
