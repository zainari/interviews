<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success | Royale Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }
        .success-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 600px;
            width: 90%;
        }
        h1 {
            color: #28a745;
            font-size: 48px;
            margin-bottom: 10px;
        }
        p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .order-details {
            text-align: left;
            margin-top: 20px;
        }
        .order-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-details td {
            padding: 8px 0;
        }
        .btn-home {
            display: inline-block;
            margin-top: 25px;
            background: #007bff;
            color: #fff;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }
        .btn-home:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>🎉 Thank You!</h1>
        <p>Your order has been placed successfully.</p>
        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
        <p><strong>Customer:</strong> {{ $order->user->name ?? $order->contact_info['first_name'] ?? '' }}</p>

        <div class="order-details">
            <h3>Order Summary</h3>
            <table>
                @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }} × Rs {{ number_format($product->pivot->price, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td><strong>Total:</strong></td>
                    <td><strong>Rs {{ number_format($order->total, 2) }}</strong></td>
                </tr>
            </table>
        </div>

        <a href="{{ url('/') }}" class="btn-home">Go to Homepage</a>
    </div>
</body>
</html>
