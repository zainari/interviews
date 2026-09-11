@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Shopping Bag | Wasaaz Premium')

@section('content')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-neutral: #111111;
        --secondary-neutral: #555555;
        --accent-neutral: #8c8276;
        --warm-bg: #faf9f6;
        --white-bg: #ffffff;
        --light-border: #e8e6e1;
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .cart-page { background: var(--warm-bg); padding: 40px 0 100px; min-height: 60vh; }

    /* Breadcrumb */
    .breadcrumb-area { background: var(--white-bg); padding: 28px 0; border-bottom: 1px solid var(--light-border); }
    .breadcrumb-links { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--secondary-neutral); }
    .breadcrumb-links a { color: var(--accent-neutral); transition: var(--transition-smooth); }
    .breadcrumb-links a:hover { color: var(--primary-neutral); }
    .breadcrumb-links i { margin: 0 12px; font-size: 9px; opacity: 0.5; }

    .page-header { text-align: center; padding: 50px 0 40px; }
    .page-header p { color: var(--accent-neutral); font-weight: 700; text-transform: uppercase; letter-spacing: 3px; font-size: 11px; margin-bottom: 10px; }
    .page-header h1 { font-size: 36px; font-weight: 300; text-transform: uppercase; letter-spacing: -0.5px; color: var(--primary-neutral); }
    .page-header h1 span { font-weight: 700; }

    /* Stepper */
    .stepper { display: flex; justify-content: center; align-items: center; gap: 20px; margin-bottom: 45px; flex-wrap: wrap; }
    .step { display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 11px; color: #ccc; text-transform: uppercase; letter-spacing: 1px; }
    .step.active { color: var(--primary-neutral); }
    .step-num { width: 28px; height: 28px; border-radius: 50%; border: 1px solid #ddd; display: grid; place-items: center; font-size: 11px; transition: var(--transition-smooth); }
    .step.active .step-num { background: var(--primary-neutral); border-color: var(--primary-neutral); color: var(--white-bg); }
    .step-line { width: 50px; height: 1px; background: var(--light-border); }

    /* Free Shipping Goal */
    .shipping-goal-card { background: var(--white-bg); padding: 25px; border: 1px solid var(--light-border); margin-bottom: 30px; }
    .goal-text { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
    .goal-bar { height: 6px; background: #f0f0f0; border-radius: 10px; overflow: hidden; }
    .goal-fill { height: 100%; background: var(--accent-neutral); transition: 1s ease; }

    /* Cart Grid */
    .cart-grid { display: grid; grid-template-columns: 1fr 380px; gap: 35px; align-items: start; }
    .cart-items-wrapper { background: var(--white-bg); border: 1px solid var(--light-border); padding: 35px; }
    .cart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding-bottom: 20px; border-bottom: 1px solid var(--light-border); }
    .cart-header h2 { font-size: 20px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin: 0; }
    .cart-header a { color: var(--accent-neutral); font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; transition: var(--transition-smooth); }
    .cart-header a:hover { color: var(--primary-neutral); }

    .cart-item { display: grid; grid-template-columns: 120px 1fr 140px; gap: 25px; padding: 28px 0; border-bottom: 1px solid var(--light-border); align-items: center; }
    .cart-item:last-child { border-bottom: none; }
    .p-img-box { width: 120px; aspect-ratio: 3/4; background: #fbfbfb; border: 1px solid var(--light-border); overflow: hidden; }
    .p-img-box img { width: 100%; height: 100%; object-fit: cover; }
    .p-info h3 { margin: 0 0 8px; font-size: 16px; font-weight: 600; color: var(--primary-neutral); }
    .p-info span { color: var(--secondary-neutral); font-size: 13px; }
    .p-info span strong { color: var(--primary-neutral); }

    .qty-box { display: flex; align-items: center; border: 1px solid var(--light-border); width: fit-content; margin-top: 15px; }
    .qty-box button { width: 36px; height: 36px; border: none; background: var(--white-bg); cursor: pointer; font-size: 16px; color: var(--primary-neutral); transition: var(--transition-smooth); }
    .qty-box button:hover { background: var(--warm-bg); }
    .qty-box input { width: 45px; text-align: center; border: none; font-weight: 800; outline: none; font-size: 14px; color: var(--primary-neutral); }

    .p-price-col { text-align: right; display: flex; flex-direction: column; justify-content: space-between; height: 100%; }
    .p-price-col .price { font-size: 16px; font-weight: 700; color: var(--primary-neutral); margin-bottom: 8px; }
    .p-price-col .remove { color: var(--danger); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; text-decoration: none; transition: var(--transition-smooth); }
    .p-price-col .remove:hover { opacity: 0.7; }

    /* Summary */
    .summary-card { background: var(--white-bg); border: 1px solid var(--light-border); padding: 35px; position: sticky; top: 110px; }
    .summary-card h3 { margin-top: 0; font-size: 16px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 25px; }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 16px; font-size: 14px; color: var(--secondary-neutral); }
    .summary-row span:last-child { color: var(--primary-neutral); font-weight: 700; }
    .summary-total { margin-top: 25px; padding-top: 25px; border-top: 1px dashed var(--light-border); display: flex; justify-content: space-between; font-size: 18px; font-weight: 800; color: var(--primary-neutral); }
    .btn-checkout { width: 100%; padding: 18px; background: var(--primary-neutral); color: var(--white-bg); border: 1px solid var(--primary-neutral); font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; transition: var(--transition-smooth); text-decoration: none; display: block; text-align: center; margin-top: 30px; }
    .btn-checkout:hover { background: transparent; color: var(--primary-neutral); }

    /* Empty State */
    .empty-state { text-align: center; padding: 100px 20px; background: var(--white-bg); border: 1px solid var(--light-border); }
    .empty-state i { font-size: 60px; color: var(--light-border); margin-bottom: 25px; }
    .empty-state h2 { font-size: 24px; font-weight: 700; margin-bottom: 12px; color: var(--primary-neutral); }
    .empty-state p { color: var(--secondary-neutral); margin-bottom: 30px; }
    .btn-shop { padding: 15px 40px; background: var(--primary-neutral); color: var(--white-bg); text-decoration: none; font-weight: 700; font-size: 12px; letter-spacing: 2px; text-transform: uppercase; transition: var(--transition-smooth); display: inline-block; border: 1px solid var(--primary-neutral); }
    .btn-shop:hover { background: transparent; color: var(--primary-neutral); }

    /* Responsive */
    @media (max-width: 1024px) {
        .cart-grid { grid-template-columns: 1fr; }
        .summary-card { position: static; margin-top: 30px; }
    }
    @media (max-width: 768px) {
        .page-header h1 { font-size: 28px; }
        .cart-item { grid-template-columns: 100px 1fr; gap: 18px; }
        .p-price-col { grid-column: 1 / -1; flex-direction: row; align-items: center; justify-content: space-between; text-align: left; margin-top: 10px; }
        .cart-items-wrapper { padding: 25px; }
        .summary-card { padding: 25px; }
    }
    @media (max-width: 480px) {
        .stepper { gap: 12px; }
        .step-line { width: 25px; }
        .cart-header { flex-direction: column; align-items: flex-start; gap: 10px; }
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-links">
            <a href="{{ route('home.new') }}">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>Shopping Bag</span>
        </div>
    </div>
</div>

<div class="cart-page">
    <div class="container">
        <div class="page-header" data-aos="fade-up">
            <p>Your Selection</p>
            <h1>Shopping <span>Bag</span></h1>
        </div>

        <div class="stepper" data-aos="fade-up" data-aos-delay="50">
            <div class="step active"><div class="step-num">1</div> Bag</div>
            <div class="step-line"></div>
            <div class="step"><div class="step-num">2</div> Checkout</div>
            <div class="step-line"></div>
            <div class="step"><div class="step-num">3</div> Payment</div>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
            @php
                $subtotal = 0;
                foreach(session('cart') as $details) { $subtotal += $details['price'] * $details['quantity']; }
                $percent = ($subtotal / 5000) * 100;
                if($percent > 100) $percent = 100;
            @endphp

            <div class="shipping-goal-card" data-aos="fade-up">
                <div class="goal-text">
                    <span><i class="fas fa-truck"></i> Free Shipping Goal</span>
                    <span style="color: var(--accent-neutral);">Target: Rs. 5,000 for FREE shipping</span>
                </div>
                <div class="goal-bar">
                    <div class="goal-fill" style="width: {{ $percent }}%;"></div>
                </div>
            </div>

            <div class="cart-grid">
                <div class="cart-left" data-aos="fade-up">
                    <div class="cart-items-wrapper">
                        <div class="cart-header">
                            <h2>Your Bag ({{ count(session('cart')) }})</h2>
                            <a href="{{ route('shop.all') }}">+ Add More Items</a>
                        </div>

                        @foreach(session('cart') as $key => $details)
                            <div class="cart-item">
                                <div class="p-img-box">
                                    <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}">
                                </div>
                                <div class="p-info">
                                    <h3>{{ $details['name'] }}</h3>
                                    <span>Size: <strong>{{ $details['size'] }}</strong></span>
                                    <div class="qty-box">
                                        <button onclick="updateCart('{{ $key }}', {{ $details['quantity'] - 1 }})">-</button>
                                        <input type="text" value="{{ $details['quantity'] }}" readonly>
                                        <button onclick="updateCart('{{ $key }}', {{ $details['quantity'] + 1 }})">+</button>
                                    </div>
                                </div>
                                <div class="p-price-col">
                                    <span class="price">Rs. {{ number_format($details['price'] * $details['quantity']) }}</span>
                                    <a href="javascript:void(0)" onclick="removeFromCart('{{ $key }}')" class="remove"><i class="fas fa-trash"></i> Remove</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="cart-right" data-aos="fade-up" data-aos-delay="100">
                    <div class="summary-card">
                        <h3>Order Summary</h3>
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format($subtotal) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span style="color: {{ $subtotal >= 5000 ? '#1a7d32' : 'inherit' }};">{{ $subtotal >= 5000 ? 'FREE' : 'Rs. 250' }}</span>
                        </div>
                        <div class="summary-total">
                            <span>Total</span>
                            <span>Rs. {{ number_format($subtotal >= 5000 ? $subtotal : $subtotal + 250) }}</span>
                        </div>
                        <a href="{{ route('checkout.form') }}" class="btn-checkout">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state" data-aos="fade-up">
                <i class="fas fa-shopping-bag"></i>
                <h2>Your bag is empty</h2>
                <p>Explore our premium collection and add your favorite pieces.</p>
                <a href="{{ route('shop.all') }}" class="btn-shop">Shop Now</a>
            </div>
        @endif
    </div>
</div>

<script>
    function updateCart(key, qty) {
        if(qty < 1) return;

        fetch("{{ route('cart.update') }}", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: JSON.stringify({ id: key, quantity: qty })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') location.reload();
        });
    }

    function removeFromCart(key) {
        Swal.fire({
            title: 'Remove Item?',
            text: "Are you sure you want to remove this from your bag?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#111111',
            cancelButtonColor: '#b22222',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('cart.remove') }}", {
                    method: "POST",
                    headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    body: JSON.stringify({ id: key })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') location.reload();
                });
            }
        });
    }
</script>
@endsection
