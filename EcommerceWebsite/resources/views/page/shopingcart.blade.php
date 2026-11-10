@extends('layoutecommercepage.layoutnewfrontend')

@section('title', ($product->name ?? 'Product') . ' | Wasaaz Premium')

@section('content')
<!-- SweetAlert2 for professional notifications -->
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
        --danger: #ef4444;
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .product-page { background: var(--warm-bg); padding: 40px 0 100px; }

    /* Breadcrumb */
    .breadcrumb-area { background: var(--white-bg); padding: 28px 0; border-bottom: 1px solid var(--light-border); }
    .breadcrumb-links { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--secondary-neutral); }
    .breadcrumb-links a { color: var(--accent-neutral); transition: var(--transition-smooth); }
    .breadcrumb-links a:hover { color: var(--primary-neutral); }
    .breadcrumb-links i { margin: 0 12px; font-size: 9px; opacity: 0.5; }

    /* Product Grid */
    .product-layout { display: grid; grid-template-columns: 100px 1fr 450px; gap: 35px; align-items: start; margin-top: 50px; }

    /* Thumbnails */
    .thumbnail-list { display: flex; flex-direction: column; gap: 14px; position: sticky; top: 120px; }
    .thumb-item { width: 80px; aspect-ratio: 3/4; background: #161616; cursor: pointer; overflow: hidden; border: 1px solid var(--light-border); transition: var(--transition-smooth); }
    .thumb-item img { width: 100%; height: 100%; object-fit: cover; }
    .thumb-item.active, .thumb-item:hover { border-color: var(--primary-neutral); }

    /* Main Image */
    .main-image-box { width: 100%; background: #161616; aspect-ratio: 3/4; overflow: hidden; position: relative; border: 1px solid var(--light-border); }
    .main-image-box img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
    .main-image-box:hover img { transform: scale(1.03); }

    /* Details */
    .product-details { padding-left: 10px; }
    .sale-tag { display: inline-block; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; padding: 5px 12px; border: 1px solid var(--primary-neutral); margin-bottom: 18px; }
    .p-title { font-size: 30px; font-weight: 300; text-transform: uppercase; letter-spacing: -0.5px; line-height: 1.1; margin-bottom: 12px; color: var(--primary-neutral); }
    .p-brand { font-size: 11px; color: var(--accent-neutral); margin-bottom: 22px; display: block; text-transform: uppercase; letter-spacing: 2px; font-weight: 700; }

    .rating-row { display: flex; align-items: center; gap: 4px; margin-bottom: 20px; font-size: 13px; color: var(--secondary-neutral); }
    .rating-row i { color: var(--accent-neutral); font-size: 13px; }
    .rating-row i.dim { color: var(--light-border); }
    .rating-row span { margin-left: 8px; font-size: 12px; letter-spacing: 0.5px; }

    .price-box { display: flex; align-items: baseline; gap: 15px; margin-bottom: 28px; }
    .new-price { font-size: 24px; font-weight: 700; color: var(--primary-neutral); }
    .old-price { font-size: 15px; text-decoration: line-through; color: var(--secondary-neutral); opacity: 0.6; }

    .option-label { font-size: 11px; font-weight: 800; margin-bottom: 12px; display: block; text-transform: uppercase; letter-spacing: 1.5px; color: var(--primary-neutral); }

    /* Color Swatches */
    .swatches { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 28px; }
    .swatch { width: 48px; height: 48px; border-radius: 50%; border: 1px solid var(--light-border); padding: 2px; cursor: pointer; transition: var(--transition-smooth); position: relative; text-decoration: none; display: inline-block; }
    .swatch img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; display: block; }
    .swatch.active { border: 2px solid var(--primary-neutral); transform: scale(1.05); }
    .swatch .tooltip { position: absolute; bottom: 120%; left: 50%; transform: translateX(-50%); background: var(--primary-neutral); color: var(--white-bg); padding: 5px 10px; font-size: 10px; border-radius: 4px; white-space: nowrap; visibility: hidden; opacity: 0; transition: 0.3s; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
    .swatch:hover .tooltip { visibility: visible; opacity: 1; }

    /* Size Buttons */
    .size-grid { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 10px; }
    .size-btn { border: 1px solid var(--light-border); padding: 12px 26px; font-size: 12px; cursor: pointer; background: var(--white-bg); transition: var(--transition-smooth); font-weight: 700; position: relative; overflow: hidden; color: var(--primary-neutral); min-width: 48px; }
    .size-btn:hover:not(.out-of-stock) { border-color: var(--primary-neutral); }
    .size-btn.active { background: var(--primary-neutral); color: var(--white-bg); border-color: var(--primary-neutral); }
    .size-btn.out-of-stock { color: #555; border: 1px dashed var(--light-border); cursor: not-allowed; opacity: 0.6; }
    .size-btn.out-of-stock::after { content: ""; position: absolute; top: 50%; left: 0; width: 100%; height: 1px; background: #555; transform: rotate(-15deg); }

    #stock-message { font-size: 12px; font-weight: 700; margin-bottom: 28px; display: block; min-height: 18px; }

    /* Quantity */
    .qty-box { display: flex; align-items: center; border: 1px solid var(--light-border); width: fit-content; margin-bottom: 22px; }
    .qty-box button { background: none; border: none; width: 45px; height: 45px; cursor: pointer; font-size: 18px; color: var(--primary-neutral); transition: var(--transition-smooth); }
    .qty-box button:hover { background: var(--warm-bg); }
    .qty-box input { width: 50px; text-align: center; border: none; background: transparent; font-weight: 800; outline: none; font-size: 15px; color: var(--primary-neutral); }

    /* Action Buttons */
    .action-row { display: flex; gap: 12px; margin-bottom: 30px; }
    .btn-add-bag { flex: 1; padding: 18px; border: 1px solid var(--primary-neutral); background: var(--primary-neutral); color: var(--white-bg); font-weight: 700; text-transform: uppercase; font-size: 12px; cursor: pointer; transition: var(--transition-smooth); letter-spacing: 2px; }
    .btn-add-bag:hover { background: transparent; color: var(--primary-neutral); }
    .btn-add-bag:disabled { background: #1a1a1a; color: #555; border-color: var(--light-border); cursor: not-allowed; }
    .btn-wishlist { width: 58px; height: 58px; border: 1px solid var(--primary-neutral); background: transparent; color: var(--primary-neutral); display: grid; place-items: center; cursor: pointer; font-size: 18px; transition: var(--transition-smooth); }
    .btn-wishlist:hover { background: var(--primary-neutral); color: var(--white-bg); }

    .info-icons { display: flex; gap: 30px; border-top: 1px solid var(--light-border); padding-top: 25px; margin-bottom: 40px; flex-wrap: wrap; }
    .icon-item { display: flex; align-items: center; gap: 12px; font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--secondary-neutral); }
    .icon-item i { color: var(--accent-neutral); font-size: 14px; }

    .description-box { margin-bottom: 50px; }
    .description-box h4 { font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 18px; color: var(--primary-neutral); }
    .description-box p { font-size: 14px; line-height: 1.8; color: var(--secondary-neutral); }

    .size-table-container { margin-bottom: 80px; }
    .size-table-container h4 { font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 18px; color: var(--primary-neutral); }
    .size-table { width: 100%; border-collapse: collapse; }
    .size-table th, .size-table td { border: 1px solid var(--light-border); padding: 14px; text-align: center; font-size: 12px; text-transform: uppercase; }
    .size-table th { background: var(--primary-neutral); color: var(--white-bg); font-weight: 700; }
    .size-table td { color: var(--secondary-neutral); }

    /* Related Products */
    .related-section { padding: 80px 0 0; border-top: 1px solid var(--light-border); }
    .related-header { text-align: center; margin-bottom: 50px; }
    .related-header p { color: var(--accent-neutral); font-weight: 700; text-transform: uppercase; letter-spacing: 3px; font-size: 11px; margin-bottom: 10px; }
    .related-header h2 { font-size: 32px; font-weight: 300; text-transform: uppercase; letter-spacing: -0.5px; color: var(--primary-neutral); }
    .related-header h2 span { font-weight: 700; }
    .related-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; }
    .related-item { text-decoration: none; color: inherit; background: var(--white-bg); border: 1px solid var(--light-border); overflow: hidden; transition: var(--transition-smooth); display: block; }
    .related-item:hover { border-color: var(--primary-neutral); transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.04); }
    .rel-img { width: 100%; aspect-ratio: 3/4; background: #161616; overflow: hidden; }
    .rel-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
    .related-item:hover .rel-img img { transform: scale(1.05); }
    .rel-info { padding: 18px; text-align: center; }
    .rel-name { font-size: 13px; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 6px; height: 36px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.3; color: var(--primary-neutral); }
    .rel-price { font-size: 14px; font-weight: 700; color: var(--primary-neutral); }

    /* Reviews */
    .reviews-section { padding: 80px 0 0; border-top: 1px solid var(--light-border); }
    .reviews-header { text-align: center; margin-bottom: 45px; }
    .reviews-header p { color: var(--accent-neutral); font-weight: 700; text-transform: uppercase; letter-spacing: 3px; font-size: 11px; margin-bottom: 10px; }
    .reviews-header h2 { font-size: 32px; font-weight: 300; text-transform: uppercase; letter-spacing: -0.5px; color: var(--primary-neutral); }
    .reviews-header h2 span { font-weight: 700; }
    .reviews-avg { margin-top: 12px; font-size: 14px; color: var(--secondary-neutral); display: flex; justify-content: center; align-items: center; gap: 4px; }
    .reviews-avg i { color: var(--accent-neutral); }
    .reviews-avg i.dim { color: var(--light-border); }
    .reviews-avg span { margin-left: 8px; }
    .reviews-grid { display: grid; grid-template-columns: 1fr 380px; gap: 30px; align-items: start; }
    .reviews-list { display: flex; flex-direction: column; gap: 16px; max-height: 520px; overflow-y: auto; }
    .review-card { background: var(--white-bg); border: 1px solid var(--light-border); padding: 22px; }
    .review-top { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
    .review-avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-neutral), #8a6a35); color: #000; font-weight: 800; display: flex; align-items: center; justify-content: center; font-size: 15px; }
    .review-top strong { display: block; font-size: 14px; color: var(--primary-neutral); }
    .review-date { font-size: 11px; color: var(--secondary-neutral); }
    .review-stars { margin-left: auto; }
    .review-stars i { color: var(--accent-neutral); font-size: 12px; }
    .review-stars i.dim { color: var(--light-border); }
    .review-text { font-size: 14px; line-height: 1.7; color: var(--secondary-neutral); }
    .review-empty { text-align: center; padding: 50px 20px; color: var(--secondary-neutral); background: var(--white-bg); border: 1px dashed var(--light-border); }
    .review-form-card { background: var(--white-bg); border: 1px solid var(--light-border); padding: 28px; position: sticky; top: 120px; }
    .review-form-card h4 { font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 18px; color: var(--primary-neutral); }
    .review-form-card textarea { width: 100%; background: transparent; border: 1px solid var(--light-border); color: var(--primary-neutral); padding: 14px; font-size: 14px; font-family: inherit; margin-bottom: 16px; resize: vertical; }
    .review-form-card textarea:focus { border-color: var(--accent-neutral); outline: none; }
    .star-input { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 6px; margin-bottom: 16px; }
    .star-input input { display: none; }
    .star-input label { cursor: pointer; font-size: 22px; color: var(--light-border); transition: color .2s; }
    .star-input input:checked ~ label, .star-input label:hover, .star-input label:hover ~ label { color: var(--accent-neutral); }
    .review-success { background: rgba(52,211,153,.12); border: 1px solid #34d399; color: #34d399; padding: 12px 16px; font-size: 13px; margin-bottom: 16px; }
    .review-err { color: var(--danger); font-size: 12px; display: block; margin: -10px 0 12px; }
    .review-login-note p { color: var(--secondary-neutral); font-size: 14px; margin-bottom: 14px; }

    /* Responsive */
    @media (max-width: 1200px) {
        .product-layout { grid-template-columns: 80px 1fr 380px; gap: 25px; }
    }
    @media (max-width: 991px) {
        .product-layout { grid-template-columns: 1fr; gap: 30px; }
        .thumbnail-list { flex-direction: row; order: 2; overflow-x: auto; position: static; }
        .main-image-box { order: 1; }
        .product-details { order: 3; padding-left: 0; }
        .related-grid { grid-template-columns: repeat(3, 1fr); }
        .reviews-grid { grid-template-columns: 1fr; }
        .review-form-card { position: static; }
    }
    @media (max-width: 768px) {
        .p-title { font-size: 24px; }
        .related-grid { grid-template-columns: repeat(2, 1fr); }
        .related-header h2 { font-size: 26px; }
    }
    @media (max-width: 480px) {
        .related-grid { grid-template-columns: 1fr; }
        .size-grid { gap: 8px; }
        .size-btn { padding: 10px 18px; }
        .action-row { flex-direction: column; }
        .btn-wishlist { width: 100%; height: 50px; }
        .info-icons { flex-direction: column; gap: 15px; }
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-links">
            <a href="{{ route('home.new') }}">Home</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('shop.all') }}">Shop All</a>
            <i class="fas fa-chevron-right"></i>
            <span>{{ $product->name }}</span>
        </div>
    </div>
</div>

<div class="product-page">
    <div class="container">
        <div class="product-layout">
            <!-- Thumbnails -->
            <div class="thumbnail-list">
                <div class="thumb-item active" onclick="swapImage('{{ asset('storage/' . $product->image_url) }}', this)">
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
                </div>
                @foreach($product->images as $img)
                <div class="thumb-item" onclick="swapImage('{{ asset('storage/' . $img->image_path) }}', this)">
                    <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $product->name }}">
                </div>
                @endforeach
            </div>

            <!-- Main Image -->
            <div class="main-image-box">
                <img id="mainViewer" src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
            </div>

            <!-- Details -->
            <div class="product-details">
                <span class="sale-tag">New Season</span>
                <h1 class="p-title">{{ $product->name }}</h1>
                <span class="p-brand">{{ $product->brand ?? 'WASA SELECT' }}</span>

                @php
                    $reviewCount = $product->reviews->count();
                    $avgRating = $reviewCount ? round($product->reviews->avg('rating'), 1) : 0;
                @endphp
                <div class="rating-row" onclick="document.getElementById('reviews-section')?.scrollIntoView({behavior:'smooth'})" style="cursor:pointer;">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= round($avgRating) ? '' : 'dim' }}"></i>
                    @endfor
                    <span>{{ $reviewCount ? $avgRating . ' · ' . $reviewCount . ' review' . ($reviewCount > 1 ? 's' : '') : 'No reviews yet — be the first' }}</span>
                </div>

                <div class="price-box">
                    <span class="new-price">Rs. {{ number_format($product->price) }}</span>
                    <span class="old-price">Rs. {{ number_format($product->price * 1.3) }}</span>
                </div>

                <!-- Variants -->
                @if(isset($variants) && count($variants) > 0)
                    @php $currColor = $product->attributes->where('name', 'Color')->first()->pivot->value ?? ''; @endphp
                    <span class="option-label">Color: <span id="colorName">{{ $currColor }}</span></span>
                    <div class="swatches">
                        @foreach($variants as $v)
                            @php $vColor = $v->attributes->where('name', 'Color')->first()->pivot->value ?? 'Color'; @endphp
                            <a href="{{ route('product.show', $v->slug) }}" class="swatch {{ $v->id == $product->id ? 'active' : '' }}" title="{{ $vColor }}">
                                <img src="{{ asset('storage/' . $v->image_url) }}" alt="{{ $vColor }}">
                                <span class="tooltip">{{ $vColor }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Sizes -->
                @php $sizes = $product->attributes->where('name', 'Size'); @endphp
                @if($sizes->count() > 0)
                    <span class="option-label">Select Size: <span id="selectedSizeName"></span></span>
                    <div class="size-grid">
                        @foreach($sizes as $size)
                            @php
                                $sStock = $product->sizeStocks->where('size', $size->pivot->value)->first();
                                $isOut = (!$sStock || $sStock->stock <= 0);
                            @endphp
                            <button class="size-btn {{ $isOut ? 'out-of-stock' : '' }}"
                                    {{ $isOut ? 'disabled' : '' }}
                                    onclick="handleSizeSelect('{{ $size->pivot->value }}', {{ $sStock->stock ?? 0 }}, this)">
                                {{ $size->pivot->value }}
                            </button>
                        @endforeach
                    </div>
                @endif

                <span id="stock-message"></span>

                <span class="option-label">Quantity</span>
                <div class="qty-box">
                    <button onclick="qtyUpdate(-1)">-</button>
                    <input type="text" id="qtyInput" value="1" readonly>
                    <button onclick="qtyUpdate(1)">+</button>
                </div>

                <div class="action-row">
                    <button type="button" id="main-cart-btn" onclick="addToBag()" class="btn-add-bag">Add to Bag</button>
                    <button type="button" class="btn-wishlist" onclick="toggleWishlist({{ $product->id }}, this)">
                        <i class="far fa-heart"></i>
                    </button>
                </div>

                <div class="info-icons">
                    <div class="icon-item"><i class="fas fa-truck"></i> Free Shipping over Rs. 5,000</div>
                    <div class="icon-item"><i class="fas fa-sync-alt"></i> 7-Day Easy Exchange</div>
                    <div class="icon-item"><i class="fas fa-shield-alt"></i> Secure Checkout</div>
                </div>

                <div class="description-box">
                    <h4>Description</h4>
                    <p>{{ $product->description ?? 'A premium piece from our curated collection, designed with exceptional fabric and a timeless silhouette.' }}</p>
                </div>

                <div class="size-table-container">
                    <h4>Size Guide (Inches)</h4>
                    <table class="size-table">
                        <thead><tr><th>Size</th><th>Chest</th><th>Length</th><th>Shoulder</th></tr></thead>
                        <tbody>
                            <tr><td>S</td><td>19.5</td><td>27.5</td><td>17.5</td></tr>
                            <tr><td>M</td><td>20.5</td><td>28.5</td><td>18.5</td></tr>
                            <tr><td>L</td><td>21.5</td><td>29.5</td><td>19.5</td></tr>
                            <tr><td>XL</td><td>23.0</td><td>30.5</td><td>20.5</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <section class="reviews-section" id="reviews-section">
            <div class="reviews-header">
                <p>Customer Feedback</p>
                <h2>Reviews <span>({{ $reviewCount }})</span></h2>
                @if($reviewCount)
                    <div class="reviews-avg">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= round($avgRating) ? '' : 'dim' }}"></i>
                        @endfor
                        <span>{{ $avgRating }} out of 5</span>
                    </div>
                @endif
            </div>

            <div class="reviews-grid">
                <!-- Review list -->
                <div class="reviews-list">
                    @forelse($product->reviews->sortByDesc('created_at') as $review)
                        <div class="review-card">
                            <div class="review-top">
                                <div class="review-avatar">{{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}</div>
                                <div>
                                    <strong>{{ $review->user->name ?? 'Customer' }}</strong>
                                    <span class="review-date">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="review-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? '' : 'dim' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            @if($review->comment)
                                <p class="review-text">{{ $review->comment }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="review-empty">
                            <i class="far fa-comment-dots" style="font-size:36px; opacity:.3; display:block; margin-bottom:14px;"></i>
                            <p>No reviews yet. Share your experience with this product.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Review form -->
                <div class="review-form-card">
                    <h4>Write a Review</h4>
                    @if(session('review_success'))
                        <div class="review-success">{{ session('review_success') }}</div>
                    @endif
                    @auth
                        <form method="POST" action="{{ route('reviews.store', $product->slug) }}">
                            @csrf
                            <div class="star-input">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} required>
                                    <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                                @endfor
                            </div>
                            @error('rating')<span class="review-err">{{ $message }}</span>@enderror
                            <textarea name="comment" rows="4" placeholder="How was the fit, quality, delivery?">{{ old('comment') }}</textarea>
                            @error('comment')<span class="review-err">{{ $message }}</span>@enderror
                            <button type="submit" class="btn-add-bag" style="width:100%;">Submit Review</button>
                        </form>
                    @else
                        <div class="review-login-note">
                            <p>Please login to write a review.</p>
                            <a href="{{ route('user.loginpage') }}" class="btn-add-bag" style="display:block; text-align:center; text-decoration:none; line-height:58px; padding:0;">Login</a>
                        </div>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Related Products -->
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="related-section">
            <div class="related-header" data-aos="fade-up">
                <p>You May Also Like</p>
                <h2>Related <span>Products</span></h2>
            </div>
            <div class="related-grid">
                @foreach($relatedProducts as $rel)
                <a href="{{ route('product.show', $rel->slug ?? $rel->id) }}" class="related-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="rel-img">
                        <img src="{{ Str::startsWith($rel->image_url, 'http') ? $rel->image_url : asset('storage/' . $rel->image_url) }}" alt="{{ $rel->name }}">
                    </div>
                    <div class="rel-info">
                        <span class="rel-name">{{ $rel->name }}</span>
                        <span class="rel-price">Rs. {{ number_format($rel->price) }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>

<script>
    let selectedSize = null;

    function swapImage(src, element) {
        document.getElementById('mainViewer').src = src;
        document.querySelectorAll('.thumb-item').forEach(i => i.classList.remove('active'));
        element.classList.add('active');
    }

    function handleSizeSelect(sizeName, stockQty, element) {
        selectedSize = sizeName;
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        element.classList.add('active');
        document.getElementById('selectedSizeName').innerText = sizeName;

        let msg = document.getElementById('stock-message');
        let cartBtn = document.getElementById('main-cart-btn');

        if(stockQty <= 0) {
            msg.innerHTML = '<span style="color:var(--danger)">Sold Out</span>';
            cartBtn.disabled = true;
            cartBtn.innerText = "Sold Out";
        } else if(stockQty <= 5) {
            msg.innerHTML = '<span style="color:#f59e0b"><i class="fas fa-fire"></i> Only ' + stockQty + ' left — order soon!</span>';
            cartBtn.disabled = false;
            cartBtn.innerText = "Add to Bag";
        } else {
            msg.innerHTML = '<span style="color:#34d399"><i class="fas fa-check"></i> In stock, ready to ship</span>';
            cartBtn.disabled = false;
            cartBtn.innerText = "Add to Bag";
        }
    }

    function qtyUpdate(val) {
        let input = document.getElementById('qtyInput');
        let current = parseInt(input.value);
        if(current + val >= 1) input.value = current + val;
    }

    function addToBag() {
        if (!selectedSize) {
            Swal.fire({
                icon: 'warning',
                title: 'Select a size',
                text: 'Please choose your size before adding to bag.',
                confirmButtonColor: '#111111'
            });
            return;
        }

        let productId = "{{ $product->id }}";
        let quantity = document.getElementById('qtyInput').value;

        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                product_id: productId,
                size: selectedSize,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                document.querySelectorAll('.cart-icon .count').forEach(el => {
                    el.innerText = data.cart_count;
                });
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Item added to bag!',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
        });
    }
</script>
@endsection
