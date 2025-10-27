@extends('layout_frontent.app')

@section('title', 'Products | Zain Store')

@section('content')

<!-- 🛒 Product Filter -->
<section class="filter-bar">
  <div class="filter-container">
    <input type="text" placeholder="Search products..." class="search-box">
    <select class="category-select">
      <option value="">All Categories</option>
      <option value="hoodies">Hoodies</option>
      <option value="tshirts">T-Shirts</option>
      <option value="jackets">Jackets</option>
      <option value="accessories">Accessories</option>
    </select>
  </div>
</section>

<!-- 🧢 Hero Section -->
<section class="product">

  <div class="product-hero">
    {{-- <h1>OUR PRODUCTS</h1>
    <p>Explore the latest trends in fashion, designed just for you.</p> --}}
  </div>
</section>



<!--  Product Gallery -->
<section class="product-grid">
  <div class="product-card">
    <img src="{{ asset('img/hoddie.jpeg') }}" alt="Product 1">
    <h3>Classic Hoodie</h3>
    <p class="price">$99</p>
    <button class="btn">Add to Cart</button>
  </div>

  <div class="product-card">
    <img src="{{ asset('img/hoddies3.jpeg') }}" alt="Product 2">
    <h3>Streetwear Hoodie</h3>
    <p class="price">$129</p>
    <button class="btn">Add to Cart</button>
  </div>

  <div class="product-card">
    <img src="{{ asset('img/hoddies2.jpeg') }}" alt="Product 3">
    <h3>Urban Fit</h3>
    <p class="price">$79</p>
    <button class="btn">Add to Cart</button>
  </div>

  <div class="product-card">
    <img src="{{ asset('img/pantsjpg.jpg') }}" alt="Product 4">
    <h3>Oversized Sweatshirt</h3>
    <p class="price">$110</p>
    <button class="btn">Add to Cart</button>
  </div>
</section>

@endsection