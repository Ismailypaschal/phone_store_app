<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Thank you for your order!</h2>
    <p>Hi {{ $order->first_name }},</p>
    <p>Your order (ID: {{ $order->id }}) has been received and is being processed.</p>
    <p><strong>Order Details:</strong></p>
    <ul>
        <li>Total: ${{ number_format($order->total_price, 2) }}</li>
        <li>Shipping Address: {{ $order->shipping_address }}</li>
        <li>Order Date: {{ $order->created_at->format('F j, Y, g:i a') }}</li>
    </ul>
    <p>We appreciate your business!</p>
</body>
</html>
