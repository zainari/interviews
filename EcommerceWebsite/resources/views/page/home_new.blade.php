@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Home | Zain Store - Premium Boutique')

@section('content')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* =============================================================
       ✅ GLOBAL & RESPONSIVE VARIABLES
    ============================================================== */
    :root {
        --primary: #000;
        --secondary: #64748b;
        --light-bg: #f8fafc;
        --white: #ffffff;
    }

    /* --- HERO SECTION --- */
    .hero { min-height: 70vh; display: flex; align-items: center; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 60px 0; }
    .hero-flex { display: flex; align-items: center; gap: 40px; flex-wrap: wrap; }
    .hero-text { flex: 1; min-width: 300px; }
    .hero-text h1 { font-size: clamp(2rem, 5vw, 4rem); font-weight: 800; line-height: 1.1; margin: 20px 0; }
    .hero-img { flex: 1; min-width: 300px; text-align: center; }
    .hero-img img { width: 100%; max-width: 500px; border-radius: 10px; filter: drop-shadow(10px 10px 30px rgba(0,0,0,0.1)); }

    /* --- FEATURES GRID --- */
    .features-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin: 50px 0; }
    .feature-card { background: #fff; padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; border: 1px solid #eee; transition: 0.3s; }
    .feature-card i { font-size: 25px; color: #000; }
    .feature-card h4 { font-size: 14px; font-weight: 700; margin-bottom: 2px; }
    .feature-card p { font-size: 12px; color: #777; }

    /* --- CATEGORY CIRCLES --- */
    .cat-container { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 40px; }
    .category-box { text-align: center; text-decoration: none; color: inherit; }
    .cat-circle { background: #fff; border-radius: 50%; width: 140px; height: 140px; margin: 0 auto 15px; display: grid; place-items: center; border: 1px solid #eee; transition: 0.4s; overflow: hidden; }
    .cat-circle img { width: 50%; }
    .category-box:hover .cat-circle { transform: translateY(-5px); border-color: #000; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }

    /* --- PRODUCT CARD (Zilbil Style) --- */
    .product-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; }
    .product-card { background: white; border-radius: 8px; overflow: hidden; transition: 0.4s; position: relative; border: 1px solid #f1f5f9; display: flex; flex-direction: column; }
    .product-card:hover { border-color: #000; transform: translateY(-5px); }
    
    .p-img-box { height: 350px; background: #f9f9f9; overflow: hidden; position: relative; }
    .p-img-box img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
    .p-actions { position: absolute; right: 10px; top: 10px; display: flex; flex-direction: column; gap: 8px; z-index: 5; opacity: 0; transition: 0.3s; }
    .product-card:hover .p-actions { opacity: 1; }
    .p-btn { width: 35px; height: 35px; background: #fff; border-radius: 50%; display: grid; place-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); cursor: pointer; color: #000; text-decoration: none; }

    .p-info { padding: 15px; text-align: left; flex-grow: 1; }
    .p-brand { color: #94a3b8; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
    .p-name { font-size: 14px; font-weight: 600; margin: 8px 0; color: #000; text-decoration: none; height: 40px; overflow: hidden; display: block; }
    .p-price-row { display: flex; align-items: baseline; gap: 10px; }
    .curr-price { font-size: 16px; font-weight: 800; }
    .old-price { font-size: 12px; color: #cbd5e1; text-decoration: line-through; }

    .home-add-btn { width: 100%; margin-top: 15px; padding: 12px; background: #000; color: #fff; border: none; border-radius: 4px; font-weight: 700; font-size: 11px; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; }

    /* =============================================================
       📱 MEDIA QUERIES (FULL RESPONSIVE)
    ============================================================== */

    /* For Tablets (up to 1024px) */
    @media (max-width: 1024px) {
        .product-grid { grid-template-columns: repeat(3, 1fr); }
        .features-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* For Small Tablets / Large Phones (up to 768px) */
    @media (max-width: 768px) {
        .hero-flex { flex-direction: column; text-align: center; }
        .hero-text { order: 2; }
        .hero-img { order: 1; }
        .cat-container { grid-template-columns: repeat(2, 1fr); }
        .product-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
        .p-img-box { height: 250px; }
        .hero { padding: 40px 0; }
    }

    /* For Mobile Devices (320px to 480px) */
    @media (max-width: 480px) {
        .container { padding: 0 15px; }
        .hero-text h1 { font-size: 2.2rem; }
        .features-grid { grid-template-columns: 1fr; gap: 10px; }
        .cat-circle { width: 110px; height: 110px; }
        .product-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .p-img-box { height: 200px; }
        .p-info { padding: 10px; }
        .p-name { font-size: 12px; height: 35px; }
        .home-add-btn { font-size: 9px; padding: 10px 5px; }
        .section-header h2 { font-size: 24px; }
    }
</style>

    <!-- 1. HERO SECTION -->
    <section class="hero">
        <div class="container">
            <div class="hero-flex">
                <div class="hero-text" data-aos="fade-up">
                    <span style="color:#000; font-weight:800; letter-spacing:3px; text-transform:uppercase; font-size:12px;">Premium Selection 2025</span>
                    <h1>Luxury Style. <br> <span style="color:#64748b;">Zain Boutique.</span></h1>
                    <p>Discover the finest handcrafted apparel and accessories. Minimalist design meets maximum comfort.</p>
                    <div style="display:flex; gap:15px; margin-top:30px; flex-wrap:wrap; justify-content: inherit;">
                        <a href="{{ route('shop.all') }}" class="btn-luxury" style="padding: 15px 40px; background:#000; color:#fff; text-decoration:none; font-weight:700;">SHOP ALL</a>
                        <a href="{{ route('shop.all') }}" class="btn-luxury" style="padding: 15px 40px; background:#fff; color:#000; border:1px solid #000; text-decoration:none; font-weight:700;">NEW DROPS</a>
                    </div>
                </div>
                <div class="hero-img" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?auto=format&fit=crop&w=800&q=80" alt="Model">
                </div>
            </div>
        </div>
    </section>

    <!-- 2. FEATURES -->
    <section class="container">
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up">
                <i class="fa-solid fa-truck-fast"></i>
                <div>
                    <h4>Fast Shipping</h4>
                    <p>Across Pakistan</p>
                </div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <i class="fa-solid fa-shield-halved"></i>
                <div>
                    <h4>Secure Pay</h4>
                    <p>100% Protected</p>
                </div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <i class="fa-solid fa-rotate-left"></i>
                <div>
                    <h4>Easy Return</h4>
                    <p>7 Days Exchange</p>
                </div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <i class="fa-solid fa-headset"></i>
                <div>
                    <h4>24/7 Support</h4>
                    <p>Live Assistance</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. TOP CATEGORIES -->
    <section style="padding: 60px 0; background: #fafafa;">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 40px;">
                <h2 style="font-size: 28px; font-weight: 800; text-transform: uppercase;">Top Categories</h2>
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
                <a href="{{ route('shop.all') }}" class="category-box">
                    <div class="cat-circle">
                        <img src="{{ $c['icon'] }}" alt="{{ $c['name'] }}">
                    </div>
                    <h4 style="font-size: 13px; font-weight: 700; text-transform: uppercase;">{{ $c['name'] }}</h4>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 4. NEW ARRIVALS GRID -->
    <section style="padding: 80px 0;">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 50px;">
                <p style="color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 11px;">Our Latest Drops</p>
                <h2 style="font-size: 32px; font-weight: 800;">New Arrivals</h2>
            </div>

            <div class="product-grid">
                @forelse($product as $item)
                <div class="product-card" data-aos="fade-up">
                    <div class="p-img-box">
                        <span style="position: absolute; top: 12px; left: 12px; background: #000; color: #fff; padding: 3px 10px; font-size: 9px; font-weight: 800; border-radius: 3px; z-index: 2;">NEW</span>
                        <div class="p-actions">
                            <div class="p-btn"><i class="fa-regular fa-heart"></i></div>
                            <a href="{{ route('product.show', $item->slug ?? $item->id) }}" class="p-btn"><i class="fa-solid fa-eye"></i></a>
                        </div>
                        <a href="{{ route('product.show', $item->slug ?? $item->id) }}">
                            <img src="{{ Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}">
                        </a>
                    </div>
                    <div class="p-info">
                        <span class="p-brand">{{ $item->brand ?? 'ELITE SELECT' }}</span>
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
                <div style="grid-column: 1/-1; text-align:center; padding:50px;">
                    <h3>Check back later for new stock!</h3>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. NEWSLETTER -->
    <section style="padding: 80px 0; background: #000; color: #fff;">
        <div class="container" style="text-align: center;">
            <h2 style="font-size: 28px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px;">Join Zain Elite</h2>
            <p style="margin: 20px 0 40px; opacity: 0.7; font-size: 15px;">Get 15% off on your first order. No spam, just style.</p>
            <form style="display: flex; gap: 10px; max-width: 500px; margin: auto; flex-wrap: wrap;">
                <input type="email" placeholder="Email Address" style="flex: 1; padding: 15px; border-radius: 4px; border: none; outline: none; min-width: 250px;">
                <button style="padding: 15px 40px; background: #fff; color: #000; border: none; font-weight: 800; cursor: pointer; text-transform: uppercase;">Subscribe</button>
            </form>
        </div>
    </section>

<script>
    function quickView(slug) {
        window.location.href = "/products/" + slug;
    }
</script>
@endsection