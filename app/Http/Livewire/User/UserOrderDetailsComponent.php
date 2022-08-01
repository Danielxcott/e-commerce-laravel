<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserOrderDetailsComponent extends Component
{
    public $order;

    public function mount($order)
    {
        $this->order = $order;
    }

    public function render()
    {
        $order = Order::where("user_id",Auth::id())->where("id",$this->order);
        return view('livewire.user.user-order-details-component',[
            "order" => $order,
        ])->layout("layouts.base");
    }
}
