@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Home | Zain Store - Premium Boutique')

@section('content')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* =============================================================
       ✅ MODERN PREMIUM LUXURY STYLING
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

    body {
        background-color: var(--warm-bg);
        color: var(--primary-neutral);
    }

    /* --- HERO SECTION --- */
    .hero {
        min-height: 80vh;
        display: flex;
        align-items: center;
        background: #f4f2ee;
        position: relative;
        overflow: hidden;
        padding: 80px 0;
    }
    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 80% 20%, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0) 70%);
        pointer-events: none;
    }
    .hero-flex {
        display: flex;
        align-items: center;
        gap: 60px;
        flex-wrap: wrap;
        position: relative;
        z-index: 2;
    }
    .hero-text {
        flex: 1.2;
        min-width: 320px;
    }
    .hero-pretitle {
        color: var(--accent-neutral);
        font-weight: 700;
        letter-spacing: 4px;
        text-transform: uppercase;
        font-size: 11px;
        display: block;
        margin-bottom: 15px;
    }
    .hero-text h1 {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 300;
        line-height: 1.05;
        margin-bottom: 25px;
        color: var(--primary-neutral);
        letter-spacing: -1px;
    }
    .hero-text h1 span {
        font-weight: 700;
        color: var(--primary-neutral);
    }
    .hero-text p {
        font-size: 17px;
        color: var(--secondary-neutral);
        margin-bottom: 40px;
        max-width: 500px;
        line-height: 1.7;
    }
    
    /* Luxury Buttons */
    .btn-lux-primary {
        padding: 18px 45px;
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
    .btn-lux-secondary {
        padding: 18px 45px;
        background: transparent;
        color: var(--primary-neutral);
        border: 1px solid var(--primary-neutral);
        text-decoration: none;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: var(--transition-smooth);
        display: inline-block;
    }
    .btn-lux-secondary:hover {
        background: var(--primary-neutral);
        color: var(--white-bg);
    }

    .hero-img {
        flex: 0.9;
        min-width: 320px;
        position: relative;
    }
    .hero-img-wrapper {
        position: relative;
        padding: 15px;
    }
    .hero-img-wrapper::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80%;
        height: 80%;
        border-left: 1px solid var(--accent-neutral);
        border-bottom: 1px solid var(--accent-neutral);
        opacity: 0.4;
        pointer-events: none;
    }
    .hero-img img {
        width: 100%;
        max-width: 480px;
        object-fit: cover;
        display: block;
        box-shadow: 0 30px 60px rgba(0,0,0,0.08);
        transition: var(--transition-smooth);
    }

    /* --- FEATURES BAR --- */
    .features-section {
        background: var(--white-bg);
        border-bottom: 1px solid var(--light-border);
        padding: 40px 0;
    }
    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }
    .feature-card {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .feature-icon-box {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--warm-bg);
        display: grid;
        place-items: center;
        flex-shrink: 0;
        border: 1px solid var(--light-border);
    }
    .feature-card i {
        font-size: 18px;
        color: var(--accent-neutral);
    }
    .feature-info h4 {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 4px;
        color: var(--primary-neutral);
    }
    .feature-info p {
        font-size: 12px;
        color: var(--secondary-neutral);
    }

    /* --- TOP CATEGORIES --- */
    .categories-section {
        padding: 100px 0;
        background: var(--warm-bg);
    }
    .section-header {
        text-align: center;
        margin-bottom: 60px;
        position: relative;
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
    .cat-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }
    .category-box {
        text-align: center;
        text-decoration: none;
        color: inherit;
        display: block;
        position: relative;
    }
    .cat-circle {
        background: var(--white-bg);
        border-radius: 50%;
        width: 160px;
        height: 160px;
        margin: 0 auto 20px;
        display: grid;
        place-items: center;
        border: 1px solid var(--light-border);
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
    }
    .cat-circle img {
        width: 45%;
        transition: var(--transition-smooth);
    }
    .category-box:hover .cat-circle {
        transform: translateY(-8px);
        border-color: var(--primary-neutral);
        box-shadow: 0 15px 30px rgba(140, 130, 118, 0.1);
    }
    .category-box:hover .cat-circle img {
        transform: scale(1.15);
    }
    .category-box h4 {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--primary-neutral);
        transition: var(--transition-smooth);
    }
    .category-box:hover h4 {
        color: var(--accent-neutral);
    }

    /* --- EDITORIAL BANNER --- */
    .editorial-banner {
        background: #f4f2ee;
        padding: 100px 0;
        border-top: 1px solid var(--light-border);
        border-bottom: 1px solid var(--light-border);
    }
    .editorial-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 80px;
        align-items: center;
    }
    .editorial-content span {
        font-size: 11px;
        letter-spacing: 3px;
        color: var(--accent-neutral);
        font-weight: 700;
        text-transform: uppercase;
        display: block;
        margin-bottom: 15px;
    }
    .editorial-content h3 {
        font-size: 38px;
        font-weight: 300;
        line-height: 1.2;
        margin-bottom: 25px;
    }
    .editorial-content p {
        font-size: 15px;
        color: var(--secondary-neutral);
        line-height: 1.8;
        margin-bottom: 35px;
    }
    .editorial-img img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
    }

    /* --- PRODUCT CARD --- */
    .products-section {
        padding: 100px 0;
        background: var(--white-bg);
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }
    .product-card {
        background: var(--white-bg);
        border: 1px solid var(--light-border);
        overflow: hidden;
        transition: var(--transition-smooth);
        position: relative;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
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
    .product-card:hover .p-img-box img {
        transform: scale(1.05);
    }
    
    /* Actions */
    .p-actions {
        position: absolute;
        right: 15px;
        bottom: 15px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        z-index: 5;
        opacity: 0;
        transform: translateY(10px);
        transition: var(--transition-smooth);
    }
    .product-card:hover .p-actions {
        opacity: 1;
        transform: translateY(0);
    }
    .p-btn {
        width: 40px;
        height: 40px;
        background: var(--white-bg);
        border: 1px solid var(--light-border);
        border-radius: 50%;
        display: grid;
        place-items: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        cursor: pointer;
        color: var(--primary-neutral);
        text-decoration: none;
        transition: var(--transition-smooth);
    }
    .p-btn:hover {
        background: var(--primary-neutral);
        color: var(--white-bg);
        border-color: var(--primary-neutral);
    }

    .badge-luxury {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--primary-neutral);
        color: var(--white-bg);
        padding: 5px 12px;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        z-index: 2;
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
    .old-price {
        font-size: 13px;
        color: var(--secondary-neutral);
        text-decoration: line-through;
        opacity: 0.6;
    }

    .home-add-btn {
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
        transition: var(--transition-smooth);
    }
    .product-card:hover .home-add-btn {
        background: var(--primary-neutral);
        color: var(--white-bg);
    }

    /* --- NEWSLETTER --- */
    .newsletter-section {
        padding: 120px 0;
        background: #111111;
        color: var(--white-bg);
        position: relative;
    }
    .newsletter-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 15% 85%, rgba(140, 130, 118, 0.15) 0%, rgba(0,0,0,0) 50%);
        pointer-events: none;
    }
    .newsletter-container {
        max-width: 650px;
        margin: 0 auto;
        text-align: center;
        position: relative;
        z-index: 2;
    }
    .newsletter-tag {
        color: var(--accent-neutral);
        font-weight: 700;
        letter-spacing: 4px;
        text-transform: uppercase;
        font-size: 11px;
        display: block;
        margin-bottom: 20px;
    }
    .newsletter-container h2 {
        font-size: 42px;
        font-weight: 300;
        letter-spacing: -1px;
        margin-bottom: 20px;
        text-transform: uppercase;
    }
    .newsletter-container p {
        opacity: 0.6;
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 45px;
    }
    .newsletter-form {
        display: flex;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        padding-bottom: 10px;
        transition: var(--transition-smooth);
    }
    .newsletter-form:focus-within {
        border-color: var(--white-bg);
    }
    .newsletter-form input {
        flex: 1;
        background: transparent;
        border: none;
        outline: none;
        color: var(--white-bg);
        padding: 10px 0;
        font-size: 15px;
    }
    .newsletter-form input::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }
    .newsletter-form button {
        background: transparent;
        color: var(--white-bg);
        border: none;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-size: 12px;
        cursor: pointer;
        padding: 10px 20px;
        transition: var(--transition-smooth);
    }
    .newsletter-form button:hover {
        color: var(--accent-neutral);
    }

    /* =============================================================
       📱 MEDIA QUERIES
    ============================================================== */
    @media (max-width: 1200px) {
        .product-grid { grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .cat-container { gap: 20px; }
        .hero-text h1 { font-size: 3.5rem; }
    }

    @media (max-width: 991px) {
        .hero-flex { gap: 40px; }
        .features-grid { grid-template-columns: repeat(2, 1fr); gap: 25px; }
        .cat-container { grid-template-columns: repeat(2, 1fr); }
        .editorial-grid { grid-template-columns: 1fr; gap: 40px; }
        .product-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .hero { padding: 60px 0; }
        .hero-flex { flex-direction: column; text-align: center; }
        .hero-text { order: 2; }
        .hero-img { order: 1; }
        .hero-text p { margin-left: auto; margin-right: auto; }
        .section-header h2 { font-size: 28px; }
        .newsletter-container h2 { font-size: 32px; }
    }

    @media (max-width: 480px) {
        .features-grid { grid-template-columns: 1fr; gap: 20px; }
        .cat-circle { width: 130px; height: 130px; }
        .product-grid { grid-template-columns: 1fr; }
        .p-img-box { height: 320px; }
        .newsletter-form { flex-direction: column; gap: 15px; border-bottom: none; }
        .newsletter-form input { border-bottom: 1px solid rgba(255,255,255,0.2); text-align: center; padding-bottom: 15px; }
    }
</style>

    <!-- 1. HERO SECTION -->
    <section class="hero">
        <div class="container">
            <div class="hero-flex">
                <div class="hero-text" data-aos="fade-up">
                    <span class="hero-pretitle">Premium Selection 2025</span>
                    <h1>Luxury Style.<br><span>Zain Boutique.</span></h1>
                    <p>Discover the finest handcrafted apparel and lifestyle accessories. Minimalist structural design meets maximum day-to-day comfort.</p>
                    <div style="display:flex; gap:15px; margin-top:30px; flex-wrap:wrap; justify-content: inherit;">
                        <a href="{{ route('shop.all') }}" class="btn-lux-primary">SHOP ALL</a>
                        <a href="{{ route('shop.all') }}" class="btn-lux-secondary">NEW DROPS</a>
                    </div>
                </div>
                <div class="hero-img" data-aos="fade-left">
                    <div class="hero-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?auto=format&fit=crop&w=800&q=80" alt="Zain Boutique Model">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. FEATURES -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up">
                    <div class="feature-icon-box">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <div class="feature-info">
                        <h4>Fast Shipping</h4>
                        <p>Across Pakistan</p>
                    </div>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon-box">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="feature-info">
                        <h4>Secure Pay</h4>
                        <p>100% Protected</p>
                    </div>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon-box">
                        <i class="fa-solid fa-rotate-left"></i>
                    </div>
                    <div class="feature-info">
                        <h4>Easy Return</h4>
                        <p>7 Days Exchange</p>
                    </div>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon-box">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div class="feature-info">
                        <h4>24/7 Support</h4>
                        <p>Live Assistance</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. TOP CATEGORIES -->
    <section class="categories-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <p>Curated Essentials</p>
                <h2>Top <span>Categories</span></h2>
            </div>
            <div class="cat-container">
                @php 
                    $cats = [
                        ['name' => 'Fashion', 'icon' => 'https://cdn-icons-png.flaticon.com/512/3050/3050186.png'],
                        ['name' => 'Watches', 'icon' => 'https://cdn-icons-png.flaticon.com/512/3050/3050230.png'],
                        ['name' => 'Footwear', 'icon' => 'https://cdn-icons-png.flaticon.com/512/3050/3050192.png'],
                        ['name' => 'Bags', 'icon' => 'https://cdn-icons-png.flaticon.com/512/3050/3050236.png']
                    ];
                @endphp
                @foreach($cats as $c)
                <a href="{{ route('shop.all') }}" class="category-box" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="cat-circle">
                        <img src="{{ $c['icon'] }}" alt="{{ $c['name'] }}">
                    </div>
                    <h4>{{ $c['name'] }}</h4>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 4. EDITORIAL BANNER -->
    <section class="editorial-banner">
        <div class="container">
            <div class="editorial-grid">
                <div class="editorial-content" data-aos="fade-right">
                    <span>The Art of Tailoring</span>
                    <h3>Sophisticated Minimalism for the Modern Closet</h3>
                    <p>Zain Boutique crafts silhouettes designed to survive changing fashion cycles. Each piece is constructed using curated fabrics and structural patterns that speak of quiet luxury and premium attention to detail.</p>
                    <a href="{{ route('shop.all') }}" class="btn-lux-primary">View Collection</a>
                </div>
                <div class="editorial-img" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=1200&q=80" alt="Editorial Collection Showcase">
                </div>
            </div>
        </div>
    </section>

    <!-- 5. NEW ARRIVALS GRID -->
    <section class="products-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <p>Our Latest Drops</p>
                <h2>New <span>Arrivals</span></h2>
            </div>

            <div class="product-grid">
                @forelse($product as $item)
                    @php
                        // Check if current user has this product wishlisted
                        $isWishlisted = false;
                        if(auth()->check()) {
                            $isWishlisted = auth()->user()->wishlists->contains('product_id', $item->id);
                        }
                    @endphp
                <div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="p-img-box">
                        <span class="badge-luxury">NEW</span>
                        <div class="p-actions">
                            <!-- Wishlist Toggle Button -->
                            <div class="p-btn" 
                                     onclick="toggleWishlist({{ $item->id }}, this)" 
                                     style="width: 38px; height: 38px; background: white; border-radius: 50%; display: grid; place-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); cursor: pointer; transition: 0.3s; color: {{ $isWishlisted ? 'red' : 'inherit' }};">
                                    <i class="{{ $isWishlisted ? 'fa-solid fas' : 'fa-regular far' }} fa-heart"></i>
                                </div>
                            <a href="{{ route('product.show', $item->slug ?? $item->id) }}" class="p-btn"><i class="fa-solid fa-eye"></i></a>
                        </div>
                        <a href="{{ route('product.show', $item->slug ?? $item->id) }}" style="width: 100%; height: 100%;">
                            <img src="{{ Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}">
                        </a>
                    </div>
                    <div class="p-info">
                        <span class="p-brand">{{ $item->brand ?? 'ZAIN SELECT' }}</span>
                        <a href="{{ route('product.show', $item->slug ?? $item->id) }}" class="p-name">{{ $item->name }}</a>
                        <div class="p-price-row">
                            <span class="curr-price">Rs. {{ number_format($item->price) }}</span>
                            <span class="old-price">Rs. {{ number_format($item->price * 1.3) }}</span>
                        </div>
                        <button type="button" onclick="quickView('{{ $item->slug ?? $item->id }}')" class="home-add-btn">
                            View Product
                        </button>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1/-1; text-align:center; padding:80px 20px; border: 1px dashed var(--light-border);">
                    <p style="color: var(--secondary-neutral);">Check back later for new arrivals.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 6. NEWSLETTER -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-container" data-aos="zoom-in">
                <span class="newsletter-tag">Exclusive Access</span>
                <h2>Join Zain Elite</h2>
                <p>Subscribe to receive early notifications on collections, seasonal private sales, and boutique news. Receive 15% off your initial purchase.</p>
                <form class="newsletter-form" onsubmit="event.preventDefault();">
                    <input type="email" placeholder="Your Premium Email Address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

<script>
    function quickView(slug) {
        window.location.href = "/products/" + slug;
    }

    // Wishlist Toggle Javascript Function
    function toggleWishlist(productId, el) {
        // Meta tag se CSRF token read karne ke liye fallback check
        const csrfToken = document.querySelector('meta[name="csrf-token"]') 
            ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            : '{{ csrf_token() }}';

        fetch("{{ route('wishlist.toggle') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                "Accept": "application/json"
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(res => {
            if (res.status === 401) {
                Swal.fire({
                    icon: 'info',
                    title: 'Login Required',
                    text: 'Please login to add items to your wishlist.',
                    confirmButtonText: 'Login',
                    showCancelButton: true,
                    confirmButtonColor: '#111111',
                    cancelButtonColor: '#8c8276'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('user.login') }}";
                    }
                });
                throw new Error('guest');
            }
            return res.json();
        })
        .then(data => {
            // Heart icon element search
            const icon = el.querySelector('i');
            if (data.status === 'added') {
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
                el.style.color = 'red';
            } else {
                icon.classList.remove('fa-solid');
                icon.classList.add('fa-regular');
                el.style.color = '';
            }

            // Navbar wishlist badge elements safely select & update
            const wishlistBadge = document.getElementById('wishlist-count');
            if (wishlistBadge) {
                wishlistBadge.innerText = data.count;
            }

            Swal.fire({
                icon: 'success',
                title: data.message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500
            });
        })
        .catch(err => {
            if (err.message !== 'guest') {
                console.error('Error toggling wishlist:', err);
            }
        });
    }
</script>
@endsection