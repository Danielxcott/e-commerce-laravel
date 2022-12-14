<style>
    nav svg{
        height: 20px;
    }
    nav .hidden{
        display: block !important;
    }
    .del-btn{
        display: inline-block;
    }
</style>
<div class="container" style="padding:30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="pannel pannel-default">
                <div class="pannel-heading">
                    <h3>All Orders</h3>
                </div>
                <div class="pannel-body">
                    <table class="table table-strip">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Zipcode</th>
                                <th>Status</th>
                                <th>Order Id</th>
                                <th>Subtotal</th>
                                <th>Discount</th>
                                <th>Tax</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order )
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $order->firstname }}</td>
                                    <td>{{ $order->lastname }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->mobile }}</td>
                                    <td>{{ $order->zipcode }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>${{ $order->subtotal }}</td>
                                    <td>${{ $order->discount }}</td>
                                    <td>${{ $order->tax }}</td>
                                    <td>${{ $order->total }}</td>
                                    <td>{{ $order->created_at->format("d M Y") }}</td>
                                    <td>
                                        <a href="{{ route('user.ordersDetail',$order->id) }}" class="btn btn-warning">Detail</a>
                                        <form class="del-btn" action="{{ route("user.orderDelete",$order->id) }}" method="post">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-danger">Del</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $orders->links() }}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
