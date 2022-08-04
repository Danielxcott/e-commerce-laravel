<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryComponent extends Component
{
    public $category;
    public function mount($category)
    {
        return $this->category = $category;
    }
    public function render()
    {
        $category = Category::where("slug",$this->category)->first();
        $categories = Category::all();
        return view('livewire.category-component',[
            "category" => $category,
            "categories" => $categories,
        ])->layout("layouts.base");
    }
}
