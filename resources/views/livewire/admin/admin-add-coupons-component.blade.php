<div class="container" style="padding: 30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="pannel pannel-default">
                <div class="pannel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Add New Coupon
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route("admin.coupons") }}" class="btn btn-success pull-right">All Coupons</a>
                        </div>
                    </div>
                </div>
                <div class="pannel-body" style="margin-top:20px;">
                    <form action="{{ route("admin.storeCoupon") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="code">Coupon Code</label>
                            <input type="text" class="form-control" name="code" id="code">
                        </div>
                        <div class="form-group">
                            <label for="type">Coupon Type</label>
                            <select name="type" id="type" class="custom-control form-control">
                                <option selected disabled>Select coupon types</option>
                                <option value="fixed">Fixed</option>
                                <option value="percent">Percent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="value">Coupon Value</label>
                            <input type="text" class="form-control" name="value" id="value">
                        </div>
                        <div class="form-group">
                            <label for="cart-value">Cart Value</label>
                            <input type="text" class="form-control" name="cart_value" id="cart-value">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>