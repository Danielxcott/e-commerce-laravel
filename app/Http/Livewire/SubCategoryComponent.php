<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;

class SubCategoryComponent extends Component
{
    public $subcategory;
    public function mount($subcategory=null)
    {
        $this->subcategory = $subcategory;
    }
    public function render()
    {
        $subcategories = SubCategory::where("slug",$this->subcategory)->first();
        $categories = Category::all();
        return view('livewire.sub-category-component',[
            "subcategories"=>$subcategories,
            "categories" => $categories,
        ])->layout("layouts.base");
    }
}
