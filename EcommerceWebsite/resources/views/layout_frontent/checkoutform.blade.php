@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Checkout | Wasaaz')

@section('content')

<style>
    .checkout-page {
        background: var(--light);
        padding: 70px 0 120px;
    }

    .checkout-stepper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 18px;
        margin-bottom: 55px;
        flex-wrap: wrap;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--muted);
    }

    .step.active {
        color: var(--primary);
    }

    .step.completed {
        color: var(--accent);
    }

    .step a {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .step-num {
        width: 30px;
        height: 30px;
        border: 2px solid var(--border);
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 11px;
        transition: var(--transition-smooth);
    }

    .step.active .step-num {
        background: var(--primary);
        border-color: var(--primary);
        color: var(--white);
    }

    .step.completed .step-num {
        background: var(--accent);
        border-color: var(--accent);
        color: var(--white);
    }

    .step-line {
        width: 60px;
        height: 1px;
        background: var(--border);
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1.2fr 420px;
        gap: 50px;
        align-items: start;
    }

    .form-section {
        background: var(--white);
        border: 1px solid var(--border);
        padding: 36px;
        margin-bottom: 28px;
    }

    .form-title {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 500;
        color: var(--primary);
        margin-bottom: 28px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group--full {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--secondary);
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid var(--border);
        background: var(--white);
        color: var(--primary);
        font-size: 14px;
        font-weight: 500;
        outline: none;
        transition: var(--transition-smooth);
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(17, 17, 17, 0.04);
    }

    .form-group input::placeholder {
        color: var(--muted);
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 10px;
    }

    .checkbox-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
        cursor: pointer;
    }

    .checkbox-group label {
        font-size: 13px;
        color: var(--secondary);
        cursor: pointer;
    }

    .btn-checkout {
        display: block;
        width: 100%;
        padding: 18px;
        background: var(--primary);
        color: var(--white);
        border: none;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        cursor: pointer;
        transition: var(--transition-smooth);
    }

    .btn-checkout:hover {
        background: var(--primary-dark);
    }

    .summary-card {
        background: var(--white);
        border: 1px solid var(--border);
        padding: 40px;
        position: sticky;
        top: 140px;
    }

    .summary-title {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 500;
        color: var(--primary);
        margin-bottom: 25px;
    }

    .summary-items {
        border-bottom: 1px solid var(--border);
        padding-bottom: 10px;
    }

    .summary-item {
        display: grid;
        grid-template-columns: 60px 1fr auto;
        gap: 16px;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid var(--border);
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .item-img {
        width: 60px;
        height: 75px;
        background: var(--light);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .item-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-name {
        font-size: 14px;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 4px;
    }

    .item-meta {
        font-size: 12px;
        color: var(--secondary);
    }

    .item-total {
        font-size: 14px;
        font-weight: 700;
        color: var(--primary);
        white-space: nowrap;
    }

    .summary-lines {
        margin-top: 25px;
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        font-size: 14px;
        color: var(--secondary);
    }

    .summary-line.discount {
        color: #2e7d32;
    }

    .summary-line.total {
        border-top: 2px solid var(--border);
        margin-top: 10px;
        padding-top: 20px;
        font-size: 18px;
        font-weight: 800;
        color: var(--primary);
    }

    .savings-note {
        margin-top: 18px;
        padding: 12px;
        background: #f0f7f0;
        color: #2e7d32;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
    }

    .empty-cart {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-cart i {
        font-size: 48px;
        color: var(--border);
        margin-bottom: 20px;
    }

    .empty-cart h3 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        margin-bottom: 10px;
    }

    .empty-cart p {
        color: var(--secondary);
        font-size: 14px;
        margin-bottom: 25px;
    }

    .btn-continue {
        display: inline-block;
        padding: 14px 32px;
        background: var(--primary);
        color: var(--white);
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: var(--transition-smooth);
    }

    .btn-continue:hover {
        background: var(--primary-dark);
    }

    @media (max-width: 1100px) {
        .checkout-grid {
            gap: 35px;
        }
    }

    @media (max-width: 991px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }

        .summary-card {
            position: static;
        }
    }

    @media (max-width: 576px) {
        .checkout-page {
            padding: 50px 0 80px;
        }

        .form-section {
            padding: 24px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-title,
        .summary-title {
            font-size: 20px;
        }

        .step-line {
            width: 30px;
        }

        .summary-card {
            padding: 28px;
        }
    }
</style>

<div class="checkout-page">
    <div class="container">

        <!-- Stepper -->
        <div class="checkout-stepper">
            <a href="{{ route('cart.index') }}" class="step completed">
                <span class="step-num"><i class="fas fa-check"></i></span>
                Bag
            </a>
            <span class="step-line"></span>
            <div class="step active">
                <span class="step-num">2</span>
                Checkout
            </div>
            <span class="step-line"></span>
            <div class="step">
                <span class="step-num">3</span>
                Payment
            </div>
        </div>

        <div class="checkout-grid">
            <!-- Left: Checkout Form -->
            <div class="checkout-form">
                <form action="{{ route('stripe.checkout') }}" method="POST">
                    @csrf

                    <section class="form-section">
                        <h2 class="form-title">Contact Information</h2>
                        <div class="form-row">
                            <div class="form-group form-group--full">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
                            </div>
                        </div>
                    </section>

                    <section class="form-section">
                        <h2 class="form-title">Delivery Details</h2>
                        <div class="form-row">
                            <div class="form-group form-group--full">
                                <label for="country">Country</label>
                                <select id="country" name="country">
                                    <option value="PK">Pakistan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" placeholder="John" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" placeholder="Doe" value="{{ old('last_name') }}" required>
                            </div>
                            <div class="form-group form-group--full">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" placeholder="Street, Apartment, Suite, etc." value="{{ old('address') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" placeholder="Karachi" value="{{ old('city') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" placeholder="+92 300 1234567" value="{{ old('phone') }}" required>
                            </div>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="save_info" name="save_info" value="1" {{ old('save_info') ? 'checked' : '' }}>
                            <label for="save_info">Save this info for next time</label>
                        </div>
                    </section>

                    <section class="form-section">
                        <h2 class="form-title">Payment Method</h2>
                        <div class="form-row">
                            <div class="form-group form-group--full">
                                <label for="payment_method">Choose Payment Method</label>
                                <select id="payment_method" name="payment_method" required>
                                    <option value="cod">Cash on Delivery (COD)</option>
                                    <option value="payfast">PayFast - Card/Wallet/Bank</option>
                                </select>
                            </div>
                        </div>
                    </section>

                    <button type="submit" class="btn-checkout">Complete Checkout</button>
                </form>
            </div>

            <!-- Right: Order Summary -->
            <div class="checkout-summary">
                <div class="summary-card">
                    <h2 class="summary-title">Order Summary</h2>

                    @if(isset($cart) && count($cart) > 0)
                        <div class="summary-items">
                            @foreach($cart as $item)
                                <div class="summary-item">
                                    <div class="item-img">
                                        <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}">
                                    </div>
                                    <div class="item-info">
                                        <p class="item-name">{{ $item['name'] }}</p>
                                        <p class="item-meta">Qty: {{ $item['quantity'] }}</p>
                                    </div>
                                    <div class="item-total">
                                        Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="summary-lines">
                            <div class="summary-line">
                                <span>Subtotal</span>
                                <span>Rs. {{ number_format($total, 2) }}</span>
                            </div>
                            <div class="summary-line">
                                <span>Shipping</span>
                                <span>{{ $shipping > 0 ? 'Rs. ' . number_format($shipping, 2) : 'Free' }}</span>
                            </div>
                            @if($discount > 0)
                                <div class="summary-line discount">
                                    <span>Discount</span>
                                    <span>- Rs. {{ number_format($discount, 2) }}</span>
                                </div>
                            @endif
                            <div class="summary-line total">
                                <span>Total</span>
                                <span>Rs. {{ number_format($total + $shipping - $discount, 2) }}</span>
                            </div>
                        </div>

                        @if($discount > 0)
                            <div class="savings-note">
                                You saved Rs. {{ number_format($discount, 2) }}
                            </div>
                        @endif
                    @else
                        <div class="empty-cart">
                            <i class="fas fa-shopping-bag"></i>
                            <h3>Your bag is empty</h3>
                            <p>Add a few items to proceed with checkout.</p>
                            <a href="{{ route('shop.all') }}" class="btn-continue">Continue Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
