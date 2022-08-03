<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class AdminAddCategoryComponent extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-category-component',[
            "categories" => $categories,
        ])->layout("layouts.base");
    }
}
