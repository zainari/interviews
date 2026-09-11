@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Contact Us | Wasaaz Premium')

@section('content')

<style>
    .contact-hero {
        position: relative;
        min-height: 55vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('{{ asset('img/contact.png') }}') center/cover no-repeat;
        text-align: center;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(17, 17, 17, 0.5);
    }
    .contact-hero .hero-inner {
        position: relative;
        z-index: 1;
        padding: 80px 20px;
    }
    .contact-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(36px, 6vw, 64px);
        color: var(--white);
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 14px;
    }
    .contact-hero p {
        font-size: clamp(14px, 2vw, 17px);
        color: rgba(255,255,255,0.9);
        max-width: 620px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .contact-section {
        padding: 100px 0;
        background: var(--light);
    }
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.1fr;
        gap: 60px;
        align-items: start;
    }
    .contact-info h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 3.5vw, 40px);
        color: var(--primary);
        margin-bottom: 16px;
        font-weight: 600;
    }
    .contact-info .accent-line {
        width: 50px;
        height: 2px;
        background: var(--accent);
        margin-bottom: 24px;
    }
    .contact-info .lead {
        color: var(--secondary);
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 36px;
    }
    .contact-info .info-block {
        display: flex;
        gap: 18px;
        margin-bottom: 26px;
        align-items: flex-start;
    }
    .contact-info .info-block i {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: var(--white);
        border: 1px solid var(--border);
        color: var(--accent);
        display: grid;
        place-items: center;
        font-size: 15px;
        flex-shrink: 0;
    }
    .contact-info .info-block h5 {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--primary);
        margin-bottom: 6px;
        font-weight: 700;
    }
    .contact-info .info-block p {
        color: var(--secondary);
        font-size: 14px;
        line-height: 1.6;
    }

    .contact-form {
        background: var(--white);
        padding: 48px;
        border-radius: 4px;
        border: 1px solid var(--border);
    }
    .contact-form h3 {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        color: var(--primary);
        margin-bottom: 30px;
        font-weight: 600;
    }
    .form-group {
        margin-bottom: 22px;
    }
    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--primary);
        margin-bottom: 8px;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 15px 18px;
        border: 1px solid var(--border);
        border-radius: 4px;
        background: var(--light);
        color: var(--primary);
        font-size: 14px;
        transition: var(--transition-smooth);
        outline: none;
    }
    .form-group input:focus,
    .form-group textarea:focus {
        background: var(--white);
        border-color: var(--primary);
    }
    .form-group textarea {
        resize: vertical;
        min-height: 140px;
    }
    .contact-form button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 36px;
        background: var(--primary);
        color: var(--white);
        border: none;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .contact-form button:hover {
        background: var(--accent);
    }

    .map-section {
        padding: 0 0 100px;
        background: var(--light);
    }
    .map-placeholder {
        width: 100%;
        height: 380px;
        background: var(--border);
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 14px;
        color: var(--secondary);
        border: 1px solid var(--border);
    }
    .map-placeholder i {
        font-size: 36px;
        color: var(--accent);
    }
    .map-placeholder p {
        font-size: 14px;
        font-weight: 500;
    }

    @media (max-width: 991px) {
        .contact-grid { grid-template-columns: 1fr; gap: 50px; }
        .contact-form { padding: 36px; }
    }
    @media (max-width: 768px) {
        .contact-section, .map-section { padding: 70px 0; }
        .contact-form { padding: 30px 24px; }
    }
    @media (max-width: 480px) {
        .contact-hero .hero-inner { padding: 60px 15px; }
    }
</style>

<section class="contact-hero">
    <div class="hero-inner">
        <h1>Contact Us</h1>
        <p>We would love to hear from you. Reach out for support, partnership enquiries, or just to say hello.</p>
    </div>
</section>

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <h2>Get in Touch</h2>
                <div class="accent-line"></div>
                <p class="lead">Our customer care team is here to help with orders, styling advice, or any questions you may have. Expect a response within one business day.</p>

                <div class="info-block">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h5>Visit Us</h5>
                        <p>Wasaaz Studio, Business District, Karachi, Pakistan</p>
                    </div>
                </div>

                <div class="info-block">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h5>Email Us</h5>
                        <p>hello@wasaaz.com<br>support@wasaaz.com</p>
                    </div>
                </div>

                <div class="info-block">
                    <i class="fas fa-phone-alt"></i>
                    <div>
                        <h5>Call Us</h5>
                        <p>+92 21 111 222 333<br>Mon - Sat / 9:00 AM - 8:00 PM</p>
                    </div>
                </div>
            </div>

            <form class="contact-form" action="{{ route('home.new') }}" method="GET">
                <h3>Send a Message</h3>
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="john@example.com" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="How can we help?" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Tell us a little more..." rows="5" required></textarea>
                </div>
                <button type="submit">Send Message <i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</section>

<section class="map-section">
    <div class="container">
        <div class="map-placeholder">
            <i class="fas fa-map-marked-alt"></i>
            <p>Wasaaz Studio, Business District, Karachi</p>
        </div>
    </div>
</section>

@endsection
