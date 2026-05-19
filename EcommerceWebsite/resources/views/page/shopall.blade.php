@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Shop All | EliteStore Premium')

@section('content')
<style>
    /* --- Shop Page Specific Styles --- */
    .shop-wrapper { padding: 40px 0; background: #fcfcfc; }
    
    /* Breadcrumbs */
    .breadcrumb-area { background: #f1f5f9; padding: 20px 0; margin-bottom: 40px; }
    .breadcrumb-links { font-size: 14px; color: var(--secondary); font-weight: 500; }
    .breadcrumb-links a:hover { color: var(--primary); }

    /* Layout */
    .shop-grid-layout { display: grid; grid-template-columns: 280px 1fr; gap: 40px; }

    /* Sidebar Filters */
    .filter-sidebar { position: sticky; top: 100px; height: fit-content; }
    .filter-widget { background: white; padding: 25px; border-radius: 20px; border: 1px solid var(--border); margin-bottom: 30px; box-shadow: var(--shadow-sm); }
    .filter-title { font-size: 18px; font-weight: 800; margin-bottom: 20px; color: var(--dark); border-bottom: 2px solid var(--light); padding-bottom: 10px; }
    
    .filter-list { list-style: none; }
    .filter-list li { margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between; font-size: 14px; font-weight: 500; color: var(--secondary); cursor: pointer; transition: 0.3s; }
    .filter-list li:hover { color: var(--primary); }
    .filter-list input { margin-right: 10px; width: 16px; height: 16px; cursor: pointer; }

    /* Price Range */
    .price-input { width: 100%; margin-top: 15px; cursor: pointer; accent-color: var(--primary); }

    /* Toolbar */
    .shop-toolbar { display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 25px; border-radius: 15px; border: 1px solid var(--border); margin-bottom: 30px; }
    .sort-select { padding: 10px; border-radius: 8px; border: 1px solid var(--border); font-size: 14px; font-weight: 600; outline: none; }

    /* Mobile Filter Button */
    .mobile-filter-btn { display: none; background: var(--dark); color: white; padding: 12px; border-radius: 10px; text-align: center; margin-bottom: 20px; cursor: pointer; font-weight: 700; }

    /* Responsive */
    @media (max-width: 991px) {
        .shop-grid-layout { grid-template-columns: 1fr; }
        .filter-sidebar { display: none; } /* Hide on mobile by default */
        .filter-sidebar.active { display: block; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 2001; overflow-y: auto; padding: 50px 20px; }
        .mobile-filter-btn { display: block; }
    }
    
    @media (max-width: 600px) {
        .product-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 15px !important; }
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-links">
            <a href="/">Home</a> <i class="fas fa-chevron-right" style="font-size: 10px; margin: 0 10px;"></i> <span>Shop All</span>
        </div>
    </div>
</div>

<div class="shop-wrapper">
    <div class="container">
        <div class="mobile-filter-btn" id="openFilters">
            <i class="fas fa-filter"></i> SHOW FILTERS
        </div>

        <div class="shop-grid-layout">
            <!-- Sidebar -->
            <aside class="filter-sidebar" id="shopSidebar">
                <div class="mobile-filter-header" style="display:none; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                    <h2 style="font-weight: 800;">Filters</h2>
                    <i class="fas fa-times" id="closeFilters" style="font-size: 24px; cursor: pointer;"></i>
                </div>

                <div class="filter-widget" data-aos="fade-up">
                    <h4 class="filter-title">Product Categories</h4>
                    <ul class="filter-list">
                        <li><span><input type="checkbox"> Electronics</span> <span>(24)</span></li>
                        <li><span><input type="checkbox"> Fashion</span> <span>(18)</span></li>
                        <li><span><input type="checkbox"> Men's Style</span> <span>(12)</span></li>
                        <li><span><input type="checkbox"> Home Decor</span> <span>(09)</span></li>
                        <li><span><input type="checkbox"> Accessories</span> <span>(15)</span></li>
                    </ul>
                </div>

                <div class="filter-widget" data-aos="fade-up">
                    <h4 class="filter-title">Price Range</h4>
                    <input type="range" class="price-input" min="0" max="5000">
                    <div style="display: flex; justify-content: space-between; margin-top: 10px; font-weight: 700; font-size: 14px;">
                        <span>$0</span>
                        <span>$5000</span>
                    </div>
                    <button class="add-cart-btn" style="margin-top: 20px; background: var(--primary);">FILTER NOW</button>
                </div>

                <div class="filter-widget" data-aos="fade-up">
                    <h4 class="filter-title">Select Brand</h4>
                    <ul class="filter-list">
                        <li><span><input type="checkbox"> Apple</span></li>
                        <li><span><input type="checkbox"> Samsung</span></li>
                        <li><span><input type="checkbox"> Nike</span></li>
                        <li><span><input type="checkbox"> Rolex</span></li>
                        <li><span><input type="checkbox"> Gucci</span></li>
                    </ul>
                </div>
            </aside>

            <!-- Main Shop Area -->
            <div class="shop-main">
                <!-- Toolbar -->
                <div class="shop-toolbar" data-aos="fade-down">
                    <div style="font-weight: 600; color: var(--secondary);">
                        Showing <span style="color: var(--dark);">{{ $product->count() }}</span> products
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <span style="font-size: 14px; font-weight: 700; color: var(--dark);">Sort By:</span>
                        <select class="sort-select">
                            <option>Default Sorting</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest Arrivals</option>
                        </select>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="product-grid" style="grid-template-columns: repeat(3, 1fr); gap: 25px;">
                    @forelse($product as $item)
                    <div class="product-card" data-aos="fade-up">
                        <span class="badge-sale">NEW</span>
                        <div class="p-actions">
                            <div class="p-btn"><i class="far fa-heart"></i></div>
                            <div class="p-btn"><i class="fas fa-eye"></i></div>
                        </div>
                        <div class="p-img-box">
                            <img src="{{ Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}">
                        </div>
                        <div class="p-info">
                            <p style="color:var(--secondary); font-size:12px; margin-bottom:5px;">{{ $item->brand ?? 'ELITE SELECT' }}</p>
                            <h3>{{ $item->name }}</h3>
                            <div class="p-price-row">
                                <div class="p-price">${{ number_format($item->price, 2) }}</div>
                                <div style="font-size:12px; color:var(--accent); font-weight:700;"><i class="fas fa-star"></i> 4.9</div>
                            </div>
                            {{-- Route name 'shoping.cart' use karein aur $item->id pass karein --}}
                            <button onclick="window.location.href='{{ route('shoping.cart', $item->id) }}'" class="add-cart-btn">
                                <i class="fas fa-shopping-bag"></i> ADD TO CART
                            </button>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: 1/-1; text-align:center; padding:100px;">
                        <i class="fas fa-search" style="font-size: 60px; opacity: 0.1; margin-bottom: 20px;"></i>
                        <h3>No products found matching your criteria.</h3>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div style="margin-top: 60px; display: flex; justify-content: center; gap: 10px;">
                    <a href="#" style="width:45px; height:45px; border:1px solid #ddd; display:grid; place-items:center; border-radius:10px; font-weight:700; background:white;">1</a>
                    <a href="#" style="width:45px; height:45px; border:1px solid #ddd; display:grid; place-items:center; border-radius:10px; font-weight:700; background:white;">2</a>
                    <a href="#" style="width:45px; height:45px; border:1px solid var(--primary); display:grid; place-items:center; border-radius:10px; font-weight:700; background:var(--primary); color:white;">3</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter Section (Same as Home for branding) -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-card" data-aos="zoom-in">
            <h2>Sign Up for 20% Off</h2>
            <p>Don't miss out on our latest collection and exclusive member-only deals.</p>
            <div class="newsletter-form">
                <input type="email" placeholder="Your best email...">
                <button>JOIN NOW</button>
            </div>
        </div>
    </div>
</section>

<script>
    // Filter Sidebar Mobile Toggle
    const openFilters = document.getElementById('openFilters');
    const closeFilters = document.getElementById('closeFilters');
    const shopSidebar = document.getElementById('shopSidebar');
    const mobileHeader = document.querySelector('.mobile-filter-header');

    if(openFilters) {
        openFilters.addEventListener('click', () => {
            shopSidebar.classList.add('active');
            mobileHeader.style.display = 'flex';
        });
    }

    if(closeFilters) {
        closeFilters.addEventListener('click', () => {
            shopSidebar.classList.remove('active');
            mobileHeader.style.display = 'none';
        });
    }
</script>
@endsection