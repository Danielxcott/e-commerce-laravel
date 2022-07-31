@php
use App\Models\Coupon;
   $coupon = Coupon::where("id",$coupon)->first()
@endphp
<div class="container" style="padding: 30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="pannel pannel-default">
                <div class="pannel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Edit Coupon
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route("admin.coupons") }}" class="btn btn-success pull-right">All Coupons</a>
                        </div>
                    </div>
                </div>
                <div class="pannel-body" style="margin-top:20px;">
                    <form action="{{ route("admin.updateCoupon",$coupon->id) }}" method="POST">
                        @csrf
                        @method("put")
                        <div class="form-group">
                            <label for="code">Coupon Code</label>
                            <input type="text" class="form-control" value="{{ $coupon->code }}" name="code" id="code">
                        </div>
                        <div class="form-group">
                            <label for="type">Coupon Type</label>
                            <select name="type" id="type" class="custom-control form-control">
                                <option selected disabled>Select coupon types</option>
                                <option value="fixed" {{ $coupon->type == 'fixed' ? "selected" : "" }}>Fixed</option>
                                <option value="percent" {{ $coupon->type == "percent" ? "selected" :"" }}>Percent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="value">Coupon Value</label>
                            <input type="text" class="form-control" value="{{ $coupon->value }}" name="value" id="value">
                        </div>
                        <div class="form-group">
                            <label for="cart-value">Cart Value</label>
                            <input type="text" value="{{ $coupon->cart_value }}" class="form-control" name="cart_value" id="cart-value">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>