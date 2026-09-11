@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'My Wishlist | Zain Store')

@section('content')
<!-- FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* =============================================================
       ✅ WISHLIST PREMIUM LUXURY STYLING
    ============================================================== */
    :root {
        --primary-neutral: #111111;
        --secondary-neutral: #555555;
        --accent-neutral: #8c8276;
        --warm-bg: #faf9f6;
        --white-bg: #ffffff;
        --light-border: #e8e6e1;
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .wishlist-wrapper {
        background-color: var(--warm-bg);
        padding: 80px 0;
        min-height: 60vh;
    }

    /* Section Header */
    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }
    .section-header p {
        color: var(--accent-neutral);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 11px;
        margin-bottom: 10px;
    }
    .section-header h2 {
        font-size: 36px;
        font-weight: 300;
        color: var(--primary-neutral);
        letter-spacing: -0.5px;
        text-transform: uppercase;
    }
    .section-header h2 span {
        font-weight: 700;
    }

    /* Product Grid */
    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .wishlist-card {
        background: var(--white-bg);
        border: 1px solid var(--light-border);
        overflow: hidden;
        transition: var(--transition-smooth);
        position: relative;
        display: flex;
        flex-direction: column;
    }
    .wishlist-card:hover {
        border-color: var(--primary-neutral);
        box-shadow: 0 20px 40px rgba(0,0,0,0.04);
        transform: translateY(-5px);
    }

    .p-img-box {
        height: 380px;
        background: #fbfbfb;
        overflow: hidden;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .p-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .wishlist-card:hover .p-img-box img {
        transform: scale(1.05);
    }

    /* Absolute Sleek Remove Button */
    .wishlist-remove-form {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
    }
    .wishlist-remove-btn {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid var(--light-border);
        color: var(--primary-neutral);
        display: grid;
        place-items: center;
        cursor: pointer;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    .wishlist-remove-btn:hover {
        background: var(--primary-neutral);
        color: var(--white-bg);
        border-color: var(--primary-neutral);
        transform: scale(1.05);
    }

    .p-info {
        padding: 25px 20px;
        text-align: center;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .p-brand {
        color: var(--accent-neutral);
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 8px;
    }
    .p-name {
        font-size: 15px;
        font-weight: 400;
        margin-bottom: 12px;
        color: var(--primary-neutral);
        text-decoration: none;
        height: 44px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 1.4;
        transition: var(--transition-smooth);
    }
    .p-name:hover {
        color: var(--accent-neutral);
    }

    .p-price-row {
        display: flex;
        align-items: baseline;
        justify-content: center;
        gap: 12px;
        margin-top: auto;
        margin-bottom: 20px;
    }
    .curr-price {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary-neutral);
    }

    .view-btn {
        width: 100%;
        padding: 15px;
        background: transparent;
        color: var(--primary-neutral);
        border: 1px solid var(--primary-neutral);
        font-weight: 700;
        font-size: 11px;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-decoration: none;
        display: inline-block;
        transition: var(--transition-smooth);
    }
    .wishlist-card:hover .view-btn {
        background: var(--primary-neutral);
        color: var(--white-bg);
    }

    /* Empty Wishlist Design */
    .empty-wishlist {
        text-align: center;
        padding: 80px 40px;
        background: var(--white-bg);
        border: 1px solid var(--light-border);
        max-width: 600px;
        margin: 0 auto;
    }
    .empty-wishlist i {
        font-size: 50px;
        color: var(--accent-neutral);
        margin-bottom: 25px;
    }
    .empty-wishlist p {
        font-size: 15px;
        color: var(--secondary-neutral);
        margin-bottom: 30px;
        line-height: 1.6;
    }
    .btn-lux-primary {
        padding: 16px 40px;
        background: var(--primary-neutral);
        color: var(--white-bg);
        text-decoration: none;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 2px;
        text-transform: uppercase;
        border: 1px solid var(--primary-neutral);
        transition: var(--transition-smooth);
        display: inline-block;
    }
    .btn-lux-primary:hover {
        background: transparent;
        color: var(--primary-neutral);
    }

    /* Responsive Queries */
    @media (max-width: 1200px) {
        .wishlist-grid { grid-template-columns: repeat(3, 1fr); gap: 20px; }
    }
    @media (max-width: 991px) {
        .wishlist-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 576px) {
        .wishlist-grid { grid-template-columns: 1fr; }
        .p-img-box { height: 320px; }
        .section-header h2 { font-size: 28px; }
    }
</style>

<div class="wishlist-wrapper">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <p>Your Saved Selection</p>
            <h2>My <span>Wishlist</span></h2>
        </div>

        <!-- Wishlist Grid -->
        <div class="wishlist-grid">
            @forelse($wishlists as $w)
                @if($w->product)
                <div class="wishlist-card">
                    
                    <!-- Sleek Remove Cross Button -->
                    <form action="{{ route('wishlist.remove', $w->id) }}" method="POST" class="wishlist-remove-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="wishlist-remove-btn" title="Remove Item">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </form>

                    <!-- Product Image -->
                    <div class="p-img-box">
                        <a href="{{ route('product.show', $w->product->slug ?? $w->product->id) }}" style="width: 100%; height: 100%;">
                            <img src="{{ Str::startsWith($w->product->image_url, 'http') ? $w->product->image_url : asset('storage/' . $w->product->image_url) }}" alt="{{ $w->product->name }}">
                        </a>
                    </div>

                    <!-- Product Details -->
                    <div class="p-info">
                        <span class="p-brand">{{ $w->product->brand ?? 'ZAIN SELECT' }}</span>
                        <a href="{{ route('product.show', $w->product->slug ?? $w->product->id) }}" class="p-name">
                            {{ $w->product->name }}
                        </a>
                        <div class="p-price-row">
                            <span class="curr-price">Rs. {{ number_format($w->product->price) }}</span>
                        </div>
                        <a href="{{ route('product.show', $w->product->slug ?? $w->product->id) }}" class="view-btn">
                            View Product
                        </a>
                    </div>

                </div>
                @endif
            @empty
                <!-- Empty State Block -->
                <div style="grid-column: 1/-1;">
                    <div class="empty-wishlist">
                        <i class="fa-regular fa-heart"></i>
                        <h3>Your Wishlist is Empty</h3>
                        <p>Explore our premium collections and save your favorite structural silhouettes here for quick access later.</p>
                        <a href="{{ route('shop.all') }}" class="btn-lux-primary">Discover Collection</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection