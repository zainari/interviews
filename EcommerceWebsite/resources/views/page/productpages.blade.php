@extends('layout_frontent.app')

@section('title', 'Smartwatch | Zain Store')

@section('content')

<section class="product-detail-section">
  <div class="detail-container">
    
    <div class="detail-image">
      <img src="{{ asset('img/watches.jpg') }}" alt="Elite Smartwatch">
    </div>

    <div class="detail-info">
      <h2>Elite Smartwatch</h2>
      <p class="price">$149.00</p>
      <p class="description">
        Experience innovation at your wrist. The Elite Smartwatch combines elegant design 
        with powerful features — heart rate tracking, Bluetooth connectivity, 
        and long-lasting battery life for your daily adventures.
      </p>

      <div class="variants">
        <label for="variant-select">Choose Color:</label>
        <select id="variant-select" name="variant">
          <option>Black — $149.00</option>
          <option>Silver — $149.00</option>
          <option>Rose Gold — $149.00</option>
        </select>
      </div>

      <button class="btn add-to-cart">Add to Cart</button>

      <div class="features">
        <h3>Key Features</h3>
        <ul>
          <li>Heart rate & sleep tracking</li>
          <li>Water-resistant design</li>
          <li>Bluetooth 5.0 connectivity</li>
          <li>Up to 10-day battery life</li>
          <li>Compatible with iOS & Android</li>
        </ul>
      </div>
    </div>
  </div>
</section>

@endsection
