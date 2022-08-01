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
                                <th colspan="2" class="text-center">Action</th>
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
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                                                Status <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                   <form action="{{ route("admin.updateOrder",$order->id) }}" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <input type="hidden" name="status" value="delivered">
                                                    <button class="btn btn-link">Delivered</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route("admin.updateOrder",$order->id) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="status" value="canceled">
                                                        <button class="btn btn-link text-decoration-none">Canceled</button>
                                                        </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route("admin.orderdetail",$order->id) }}" class="btn btn-sm btn-warning">Detail</a>
                                        <form class="del-btn" action="{{ route("admin.orderDelete",$order->id) }}" method="post">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-sm btn-danger">del</button>
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
