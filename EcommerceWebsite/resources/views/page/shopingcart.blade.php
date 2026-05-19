@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Shopping Cart | EliteStore Luxury')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-soft: #eff6ff;
        --dark: #0f172a;
        --light-bg: #f8fafc;
        --border-color: #e2e8f0;
        --success: #10b981;
        --danger: #ef4444;
        --text-muted: #64748b;
        --white: #ffffff;
    }

    .cart-section { background-color: var(--light-bg); padding: 40px 0 80px; min-height: 100vh; }

    /* --- Stepper UI --- */
    .stepper { display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 40px; padding: 0 15px; }
    .stepper-item { display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: clamp(10px, 2vw, 13px); color: var(--text-muted); }
    .stepper-item.active { color: var(--primary); }
    .stepper-circle { width: 28px; height: 28px; border-radius: 50%; background: #cbd5e1; color: var(--white); display: grid; place-items: center; font-size: 12px; }
    .stepper-item.active .stepper-circle { background: var(--primary); box-shadow: 0 0 15px rgba(37,99,235,0.3); }
    .stepper-line { width: clamp(20px, 5vw, 40px); height: 2px; background: #cbd5e1; }

    /* --- Shipping Progress --- */
    .shipping-card { background: var(--white); padding: 25px; border-radius: 20px; border: 1px solid var(--border-color); margin-bottom: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .shipping-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 10px; }
    .shipping-header h5 { font-size: 15px; font-weight: 700; color: var(--dark); }
    .progress-track { height: 10px; background: #f1f5f9; border-radius: 20px; overflow: hidden; }
    .progress-bar-fill { height: 100%; background: linear-gradient(90deg, var(--primary), #60a5fa); border-radius: 20px; transition: width 1s ease-in-out; }

    /* --- Cart Layout --- */
    .cart-grid { display: grid; grid-template-columns: 1fr 400px; gap: 30px; }
    .cart-list-card { background: var(--white); border-radius: 24px; padding: 30px; border: 1px solid var(--border-color); }
    
    .cart-item-row { 
        display: grid; 
        grid-template-columns: 120px 1fr 180px; 
        gap: 25px; 
        padding: 25px 0; 
        border-bottom: 1px solid #f1f5f9; 
    }
    .cart-item-row:last-child { border-bottom: none; }
    
    .p-image-box { width: 120px; height: 120px; background: #f8fafc; border-radius: 18px; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 1px solid #f1f5f9; }
    .p-image-box img { width: 85%; transition: 0.4s; }

    .p-info-box h3 { font-size: 18px; font-weight: 800; color: var(--dark); margin-bottom: 8px; }
    .p-meta { font-size: 12px; color: var(--text-muted); display: flex; gap: 15px; margin-bottom: 15px; flex-wrap: wrap; }
    
    /* Quantity Control */
    .qty-control { display: flex; align-items: center; background: var(--light-bg); border-radius: 12px; width: fit-content; padding: 4px; border: 1px solid var(--border-color); }
    .qty-control button { width: 32px; height: 32px; border: none; background: var(--white); border-radius: 8px; cursor: pointer; font-weight: 800; transition: 0.2s; }
    .qty-control button:hover { background: var(--primary); color: var(--white); }
    .qty-control input { width: 40px; text-align: center; border: none; background: none; font-weight: 800; font-size: 14px; }

    .price-action-box { text-align: right; display: flex; flex-direction: column; justify-content: space-between; }
    .item-total-price { font-size: 20px; font-weight: 900; color: var(--primary); display: block; }
    .action-links { display: flex; gap: 15px; justify-content: flex-end; margin-top: 10px; }
    .action-links span { font-size: 13px; font-weight: 700; cursor: pointer; transition: 0.3s; }
    .save-link { color: var(--primary); }
    .remove-link { color: var(--danger); }

    /* --- Summary Sidebar --- */
    .summary-card { background: var(--white); border-radius: 28px; padding: 35px; border: 1px solid var(--border-color); position: sticky; top: 110px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 15px; font-weight: 600; color: var(--text-muted); }
    .summary-total { margin-top: 20px; padding-top: 20px; border-top: 2px dashed #e2e8f0; display: flex; justify-content: space-between; font-size: 24px; font-weight: 900; color: var(--dark); }

    .btn-checkout-mega { width: 100%; padding: 20px; background: var(--primary); color: var(--white); border: none; border-radius: 15px; font-size: 16px; font-weight: 800; cursor: pointer; transition: 0.4s; display: flex; justify-content: center; align-items: center; gap: 10px; margin-top: 25px; }
    .btn-checkout-mega:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(37,99,235,0.2); }

    /* --- RESPONSIVE BREAKPOINTS --- */
    @media (max-width: 1024px) {
        .cart-grid { grid-template-columns: 1fr; }
        .summary-card { position: static; }
    }

    @media (max-width: 768px) {
        .cart-list-card { padding: 20px; }
        .cart-item-row { grid-template-columns: 100px 1fr; }
        .price-action-box { grid-column: 1 / -1; flex-direction: row; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 15px; text-align: left; }
        .p-image-box { width: 100px; height: 100px; }
        .stepper { gap: 10px; }
    }

    @media (max-width: 480px) {
        .cart-item-row { grid-template-columns: 1fr; text-align: center; }
        .p-image-box, .qty-control { margin: 0 auto 15px; }
        .p-meta { justify-content: center; }
        .price-action-box { flex-direction: column; gap: 10px; text-align: center; }
        .action-links { justify-content: center; }
    }
</style>

<div class="cart-section">
    <div class="container">
        
        <!-- Stepper -->
        <div class="stepper" data-aos="fade-down">
            <div class="stepper-item active"><div class="stepper-circle"><i class="fas fa-shopping-cart"></i></div> CART</div>
            <div class="stepper-line"></div>
            <div class="stepper-item"><div class="stepper-circle">2</div> CHECKOUT</div>
            <div class="stepper-line"></div>
            <div class="stepper-item"><div class="stepper-circle">3</div> PAYMENT</div>
        </div>

        @if($product)
        <!-- Shipping Progress -->
        <div class="shipping-card" data-aos="fade-up">
            <div class="shipping-header">
                <h5><i class="fas fa-truck-moving" style="color:var(--primary); margin-right:8px;"></i> Free Shipping Goal</h5>
                <span style="font-weight:800; color:var(--primary); font-size:13px;">Add $120.00 more for FREE Shipping!</span>
            </div>
            <div class="progress-track">
                <div class="progress-bar-fill" style="width: 70%;"></div>
            </div>
        </div>

        <div class="cart-grid">
            <!-- Left Side: List -->
            <div class="cart-left-side" data-aos="fade-right">
                <div class="cart-list-card">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
                        <h2 style="font-weight:900; font-size:24px;">Your Cart (1 Item)</h2>
                        <a href="{{ route('shop.all') }}" style="font-size:13px; font-weight:700; color:var(--primary);"><i class="fas fa-plus"></i> Add More</a>
                    </div>

                    <div class="cart-item-row">
                        <div class="p-image-box">
                            <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="p-info-box">
                            <h3>{{ $product->name }}</h3>
                            <div class="p-meta">
                                <span><i class="fas fa-box" style="color:var(--success);"></i> In Stock</span>
                                <span><i class="fas fa-calendar-alt"></i> Delivery: {{ now()->addDays(3)->format('D, d M') }}</span>
                            </div>
                            <div class="qty-control">
                                <button onclick="changeQty(-1)">-</button>
                                <input type="text" value="1" readonly id="itemQty">
                                <button onclick="changeQty(1)">+</button>
                            </div>
                        </div>
                        <div class="price-action-box">
                            <span class="item-total-price" id="totalPriceDisplay">${{ number_format($product->price, 2) }}</span>
                            <div class="action-links">
                                <span class="save-link"><i class="far fa-heart"></i> Save</span>
                                <span class="remove-link"><i class="far fa-trash-alt"></i> Remove</span>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:40px; padding-top:20px; border-top:1px solid #f1f5f9; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px;">
                        <p style="font-size:13px; color:var(--text-muted);"><i class="fas fa-info-circle"></i> Shipping and taxes calculated at checkout.</p>
                        <img src="https://help.zazzle.com/hc/article_attachments/360010513393/Logos-01.png" style="height:25px; opacity:0.6;">
                    </div>
                </div>
            </div>

            <!-- Right Side: Summary -->
            <div class="cart-right-side" data-aos="fade-left">
                <div class="summary-card">
                    <h2 style="font-weight:900; font-size:20px; margin-bottom:25px;">Order Summary</h2>
                    
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="subtotal">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping Fee</span>
                        <span style="color:var(--success); font-weight:700;">$15.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (Estimated)</span>
                        <span>$5.00</span>
                    </div>

                    <div style="margin:25px 0;">
                        <p style="font-size:12px; font-weight:700; margin-bottom:10px; color:var(--dark);">HAVE A PROMO CODE?</p>
                        <div style="display:flex; gap:10px;">
                            <input type="text" placeholder="Code" style="flex:1; padding:12px; border-radius:10px; border:1px solid var(--border-color); outline:none;">
                            <button style="padding:0 15px; border-radius:10px; background:var(--dark); color:white; border:none; font-weight:700; cursor:pointer;">APPLY</button>
                        </div>
                    </div>

                    <div class="summary-total">
                        <span>Total Pay</span>
                        <span style="color:var(--primary);" id="grandTotal">${{ number_format($product->price + 20, 2) }}</span>
                    </div>

                    <button class="btn-checkout-mega">
                        PROCEED TO CHECKOUT <i class="fas fa-arrow-right"></i>
                    </button>

                    <div style="display:flex; justify-content:center; gap:20px; margin-top:30px; opacity:0.5; font-size:20px;">
                        <i class="fab fa-cc-visa"></i>
                        <i class="fab fa-cc-mastercard"></i>
                        <i class="fab fa-cc-paypal"></i>
                        <i class="fab fa-cc-apple-pay"></i>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Empty Cart State -->
        <div style="text-align:center; padding:100px 20px;" data-aos="zoom-in">
            <div style="font-size:80px; color:#ddd; margin-bottom:20px;"><i class="fas fa-shopping-basket"></i></div>
            <h2 style="font-weight:900;">Your cart is empty!</h2>
            <p style="color:var(--text-muted); margin-bottom:30px;">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('shop.all') }}" class="btn-checkout-mega" style="display:inline-flex; width:auto; padding:15px 40px;">START SHOPPING</a>
        </div>
        @endif
    </div>
</div>

<script>
    const basePrice = {{ $product->price ?? 0 }};

    function changeQty(val) {
        let qtyInput = document.getElementById('itemQty');
        let currentQty = parseInt(qtyInput.value);
        
        if (currentQty + val >= 1) {
            let newQty = currentQty + val;
            qtyInput.value = newQty;
            
            let newPrice = basePrice * newQty;
            document.getElementById('totalPriceDisplay').innerText = '$' + newPrice.toLocaleString(undefined, {minimumFractionDigits: 2});
            document.getElementById('subtotal').innerText = '$' + newPrice.toLocaleString(undefined, {minimumFractionDigits: 2});
            document.getElementById('grandTotal').innerText = '$' + (newPrice + 20).toLocaleString(undefined, {minimumFractionDigits: 2});
        }
    }
</script>
@endsection