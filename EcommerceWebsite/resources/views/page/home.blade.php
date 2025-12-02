@extends('layout_frontent.app')

@section('title', 'Home | Zain Store')

@section('content')

    <!-- Slider -->
    <style>
      .add-btn {
    width: 100%;
    background: #000;
    color: #fff;
    padding: 10px 15px;
    text-align: center;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    margin-top: 8px;
    font-size: 16px;
}

.add-btn:hover {
    background: #625e5e;
}
    </style>
    
    <div class="slider">
        <div class="slide"><img src="img/watches.jpg" alt="Slide 1" /></div>
        <div class="slide"><img src="img/watch1.jpg" alt="Slide 2" /></div>
        <div class="slide"><img src="img/image15.jpg" alt="Slide 3" /></div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
      </div>
      <div class="image-set-container">
        <div class="image-set">
         
            <div class="image-item">
                <h2>Be Yourself</h2>
                <img src="img/image15.jpg" alt="Image 1">
            </div>
            <div class="image-item">
                <img src="img/image6jpg.jpg" alt="Image 2">
                <h2>This is the First Day <br> Of Your New Life</h2>
            </div>
        </div>
        <div class="image-set" >
            <div class="image-item">
                <h2>Just Do It!</h2>
                <img src="img/image5.jpg" alt="Image 3">
            </div>
        </div>
    </div>
    <section class="featured-products">
      <h2>Featured Products</h2>
      <div class="product-gallery">
        @foreach ($product as $products )
        <div class="product-item">
          <a href="{{ route('product.show', $products->id) }}" class="btn">
              @if ($products->image_url)
                  <img src="{{ asset('storage/' . $products->image_url) }}" 
                       alt="{{ $products->name }}" width="80" style="border-radius:8px;">
              @else
                  <span>No Image</span>
              @endif
          
              <h3>{{ $products->name }}</h3>
              <p class="rating">★★★★☆</p>
              <span class="price">Rs{{ number_format($products->price) }}</span>
            </a>
      
          <button onclick="window.location.href='{{ route('product.show', $products->id) }}'" 
            class="btn primary add-btn">
        Add to Cart
    </button>
    
      </div>
      
        @endforeach
        
          {{-- <div class="product-item">
            <img src="img/hoddies3.jpeg" alt="Product" />
            <h3>Streetwear Hoodie</h3>
            <p class="rating">★★★★★</p>
            <p class="price">$129</p>
          </div>
          <div class="product-item">
            <img src="img/hoddies2.jpeg" alt="Product" />
            <h3>Urban Fit</h3>
            <p class="rating">★★★☆☆</p>
            <p class="price">$79</p>
          </div> --}}
        </div>
      </section>

      
@endsection
