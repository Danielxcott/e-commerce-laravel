<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;

class AdminEditCategoryComponent extends Component
{
    public $category;

    public function mount($category)
    {
         $this->category = $category;
    }
    public function render()
    {
        $category = Category::where("slug",$this->category);
        $categories = Category::all();
        return view('livewire.admin.admin-edit-category-component',[
            "category" => $category,
            "categories" => $categories,
        ])->layout("layouts.base");
    }
}
