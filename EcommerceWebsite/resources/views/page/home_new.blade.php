@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Wasaaz — Statement Streetwear')

@section('content')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --wasaaz-bg: #0a0a0a;
        --wasaaz-card: #111111;
        --wasaaz-elevated: #161616;
        --wasaaz-border: #1f1f1f;
        --wasaaz-text: #ffffff;
        --wasaaz-muted: #888888;
        --wasaaz-accent: #7a1f2a;
        --wasaaz-gold: #c9a86c;
        --transition-smooth: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* Header overrides for dark home */
    #mainHeader { background: transparent !important; border-bottom-color: rgba(255,255,255,0.1) !important; }
    #mainHeader.scrolled { background: var(--white) !important; border-bottom-color: var(--border) !important; box-shadow: var(--shadow-md) !important; }
    #mainHeader .logo-box { color: var(--wasaaz-text) !important; }
    #mainHeader.scrolled .logo-box { color: var(--primary) !important; }
    #mainHeader .icon-box { color: var(--wasaaz-text); }
    #mainHeader.scrolled .icon-box { color: var(--primary); }
    #mainHeader .icon-box:hover { background: rgba(255,255,255,0.1); }
    #mainHeader.scrolled .icon-box:hover { background: var(--light); }
    #mainHeader .search-bar form { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); }
    #mainHeader.scrolled .search-bar form { background: var(--light); border-color: var(--border); }
    #mainHeader .search-bar input { color: var(--wasaaz-text); }
    #mainHeader.scrolled .search-bar input { color: var(--primary); }
    #mainHeader .search-bar input::placeholder { color: rgba(255,255,255,0.6); }
    #mainHeader.scrolled .search-bar input::placeholder { color: var(--muted); }
    #mainHeader .search-bar button { color: var(--wasaaz-text); }
    #mainHeader.scrolled .search-bar button { color: var(--secondary); }
    #mainHeader .mobile-toggle { color: var(--wasaaz-text); }
    #mainHeader.scrolled .mobile-toggle { color: var(--primary); }
    .bottom-nav { background: transparent; border-bottom-color: rgba(255,255,255,0.1); }
    .bottom-nav .nav-menu li a { color: rgba(255,255,255,0.8); }
    .bottom-nav .nav-menu li a:hover { color: var(--wasaaz-text); }
    .bottom-nav .nav-menu li a::after { background: var(--wasaaz-text); }

    /* HERO */
    .hero {
        min-height: 100vh;
        background: var(--wasaaz-bg);
        margin-top: -130px;
        padding-top: 190px;
        padding-bottom: 80px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        z-index: 1;
    }
    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }
    .hero-bg::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 30%, rgba(122,31,42,0.15) 0%, rgba(0,0,0,0) 60%);
    }
    .hero-flex {
        display: grid;
        grid-template-columns: 1fr 1.2fr 1fr;
        gap: 20px;
        align-items: center;
        position: relative;
        z-index: 2;
    }
    .hero-img {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .hero-img img {
        max-height: 72vh;
        width: auto;
        object-fit: contain;
        transition: var(--transition-smooth);
    }
    .hero-text {
        text-align: center;
        z-index: 3;
    }
    .hero-pretitle {
        display: block;
        color: var(--wasaaz-gold);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }
    .hero-text h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(3.5rem, 8vw, 7rem);
        font-weight: 600;
        line-height: 0.95;
        color: var(--wasaaz-text);
        letter-spacing: -2px;
        margin-bottom: 22px;
    }
    .hero-text h1 span { color: var(--wasaaz-accent); font-weight: 700; }
    .hero-text p {
        font-size: 16px;
        color: var(--wasaaz-muted);
        max-width: 420px;
        margin: 0 auto 35px;
        line-height: 1.7;
    }
    .hero-cta {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .btn-wasaaz {
        padding: 17px 42px;
        background: var(--wasaaz-text);
        color: var(--wasaaz-bg);
        text-decoration: none;
        font-weight: 800;
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
        border: 1px solid var(--wasaaz-text);
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-wasaaz:hover {
        background: transparent;
        color: var(--wasaaz-text);
    }
    .btn-wasaaz-outline {
        padding: 17px 42px;
        background: transparent;
        color: var(--wasaaz-text);
        border: 1px solid var(--wasaaz-text);
        text-decoration: none;
        font-weight: 800;
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-wasaaz-outline:hover {
        background: var(--wasaaz-text);
        color: var(--wasaaz-bg);
    }

    /* SCROLL MARQUEE */
    .marquee-section {
        background: var(--wasaaz-card);
        border-top: 1px solid var(--wasaaz-border);
        border-bottom: 1px solid var(--wasaaz-border);
        padding: 22px 0;
        overflow: hidden;
    }
    .marquee-track {
        display: flex;
        width: fit-content;
        animation: marquee 25s linear infinite;
    }
    .marquee-item {
        font-family: 'Playfair Display', serif;
        font-size: clamp(24px, 4vw, 42px);
        font-weight: 600;
        color: var(--wasaaz-text);
        white-space: nowrap;
        padding: 0 40px;
        display: flex;
        align-items: center;
        gap: 40px;
    }
    .marquee-item i { color: var(--wasaaz-accent); font-size: 14px; }
    @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }

    /* BRAND STORY */
    .story-section {
        background: var(--wasaaz-bg);
        padding: 120px 0;
    }
    .story-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }
    .story-img img {
        width: 100%;
        max-height: 640px;
        object-fit: contain;
    }
    .story-content span {
        color: var(--wasaaz-gold);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 16px;
    }
    .story-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(32px, 4vw, 48px);
        color: var(--wasaaz-text);
        margin-bottom: 24px;
        line-height: 1.1;
    }
    .story-content p {
        color: var(--wasaaz-muted);
        font-size: 15px;
        line-height: 1.9;
        margin-bottom: 18px;
    }
    .story-content .accent-line {
        width: 60px;
        height: 2px;
        background: var(--wasaaz-accent);
        margin-bottom: 22px;
    }

    /* FEATURES */
    .features-section {
        background: var(--wasaaz-card);
        border-top: 1px solid var(--wasaaz-border);
        border-bottom: 1px solid var(--wasaaz-border);
        padding: 60px 0;
    }
    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }
    .feature-card {
        display: flex;
        align-items: center;
        gap: 18px;
    }
    .feature-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: var(--wasaaz-elevated);
        display: grid;
        place-items: center;
        flex-shrink: 0;
        border: 1px solid var(--wasaaz-border);
    }
    .feature-card i { font-size: 18px; color: var(--wasaaz-accent); }
    .feature-info h4 { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; color: var(--wasaaz-text); }
    .feature-info p { font-size: 12px; color: var(--wasaaz-muted); }

    /* CATEGORIES */
    .categories-section {
        padding: 120px 0;
        background: var(--wasaaz-bg);
    }
    .section-header { text-align: center; margin-bottom: 60px; }
    .section-header p { color: var(--wasaaz-gold); font-weight: 700; text-transform: uppercase; letter-spacing: 3px; font-size: 11px; margin-bottom: 10px; }
    .section-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 4vw, 40px);
        color: var(--wasaaz-text);
        letter-spacing: -0.5px;
    }
    .cat-container { display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; }
    .category-box {
        text-align: center;
        text-decoration: none;
        color: inherit;
        display: block;
        position: relative;
    }
    .cat-circle {
        background: var(--wasaaz-card);
        border-radius: 50%;
        width: 170px;
        height: 170px;
        margin: 0 auto 20px;
        display: grid;
        place-items: center;
        border: 1px solid var(--wasaaz-border);
        transition: var(--transition-smooth);
        overflow: hidden;
    }
    .cat-circle i { font-size: 40px; color: var(--wasaaz-text); transition: var(--transition-smooth); }
    .category-box:hover .cat-circle { transform: translateY(-8px); border-color: var(--wasaaz-accent); box-shadow: 0 20px 40px rgba(122,31,42,0.15); }
    .category-box:hover .cat-circle i { color: var(--wasaaz-accent); transform: scale(1.1); }
    .category-box h4 { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: var(--wasaaz-text); }

    /* PRODUCTS */
    .products-section {
        padding: 120px 0;
        background: var(--wasaaz-bg);
    }
    .products-section .section-header h2 span { color: var(--wasaaz-accent); font-weight: 700; }
    .product-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; }
    .product-card {
        background: var(--wasaaz-card);
        border: 1px solid var(--wasaaz-border);
        overflow: hidden;
        transition: var(--transition-smooth);
        position: relative;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover { border-color: var(--wasaaz-accent); box-shadow: 0 20px 40px rgba(0,0,0,0.4); transform: translateY(-5px); }
    .p-img-box {
        height: clamp(280px, 30vw, 420px);
        background: var(--wasaaz-elevated);
        overflow: hidden;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .p-img-box img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
    .product-card:hover .p-img-box img { transform: scale(1.05); }
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
    .product-card:hover .p-actions { opacity: 1; transform: translateY(0); }
    @media (max-width: 768px) { .p-actions { opacity: 1; transform: translateY(0); } }
    .p-btn {
        width: 40px;
        height: 40px;
        background: var(--wasaaz-card);
        border: 1px solid var(--wasaaz-border);
        border-radius: 50%;
        display: grid;
        place-items: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        cursor: pointer;
        color: var(--wasaaz-text);
        text-decoration: none;
        transition: var(--transition-smooth);
    }
    .p-btn:hover { background: var(--wasaaz-accent); color: var(--wasaaz-text); border-color: var(--wasaaz-accent); }
    .badge-luxury {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--wasaaz-accent);
        color: var(--wasaaz-text);
        padding: 5px 12px;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        z-index: 2;
    }
    .p-info { padding: 24px 20px; text-align: center; flex-grow: 1; display: flex; flex-direction: column; }
    .p-brand { color: var(--wasaaz-gold); font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px; }
    .p-name { font-size: 15px; font-weight: 400; margin-bottom: 12px; color: var(--wasaaz-text); text-decoration: none; height: 44px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.4; }
    .p-price-row { display: flex; align-items: baseline; justify-content: center; gap: 12px; margin-top: auto; margin-bottom: 20px; }
    .curr-price { font-size: 16px; font-weight: 700; color: var(--wasaaz-text); }
    .old-price { font-size: 13px; color: var(--wasaaz-muted); text-decoration: line-through; opacity: 0.6; }
    .home-add-btn {
        width: 100%;
        padding: 15px;
        background: transparent;
        color: var(--wasaaz-text);
        border: 1px solid var(--wasaaz-text);
        font-weight: 700;
        font-size: 11px;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: var(--transition-smooth);
    }
    .product-card:hover .home-add-btn { background: var(--wasaaz-text); color: var(--wasaaz-bg); }

    /* NEWSLETTER */
    .newsletter-section {
        padding: 120px 0;
        background: var(--wasaaz-card);
        border-top: 1px solid var(--wasaaz-border);
        position: relative;
    }
    .newsletter-container { max-width: 650px; margin: 0 auto; text-align: center; }
    .newsletter-tag { color: var(--wasaaz-gold); font-weight: 700; letter-spacing: 4px; text-transform: uppercase; font-size: 11px; display: block; margin-bottom: 20px; }
    .newsletter-container h2 { font-family: 'Playfair Display', serif; font-size: 40px; font-weight: 500; color: var(--wasaaz-text); margin-bottom: 20px; }
    .newsletter-container p { color: var(--wasaaz-muted); font-size: 15px; line-height: 1.8; margin-bottom: 45px; }
    .newsletter-form { display: flex; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px; }
    .newsletter-form:focus-within { border-color: var(--wasaaz-text); }
    .newsletter-form input { flex: 1; background: transparent; border: none; outline: none; color: var(--wasaaz-text); padding: 10px 0; font-size: 15px; }
    .newsletter-form input::placeholder { color: rgba(255,255,255,0.4); }
    .newsletter-form button { background: transparent; color: var(--wasaaz-text); border: none; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 12px; cursor: pointer; }
    .newsletter-form button:hover { color: var(--wasaaz-gold); }

    /* RESPONSIVE */
    @media (max-width: 1200px) {
        .hero-flex { grid-template-columns: 1fr 1.2fr 1fr; }
        .product-grid { grid-template-columns: repeat(3, 1fr); }
        .cat-container { gap: 20px; }
        .hero-img img { max-height: 60vh; }
    }
    @media (max-width: 991px) {
        .hero-flex { grid-template-columns: 1fr; text-align: center; }
        .hero-img { order: 1; }
        .hero-img img { max-height: 55vh; }
        .hero-text { order: 2; margin-top: 30px; }
        .hero-text p { margin: 0 auto 30px; }
        .features-grid { grid-template-columns: repeat(2, 1fr); }
        .cat-container { grid-template-columns: repeat(2, 1fr); }
        .story-grid { grid-template-columns: 1fr; gap: 45px; }
        .product-grid { grid-template-columns: repeat(2, 1fr); }
        .story-img { order: 1; }
        .story-content { order: 2; }
    }
    @media (max-width: 768px) {
        .hero { padding-top: 160px; }
        .hero-img img { max-height: 45vh; }
        .section-header h2 { font-size: 28px; }
        .newsletter-container h2 { font-size: 32px; }
        .cat-container { gap: 20px; }
    }
    @media (max-width: 480px) {
        .features-grid { grid-template-columns: 1fr; }
        .cat-circle { width: 140px; height: 140px; }
        .product-grid { grid-template-columns: 1fr; }
        .p-img-box { height: 320px; }
        .newsletter-form { flex-direction: column; gap: 15px; border-bottom: none; }
        .newsletter-form input { border-bottom: 1px solid rgba(255,255,255,0.2); text-align: center; padding-bottom: 15px; }
    }
</style>

<!-- 1. HERO SECTION -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-flex">
            <div class="hero-img" data-aos="fade-right">
                <img src="{{ asset('img/brandimage.png') }}" alt="Wasaaz Black Drop">
            </div>
            <div class="hero-text" data-aos="fade-up">
                <span class="hero-pretitle">New Collection 2025</span>
                <h1>WASA<span>AZ</span></h1>
                <p>Threaded with meaning. Worn with pride. A statement of identity, culture, and contemporary streetwear.</p>
                <div class="hero-cta">
                    <a href="{{ route('shop.all') }}" class="btn-wasaaz">Shop the Drop</a>
                    <a href="{{ route('shop.all') }}" class="btn-wasaaz-outline">View Lookbook</a>
                </div>
            </div>
            <div class="hero-img" data-aos="fade-left">
                <img src="{{ asset('img/brandimage1.png') }}" alt="Wasaaz Maroon Drop">
            </div>
        </div>
    </div>
</section>

<!-- 2. SCROLL MARQUEE -->
<section class="marquee-section" data-aos="fade-in">
    <div class="marquee-track">
        <div class="marquee-item">Wasaaz <i class="fas fa-times"></i></div>
        <div class="marquee-item">Wear the Culture <i class="fas fa-times"></i></div>
        <div class="marquee-item">Threaded with Meaning <i class="fas fa-times"></i></div>
        <div class="marquee-item">Own the Statement <i class="fas fa-times"></i></div>
        <div class="marquee-item">Wasaaz <i class="fas fa-times"></i></div>
        <div class="marquee-item">Wear the Culture <i class="fas fa-times"></i></div>
        <div class="marquee-item">Threaded with Meaning <i class="fas fa-times"></i></div>
        <div class="marquee-item">Own the Statement <i class="fas fa-times"></i></div>
    </div>
</section>

<!-- 3. BRAND STORY -->
<section class="story-section">
    <div class="container">
        <div class="story-grid">
            <div class="story-img" data-aos="fade-right">
                <img src="{{ asset('img/brandimage1.png') }}" alt="Wasaaz Craft">
            </div>
            <div class="story-content" data-aos="fade-left">
                <div class="accent-line"></div>
                <span>Rooted in Identity</span>
                <h2>Wear Your Story</h2>
                <p>Wasaaz is more than a clothing label — it is a canvas for self-expression. Every piece is designed around the idea that what you wear should speak before you do.</p>
                <p>From hand-drawn calligraphy to carefully sourced fabrics, each drop reflects a blend of cultural heritage and modern streetwear. We create garments that carry meaning, spark conversation, and feel like an extension of you.</p>
                <a href="{{ url('/aboutpage') }}" class="btn-wasaaz-outline">Read Our Story</a>
            </div>
        </div>
    </div>
</section>

<!-- 4. FEATURES -->
<section class="features-section">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up">
                <div class="feature-icon-box"><i class="fa-solid fa-truck-fast"></i></div>
                <div class="feature-info"><h4>Fast Shipping</h4><p>Across Pakistan</p></div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon-box"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="feature-info"><h4>Secure Pay</h4><p>100% Protected</p></div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon-box"><i class="fa-solid fa-rotate-left"></i></div>
                <div class="feature-info"><h4>Easy Return</h4><p>7 Days Exchange</p></div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon-box"><i class="fa-solid fa-headset"></i></div>
                <div class="feature-info"><h4>24/7 Support</h4><p>Live Assistance</p></div>
            </div>
        </div>
    </div>
</section>

<!-- 5. TOP CATEGORIES -->
<section class="categories-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <p>Curated Essentials</p>
            <h2>Explore the <span style="color: var(--wasaaz-accent); font-weight: 700;">Drop</span></h2>
        </div>
        <div class="cat-container">
            @php $cats = [
                ['name' => 'Fashion', 'icon' => 'fa-shirt'],
                ['name' => 'Watches', 'icon' => 'fa-clock'],
                ['name' => 'Footwear', 'icon' => 'fa-shoe-prints'],
                ['name' => 'Bags', 'icon' => 'fa-bag-shopping']
            ]; @endphp
            @foreach($cats as $c)
            <a href="{{ route('shop.all') }}" class="category-box" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="cat-circle"><i class="fa-solid {{ $c['icon'] }}"></i></div>
                <h4>{{ $c['name'] }}</h4>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- 6. NEW ARRIVALS GRID -->
<section class="products-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <p>Our Latest Drops</p>
            <h2>New <span>Arrivals</span></h2>
        </div>

        <div class="product-grid">
            @forelse($product as $item)
                @php
                    $isWishlisted = false;
                    if(auth()->check()) {
                        $isWishlisted = auth()->user()->wishlists->contains('product_id', $item->id);
                    }
                @endphp
            <div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->index % 8 * 50 }}">
                <div class="p-img-box">
                    <span class="badge-luxury">NEW</span>
                    <div class="p-actions">
                        <div class="p-btn" onclick="toggleWishlist({{ $item->id }}, this)" style="color: {{ $isWishlisted ? 'red' : 'inherit' }};">
                            <i class="{{ $isWishlisted ? 'fa-solid fas' : 'fa-regular far' }} fa-heart"></i>
                        </div>
                        <a href="{{ route('product.show', $item->slug ?? $item->id) }}" class="p-btn"><i class="fa-solid fa-eye"></i></a>
                    </div>
                    <a href="{{ route('product.show', $item->slug ?? $item->id) }}" style="width: 100%; height: 100%;">
                        <img src="{{ Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}">
                    </a>
                </div>
                <div class="p-info">
                    <span class="p-brand">{{ $item->brand ?? 'WASA SELECT' }}</span>
                    <a href="{{ route('product.show', $item->slug ?? $item->id) }}" class="p-name">{{ $item->name }}</a>
                    <div class="p-price-row">
                        <span class="curr-price">Rs. {{ number_format($item->price) }}</span>
                        <span class="old-price">Rs. {{ number_format($item->price * 1.3) }}</span>
                    </div>
                    <button type="button" onclick="quickView('{{ $item->slug ?? $item->id }}')" class="home-add-btn">View Product</button>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align:center; padding:80px 20px; border: 1px dashed var(--wasaaz-border);">
                <p style="color: var(--wasaaz-muted);">Check back later for new arrivals.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 7. NEWSLETTER -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-container" data-aos="zoom-in">
            <span class="newsletter-tag">Inner Circle</span>
            <h2>Join the Wasaaz Family</h2>
            <p>Be the first to know about new drops, limited editions, and exclusive member-only releases.</p>
            <form class="newsletter-form" onsubmit="event.preventDefault();">
                <input type="email" placeholder="Your email address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<script>
    function quickView(slug) {
        window.location.href = "/products/" + slug;
    }
</script>
@endsection
