<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | Wasaaz</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg: #0a0a0a;
            --card: #111111;
            --elevated: #161616;
            --border: #1f1f1f;
            --text: #ffffff;
            --muted: #888888;
            --accent: #c9a86c;
            --maroon: #7a1f2a;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            background-image: radial-gradient(circle at 50% 0%, rgba(122, 31, 42, 0.18), transparent 60%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 24px;
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }
        .success-container {
            background: var(--card);
            padding: 56px 46px;
            border-radius: 10px;
            border: 1px solid var(--border);
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            text-align: center;
            max-width: 620px;
            width: 100%;
        }
        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 34px;
        }
        .brand span { color: var(--accent); font-weight: 400; }
        .check-icon {
            width: 74px;
            height: 74px;
            margin: 0 auto 22px;
            border-radius: 50%;
            background: rgba(52, 211, 153, 0.12);
            border: 1px solid rgba(52, 211, 153, 0.35);
            color: #34d399;
            display: grid;
            place-items: center;
            font-size: 30px;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--text);
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .lead { font-size: 15px; color: var(--muted); margin-bottom: 26px; }
        .meta {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 8px;
        }
        .meta strong { color: var(--text); }
        .order-details {
            text-align: left;
            margin-top: 30px;
            border-top: 1px solid var(--border);
            padding-top: 22px;
        }
        .order-details h3 {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--accent);
            margin-bottom: 16px;
        }
        .order-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-details td {
            padding: 10px 0;
            font-size: 14px;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
        }
        .order-details tr:last-child td {
            border-bottom: none;
            color: var(--text);
            font-weight: 700;
            padding-top: 16px;
        }
        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 34px;
            background: var(--text);
            color: var(--bg);
            padding: 16px 38px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 800;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
            border: 1px solid var(--text);
            transition: all 0.35s ease;
        }
        .btn-home:hover { background: transparent; color: var(--text); }
        @media (max-width: 480px) {
            .success-container { padding: 40px 24px; }
            h1 { font-size: 26px; }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="brand">WASA<span>AZ</span></div>
        <div class="check-icon"><i class="fas fa-check"></i></div>
        <h1>Thank You!</h1>
        <p class="lead">Your order has been placed successfully. A confirmation will be sent to you shortly.</p>
        <p class="meta"><strong>Order ID:</strong> #{{ $order->id }}</p>
        <p class="meta"><strong>Customer:</strong> {{ $order->user->name ?? $order->contact_info['first_name'] ?? '' }}</p>

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

        <a href="{{ url('/') }}" class="btn-home"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
    </div>
</body>
</html>
