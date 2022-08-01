<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class AdminOrderDetailComponent extends Component
{
    public $order;
    public function mount($order)
    {
        $this->order = $order;
    }
    public function render()
    {
        $order = Order::where("order_id",$this->order);
        return view('livewire.admin.admin-order-detail-component',[
            "order" => $order,
        ])->layout("layouts.base");
    }
}
