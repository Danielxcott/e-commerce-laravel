<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class AdminEditCategoryComponent extends Component
{
    public $category;

    public function mount($category)
    {
        return $this->category = $category;
    }
    public function render()
    {
        $category = Category::where("slug",$this->category);
        return view('livewire.admin.admin-edit-category-component',[
            "category" => $category,
        ])->layout("layouts.base");
    }
}
