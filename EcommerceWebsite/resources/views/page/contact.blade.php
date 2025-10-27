@extends('layout_frontent.app')

@section('title', 'Contact Us | Zain Store')

@section('content')

<!-- Hero Section -->
<section class="contact-hero" style="background-image: url('{{ asset('img/contact.png') }}');">
  <div class="overlay"></div>
  <div class="hero-text">
    {{-- <h1>Contact Us</h1> --}}
    <p>We’d love to hear from you! Get in touch with our team today.</p>
  </div>
</section>

<!-- Contact Form Section -->
<section class="contact-section">
  <div class="contact-container">
    <div class="contact-info">
      <h2>Get in Touch</h2>
      <p>Have a question or feedback? Reach out via the form or email us directly at <strong>support@zainstore.com</strong></p>
      <ul>
        <li><i class="fas fa-map-marker-alt"></i> Lahore, Pakistan</li>
        <li><i class="fas fa-envelope"></i> info@zainstore.com</li>
        <li><i class="fas fa-phone"></i> +92 300 1234567</li>
      </ul>
    </div>

    <form class="contact-form">
      <div class="form-group">
        <input type="text" placeholder="Your Name" required>
      </div>
      <div class="form-group">
        <input type="email" placeholder="Your Email" required>
      </div>
      <div class="form-group">
        <textarea placeholder="Your Message" rows="5" required></textarea>
      </div>
      <button type="submit">Send Message</button>
    </form>
  </div>
</section>

@endsection
