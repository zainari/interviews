@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Shop All | EliteStore Premium')

@section('content')
<!-- SweetAlert2 (For Login Popups) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* --- Shop Page Specific Styles --- */
    .shop-wrapper { padding: 40px 0; background: #fcfcfc; margin-top: 20px; }
    
    /* Breadcrumbs */
    .breadcrumb-area { background: #f8fafc; padding: 25px 0; margin-top: 70px; border-bottom: 1px solid #eee; }
    .breadcrumb-links { font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
    .breadcrumb-links a { text-decoration: none; color: #94a3b8; transition: 0.3s; }
    .breadcrumb-links a:hover { color: var(--primary); }
    .breadcrumb-links span { color: #1e293b; }

    /* Layout Grid */
    .shop-grid-layout { display: grid; grid-template-columns: 280px 1fr; gap: 50px; }

    /* Sidebar Filters */
    .filter-sidebar { position: sticky; top: 120px; height: fit-content; }
    .filter-widget { background: white; padding: 30px; border-radius: 12px; border: 1px solid #f1f5f9; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .filter-title { font-size: 14px; font-weight: 800; margin-bottom: 25px; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; }
    
    .filter-list { list-style: none; }
    .filter-list li { margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #64748b; cursor: pointer; transition: 0.3s; }
    .filter-list li:hover { color: #000; }
    .filter-list input { margin-right: 12px; width: 18px; height: 18px; cursor: pointer; accent-color: #000; }

    /* Price Range */
    .price-input { width: 100%; margin-top: 15px; cursor: pointer; accent-color: #000; }

    /* Toolbar */
    .shop-toolbar { display: flex; justify-content: space-between; align-items: center; background: white; padding: 20px 30px; border-radius: 12px; border: 1px solid #f1f5f9; margin-bottom: 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .sort-select { padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 700; outline: none; cursor: pointer; color: #1e293b; }

    /* Mobile Filter Button */
    .mobile-filter-btn { display: none; background: #000; color: white; padding: 15px; border-radius: 8px; text-align: center; margin-bottom: 25px; cursor: pointer; font-weight: 700; font-size: 12px; letter-spacing: 1px; }

    /* Zilbil Style Product Card Fix */
    .product-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .p-img-box { height: 380px; background: #f9f9f9; border-radius: 8px; overflow: hidden; position: relative; }
    .p-img-box img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s ease; }
    .product-card:hover .p-img-box img { transform: scale(1.05); }

    .add-cart-btn { 
        width: 100%; margin-top: 20px; padding: 14px; background: #000; color: #fff; 
        border: none; border-radius: 4px; font-weight: 700; text-transform: uppercase; 
        font-size: 11px; letter-spacing: 1px; cursor: pointer; transition: 0.3s;
    }
    .add-cart-btn:hover { background: #333; }

    /* Responsive */
    @media (max-width: 1200px) {
        .shop-grid-layout { grid-template-columns: 240px 1fr; gap: 30px; }
        .product-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 991px) {
        .shop-grid-layout { grid-template-columns: 1fr; }
        .filter-sidebar { display: none; } 
        .filter-sidebar.active { display: block; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 2001; overflow-y: auto; padding: 60px 25px; }
        .mobile-filter-btn { display: block; }
        .mobile-filter-header { display: flex !important; }
    }
    
    @media (max-width: 600px) {
        .product-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 15px !important; }
        .p-img-box { height: 240px; }
        .shop-toolbar { flex-direction: column; gap: 15px; text-align: center; }
    }
</style>

<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-links">
            <a href="{{ route('home.new') }}">Home</a> 
            <i class="fas fa-chevron-right" style="font-size: 8px; margin: 0 15px; opacity: 0.5;"></i> 
            <span>Shop All Collection</span>
        </div>
    </div>
</div>

<div class="shop-wrapper">
    <div class="container">
        
        <!-- Mobile Toggle -->
        <div class="mobile-filter-btn" id="openFilters">
            <i class="fas fa-sliders-h"></i> &nbsp; FILTER & REFINE
        </div>

        <div class="shop-grid-layout">
            <!-- Sidebar Filters -->
            <aside class="filter-sidebar" id="shopSidebar">
                <div class="mobile-filter-header" style="display:none; justify-content: space-between; align-items: center; margin-bottom: 40px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                    <h2 style="font-size: 18px; font-weight: 900; letter-spacing: 1px;">FILTERS</h2>
                    <i class="fas fa-times" id="closeFilters" style="font-size: 20px; cursor: pointer;"></i>
                </div>

                <div class="filter-widget" data-aos="fade-up">
                    <h4 class="filter-title">Categories</h4>
                    <ul class="filter-list">
                        <li><span><input type="checkbox"> Men's Polos</span> <span>(12)</span></li>
                        <li><span><input type="checkbox"> Luxury Watches</span> <span>(08)</span></li>
                        <li><span><input type="checkbox"> Formal Wear</span> <span>(15)</span></li>
                        <li><span><input type="checkbox"> Accessories</span> <span>(20)</span></li>
                    </ul>
                </div>

                <div class="filter-widget" data-aos="fade-up">
                    <h4 class="filter-title">Price Range</h4>
                    <input type="range" class="price-input" min="0" max="10000">
                    <div style="display: flex; justify-content: space-between; margin-top: 15px; font-weight: 800; font-size: 12px; color: #1e293b;">
                        <span>Rs. 0</span>
                        <span>Rs. 10,000+</span>
                    </div>
                    <button class="add-cart-btn" style="margin-top: 25px; border-radius: 8px;">APPLY FILTER</button>
                </div>

                <div class="filter-widget" data-aos="fade-up">
                    <h4 class="filter-title">Featured Brands</h4>
                    <ul class="filter-list">
                        <li><span><input type="checkbox"> Elite Select</span></li>
                        <li><span><input type="checkbox"> Zilbil Boutique</span></li>
                        <li><span><input type="checkbox"> Urban Luxury</span></li>
                    </ul>
                </div>
            </aside>

            <!-- Main Shop Area -->
            <div class="shop-main">
                <!-- Toolbar -->
                <div class="shop-toolbar" data-aos="fade-down">
                    <div style="font-weight: 700; color: #64748b; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">
                        Showing <span style="color: #000;">{{ $product->count() }}</span> Premium Products
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <span style="font-size: 12px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Sort:</span>
                        <select class="sort-select">
                            <option>Latest Arrivals</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Top Rated</option>
                        </select>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="product-grid">
                    @forelse($product as $item)
                        @php
                            // Check if current logged-in user has this product in wishlist
                            $isWishlisted = false;
                            if(auth()->check()) {
                                $isWishlisted = auth()->user()->wishlists->contains('product_id', $item->id);
                            }
                        @endphp
                    <div class="product-card" data-aos="fade-up" style="background: white; border-radius: 12px; padding: 0; border: none; transition: 0.4s;">
                        <div class="p-img-box">
                            <span class="badge-sale" style="position: absolute; top: 15px; left: 15px; background: #000; color: #fff; padding: 4px 12px; font-size: 10px; font-weight: 800; border-radius: 4px; z-index: 5;">NEW</span>
                            
                            {{-- Route Model Binding --}}
                            <a href="{{ route('product.show', $item->slug ?? $item->id) }}">
                                <img src="{{ Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}">
                            </a>

                            <!-- Wishlist Toggle Action -->
                            <div class="p-actions" style="position: absolute; right: 15px; top: 15px; display: flex; flex-direction: column; gap: 8px;">
                                <div class="p-btn" 
                                     onclick="toggleWishlist({{ $item->id }}, this)" 
                                     style="width: 38px; height: 38px; background: white; border-radius: 50%; display: grid; place-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); cursor: pointer; transition: 0.3s; color: {{ $isWishlisted ? 'red' : 'inherit' }};">
                                    <i class="{{ $isWishlisted ? 'fa-solid fas' : 'fa-regular far' }} fa-heart"></i>
                                </div>
                            </div>
                        </div>

                        <div class="p-info" style="padding: 20px 5px; text-align: left;">
                            <p style="color:#94a3b8; font-size:11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">{{ $item->brand ?? 'ELITE SELECT' }}</p>
                            <a href="{{ route('product.show', $item->slug ?? $item->id) }}" style="text-decoration: none; color: inherit;">
                                <h3 style="font-size: 15px; font-weight: 600; margin-bottom: 12px; color: #1e293b;">{{ $item->name }}</h3>
                            </a>
                            <div class="p-price-row" style="display: flex; align-items: baseline; gap: 10px;">
                                <div class="p-price" style="font-size: 18px; font-weight: 800; color: #000;">Rs. {{ number_format($item->price) }}</div>
                                <div style="font-size: 12px; color: #cbd5e1; text-decoration: line-through;">Rs. {{ number_format($item->price * 1.4) }}</div>
                            </div>

                            <button onclick="window.location.href='{{ route('product.show', $item->slug ?? $item->id) }}'" class="add-cart-btn">
                                View Details
                            </button>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: 1/-1; text-align:center; padding:100px 20px;">
                        <i class="fas fa-search" style="font-size: 50px; color: #eee; margin-bottom: 20px;"></i>
                        <h3 style="color: #94a3b8;">No products found in this collection.</h3>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div style="margin-top: 80px; display: flex; justify-content: center; gap: 12px;">
                    <a href="#" style="width:45px; height:45px; border:1px solid #000; display:grid; place-items:center; border-radius:4px; font-weight:800; background:#000; color:#fff; text-decoration: none;">1</a>
                    <a href="#" style="width:45px; height:45px; border:1px solid #e2e8f0; display:grid; place-items:center; border-radius:4px; font-weight:800; background:white; color:#1e293b; text-decoration: none;">2</a>
                    <a href="#" style="width:45px; height:45px; border:1px solid #e2e8f0; display:grid; place-items:center; border-radius:4px; font-weight:800; background:white; color:#1e293b; text-decoration: none;">Next</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter -->
<section class="newsletter-section" style="padding: 100px 0; background: #fff; border-top: 1px solid #eee;">
    <div class="container">
        <div class="newsletter-card" data-aos="zoom-in" style="background: #000; color: #fff; padding: 80px 40px; border-radius: 20px; text-align: center;">
            <h2 style="font-size: 32px; font-weight: 800; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 2px;">Keep In Touch</h2>
            <p style="margin-bottom: 40px; opacity: 0.7; max-width: 600px; margin-left: auto; margin-right: auto;">Subscribe to receive updates, access to exclusive deals, and more luxury arrivals.</p>
            <div class="newsletter-form" style="display: flex; gap: 15px; max-width: 500px; margin: auto; flex-wrap: wrap;">
                <input type="email" placeholder="Your premium email address" style="flex: 1; padding: 18px 25px; border-radius: 4px; border: none; outline: none; min-width: 250px;">
                <button style="padding: 18px 40px; background: #fff; color: #000; border: none; font-weight: 800; border-radius: 4px; cursor: pointer; text-transform: uppercase;">SUBSCRIBE</button>
            </div>
        </div>
    </div>
</section>

<script>
    // Sidebar Mobile Toggle
    const openFilters = document.getElementById('openFilters');
    const closeFilters = document.getElementById('closeFilters');
    const shopSidebar = document.getElementById('shopSidebar');

    if(openFilters) {
        openFilters.addEventListener('click', () => {
            shopSidebar.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    if(closeFilters) {
        closeFilters.addEventListener('click', () => {
            shopSidebar.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    }

    // Wishlist Toggle Function with Ajax & SweetAlert
    function toggleWishlist(productId, el) {
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
                    confirmButtonColor: '#000000',
                    cancelButtonColor: '#64748b'
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
            const icon = el.querySelector('i');
            if (data.status === 'added') {
                icon.classList.remove('fa-regular', 'far');
                icon.classList.add('fa-solid', 'fas');
                el.style.color = 'red';
            } else {
                icon.classList.remove('fa-solid', 'fas');
                icon.classList.add('fa-regular', 'far');
                el.style.color = '';
            }

            // Navbar counter update
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
                console.error('Wishlist error:', err);
            }
        });
    }
</script>
@endsection