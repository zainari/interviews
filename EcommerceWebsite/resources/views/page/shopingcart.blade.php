@extends('layoutecommercepage.layoutnewfrontend')

@section('title', $product->name . ' | EliteStore Premium')

@section('content')
<style>
    :root {
        --black: #000000;
        --white: #ffffff;
        --gray-light: #f5f5f5;
        --text-muted: #555555;
        --border: #e5e5e5;
        --accent-blue: #2563eb;
        --danger: #ef4444;
    }

    body { font-family: 'Inter', sans-serif; background: #fff; color: var(--black); }

    /* --- Breadcrumbs --- */
    .breadcrumb-nav { padding: 100px 5% 20px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #999; }
    .breadcrumb-nav a { text-decoration: none; color: #999; }

    /* --- Main Layout Grid --- */
    .product-container { display: grid; grid-template-columns: 80px 1fr 450px; gap: 30px; padding: 0 5%; max-width: 1400px; margin: auto; }

    /* Vertical Thumbnails */
    .thumbnail-list { display: flex; flex-direction: column; gap: 12px; }
    .thumb-item { width: 75px; aspect-ratio: 3/4; background: var(--gray-light); cursor: pointer; overflow: hidden; border: 1px solid transparent; transition: 0.3s; }
    .thumb-item.active { border-color: var(--black); }
    .thumb-item img { width: 100%; height: 100%; object-fit: cover; }

    /* Main Big Image */
    .main-image-box { width: 100%; background: var(--gray-light); aspect-ratio: 3/4; overflow: hidden; position: relative; }
    .main-image-box img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s cubic-bezier(0.4, 0, 0.2, 1); }

    /* Product Details Side */
    .product-details { padding-left: 20px; }
    .sale-tag { font-size: 10px; border: 1px solid #ddd; padding: 3px 10px; display: inline-block; margin-bottom: 15px; text-transform: uppercase; font-weight: 800; }
    .p-title { font-size: 28px; font-weight: 500; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; line-height: 1.1; }
    .p-brand { font-size: 12px; color: #999; margin-bottom: 25px; display: block; text-transform: uppercase; letter-spacing: 1px; }

    .price-box { margin-bottom: 35px; display: flex; align-items: baseline; gap: 15px; }
    .new-price { font-size: 22px; font-weight: 700; color: var(--black); }
    .old-price { font-size: 15px; text-decoration: line-through; color: #aaa; }

    /* Variant Swatches (Color) */
    .option-label { font-size: 12px; font-weight: 700; margin-bottom: 15px; display: block; text-transform: uppercase; letter-spacing: 1px; }
    .swatches { display: flex; gap: 15px; margin-bottom: 35px; }
    .swatch { 
        width: 48px; height: 48px; border-radius: 50%; border: 1px solid #ddd; 
        padding: 2px; cursor: pointer; transition: 0.3s; position: relative; text-decoration: none;
    }
    .swatch img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }
    .swatch.active { border: 2px solid var(--black); transform: scale(1.05); }

    /* Tooltip */
    .swatch .tooltip {
        position: absolute; bottom: 120%; left: 50%; transform: translateX(-50%);
        background: #000; color: #fff; padding: 5px 10px; font-size: 10px;
        border-radius: 4px; white-space: nowrap; visibility: hidden; opacity: 0; transition: 0.3s;
    }
    .swatch:hover .tooltip { visibility: visible; opacity: 1; }

    /* Size Buttons & Stock Logic */
    .size-grid { display: flex; gap: 12px; margin-bottom: 20px; }
    .size-btn { 
        border: 1px solid #ddd; padding: 12px 28px; font-size: 12px; 
        cursor: pointer; background: #fff; transition: 0.3s; font-weight: 700; 
        position: relative; overflow: hidden;
    }
    .size-btn:hover:not(.out-of-stock) { border-color: var(--black); }
    .size-btn.active { background: var(--black); color: #fff; border-color: var(--black); }

    /* Zilbil Out of Stock Style */
    .size-btn.out-of-stock {
        color: #ccc; border: 1px dashed #ddd; cursor: not-allowed; opacity: 0.6;
    }
    .size-btn.out-of-stock::after {
        content: ""; position: absolute; top: 50%; left: 0; width: 100%; height: 1px;
        background: #ccc; transform: rotate(-15deg);
    }

    #stock-message { font-size: 12px; font-weight: 700; margin-bottom: 30px; display: block; }

    /* Quantity & Buttons */
    .qty-box { display: flex; align-items: center; border: 1px solid #ddd; width: fit-content; margin-bottom: 35px; }
    .qty-box button { background: none; border: none; width: 45px; height: 45px; cursor: pointer; font-size: 20px; }
    .qty-box input { width: 50px; text-align: center; border: none; font-weight: 800; outline: none; font-size: 15px; }

    .btn-add-bag { width: 100%; padding: 18px; border: 1px solid var(--black); background: #fff; font-weight: 800; text-transform: uppercase; font-size: 13px; cursor: pointer; margin-bottom: 12px; transition: 0.4s; letter-spacing: 1px; }
    .btn-add-bag:disabled { background: #f1f1f1; border-color: #ddd; color: #aaa; cursor: not-allowed; }
    
    .btn-buy-now { width: 100%; padding: 18px; border: 1px solid var(--black); background: var(--black); color: #fff; font-weight: 800; text-transform: uppercase; font-size: 13px; cursor: pointer; margin-bottom: 40px; transition: 0.4s; letter-spacing: 1px; }

    /* Rest of Zilbil Styles */
    .info-icons { display: flex; gap: 30px; border-top: 1px solid #eee; padding-top: 25px; margin-bottom: 45px; }
    .icon-item { display: flex; align-items: center; gap: 12px; font-size: 11px; font-weight: 700; text-transform: uppercase; color: #333; }
    .description-box h4 { font-size: 14px; margin-bottom: 15px; text-transform: uppercase; border-bottom: 1px solid #eee; padding-bottom: 10px; font-weight: 800; }
    .description-box p { font-size: 13px; line-height: 1.9; color: #666; margin-bottom: 50px; }
    
    .size-table-container { margin-bottom: 80px; }
    .size-table { width: 100%; border-collapse: collapse; }
    .size-table th, .size-table td { border: 1px solid #eee; padding: 14px; text-align: center; font-size: 12px; text-transform: uppercase; }
    .size-table th { background: #000; color: #fff; }

    /* Related Grid */
    .related-section { border-top: 1px solid #eee; padding: 80px 5%; }
    .related-title { font-size: 22px; font-weight: 500; text-transform: uppercase; margin-bottom: 45px; letter-spacing: 2px; }
    .related-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 20px; }
    .related-item { text-decoration: none; color: inherit; }
    .rel-img { width: 100%; aspect-ratio: 3/4; background: #f9f9f9; margin-bottom: 15px; overflow: hidden; }
    .rel-img img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
    .rel-name { font-size: 11px; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 5px; height: 32px; overflow: hidden; }
    .rel-price { font-size: 13px; font-weight: 800; }

    @media (max-width: 1024px) {
        .product-container { grid-template-columns: 1fr; }
        .thumbnail-list { flex-direction: row; order: 2; overflow-x: auto; }
        .main-image-box { order: 1; }
        .product-details { order: 3; padding-left: 0; margin-top: 30px; }
        .related-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="breadcrumb-nav">
    <a href="/">Home</a> <span>›</span> {{ $product->name }}
</div>

<div class="product-container">
    <!-- 1. Thumbnails -->
    <div class="thumbnail-list">
        <div class="thumb-item active" onclick="swapImage('{{ asset('storage/' . $product->image_url) }}', this)">
            <img src="{{ asset('storage/' . $product->image_url) }}" alt="">
        </div>
        @foreach($product->images as $img)
        <div class="thumb-item" onclick="swapImage('{{ asset('storage/' . $img->image_path) }}', this)">
            <img src="{{ asset('storage/' . $img->image_path) }}" alt="">
        </div>
        @endforeach
    </div>

    <!-- 2. Main Image -->
    <div class="main-image-box">
        <img id="mainViewer" src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
    </div>

    <!-- 3. Details -->
    <div class="product-details">
        <span class="sale-tag">New Season</span>
        <h1 class="p-title">{{ $product->name }}</h1>
        <span class="p-brand">{{ $product->brand ?? 'Elite Select' }}</span>

        <div class="price-box">
            <span class="new-price">Rs. {{ number_format($product->price) }}</span>
            <span class="old-price">Rs. {{ number_format($product->price * 1.3) }}</span>
        </div>

        <!-- Variants (Zilbil Style Swatches) -->
        @if(isset($variants) && count($variants) > 0)
            @php $currColor = $product->attributes->where('name', 'Color')->first()->pivot->value ?? ''; @endphp
            <span class="option-label">Color: <span id="colorName">{{ $currColor }}</span></span>
            <div class="swatches">
                @foreach($variants as $v)
                    @php $vColor = $v->attributes->where('name', 'Color')->first()->pivot->value ?? 'Color'; @endphp
                    <a href="{{ route('product.show', $v->slug) }}" class="swatch {{ $v->id == $product->id ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $v->image_url) }}" alt="{{ $vColor }}">
                        <span class="tooltip">{{ $vColor }}</span>
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Sizes Logic (The main request) -->
        @php $sizes = $product->attributes->where('name', 'Size'); @endphp
        @if($sizes->count() > 0)
            <span class="option-label">Select Size: <span id="selectedSizeName"></span></span>
            <div class="size-grid">
                @foreach($sizes as $size)
                    @php 
                        // Fetch stock for this specific size
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

        <!-- Dynamic Stock Message -->
        <span id="stock-message"></span>

        <span class="option-label">Quantity</span>
        <div class="qty-box">
            <button onclick="qtyUpdate(-1)">-</button>
            <input type="text" id="qtyInput" value="1" readonly>
            <button onclick="qtyUpdate(1)">+</button>
        </div>

        <button id="main-cart-btn" class="btn-add-bag">Add to Bag</button>
        <button id="buy-now-btn" class="btn-buy-now">Buy it now</button>

        <div class="info-icons">
            <div class="icon-item"><i class="fas fa-truck"></i> Free Shipping</div>
            <div class="icon-item"><i class="fas fa-sync-alt"></i> Easy Exchange</div>
        </div>

        <div class="description-box">
            <h4>Description</h4>
            <p>{{ $product->description }}</p>
        </div>

        <!-- Size Chart -->
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

<!-- Related Products -->
<div class="related-section">
    <h2 class="related-title">You May Also Like</h2>
    <div class="related-grid">
        @foreach($relatedProducts as $rel)
        <a href="{{ route('product.show', $rel->slug) }}" class="related-item">
            <div class="rel-img"><img src="{{ asset('storage/' . $rel->image_url) }}"></div>
            <span class="rel-name">{{ $rel->name }}</span>
            <span class="rel-price">Rs. {{ number_format($rel->price) }}</span>
        </a>
        @endforeach
    </div>
</div>

<script>
    // 1. Image Swapping
    function swapImage(src, element) {
        document.getElementById('mainViewer').src = src;
        document.querySelectorAll('.thumb-item').forEach(i => i.classList.remove('active'));
        element.classList.add('active');
    }

    // 2. Zilbil Style Size & Stock Selection Logic
    function handleSizeSelect(sizeName, stockQty, element) {
        // Highlight active size
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        element.classList.add('active');
        document.getElementById('selectedSizeName').innerText = sizeName;

        let msg = document.getElementById('stock-message');
        let cartBtn = document.getElementById('main-cart-btn');
        let buyBtn = document.getElementById('buy-now-btn');

        if(stockQty <= 0) {
            msg.innerHTML = '<span style="color:var(--danger)">Sold Out</span>';
            cartBtn.disabled = true;
            cartBtn.innerText = "Sold Out";
            buyBtn.style.display = "none";
        } else {
            msg.innerHTML = '<span style="color:#1a7d32"><i class="fas fa-check"></i> In stock, and ready to ship</span>';
            cartBtn.disabled = false;
            cartBtn.innerText = "Add to Bag";
            buyBtn.style.display = "block";
        }
    }

    function qtyUpdate(val) {
        let input = document.getElementById('qtyInput');
        let current = parseInt(input.value);
        if(current + val >= 1) input.value = current + val;
    }
</script>
@endsection