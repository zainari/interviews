@extends('layout_frontent.app')

@section('title', 'Home | Zain Store')

@section('content')

    <!-- Slider -->
    
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
          <div class="product-item">
            <img src="img/hoddie.jpeg" alt="Product" />
            <h3>Classic Hoodie</h3>
            <p class="rating">★★★★☆</p>
            <p class="price">$99</p>
          </div>
          <div class="product-item">
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
          </div>
        </div>
      </section>

      
@endsection
