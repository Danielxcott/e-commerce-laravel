<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ShopComponent extends Component
{
    public $sorting;
    public $pagesize;

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
    }

    public function render()
    {
        if($this->sorting == "date")
        {
            $products = Product::orderBy('created_at','DESC')->paginate($this->pagesize);
        }else if($this->sorting == "price")
        {
            $products = Product::orderBy('regular_price','ASC')->paginate($this->pagesize);
        }else if($this->sorting == "price-desc")
        {
            $products = Product::orderBy('regular_price','DESC')->paginate($this->pagesize);
        }else{
            $products = Product::paginate($this->pagesize);
        }

        $categories = Category::all();

        // $products = Product::paginate(12);
        return view('livewire.shop-component',[
            'products' => $products,
            "categories" => $categories,
        ])->layout("layouts.base");
    }
}
