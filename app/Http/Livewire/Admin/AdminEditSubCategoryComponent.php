<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;

class AdminEditSubCategoryComponent extends Component
{
    public $subCategory;

    public function mount($subCategory=null)
    {
        $this->subCategory = $subCategory;

    }
    
    public function render()
    {
        $subCategory = SubCategory::where("slug",$this->subCategory);
        $categories = Category::all();
        return view('livewire.admin.admin-edit-sub-category-component',[
            "categories" => $categories,
            "subCategory" => $subCategory,
        ])->layout("layouts.base");
    }
}
