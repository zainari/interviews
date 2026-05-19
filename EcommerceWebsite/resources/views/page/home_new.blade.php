
@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Home | Zain Store')

@section('content')


    <!-- Hero Slider Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-flex">
                <div class="hero-text" data-aos="fade-right">
                    <span style="color:var(--primary); font-weight:800; letter-spacing:3px; text-transform:uppercase; font-size:14px;">Spring Collection 2024</span>
                    <h1>Luxury Style. <br> <span>Ultimate Quality.</span></h1>
                    <p>Experience the next level of premium shopping with our handcrafted selection of international brands. Limited stock available.</p>
                    <div style="display:flex; gap:20px; flex-wrap:wrap;">
                        <a href="#shop" class="btn-luxury" style="padding: 18px 45px; background:var(--dark); color:white; font-weight:700;">SHOP NOW</a>
                        <a href="#" class="btn-luxury" style="padding: 18px 45px; background:white; color:var(--dark); font-weight:700; border:1px solid #ddd;">VIEW OFFERS</a>
                    </div>
                </div>
                <div class="hero-img" data-aos="zoom-in" data-aos-duration="1500">
                    <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?auto=format&fit=crop&w=800&q=80" alt="New Arrival Model">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Badges -->
    <section class="container" style="margin-bottom: 80px;">
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up">
                <i class="fas fa-truck-fast"></i>
                <div>
                    <h4>Express Delivery</h4>
                    <p>Worldwide in 3-5 days</p>
                </div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-shield-check"></i>
                <div>
                    <h4>Secure Checkout</h4>
                    <p>100% Encrypted Payment</p>
                </div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-comments-alt-dollar"></i>
                <div>
                    <h4>Money Guarantee</h4>
                    <p>30 Days easy return</p>
                </div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <i class="fas fa-headset"></i>
                <div>
                    <h4>Expert Support</h4>
                    <p>Live chat 24/7 available</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories Grid -->
    <section class="section-padding">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <p style="color:var(--secondary); font-weight:700; letter-spacing:2px; margin-bottom:10px;">BROWSE BY</p>
                <h2>Top Categories</h2>
            </div>
            
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap:25px; margin-top:40px;">
                <!-- Repeat these as per your category DB -->
                <a href="#" class="category-box" style="text-align:center;" data-aos="zoom-in">
                    <div style="background:#f1f5f9; border-radius:50%; width:150px; height:150px; margin:0 auto 15px; display:grid; place-items:center; transition:0.3s; overflow:hidden;">
                        <img src="https://cdn-icons-png.flaticon.com/512/3050/3050230.png" style="width:60%;" alt="">
                    </div>
                    <h4 style="font-weight:700;">Electronics</h4>
                </a>
                <a href="#" class="category-box" style="text-align:center;" data-aos="zoom-in" data-aos-delay="100">
                    <div style="background:#f1f5f9; border-radius:50%; width:150px; height:150px; margin:0 auto 15px; display:grid; place-items:center; transition:0.3s; overflow:hidden;">
                        <img src="https://cdn-icons-png.flaticon.com/512/3050/3050186.png" style="width:60%;" alt="">
                    </div>
                    <h4 style="font-weight:700;">Fashion</h4>
                </a>
                <a href="#" class="category-box" style="text-align:center;" data-aos="zoom-in" data-aos-delay="200">
                    <div style="background:#f1f5f9; border-radius:50%; width:150px; height:150px; margin:0 auto 15px; display:grid; place-items:center; transition:0.3s; overflow:hidden;">
                        <img src="https://cdn-icons-png.flaticon.com/512/3050/3050236.png" style="width:60%;" alt="">
                    </div>
                    <h4 style="font-weight:700;">Cosmetics</h4>
                </a>
                <a href="#" class="category-box" style="text-align:center;" data-aos="zoom-in" data-aos-delay="300">
                    <div style="background:#f1f5f9; border-radius:50%; width:150px; height:150px; margin:0 auto 15px; display:grid; place-items:center; transition:0.3s; overflow:hidden;">
                        <img src="https://cdn-icons-png.flaticon.com/512/3050/3050192.png" style="width:60%;" alt="">
                    </div>
                    <h4 style="font-weight:700;">Footwear</h4>
                </a>
            </div>
        </div>
    </section>

    <!-- Flash Sale with Timer -->
    <section class="container" style="margin-bottom:80px;">
        <div style="background: #0f172a; border-radius: 30px; padding: 50px; color: white; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 30px;" data-aos="fade-up">
            <div>
                <h2 style="font-size:35px; font-weight:800; margin-bottom:10px;"><i class="fas fa-bolt" style="color:var(--accent);"></i> FLASH SALE</h2>
                <p style="opacity:0.7;">Get extra 20% off on your favorite electronics items today.</p>
            </div>
            <div style="display:flex; gap:20px;">
                <div style="background:rgba(255,255,255,0.1); padding:15px; border-radius:15px; text-align:center; min-width:80px;">
                    <h3 style="font-size:24px;">12</h3><span style="font-size:10px; opacity:0.6; text-transform:uppercase;">Hours</span>
                </div>
                <div style="background:rgba(255,255,255,0.1); padding:15px; border-radius:15px; text-align:center; min-width:80px;">
                    <h3 style="font-size:24px;">45</h3><span style="font-size:10px; opacity:0.6; text-transform:uppercase;">Mins</span>
                </div>
                <div style="background:rgba(255,255,255,0.1); padding:15px; border-radius:15px; text-align:center; min-width:80px;">
                    <h3 style="font-size:24px;">30</h3><span style="font-size:10px; opacity:0.6; text-transform:uppercase;">Secs</span>
                </div>
            </div>
            <a href="#" class="btn-luxury" style="background:var(--primary); color:white; padding:15px 40px; border-radius:15px;">VIEW ALL SALE</a>
        </div>
    </section>

    <!-- Main Products Grid -->
    <section class="section-padding" id="shop">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <p style="color:var(--primary); font-weight:800; letter-spacing:2px; margin-bottom:10px;">CURATED FOR YOU</p>
                <h2>New Arrivals</h2>
            </div>

            <div class="product-grid">
                @forelse($product as $item)
                <div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <span class="badge-sale">NEW</span>
                    <div class="p-actions">
                        <div class="p-btn"><i class="far fa-heart"></i></div>
                        <div class="p-btn"><i class="fas fa-eye"></i></div>
                        <div class="p-btn"><i class="fas fa-share-alt"></i></div>
                    </div>
                    <div class="p-img-box">
                        <img src="{{ Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}">
                    </div>
                    <div class="p-info">
                        <p style="color:var(--secondary); font-size:12px; margin-bottom:5px;">{{ $item->brand ?? 'ELITE SELECT' }}</p>
                        <h3>{{ $item->name }}</h3>
                        <div class="p-price-row">
                            <div class="p-price">
                                ${{ number_format($item->price, 2) }}
                                <span class="p-old-price">${{ number_format($item->price * 1.2, 2) }}</span>
                            </div>
                            <div style="font-size:12px; color:var(--accent); font-weight:700;"><i class="fas fa-star"></i> 4.9</div>
                        </div>
                        <button onclick="window.location.href='{{ route('shoping.cart', $item->id) }}'" class="add-cart-btn">
                            <i class="fas fa-shopping-bag"></i> ADD TO CART
                        </button>                    </div>
                </div>
                @empty
                <div style="grid-column: 1/-1; text-align:center; padding:50px;">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" style="width:100px; opacity:0.3; margin-bottom:20px;">
                    <h3 style="opacity:0.5;">No products found in the database.</h3>
                </div>
                @endforelse
            </div>
            
            <div style="text-align:center; margin-top:60px;">
                <button class="btn-luxury" style="padding:15px 60px; border:2px solid var(--dark); font-weight:800; background:none;">LOAD MORE PRODUCTS</button>
            </div>
        </div>
    </section>

    <!-- Why Choose Us / Trust Section -->
    <section class="section-padding" style="background:#f8fafc;">
        <div class="container">
            <div class="footer-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); text-align:center;">
                <div data-aos="fade-up">
                    <img src="https://cdn-icons-png.flaticon.com/512/1162/1162456.png" style="width:60px; margin-bottom:20px;">
                    <h4 style="margin-bottom:10px;">Premium Quality</h4>
                    <p style="font-size:14px; opacity:0.7;">We source products only from verified international manufacturers.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="100">
                    <img src="https://cdn-icons-png.flaticon.com/512/2821/2821785.png" style="width:60px; margin-bottom:20px;">
                    <h4 style="margin-bottom:10px;">Sustainable Sourcing</h4>
                    <p style="font-size:14px; opacity:0.7;">Eco-friendly packaging and ethical trade practices guaranteed.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <img src="https://cdn-icons-png.flaticon.com/512/3503/3503194.png" style="width:60px; margin-bottom:20px;">
                    <h4 style="margin-bottom:10px;">Secure Assets</h4>
                    <p style="font-size:14px; opacity:0.7;">Your data and payment information is always encrypted and safe.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-card" data-aos="zoom-in">
                <h2>Join The Elite Community</h2>
                <p>Subscribe to our newsletter and get **20% OFF** on your first order. Stay updated with the latest trends!</p>
                <div class="newsletter-form">
                    <input type="email" placeholder="Enter your email address...">
                    <button>SUBSCRIBE</button>
                </div>
            </div>
        </div>
    </section>
@endsection
  