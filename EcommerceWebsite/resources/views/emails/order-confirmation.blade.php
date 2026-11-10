<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #0a0a0a; color: #eee; margin: 0; padding: 30px; }
        .box { max-width: 560px; margin: auto; background: #111; border: 1px solid #222; padding: 40px; }
        .brand { font-size: 24px; font-weight: 700; letter-spacing: 2px; margin-bottom: 24px; }
        .brand span { color: #c9a86c; font-weight: 400; }
        h1 { font-size: 22px; margin: 0 0 8px; }
        p { color: #aaa; font-size: 14px; line-height: 1.7; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 10px 0; font-size: 13px; border-bottom: 1px solid #222; color: #ccc; }
        .total td { color: #fff; font-weight: 700; border-bottom: none; padding-top: 14px; }
        .meta { font-size: 13px; color: #888; margin-top: 24px; }
    </style>
</head>
<body>
    <div class="box">
        <div class="brand">WASA<span>AZ</span></div>
        <h1>Thank you, {{ $order->first_name }}!</h1>
        <p>Your order #{{ $order->id }} has been placed successfully. We'll notify you when it ships.</p>

        <table>
            @foreach($order->products as $product)
            <tr>
                <td>{{ $product->name }} × {{ $product->pivot->quantity }}</td>
                <td style="text-align:right">Rs. {{ number_format($product->pivot->price * $product->pivot->quantity) }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td>Total ({{ strtoupper($order->payment_method) }})</td>
                <td style="text-align:right">Rs. {{ number_format($order->total) }}</td>
            </tr>
        </table>

        <p class="meta">
            Delivering to: {{ $order->address }}, {{ $order->city }}, {{ $order->country }}<br>
            Questions? Reply to this email or contact hello@wasaaz.com
        </p>
    </div>
</body>
</html>
