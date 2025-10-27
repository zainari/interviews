<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Royale Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #007bff;
            --dark: #222;
            --light: #f9f9f9;
            --border: #ddd;
            --radius: 12px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding-top: 90px;
            color: var(--dark);
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
            z-index: 100;
        }

        .navbar img {
            width: 70px;
            height: auto;
        }

        /* Checkout Container */
        .checkout-container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            border-radius: var(--radius);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 40px 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            color: var(--primary);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin: 25px 0 10px;
            border-left: 4px solid var(--primary);
            padding-left: 10px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
        }

        input, select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s ease;
        }

        input:focus, select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0,123,255,0.1);
            outline: none;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .button {
            display: block;
            width: 100%;
            background: var(--primary);
            color: #fff;
            padding: 14px;
            border: none;
            border-radius: var(--radius);
            font-size: 17px;
            font-weight: 600;
            margin-top: 25px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .button:hover {
            background: #0056b3;
        }

        /* Order Summary */
        .order-summary {
            margin-top: 40px;
            border-top: 2px solid var(--light);
            padding-top: 25px;
        }

        .order-summary h3 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .price {
            text-align: right;
            font-weight: 600;
        }

        .total-row td {
            border-top: 2px solid #ccc;
            font-size: 18px;
            font-weight: 700;
        }

        .savings {
            text-align: right;
            color: #28a745;
            font-weight: 600;
            margin-top: 10px;
        }

        img.product-thumb {
            border-radius: 8px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .checkout-container {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <img src="{{ asset('img/zain07.png') }}" alt="Logo">
    </div>

    <!-- Checkout Form -->
    <div class="checkout-container">
        <h2>Checkout</h2>

        <div class="section-title">Contact Information</div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="you@example.com">
        </div>

        <div class="section-title">Delivery Details</div>
        <div class="input-group">
            <label for="country">Country</label>
            <select id="country">
                <option value="PK">Pakistan</option>
            </select>
        </div>
        <div class="input-group">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" placeholder="John">
        </div>
        <div class="input-group">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" placeholder="Doe">
        </div>
        <div class="input-group">
            <label for="address">Address</label>
            <input type="text" id="address" placeholder="Street, Apartment, etc.">
        </div>
        <div class="input-group">
            <label for="city">City</label>
            <input type="text" id="city" placeholder="Karachi">
        </div>
        <div class="input-group">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" placeholder="+92 300 1234567">
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="save-info">
            <label for="save-info">Save this info for next time</label>
        </div>

        <div class="section-title">Payment Method</div>
        <div class="input-group">
            <select>
                <option value="cod">Cash on Delivery (COD)</option>
                <option value="payfast">PayFast - Card/Wallet/Bank</option>
            </select>
        </div>

        <button class="button">Complete Checkout</button>

        <div class="order-summary">
            <h3>Order Summary</h3>
            <table>
                <tr>
                    <td><img src="{{ asset('img/product.png') }}" width="55" class="product-thumb"></td>
                    <td>
                        <div><strong>Royale Smartwatch</strong></div>
                        <div class="description">Black Metal</div>
                    </td>
                    <td class="price">1 × Rs 13,499.00</td>
                </tr>
                <tr>
                    <td colspan="2">Discount</td>
                    <td class="price">- Rs 2,000.00</td>
                </tr>
                <tr>
                    <td colspan="2">Shipping</td>
                    <td class="price">Free</td>
                </tr>
                <tr class="total-row">
                    <td colspan="2">Total</td>
                    <td class="price">Rs 13,499.00</td>
                </tr>
            </table>
            <div class="savings">You saved Rs 2,000.00 🎉</div>
        </div>
    </div>
</body>
</html>
