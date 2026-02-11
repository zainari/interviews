<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Zain Store')</title>

    <!-- CSRF Token for AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">

    <!-- Optional Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    {{-- Header --}}
    @include('partials.header')

    {{-- MINI CART SIDE MODAL (global) --}}
    <div id="cartBackdrop" onclick="closeCart()"></div>
    <div id="cartSideModal">
        <h4 class="fw-bold">Your Cart</h4>

        <div id="freeShippingMsg" class="alert alert-success py-2" style="display:none;">
             You are eligible for FREE shipping!
        </div>

        <div id="cartItems"></div>

        <h5 class="mt-3 text-end fw-bold">
            Total: Rs. <span id="cartTotal">0</span>
        </h5>

        <a href="{{ route('checkout.form') }}" class="btn btn-dark w-100 mt-3">
            Go to Checkout
        </a>
    </div>

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    <!-- Optional JS -->
    <script src="{{ asset('asset/js/slider.js') }}"></script>
    <script src="{{ asset('asset/js/cart.js') }}"></script>

    <style>
        /* MINI CART STYLES */
        #cartBackdrop {
            display: none;
            position: fixed;
            top:0; left:0;
            width:100%; height:100%;
            background: rgba(0,0,0,0.5);
            z-index:9999;
        }
        #cartSideModal {
            position: fixed;
            top:0;
            right: -420px;
            width: 420px;
            height: 100%;
            background: #fff;
            z-index: 99999;
            padding: 20px;
            overflow-y: auto;
            transition: 0.3s ease-in-out;
            box-shadow: -4px 0px 20px rgba(0,0,0,0.2);
        }
    </style>

    <script>
   
    function openCart() {
        fetch('/cart/data') // Laravel route that returns current cart
            .then(res => res.json())
            .then(data => {
                updateCartUI(data.cart);  // update modal content
                const backdrop = document.getElementById("cartBackdrop");
                const modal = document.getElementById("cartSideModal");
                if(backdrop && modal){
                    backdrop.style.display = "block";
                    modal.style.right = "0";
                }
            })
            .catch(err => console.error('Cart fetch error:', err));
    }

    // Close Cart
    function closeCart() {
        const backdrop = document.getElementById("cartBackdrop");
        const modal = document.getElementById("cartSideModal");
        if(backdrop && modal){
            backdrop.style.display = "none";
            modal.style.right = "-420px";
        }
    }

    // Update cart modal UI
    function updateCartUI(cart) {
        const container = document.getElementById("cartItems");
        container.innerHTML = "";
        let total = 0;
        let count = 0;

        for (let itemId in cart) {
            const item = cart[itemId];
            total += item.price * item.quantity;
            count += item.quantity;

            container.innerHTML += `
                <div class="d-flex align-items-center border-bottom pb-2 mt-3">
                    <img src="/storage/${item.image}" width="70" class="rounded me-3">
                    <div style="flex:1">
                        <strong>${item.name}</strong>
                        <div class="mt-1">
                            <button class="btn btn-sm btn-light" onclick="changeQty(${itemId}, 'minus')">−</button>
                            <strong>${item.quantity}</strong>
                            <button class="btn btn-sm btn-light" onclick="changeQty(${itemId}, 'plus')">+</button>
                        </div>
                        <span>Rs. ${item.price}</span>
                    </div>
                </div>
            `;
        }

        document.getElementById("cartTotal").innerText = total;

        // Free Shipping message
        const freeMsg = document.getElementById("freeShippingMsg");
        if(freeMsg){
            freeMsg.style.display = (total >= 5000) ? "block" : "none";
        }

        // Update cart icon count
        const cartCount = document.getElementById("cartCount");
        if(cartCount) cartCount.innerText = count;
    }

    // Add item to cart
    function addToCart(id, qty = 1) {
        fetch("/cart/add/" + id, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ quantity: qty })
        })
        .then(res => res.json())
        .then(data => {
            updateCartUI(data.cart);
            openCart();
        })
        .catch(err => console.error('Add to cart error:', err));
    }

    // Change quantity (+/-)
    function changeQty(id, type){
        const url = type === 'plus' ? "/cart/add/" + id : "/cart/remove/" + id;

        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ quantity: 1 })
        })
        .then(res => res.json())
        .then(data => updateCartUI(data.cart))
        .catch(err => console.error('Change quantity error:', err));
    }

    // Initialize cart on page load
    document.addEventListener('DOMContentLoaded', () => {
        fetch('/cart/data')
            .then(res => res.json())
            .then(data => updateCartUI(data.cart))
            .catch(err => console.error('Cart init error:', err));
    });

    </script>
    

</body>
</html>
