@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Home | Zain Store - Premium Boutique')

@section('content')

    <!-- =============================================================
        1. HERO SLIDER SECTION
    ============================================================== -->
    <section class="hero" style="position: relative; overflow: hidden; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 100px 0;">
        <div class="container">
            <div class="hero-flex" style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap;">
                <div class="hero-text" data-aos="fade-right" style="flex: 1; min-width: 300px;">
                    <span style="color:var(--primary); font-weight:800; letter-spacing:4px; text-transform:uppercase; font-size:14px; display: block; margin-bottom: 20px;">
                        Luxury Collection 2025
                    </span>
                    <h1 style="font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 800; line-height: 1.1; margin-bottom: 25px; color: var(--dark);">
                        Elegance in Every <br> <span style="color: var(--primary);">Stitch & Detail.</span>
                    </h1>
                    <p style="font-size: 18px; color: var(--secondary); margin-bottom: 40px; max-width: 600px; line-height: 1.8;">
                        Discover our curated selection of high-end fashion and lifestyle essentials. Handcrafted quality meets modern aesthetics.
                    </p>
                    <div style="display:flex; gap:20px; flex-wrap:wrap;">
                        <a href="{{ route('shop.all') }}" class="btn-luxury" style="padding: 20px 50px; background:var(--dark); color:white; font-weight:700; text-decoration:none; border-radius:4px; transition: 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                            SHOP COLLECTION
                        </a>
                        <a href="{{ route('shop.all') }}" class="btn-luxury" style="padding: 20px 50px; background:white; color:var(--dark); font-weight:700; border:1px solid #ddd; text-decoration:none; border-radius:4px; transition: 0.3s;">
                            VIEW OFFERS
                        </a>
                    </div>
                </div>
                <div class="hero-img" data-aos="zoom-in" data-aos-duration="1500" style="flex: 1; min-width: 300px; text-align: right;">
                    <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?auto=format&fit=crop&w=800&q=80" 
                         alt="New Arrival Model" 
                         style="width: 100%; max-width: 550px; border-radius: 20px; box-shadow: 20px 20px 60px rgba(0,0,0,0.15); transform: rotate(-2deg);">
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
        2. FEATURES BADGES (Trust Builders)
    ============================================================== -->
    <section style="background: white; padding: 60px 0; border-bottom: 1px solid #eee;">
        <div class="container">
            <div class="features-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                <div class="feature-card" data-aos="fade-up" style="display: flex; align-items: center; gap: 20px; padding: 20px; background: #fafafa; border-radius: 12px;">
                    <i class="fas fa-truck-fast" style="font-size: 30px; color: var(--primary);"></i>
                    <div>
                        <h4 style="font-weight: 700; font-size: 16px; margin-bottom: 5px;">Express Delivery</h4>
                        <p style="font-size: 13px; color: #777;">Worldwide in 3-5 business days</p>
                    </div>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100" style="display: flex; align-items: center; gap: 20px; padding: 20px; background: #fafafa; border-radius: 12px;">
                    <i class="fas fa-shield-check" style="font-size: 30px; color: var(--primary);"></i>
                    <div>
                        <h4 style="font-weight: 700; font-size: 16px; margin-bottom: 5px;">Secure Checkout</h4>
                        <p style="font-size: 13px; color: #777;">100% Encrypted SSL Payments</p>
                    </div>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200" style="display: flex; align-items: center; gap: 20px; padding: 20px; background: #fafafa; border-radius: 12px;">
                    <i class="fas fa-comments-alt-dollar" style="font-size: 30px; color: var(--primary);"></i>
                    <div>
                        <h4 style="font-weight: 700; font-size: 16px; margin-bottom: 5px;">Easy Returns</h4>
                        <p style="font-size: 13px; color: #777;">30 Days hassle-free exchange</p>
                    </div>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300" style="display: flex; align-items: center; gap: 20px; padding: 20px; background: #fafafa; border-radius: 12px;">
                    <i class="fas fa-headset" style="font-size: 30px; color: var(--primary);"></i>
                    <div>
                        <h4 style="font-weight: 700; font-size: 16px; margin-bottom: 5px;">24/7 Support</h4>
                        <p style="font-size: 13px; color: #777;">Expert help whenever you need it</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
        3. FEATURED CATEGORIES SECTION
    ============================================================== -->
    <section class="section-padding" style="padding: 100px 0;">
        <div class="container">
            <div class="section-header" data-aos="fade-up" style="text-align: center; margin-bottom: 60px;">
                <p style="color:var(--secondary); font-weight:700; letter-spacing:3px; margin-bottom:15px; text-transform:uppercase;">Browse our Universe</p>
                <h2 style="font-size: 36px; font-weight: 800;">Top Categories</h2>
            </div>
            
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:30px; margin-top:40px;">
                <a href="{{ route('shop.all') }}" class="category-box" style="text-align:center; text-decoration: none; color: inherit; group;" data-aos="zoom-in">
                    <div style="background:#f1f5f9; border-radius:50%; width:180px; height:180px; margin:0 auto 20px; display:grid; place-items:center; transition:0.5s; overflow:hidden; border: 1px solid #eee;">
                        <img src="https://cdn-icons-png.flaticon.com/512/3050/3050230.png" style="width:50%;" alt="Electronics">
                    </div>
                    <h4 style="font-weight:700; text-transform: uppercase; letter-spacing: 1px;">Electronics</h4>
                </a>
                <a href="{{ route('shop.all') }}" class="category-box" style="text-align:center; text-decoration: none; color: inherit;" data-aos="zoom-in" data-aos-delay="100">
                    <div style="background:#f1f5f9; border-radius:50%; width:180px; height:180px; margin:0 auto 20px; display:grid; place-items:center; transition:0.5s; overflow:hidden; border: 1px solid #eee;">
                        <img src="https://cdn-icons-png.flaticon.com/512/3050/3050186.png" style="width:50%;" alt="Fashion">
                    </div>
                    <h4 style="font-weight:700; text-transform: uppercase; letter-spacing: 1px;">Fashion</h4>
                </a>
                <a href="{{ route('shop.all') }}" class="category-box" style="text-align:center; text-decoration: none; color: inherit;" data-aos="zoom-in" data-aos-delay="200">
                    <div style="background:#f1f5f9; border-radius:50%; width:180px; height:180px; margin:0 auto 20px; display:grid; place-items:center; transition:0.5s; overflow:hidden; border: 1px solid #eee;">
                        <img src="https://cdn-icons-png.flaticon.com/512/3050/3050236.png" style="width:50%;" alt="Cosmetics">
                    </div>
                    <h4 style="font-weight:700; text-transform: uppercase; letter-spacing: 1px;">Cosmetics</h4>
                </a>
                <a href="{{ route('shop.all') }}" class="category-box" style="text-align:center; text-decoration: none; color: inherit;" data-aos="zoom-in" data-aos-delay="300">
                    <div style="background:#f1f5f9; border-radius:50%; width:180px; height:180px; margin:0 auto 20px; display:grid; place-items:center; transition:0.5s; overflow:hidden; border: 1px solid #eee;">
                        <img src="https://cdn-icons-png.flaticon.com/512/3050/3050192.png" style="width:50%;" alt="Footwear">
                    </div>
                    <h4 style="font-weight:700; text-transform: uppercase; letter-spacing: 1px;">Footwear</h4>
                </a>
            </div>
        </div>
    </section>

    <!-- =============================================================
        4. FLASH SALE WITH TIMER
    ============================================================== -->
    <section class="container" style="margin-bottom:100px;">
        <div style="background: #0f172a; border-radius: 30px; padding: 60px; color: white; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 40px;" data-aos="fade-up">
            <div style="flex: 1; min-width: 300px;">
                <h2 style="font-size:40px; font-weight:800; margin-bottom:15px; letter-spacing: -1px;">
                    <i class="fas fa-bolt" style="color:var(--accent); margin-right: 10px;"></i> FLASH SALE
                </h2>
                <p style="font-size: 18px; opacity:0.8; line-height: 1.6;">Get an exclusive 25% discount on all premium watches and electronics for the next 24 hours only.</p>
            </div>
            <div style="display:flex; gap:20px; flex-wrap: wrap;">
                <div style="background:rgba(255,255,255,0.08); padding:20px; border-radius:15px; text-align:center; min-width:100px; border: 1px solid rgba(255,255,255,0.1);">
                    <h3 style="font-size:32px; font-weight: 800;">12</h3><span style="font-size:11px; opacity:0.6; text-transform:uppercase; font-weight: 700;">Hours</span>
                </div>
                <div style="background:rgba(255,255,255,0.08); padding:20px; border-radius:15px; text-align:center; min-width:100px; border: 1px solid rgba(255,255,255,0.1);">
                    <h3 style="font-size:32px; font-weight: 800;">45</h3><span style="font-size:11px; opacity:0.6; text-transform:uppercase; font-weight: 700;">Mins</span>
                </div>
                <div style="background:rgba(255,255,255,0.08); padding:20px; border-radius:15px; text-align:center; min-width:100px; border: 1px solid rgba(255,255,255,0.1);">
                    <h3 style="font-size:32px; font-weight: 800;">30</h3><span style="font-size:11px; opacity:0.6; text-transform:uppercase; font-weight: 700;">Secs</span>
                </div>
            </div>
            <div style="text-align: right;">
                <a href="{{ route('shop.all') }}" class="btn-luxury" style="background:var(--primary); color:white; padding:18px 45px; border-radius:12px; font-weight: 800; text-decoration: none; display: inline-block;">
                    EXPLORE DEALS
                </a>
            </div>
        </div>
    </section>

    <!-- =============================================================
        5. MAIN PRODUCTS GRID (NEW ARRIVALS)
    ============================================================== -->
    <section class="section-padding" id="shop" style="padding-bottom: 100px;">
        <div class="container">
            <div class="section-header" data-aos="fade-up" style="text-align: center; margin-bottom: 60px;">
                <p style="color:var(--primary); font-weight:800; letter-spacing:4px; margin-bottom:15px; text-transform:uppercase;">Handpicked Selection</p>
                <h2 style="font-size: 40px; font-weight: 800;">New Arrivals</h2>
            </div>

            <div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
                @forelse($product as $item)
                <div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}" style="background: white; border-radius: 15px; overflow: hidden; transition: 0.4s; position: relative; border: 1px solid #eee;">
                    <span class="badge-sale" style="position: absolute; top: 15px; left: 15px; background: #000; color: #fff; padding: 4px 12px; font-size: 10px; font-weight: 800; border-radius: 4px; z-index: 5;">NEW</span>
                    <div class="p-actions" style="position: absolute; right: 15px; top: 15px; display: flex; flex-direction: column; gap: 8px; z-index: 5;">
                        <div class="p-btn" style="width: 40px; height: 40px; background: white; border-radius: 50%; display: grid; place-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); cursor: pointer;"><i class="far fa-heart"></i></div>
                        <a href="{{ route('product.show', $item->slug ?? $item->id) }}" class="p-btn" style="width: 40px; height: 40px; background: white; border-radius: 50%; display: grid; place-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); color: inherit; text-decoration: none;"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="p-img-box" style="height: 350px; background: #f9f9f9; overflow: hidden;">
                        <a href="{{ route('product.show', $item->slug ?? $item->id) }}">
                            <img src="{{ Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" 
                                 alt="{{ $item->name }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; transition: 0.6s;">
                        </a>
                    </div>
                    <div class="p-info" style="padding: 25px; text-align: left;">
                        <p style="color:var(--secondary); font-size:11px; margin-bottom:8px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">{{ $item->brand ?? 'ELITE SELECT' }}</p>
                        <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 12px; height: 20px; overflow: hidden;">{{ $item->name }}</h3>
                        <div class="p-price-row" style="display: flex; align-items: center; justify-content: space-between;">
                            <div class="p-price" style="font-size: 20px; font-weight: 800; color: #000;">
                                Rs. {{ number_format($item->price) }}
                                <span style="font-size: 13px; color: #bbb; text-decoration: line-through; font-weight: 400; margin-left: 10px;">Rs. {{ number_format($item->price * 1.3) }}</span>
                            </div>
                        </div>
                        {{-- FIX: Dynamic Slug-based details link --}}
                        <button onclick="window.location.href='{{ route('product.show', $item->slug ?? $item->id) }}'" 
                                class="add-cart-btn" 
                                style="width: 100%; margin-top: 20px; padding: 14px; background: #000; color: #fff; border: none; border-radius: 6px; font-weight: 700; text-transform: uppercase; font-size: 12px; cursor: pointer; letter-spacing: 1px; transition: 0.3s;">
                            VIEW PRODUCT
                        </button>                    
                    </div>
                </div>
                @empty
                <div style="grid-column: 1/-1; text-align:center; padding:100px;">
                    <h3 style="opacity:0.3; font-weight: 800; font-size: 24px;">NO PRODUCTS IN STOCK</h3>
                    <p style="color: #999;">Check back later for our new collection.</p>
                </div>
                @endforelse
            </div>
            
            <div style="text-align:center; margin-top:80px;">
                <a href="{{ route('shop.all') }}" style="padding:18px 60px; border:2px solid #000; font-weight:800; background:none; color: #000; text-decoration: none; border-radius: 4px; transition: 0.3s;">
                    VIEW ALL PRODUCTS
                </a>
            </div>
        </div>
    </section>

    <!-- =============================================================
        6. WHY CHOOSE US (TRUST SECTION)
    ============================================================== -->
    <section class="section-padding" style="background:#fcfcfc; padding: 100px 0; border-top: 1px solid #eee;">
        <div class="container">
            <div class="footer-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 50px; text-align:center;">
                <div data-aos="fade-up">
                    <img src="https://cdn-icons-png.flaticon.com/512/1162/1162456.png" style="width:70px; margin-bottom:25px;" alt="Quality">
                    <h4 style="margin-bottom:15px; font-weight: 800; text-transform: uppercase; font-size: 16px;">Premium Quality</h4>
                    <p style="font-size:14px; color: #777; line-height: 1.7;">We partner only with the world's most prestigious manufacturers to ensure longevity and style.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="100">
                    <img src="https://cdn-icons-png.flaticon.com/512/2821/2821785.png" style="width:70px; margin-bottom:25px;" alt="Eco">
                    <h4 style="margin-bottom:15px; font-weight: 800; text-transform: uppercase; font-size: 16px;">Sustainability</h4>
                    <p style="font-size:14px; color: #777; line-height: 1.7;">Our mission is to reduce environmental impact through ethical sourcing and recyclable packaging.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <img src="https://cdn-icons-png.flaticon.com/512/3503/3503194.png" style="width:70px; margin-bottom:25px;" alt="Secure">
                    <h4 style="margin-bottom:15px; font-weight: 800; text-transform: uppercase; font-size: 16px;">Encrypted Data</h4>
                    <p style="font-size:14px; color: #777; line-height: 1.7;">Your privacy is our priority. All transactions and personal data are protected by bank-level encryption.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
        7. NEWSLETTER SECTION
    ============================================================== -->
    <section class="newsletter-section" style="padding: 100px 0;">
        <div class="container">
            <div class="newsletter-card" data-aos="zoom-in" style="background: #000; padding: 80px 40px; border-radius: 30px; color: white; text-align: center; position: relative; overflow: hidden;">
                <h2 style="font-size:38px; font-weight:800; margin-bottom:20px; text-transform: uppercase; letter-spacing: 2px;">Join The Elite</h2>
                <p style="font-size: 18px; margin-bottom: 40px; opacity:0.8; max-width: 600px; margin-left: auto; margin-right: auto;">Subscribe today and receive an instant 20% discount voucher for your next luxury purchase.</p>
                <form class="newsletter-form" style="display: flex; gap: 15px; max-width: 550px; margin: auto; flex-wrap: wrap;">
                    <input type="email" placeholder="Your premium email address..." style="flex: 1; padding: 20px 25px; border-radius: 8px; border: none; outline: none; font-size: 15px; min-width: 250px;">
                    <button style="padding: 20px 40px; background: white; color: black; border: none; font-weight: 800; border-radius: 8px; cursor: pointer; text-transform: uppercase; transition: 0.3s;">SUBSCRIBE</button>
                </form>
            </div>
        </div>
    </section>

@endsection