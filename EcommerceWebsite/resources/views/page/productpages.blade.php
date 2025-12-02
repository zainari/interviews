@extends('layout_frontent.app')

@section('title', $product->name)

@section('content')

<link rel="stylesheet" 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
/* Product Layout */
.product-detail-container {
    max-width: 1100px;
    margin: 40px auto;
    display: flex;
    gap: 40px;
}

.product-image img {
    width: 380px;
    border-radius: 10px;
    box-shadow: 0px 5px 25px rgba(0,0,0,0.15);
}

.btn-add {
    background: #000;
    color: #fff;
    padding: 12px 22px;
    border-radius: 8px;
    border: none;
    font-size: 18px;
}

.btn-add:hover {
    background: #444;
}

/* Mini Cart Modal */
#cartSideModal {
    position: fixed;
    top: 0;
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

/* #cartBackdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 9999;
} */
</style>


<div class="product-detail-container">

    <div class="product-image">
        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
    </div>

    <div class="product-info">
        <h2>{{ $product->name }}</h2>
        <p class="price">Rs. {{ number_format($product->price) }}</p>
        <p>{{ $product->description }}</p>

        <div class="mt-3">
            <label>Quantity</label>
            <input type="number" id="qty" value="1" min="1" 
                   class="form-control w-50 text-center">
        </div>

        <button onclick="addToCart({{ $product->id }})" 
                class="btn-add mt-4">
            Add to Cart
        </button>

    </div>
</div>




@endsection
