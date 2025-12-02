function openCart() {
    document.getElementById("cartBackdrop").style.display = "block";
    document.getElementById("cartSideModal").style.right = "0";
}

function closeCart() {
    document.getElementById("cartBackdrop").style.display = "none";
    document.getElementById("cartSideModal").style.right = "-420px";
}

function updateCartUI(cart) {
    let container = document.getElementById("cartItems");
    if(!container) return;
    container.innerHTML = "";
    let total = 0;
    let count = 0;

    for (let id in cart) {
        let item = cart[id];
        total += item.price * item.quantity;
        count += item.quantity;

        container.innerHTML += `
        <div class="d-flex align-items-center border-bottom pb-2 mt-3">
            <img src="/storage/${item.image}" width="70" class="rounded me-3">
            <div style="flex:1">
                <strong>${item.name}</strong>
                <div class="mt-1">
                    <button class="btn btn-sm btn-light" onclick="changeQty(${id}, 'minus')">−</button>
                    <strong>${item.quantity}</strong>
                    <button class="btn btn-sm btn-light" onclick="changeQty(${id}, 'plus')">+</button>
                </div>
                <span>Rs. ${item.price}</span>
            </div>
        </div>`;
    }

    document.getElementById("cartTotal").innerText = total;
    let cartCount = document.getElementById("cartCount");
    if(cartCount) cartCount.innerText = count;
    let freeMsg = document.getElementById("freeShippingMsg");
    if(freeMsg) freeMsg.style.display = total >= 5000 ? "block" : "none";
}

function addToCart(id) {
    let qty = 1;
    let qtyInput = document.getElementById("qty");
    if(qtyInput) qty = parseInt(qtyInput.value) || 1;

    fetch("/cart/add/" + id, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ quantity: qty })
    })
    .then(res => res.json())
    .then(data => {
        updateCartUI(data.cart);
        openCart();
    });
}

function changeQty(id, type) {
    let url = type === 'plus' ? "/cart/add/" + id : "/cart/remove/" + id;
    fetch(url, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ quantity: 1 })
    })
    .then(res => res.json())
    .then(data => updateCartUI(data.cart));
}

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', function() {
    let cart = window.cartData || [];
    updateCartUI(cart);
});
