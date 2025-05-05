<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Notification</title>
</head>

<body>
    <h1>Hi {{ $user->full_name }},</h1>
    <p class="font-bold">{{ $ticket }}</p>

    <h3>Order Details:</h3>
    <ul>
        <li>Order ID: {{ $order->id }}</li>
        <li>Menu Items:</li>
        <ul>
            @foreach ($order->menu_items as $item)
                <li>{{ $item->name }} - {{ $item->price }}</li>
            @endforeach
        </ul>
        <li>Total: {{ $order->total_price }}</li>
        <li>Status: {{ $order->status }}</li>
        <li>Payment Method: {{ $order->payment_method }}</li>
    </ul>

    <p>Thank you for shopping with us!</p>
</body>

</html>
