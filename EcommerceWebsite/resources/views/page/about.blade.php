@extends('layout_frontent.app')

@section('title', 'Home | Zain Store')

@section('content')


  <!-- Hero Section -->
  <section class="hero" style="background-image: url('{{ asset('img/bimage.png') }}');">
   <div class="hero-content">
    <h1 >About Zain Store</h1>
    <p>Delivering quality, innovation, and style to elevate your everyday lifestyle.</p>
    </div>
</section>
  

  <!-- About Section -->
  <section class="aboutpage">
    <img src="img/aboutimage.png" alt="About Us">
    <div class="about-text">
      <h2>Who We Are</h2>
      <p>Welcome to Zain Store! We are passionate about bringing you the best in fashion, electronics, and lifestyle products. Our journey began with a mission — to make premium quality accessible to everyone.</p>
      <p>We value our customers’ trust and constantly work to provide top-notch service and innovative designs that meet your everyday needs.</p>
    </div>
  </section>

  <!-- Mission & Vision -->
  <section class="mission-section">
    <div class="mission-box">
      <h3>Our Mission</h3>
      <p>To provide premium, stylish, and affordable products that empower our customers to express themselves with confidence.</p>
    </div>
    <div class="mission-box">
      <h3>Our Vision</h3>
      <p>To become a global lifestyle brand recognized for quality, trust, and innovation in every product we deliver.</p>
    </div>
  </section>

  <!-- Team Section -->
  <section class="team">
    <h2>Meet Our Team</h2>
    <div class="team-members">
      <div class="member">
        <img src="img/human.jpeg" alt="Team Member 1">
        <h4>Zain Arif</h4>
        <p>Founder & CEO</p>
      </div>
      <div class="member">
        <img src="img/women.jpeg" alt="Team Member 2">
        <h4>Sarah Khan</h4>
        <p>Marketing Head</p>
      </div>
      <div class="member">
        <img src="img/human1.jpeg" alt="Team Member 3">
        <h4>Ahmed Raza</h4>
        <p>Product Designer</p>
      </div>
    </div>
  </section>

      
@endsection
