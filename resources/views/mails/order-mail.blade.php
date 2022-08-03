<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>
<style>
    .price-list{
        font-size: 15px;
        font-weight: 500;
    }
</style>
<body>
    <p>Hi {{ $order->firstname }} {{ $order->lastname }}</p>
    <p>Your order has been successfully placed</p>
    <br>

    <table class="table" style="width:600px ; text-align:right;">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $orderItem )
                <tr>
                    <td><img src="{{ asset("storage/product/".$orderItem->product->image) }}" width="100" alt=""></td>
                    <td>{{ $orderItem->product->name }}</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>${{ $orderItem->price * $orderItem->quantity}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="border-top: 1px solid #ccc;"></td>
                <td class="price-list" style="border-top: 1px solid #ccc;">SubTotal : ${{ $order->subtotal }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="price-list">Tax : ${{ $order->tax }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="price-list">Shipping : Free Shipping</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="price-list">Total : ${{ $order->total }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>