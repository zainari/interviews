@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'My Wishlist | Wasaaz Premium')

@section('content')
<!-- FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-neutral: #111111;
        --secondary-neutral: #555555;
        --accent-neutral: #8c8276;
        --warm-bg: #faf9f6;
        --white-bg: #ffffff;
        --light-border: #e8e6e1;
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .wishlist-page { background: var(--warm-bg); padding: 40px 0 100px; min-height: 60vh; }

    /* Breadcrumb */
    .breadcrumb-area { background: var(--white-bg); padding: 28px 0; border-bottom: 1px solid var(--light-border); }
    .breadcrumb-links { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--secondary-neutral); }
    .breadcrumb-links a { color: var(--accent-neutral); transition: var(--transition-smooth); }
    .breadcrumb-links a:hover { color: var(--primary-neutral); }
    .breadcrumb-links i { margin: 0 12px; font-size: 9px; opacity: 0.5; }

    .page-header { text-align: center; padding: 50px 0 50px; }
    .page-header p { color: var(--accent-neutral); font-weight: 700; text-transform: uppercase; letter-spacing: 3px; font-size: 11px; margin-bottom: 10px; }
    .page-header h1 { font-size: 36px; font-weight: 300; text-transform: uppercase; letter-spacing: -0.5px; color: var(--primary-neutral); }
    .page-header h1 span { font-weight: 700; }

    .wishlist-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; }

    .wishlist-card { background: var(--white-bg); border: 1px solid var(--light-border); overflow: hidden; transition: var(--transition-smooth); position: relative; display: flex; flex-direction: column; }
    .wishlist-card:hover { border-color: var(--primary-neutral); box-shadow: 0 20px 40px rgba(0,0,0,0.04); transform: translateY(-5px); }

    .p-img-box { height: clamp(260px, 30vw, 380px); background: #fbfbfb; overflow: hidden; position: relative; display: flex; align-items: center; justify-content: center; }
    .p-img-box img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
    .wishlist-card:hover .p-img-box img { transform: scale(1.05); }

    .wishlist-remove-form { position: absolute; top: 12px; right: 12px; z-index: 10; }
    .wishlist-remove-btn { width: 38px; height: 38px; border-radius: 50%; background: rgba(255,255,255,0.95); border: 1px solid var(--light-border); color: var(--primary-neutral); display: grid; place-items: center; cursor: pointer; transition: var(--transition-smooth); box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .wishlist-remove-btn:hover { background: var(--primary-neutral); color: var(--white-bg); border-color: var(--primary-neutral); transform: scale(1.05); }

    .p-info { padding: 22px 18px; text-align: center; flex-grow: 1; display: flex; flex-direction: column; }
    .p-brand { color: var(--accent-neutral); font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px; }
    .p-name { font-size: 15px; font-weight: 400; margin-bottom: 12px; color: var(--primary-neutral); text-decoration: none; height: 44px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.4; transition: var(--transition-smooth); }
    .p-name:hover { color: var(--accent-neutral); }

    .p-price-row { display: flex; align-items: baseline; justify-content: center; gap: 10px; margin-top: auto; margin-bottom: 18px; }
    .curr-price { font-size: 16px; font-weight: 700; color: var(--primary-neutral); }

    .view-btn { width: 100%; padding: 14px; background: transparent; color: var(--primary-neutral); border: 1px solid var(--primary-neutral); font-weight: 700; font-size: 11px; cursor: pointer; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; display: inline-block; transition: var(--transition-smooth); }
    .wishlist-card:hover .view-btn { background: var(--primary-neutral); color: var(--white-bg); }

    .empty-state { text-align: center; padding: 80px 30px; background: var(--white-bg); border: 1px dashed var(--light-border); max-width: 600px; margin: 0 auto; }
    .empty-state i { font-size: 50px; color: var(--accent-neutral); margin-bottom: 25px; }
    .empty-state h3 { font-size: 22px; font-weight: 700; margin-bottom: 12px; color: var(--primary-neutral); }
    .empty-state p { font-size: 14px; color: var(--secondary-neutral); margin-bottom: 30px; line-height: 1.7; }
    .btn-lux-primary { padding: 16px 40px; background: var(--primary-neutral); color: var(--white-bg); text-decoration: none; font-weight: 700; font-size: 12px; letter-spacing: 2px; text-transform: uppercase; border: 1px solid var(--primary-neutral); transition: var(--transition-smooth); display: inline-block; }
    .btn-lux-primary:hover { background: transparent; color: var(--primary-neutral); }

    /* Responsive */
    @media (max-width: 1200px) {
        .wishlist-grid { grid-template-columns: repeat(3, 1fr); gap: 20px; }
    }
    @media (max-width: 991px) {
        .wishlist-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .page-header { padding: 40px 0 40px; }
        .page-header h1 { font-size: 28px; }
    }
    @media (max-width: 480px) {
        .wishlist-grid { grid-template-columns: 1fr; }
        .p-img-box { height: 320px; }
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-links">
            <a href="{{ route('home.new') }}">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>My Wishlist</span>
        </div>
    </div>
</div>

<div class="wishlist-page">
    <div class="container">
        <div class="page-header" data-aos="fade-up">
            <p>Your Saved Selection</p>
            <h1>My <span>Wishlist</span></h1>
        </div>

        <div class="wishlist-grid">
            @forelse($wishlists as $w)
                @if($w->product)
                <div class="wishlist-card" data-aos="fade-up" data-aos-delay="{{ $loop->index % 8 * 50 }}">
                    <form action="{{ route('wishlist.remove', $w->id) }}" method="POST" class="wishlist-remove-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="wishlist-remove-btn" title="Remove Item">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </form>

                    <div class="p-img-box">
                        <a href="{{ route('product.show', $w->product->slug ?? $w->product->id) }}" style="width: 100%; height: 100%;">
                            <img src="{{ Str::startsWith($w->product->image_url, 'http') ? $w->product->image_url : asset('storage/' . $w->product->image_url) }}" alt="{{ $w->product->name }}">
                        </a>
                    </div>

                    <div class="p-info">
                        <span class="p-brand">{{ $w->product->brand ?? 'WASA SELECT' }}</span>
                        <a href="{{ route('product.show', $w->product->slug ?? $w->product->id) }}" class="p-name">
                            {{ $w->product->name }}
                        </a>
                        <div class="p-price-row">
                            <span class="curr-price">Rs. {{ number_format($w->product->price) }}</span>
                        </div>
                        <a href="{{ route('product.show', $w->product->slug ?? $w->product->id) }}" class="view-btn">
                            View Product
                        </a>
                    </div>
                </div>
                @endif
            @empty
                <div style="grid-column: 1/-1;">
                    <div class="empty-state" data-aos="fade-up">
                        <i class="fa-regular fa-heart"></i>
                        <h3>Your Wishlist is Empty</h3>
                        <p>Explore our premium collections and save your favorite pieces for quick access later.</p>
                        <a href="{{ route('shop.all') }}" class="btn-lux-primary">Discover Collection</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
