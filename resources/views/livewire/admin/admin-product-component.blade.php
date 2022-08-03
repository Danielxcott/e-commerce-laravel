<style>
    nav svg{
        height: 20px;
    }
    nav .hidden{
        display: block !important;
    }
</style>
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pannel pannel-default">
                    <div class="pannel-heading">
                        <h3>All Products</h3>
                    </div>
                    <div class="pannel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Sale Price</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product )
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><img src="{{ asset('assets/images/products/'.$product->image) }}" alt="" width="50px"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->stock_status }}</td>
                                        <td>${{ $product->regular_price }}</td>
                                        <td>${{ $product->sale_price == 0 ? " - " : $product->sale_price}}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->created_at->format("d M Y") }}</td>
                                        <td>
                                            <a href="{{ route('admin.editProduct',['product'=>$product->slug]) }}" class="btn btn-warning">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
