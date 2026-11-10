@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Shop All | Wasaaz Premium')

@section('content')
<!-- SweetAlert2 (For Login Popups) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-neutral: #ffffff;
        --secondary-neutral: #888888;
        --accent-neutral: #c9a86c;
        --warm-bg: #0a0a0a;
        --white-bg: #111111;
        --light-border: #1f1f1f;
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .shop-page { background: var(--warm-bg); padding: 0 0 100px; }

    /* Breadcrumb */
    .breadcrumb-area { background: var(--white-bg); padding: 28px 0; border-bottom: 1px solid var(--light-border); }
    .breadcrumb-links { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--secondary-neutral); }
    .breadcrumb-links a { color: var(--accent-neutral); transition: var(--transition-smooth); }
    .breadcrumb-links a:hover { color: var(--primary-neutral); }
    .breadcrumb-links i { margin: 0 12px; font-size: 9px; opacity: 0.5; }

    /* Page Header */
    .page-header { text-align: center; padding: 70px 0 50px; }
    .page-header p { color: var(--accent-neutral); font-weight: 700; text-transform: uppercase; letter-spacing: 3px; font-size: 11px; margin-bottom: 10px; }
    .page-header h1 { font-size: 36px; font-weight: 300; text-transform: uppercase; letter-spacing: -0.5px; color: var(--primary-neutral); }
    .page-header h1 span { font-weight: 700; }

    /* Layout Grid */
    .shop-grid { display: grid; grid-template-columns: 280px 1fr; gap: 40px; align-items: start; }

    /* Sidebar Filters */
    .filter-sidebar { position: sticky; top: 110px; }
    .filter-card { background: var(--white-bg); border: 1px solid var(--light-border); padding: 28px; margin-bottom: 20px; }
    .filter-title { font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid var(--light-border); color: var(--primary-neutral); }
    .filter-list { list-style: none; }
    .filter-list li { margin-bottom: 14px; display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: var(--secondary-neutral); cursor: pointer; transition: var(--transition-smooth); }
    .filter-list li:hover { color: var(--primary-neutral); }
    .filter-list label { display: flex; align-items: center; cursor: pointer; }
    .filter-list input { margin-right: 10px; width: 16px; height: 16px; accent-color: var(--primary-neutral); cursor: pointer; }
    .filter-list span { font-size: 11px; color: var(--accent-neutral); font-weight: 700; }
    .price-range { width: 100%; margin: 15px 0; accent-color: var(--primary-neutral); }
    .price-labels { display: flex; justify-content: space-between; font-size: 12px; font-weight: 700; color: var(--primary-neutral); }
    .price-inputs { display: flex; align-items: center; gap: 10px; }
    .price-inputs input { width: 100%; padding: 10px 12px; border: 1px solid var(--light-border); background: var(--warm-bg); color: var(--primary-neutral); font-size: 13px; outline: none; transition: var(--transition-smooth); }
    .price-inputs input:focus { border-color: var(--accent-neutral); }
    .price-inputs span { color: var(--secondary-neutral); font-size: 13px; }
    .apply-btn { width: 100%; padding: 14px; background: var(--primary-neutral); color: var(--white-bg); border: 1px solid var(--primary-neutral); font-weight: 700; font-size: 11px; letter-spacing: 2px; text-transform: uppercase; cursor: pointer; transition: var(--transition-smooth); }
    .apply-btn:hover { background: transparent; color: var(--primary-neutral); }

    /* Mobile Filter Button & Sidebar */
    .mobile-filter-btn { display: none; background: var(--primary-neutral); color: var(--white-bg); padding: 14px; text-align: center; margin-bottom: 25px; cursor: pointer; font-weight: 700; font-size: 11px; letter-spacing: 2px; text-transform: uppercase; }
    .mobile-filter-header { display: none !important; justify-content: space-between; align-items: center; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 1px solid var(--light-border); }
    .mobile-filter-header h2 { font-size: 18px; font-weight: 900; letter-spacing: 1px; text-transform: uppercase; }

    /* Toolbar */
    .shop-toolbar { display: flex; justify-content: space-between; align-items: center; background: var(--white-bg); border: 1px solid var(--light-border); padding: 18px 24px; margin-bottom: 30px; }
    .result-count { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--secondary-neutral); }
    .result-count span { color: var(--primary-neutral); }
    .sort-select { padding: 10px 14px; border: 1px solid var(--light-border); background: var(--warm-bg); font-size: 13px; font-weight: 600; color: var(--primary-neutral); outline: none; cursor: pointer; transition: var(--transition-smooth); }
    .sort-select:focus { border-color: var(--accent-neutral); }

    /* Product Grid */
    .product-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; }
    .product-card { background: var(--white-bg); border: 1px solid var(--light-border); overflow: hidden; transition: var(--transition-smooth); position: relative; display: flex; flex-direction: column; }
    .product-card:hover { border-color: var(--primary-neutral); box-shadow: 0 20px 40px rgba(0,0,0,0.04); transform: translateY(-5px); }

    .p-img-box { height: clamp(260px, 30vw, 380px); background: #161616; overflow: hidden; position: relative; display: flex; align-items: center; justify-content: center; }
    .p-img-box img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
    .product-card:hover .p-img-box img { transform: scale(1.05); }

    /* Actions */
    .p-actions { position: absolute; right: 12px; bottom: 12px; display: flex; flex-direction: row; gap: 8px; z-index: 5; opacity: 0; transform: translateY(10px); transition: var(--transition-smooth); }
    .product-card:hover .p-actions { opacity: 1; transform: translateY(0); }
    .p-btn { width: 40px; height: 40px; background: var(--white-bg); border: 1px solid var(--light-border); border-radius: 50%; display: grid; place-items: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05); cursor: pointer; color: var(--primary-neutral); text-decoration: none; transition: var(--transition-smooth); }
    .p-btn:hover { background: var(--primary-neutral); color: var(--white-bg); border-color: var(--primary-neutral); }

    .badge-luxury { position: absolute; top: 12px; left: 12px; background: #7a1f2a; color: #ffffff; padding: 5px 12px; font-size: 9px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; z-index: 2; }

    .p-info { padding: 22px 18px; text-align: center; flex-grow: 1; display: flex; flex-direction: column; }
    .p-brand { color: var(--accent-neutral); font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px; }
    .p-name { font-size: 15px; font-weight: 400; margin-bottom: 12px; color: var(--primary-neutral); text-decoration: none; height: 44px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.4; transition: var(--transition-smooth); }
    .p-name:hover { color: var(--accent-neutral); }
    .p-price-row { display: flex; align-items: baseline; justify-content: center; gap: 10px; margin-top: auto; margin-bottom: 16px; }
    .curr-price { font-size: 16px; font-weight: 700; color: var(--primary-neutral); }
    .old-price { font-size: 13px; color: var(--secondary-neutral); text-decoration: line-through; opacity: 0.6; }
    .add-btn { width: 100%; padding: 14px; background: transparent; color: var(--primary-neutral); border: 1px solid var(--primary-neutral); font-weight: 700; font-size: 11px; cursor: pointer; text-transform: uppercase; letter-spacing: 2px; transition: var(--transition-smooth); text-decoration: none; display: inline-block; }
    .product-card:hover .add-btn { background: var(--primary-neutral); color: var(--white-bg); }

    .empty-state { grid-column: 1/-1; text-align: center; padding: 80px 20px; background: var(--white-bg); border: 1px dashed var(--light-border); }
    .empty-state i { font-size: 48px; color: var(--secondary-neutral); margin-bottom: 20px; }
    .empty-state p { color: var(--secondary-neutral); font-size: 15px; }

    /* Pagination */
    .pagination { margin-top: 60px; display: flex; justify-content: center; gap: 10px; }
    .pagination a, .pagination span.disabled { width: 44px; height: 44px; border: 1px solid var(--light-border); display: grid; place-items: center; font-weight: 700; font-size: 13px; color: var(--primary-neutral); transition: var(--transition-smooth); }
    .pagination a:hover, .pagination a.active { background: var(--primary-neutral); color: var(--white-bg); border-color: var(--primary-neutral); }
    .pagination span.disabled { color: var(--secondary-neutral); opacity: 0.4; cursor: not-allowed; }

    /* Newsletter */
    .newsletter-section { padding: 100px 0; background: #111111; color: #ffffff; text-align: center; border-top: 1px solid var(--light-border); }
    .newsletter-section h2 { font-family: 'Playfair Display', serif; font-size: 34px; font-weight: 500; margin-bottom: 15px; }
    .newsletter-section p { opacity: 0.6; font-size: 15px; margin-bottom: 35px; max-width: 600px; margin-left: auto; margin-right: auto; }
    .newsletter-form { display: flex; max-width: 520px; margin: auto; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px; }
    .newsletter-form input { flex: 1; background: transparent; border: none; outline: none; color: #ffffff; padding: 12px 0; font-size: 15px; }
    .newsletter-form input::placeholder { color: rgba(255,255,255,0.4); }
    .newsletter-form button { background: transparent; color: #ffffff; border: none; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 12px; cursor: pointer; }
    .newsletter-form button:hover { color: var(--accent-neutral); }

    /* Responsive */
    @media (max-width: 1024px) {
        .shop-grid { grid-template-columns: 240px 1fr; gap: 30px; }
        .product-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .page-header { padding: 50px 0 35px; }
        .page-header h1 { font-size: 28px; }
        .shop-grid { grid-template-columns: 1fr; }
        .filter-sidebar { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: var(--white-bg); z-index: 2001; overflow-y: auto; padding: 60px 24px; }
        .filter-sidebar.active { display: block; }
        .mobile-filter-btn { display: block; }
        .mobile-filter-header { display: flex !important; }
        .shop-toolbar { flex-direction: column; gap: 12px; text-align: center; }
        .p-actions { opacity: 1; transform: translateY(0); }
        .newsletter-section h2 { font-size: 26px; }
    }
    @media (max-width: 480px) {
        .product-grid { grid-template-columns: 1fr; }
        .p-img-box { height: 320px; }
        .breadcrumb-area { padding: 20px 0; }
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-links">
            <a href="{{ route('home.new') }}">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>Shop All Collection</span>
        </div>
    </div>
</div>

<div class="shop-page">
    <div class="container">
        <div class="page-header" data-aos="fade-up">
            <p>Curated Essentials</p>
            <h1>Shop All <span>Collection</span></h1>
        </div>

        <!-- Mobile Filter Toggle -->
        <div class="mobile-filter-btn" id="openFilters">
            <i class="fas fa-sliders-h"></i> Filter & Refine
        </div>

        <div class="shop-grid">
            <!-- Sidebar Filters -->
            <aside class="filter-sidebar" id="shopSidebar">
                <div class="mobile-filter-header">
                    <h2>Filters</h2>
                    <i class="fas fa-times" id="closeFilters" style="font-size: 20px; cursor: pointer;"></i>
                </div>

                <form method="GET" action="{{ route('shop.all') }}">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <div class="filter-card" data-aos="fade-up">
                        <h4 class="filter-title">Categories</h4>
                        <ul class="filter-list">
                            @foreach($categories as $cat)
                            <li><label><input type="checkbox" name="categories[]" value="{{ $cat->id }}" {{ in_array($cat->id, (array) request('categories')) ? 'checked' : '' }}> {{ $cat->name }}</label> <span>{{ $cat->products_count }}</span></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="filter-card" data-aos="fade-up" data-aos-delay="50">
                        <h4 class="filter-title">Price Range</h4>
                        <div class="price-inputs">
                            <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" min="0">
                            <span>—</span>
                            <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" min="0">
                        </div>
                    </div>

                    <div class="filter-card" data-aos="fade-up" data-aos-delay="100">
                        <h4 class="filter-title">Brands</h4>
                        <ul class="filter-list">
                            @foreach($brands as $brand)
                            <li><label><input type="checkbox" name="brands[]" value="{{ $brand }}" {{ in_array($brand, (array) request('brands')) ? 'checked' : '' }}> {{ $brand }}</label></li>
                            @endforeach
                        </ul>
                    </div>

                    <button type="submit" class="apply-btn">Apply Filters</button>
                    <a href="{{ route('shop.all') }}" style="display:block; text-align:center; margin-top:14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color: var(--secondary-neutral);">Clear All</a>
                </form>
            </aside>

            <!-- Main Shop Area -->
            <div class="shop-main">
                <!-- Toolbar -->
                <div class="shop-toolbar" data-aos="fade-down">
                    <div class="result-count">
                        Showing <span>{{ $product->firstItem() ?? 0 }}–{{ $product->lastItem() ?? 0 }}</span> of <span>{{ $product->total() }}</span> Products
                    </div>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--secondary-neutral);">Sort By:</span>
                        <select class="sort-select" id="sortSelect">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Arrivals</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A to Z</option>
                        </select>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="product-grid">
                    @forelse($product as $item)
                        @php
                            $isWishlisted = false;
                            if(auth()->check()) {
                                $isWishlisted = auth()->user()->wishlists->contains('product_id', $item->id);
                            }
                        @endphp
                        <div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->index % 6 * 50 }}">
                            <div class="p-img-box">
                                @if($item->stock <= 0)
                                    <span class="badge-luxury" style="background:#2a2a2a; color:#888;">Sold Out</span>
                                @elseif($item->stock <= 5)
                                    <span class="badge-luxury" style="background:#f59e0b; color:#000;">Only {{ $item->stock }} Left</span>
                                @else
                                    <span class="badge-luxury">Premium</span>
                                @endif
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
                                <a href="{{ route('product.show', $item->slug ?? $item->id) }}" class="add-btn">View Details</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-search"></i>
                            <p>No products found in this collection.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($product->hasPages())
                <div class="pagination" data-aos="fade-up">
                    @if($product->onFirstPage())
                        <span class="disabled"><i class="fas fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $product->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                    @endif

                    @foreach($product->getUrlRange(1, $product->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="{{ $page == $product->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach

                    @if($product->hasMorePages())
                        <a href="{{ $product->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                    @else
                        <span class="disabled"><i class="fas fa-chevron-right"></i></span>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Newsletter -->
<section class="newsletter-section">
    <div class="container">
        <div data-aos="zoom-in">
            <h2>Join Wasaaz Club</h2>
            <p>Subscribe for early access to new collections, private sales, and exclusive member-only offers.</p>
            <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Your premium email address" required>
                <button type="submit">Subscribe</button>
            </form>
            @if(session('newsletter_success'))
                <p style="margin-top:16px; color:#34d399; font-size:13px; font-weight:600;"><i class="fas fa-check-circle"></i> {{ session('newsletter_success') }}</p>
            @endif
        </div>
    </div>
</section>

<script>
    // Mobile Filter Toggle
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

    // Sort dropdown — preserves all current filters in the URL
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', this.value);
            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    }
</script>
@endsection
