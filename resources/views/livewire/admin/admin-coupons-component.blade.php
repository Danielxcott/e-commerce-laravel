<div class="container" style="padding: 30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="pannel pannel-default">
                <div class="pannel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            All Coupons
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route("admin.addCoupons") }}" class="btn btn-success pull-right">Add New Coupons</a>
                        </div>
                    </div>
                </div>
                <div class="pannel-body" style="margin-top:20px;">
                    <table class="table table-striped">
                        <head>
                            <tr>
                                <th>Id</th>
                                <th>Coupon Code</th>
                                <th>Coupon Type</th>
                                <th>Coupon Value</th>
                                <th>Cart Value</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </head>
                        <tbody>
                            @forelse ($coupons as $coupon )
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->type }}</td>
                                    @if ($coupon->type == "fixed")
                                        <td>${{ $coupon->value }}</td>
                                    @else
                                        <td>{{ $coupon->value }} %</td>
                                    @endif
                                    <td>{{ $coupon->cart_value }}</td>
                                    <td>{{ $coupon->expiry_date }}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('admin.editCoupons',["coupon"=>$coupon->id]) }}">edit</a>
                                        <form style="display: inline-block;" action="{{ route("coupon.destroy",$coupon->id) }}" method="post"> 
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger">del</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center"><h3>There is no coupon at this point!</h3></td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>