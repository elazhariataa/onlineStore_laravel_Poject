<!DOCTYPE html>
<html>
<head>
    <title>facture de commande - OnlineShop.com</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>Order ID: {{ $order->id }} for MR. {{$user->username}}</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua.</p>
    
    <h2>Order details</h2>
    <table class="table table-bordered">
        <thead>
           <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr> 
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
                @php
                    $total += $item->quantity * $item->price;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Total:</td>
                <td>{{ $total }}</td>
            </tr>
        </tfoot>
        
    </table>
  
</body>
</html>