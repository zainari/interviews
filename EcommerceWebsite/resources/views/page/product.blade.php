@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Our Products | Wasaaz Premium')

@section('content')

<style>
    .product-hero {
        position: relative;
        min-height: 45vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary);
        text-align: center;
    }
    .product-hero .hero-inner {
        position: relative;
        z-index: 1;
        padding: 70px 20px;
    }
    .product-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(36px, 6vw, 64px);
        color: var(--white);
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 14px;
    }
    .product-hero p {
        font-size: clamp(14px, 2vw, 17px);
        color: rgba(255,255,255,0.75);
        max-width: 620px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .filter-bar {
        padding: 28px 0;
        background: var(--white);
        border-bottom: 1px solid var(--border);
    }
    .filter-container {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .filter-left, .filter-right {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }
    .filter-left span {
        font-size: 13px;
        color: var(--secondary);
        font-weight: 600;
    }
    .filter-search {
        position: relative;
    }
    .filter-search input {
        padding: 12px 16px 12px 40px;
        border: 1px solid var(--border);
        border-radius: 4px;
        background: var(--light);
        font-size: 13px;
        color: var(--primary);
        outline: none;
        width: 260px;
        transition: var(--transition-smooth);
    }
    .filter-search input:focus {
        background: var(--white);
        border-color: var(--primary);
    }
    .filter-search i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        font-size: 13px;
    }
    .filter-right select {
        padding: 12px 36px 12px 16px;
        border: 1px solid var(--border);
        border-radius: 4px;
        background: var(--light);
        font-size: 13px;
        color: var(--primary);
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='%23555555'%3E%3Cpath d='M6 8L0 0h12L6 8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        cursor: pointer;
        min-width: 160px;
    }
    .filter-right select:focus {
        outline: none;
        border-color: var(--primary);
    }

    .product-section {
        padding: 70px 0 100px;
        background: var(--light);
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 26px;
    }
    .product-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 4px;
        overflow: hidden;
        transition: var(--transition-smooth);
        position: relative;
    }
    .product-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-6px);
    }
    .product-card .image-wrap {
        position: relative;
        overflow: hidden;
        aspect-ratio: 3 / 4;
        background: var(--light);
    }
    .product-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition-smooth);
    }
    .product-card:hover img {
        transform: scale(1.05);
    }
    .product-card .wishlist-btn {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--white);
        border: 1px solid var(--border);
        display: grid;
        place-items: center;
        color: var(--primary);
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .product-card .wishlist-btn:hover {
        background: var(--primary);
        color: var(--white);
        border-color: var(--primary);
    }
    .product-card .info {
        padding: 22px 18px;
        text-align: center;
    }
    .product-card .tag {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--accent);
        font-weight: 700;
        margin-bottom: 8px;
    }
    .product-card h3 {
        font-size: 15px;
        color: var(--primary);
        margin-bottom: 10px;
        font-weight: 600;
        line-height: 1.4;
    }
    .product-card .price {
        font-size: 16px;
        color: var(--primary);
        font-weight: 800;
        margin-bottom: 16px;
    }
    .product-card .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 22px;
        background: var(--primary);
        color: var(--white);
        border: none;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .product-card .btn:hover {
        background: var(--accent);
    }

    @media (max-width: 1200px) {
        .product-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 991px) {
        .product-grid { grid-template-columns: repeat(2, 1fr); }
        .filter-container { flex-direction: column; align-items: stretch; }
        .filter-left, .filter-right { justify-content: space-between; width: 100%; }
        .filter-search input { width: 100%; }
    }
    @media (max-width: 768px) {
        .product-section { padding: 50px 0 80px; }
        .product-grid { grid-template-columns: repeat(2, 1fr); gap: 18px; }
    }
    @media (max-width: 480px) {
        .product-hero .hero-inner { padding: 50px 15px; }
        .product-grid { grid-template-columns: 1fr; }
        .filter-right select { width: 100%; }
    }
</style>

<section class="product-hero">
    <div class="hero-inner">
        <h1>Our Products</h1>
        <p>Explore a refined selection of wardrobe essentials designed for everyday sophistication.</p>
    </div>
</section>

<section class="filter-bar">
    <div class="container">
        <div class="filter-container">
            <div class="filter-left">
                <span>Showing 4 products</span>
                <div class="filter-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search products...">
                </div>
            </div>
            <div class="filter-right">
                <select>
                    <option value="">All Categories</option>
                    <option value="hoodies">Hoodies</option>
                    <option value="tshirts">T-Shirts</option>
                    <option value="jackets">Jackets</option>
                    <option value="accessories">Accessories</option>
                </select>
                <select>
                    <option value="">Sort By</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="newest">Newest First</option>
                </select>
            </div>
        </div>
    </div>
</section>

<section class="product-section">
    <div class="container">
        <div class="product-grid">
            <div class="product-card">
                <div class="image-wrap">
                    <img src="{{ asset('img/hoddie.jpeg') }}" alt="Classic Hoodie">
                    <button class="wishlist-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="info">
                    <p class="tag">Hoodies</p>
                    <h3>Classic Hoodie</h3>
                    <p class="price">Rs. 9,900</p>
                    <button class="btn"><i class="fas fa-shopping-bag"></i> Add to Cart</button>
                </div>
            </div>

            <div class="product-card">
                <div class="image-wrap">
                    <img src="{{ asset('img/hoddies3.jpeg') }}" alt="Streetwear Hoodie">
                    <button class="wishlist-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="info">
                    <p class="tag">Hoodies</p>
                    <h3>Streetwear Hoodie</h3>
                    <p class="price">Rs. 12,900</p>
                    <button class="btn"><i class="fas fa-shopping-bag"></i> Add to Cart</button>
                </div>
            </div>

            <div class="product-card">
                <div class="image-wrap">
                    <img src="{{ asset('img/hoddies2.jpeg') }}" alt="Urban Fit">
                    <button class="wishlist-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="info">
                    <p class="tag">Hoodies</p>
                    <h3>Urban Fit</h3>
                    <p class="price">Rs. 7,900</p>
                    <button class="btn"><i class="fas fa-shopping-bag"></i> Add to Cart</button>
                </div>
            </div>

            <div class="product-card">
                <div class="image-wrap">
                    <img src="{{ asset('img/pantsjpg.jpg') }}" alt="Signature Bottoms">
                    <button class="wishlist-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="info">
                    <p class="tag">Bottoms</p>
                    <h3>Signature Bottoms</h3>
                    <p class="price">Rs. 11,000</p>
                    <button class="btn"><i class="fas fa-shopping-bag"></i> Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
