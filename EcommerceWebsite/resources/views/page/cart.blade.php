@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Shopping Bag | Zain Store Premium')

@section('content')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --black: #000000;
        --white: #ffffff;
        --bg-soft: #fcfcfc;
        --border: #eeeeee;
        --accent: #2563eb;
        --success: #10b981;
    }
    .cart-page { background: var(--bg-soft); padding: 80px 0 100px; min-height: 100vh; margin-top: 50px; }
    .stepper { display: flex; justify-content: center; align-items: center; gap: 20px; margin-bottom: 50px; }
    .step { display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 12px; color: #ccc; text-transform: uppercase; letter-spacing: 1px; }
    .step.active { color: var(--black); }
    .step-num { width: 25px; height: 24px; border-radius: 50%; border: 2px solid #ddd; display: grid; place-items: center; font-size: 11px; }
    .step.active .step-num { background: var(--black); border-color: var(--black); color: #fff; }
    .step-line { width: 50px; height: 1px; background: #ddd; }
    .shipping-goal-card { background: #fff; padding: 25px; border-radius: 12px; border: 1px solid var(--border); margin-bottom: 30px; }
    .goal-text { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px; font-weight: 700; }
    .goal-bar { height: 6px; background: #f0f0f0; border-radius: 10px; overflow: hidden; }
    .goal-fill { height: 100%; background: var(--accent); transition: 1s ease; }
    .cart-grid { display: grid; grid-template-columns: 1fr 400px; gap: 40px; max-width: 1350px; margin: auto; padding: 0 5%; }
    .cart-items-wrapper { background: #fff; padding: 35px; border-radius: 16px; border: 1px solid var(--border); }
    .cart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #f5f5f5; padding-bottom: 20px; }
    .cart-header h2 { font-size: 24px; font-weight: 800; }
    .cart-item { display: grid; grid-template-columns: 120px 1fr 150px; gap: 30px; padding: 30px 0; border-bottom: 1px solid #f5f5f5; }
    .p-img-box { width: 120px; aspect-ratio: 3/4; background: #f9f9f9; border-radius: 8px; overflow: hidden; }
    .p-img-box img { width: 100%; height: 100%; object-fit: cover; }
    .qty-box { display: flex; align-items: center; border: 1px solid #ddd; width: fit-content; border-radius: 4px; }
    .qty-box button { width: 35px; height: 35px; border: none; background: #fff; cursor: pointer; font-size: 18px; }
    .qty-box input { width: 45px; text-align: center; border: none; font-weight: 700; outline: none; }
    .p-price-col { text-align: right; display: flex; flex-direction: column; justify-content: space-between; }
    .summary-card { background: #fff; padding: 40px; border-radius: 16px; border: 1px solid var(--border); position: sticky; top: 110px; }
    .summary-total { margin-top: 30px; padding-top: 25px; border-top: 1px dashed #ddd; display: flex; justify-content: space-between; font-size: 24px; font-weight: 900; }
    .btn-checkout { width: 100%; padding: 20px; background: var(--black); color: #fff; border: 1px solid var(--black); border-radius: 4px; font-size: 14px; font-weight: 700; text-transform: uppercase; cursor: pointer; transition: 0.4s; margin-top: 30px; text-decoration: none; display: block; text-align: center; }
</style>

<div class="cart-page">
    <div class="container">
        <div class="stepper">
            <div class="step active"><div class="step-num">1</div> Bag</div>
            <div class="step-line"></div>
            <div class="step"><div class="step-num">2</div> Checkout</div>
            <div class="step-line"></div>
            <div class="step"><div class="step-num">3</div> Payment</div>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
            <div class="shipping-goal-card">
                <div class="goal-text">
                    <span><i class="fas fa-truck"></i> Free Shipping Goal</span>
                    <span style="color: var(--accent);">Target: Rs. 5,000 for FREE Shipping!</span>
                </div>
                <div class="goal-bar">
                    @php 
                        $subtotal = 0; 
                        foreach(session('cart') as $details) { $subtotal += $details['price'] * $details['quantity']; }
                        $percent = ($subtotal / 5000) * 100;
                        if($percent > 100) $percent = 100;
                    @endphp
                    <div class="goal-fill" style="width: {{ $percent }}%;"></div>
                </div>
            </div>

            <div class="cart-grid">
                <div class="cart-left">
                    <div class="cart-items-wrapper">
                        <div class="cart-header">
                            <h2>Your Bag ({{ count(session('cart')) }})</h2>
                            <a href="{{ route('shop.all') }}" style="color: var(--accent); font-size: 12px; font-weight: 700; text-decoration: none;">+ ADD MORE</a>
                        </div>

                        @foreach(session('cart') as $key => $details)
                            <div class="cart-item">
                                <div class="p-img-box">
                                    <img src="{{ asset('storage/' . $details['image']) }}">
                                </div>
                                <div class="p-info">
                                    <h3 style="margin:0;">{{ $details['name'] }}</h3>
                                    <span style="color: #777; font-size: 13px;">Size: <strong>{{ $details['size'] }}</strong></span>
                                    <div class="qty-box" style="margin-top:15px;">
                                        <button onclick="updateCart('{{ $key }}', {{ $details['quantity'] - 1 }})">-</button>
                                        <input type="text" value="{{ $details['quantity'] }}" readonly>
                                        <button onclick="updateCart('{{ $key }}', {{ $details['quantity'] + 1 }})">+</button>
                                    </div>
                                </div>
                                <div class="p-price-col">
                                    <span style="font-weight:800;">Rs. {{ number_format($details['price'] * $details['quantity']) }}</span>
                                    <a href="javascript:void(0)" onclick="removeFromCart('{{ $key }}')" style="color:red; font-size:11px; font-weight:700; text-decoration:none;">REMOVE</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="cart-right">
                    <div class="summary-card">
                        <h3 style="margin-top:0;">Order Summary</h3>
                        <div style="display:flex; justify-content:space-between; margin-bottom:15px;">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format($subtotal) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between;">
                            <span>Shipping</span>
                            <span style="color:green;">{{ $subtotal >= 5000 ? 'FREE' : 'Rs. 250' }}</span>
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
            <div style="text-align:center; padding:80px 0;">
                <i class="fas fa-shopping-bag" style="font-size:50px; color:#ddd; margin-bottom:20px;"></i>
                <h2>Your bag is empty</h2>
                <a href="{{ route('shop.all') }}" class="btn-checkout" style="display:inline-block; width:auto; padding:15px 40px;">Shop Now</a>
            </div>
        @endif
    </div>
</div>

<script>
    // Update Cart Quantity
    function updateCart(key, qty) {
        if(qty < 1) return;

        fetch("{{ route('cart.update') }}", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: JSON.stringify({ id: key, quantity: qty })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                location.reload(); // Simple reload to update all totals
            }
        });
    }

    // Remove Item
    function removeFromCart(key) {
        Swal.fire({
            title: 'Remove Item?',
            text: "Are you sure you want to remove this from bag?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000',
            cancelButtonColor: '#d33',
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
                    if(data.status === 'success') {
                        location.reload();
                    }
                });
            }
        })
    }
</script>
@endsection