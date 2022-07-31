<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminEditCouponsComponent extends Component
{
    public $coupon;

    public function mount($coupon)
    {
        $this->coupon = $coupon;
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-coupons-component')->layout("layouts.base");
    }
}
