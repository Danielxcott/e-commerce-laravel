<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class AdminEditProductComponent extends Component
{
    public $product;
    public function mount($product)
    {
        $this->product = $product;
    }
    public function render()
    {
        $categories = Category::all();
        $product = Product::where("slug",$this->product);
        return view('livewire.admin.admin-edit-product-component',[
            "categories" => $categories,
            "products" => $product,
        ])->layout("layouts.base");
    }
}
