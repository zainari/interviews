@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Contact Us | Wasaaz')

@section('content')

<style>
    :root {
        --wasaaz-bg: #0a0a0a;
        --wasaaz-card: #111111;
        --wasaaz-elevated: #161616;
        --wasaaz-border: #1f1f1f;
        --wasaaz-text: #ffffff;
        --wasaaz-muted: #888888;
        --wasaaz-accent: #7a1f2a;
        --wasaaz-gold: #c9a86c;
        --transition-smooth: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* Header overrides for dark page */
    #mainHeader { background: transparent !important; border-bottom-color: rgba(255,255,255,0.1) !important; }
    #mainHeader.scrolled { background: var(--white) !important; border-bottom-color: var(--border) !important; box-shadow: var(--shadow-md) !important; }
    #mainHeader .logo-box { color: #ffffff !important; }
    #mainHeader.scrolled .logo-box { color: var(--primary) !important; }
    #mainHeader .icon-box { color: #ffffff; }
    #mainHeader.scrolled .icon-box { color: var(--primary); }
    #mainHeader .icon-box:hover { background: rgba(255,255,255,0.1); }
    #mainHeader.scrolled .icon-box:hover { background: var(--light); }
    #mainHeader .search-bar form { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); }
    #mainHeader.scrolled .search-bar form { background: var(--light); border-color: var(--border); }
    #mainHeader .search-bar input { color: #ffffff; }
    #mainHeader.scrolled .search-bar input { color: var(--primary); }
    #mainHeader .search-bar input::placeholder { color: rgba(255,255,255,0.6); }
    #mainHeader.scrolled .search-bar input::placeholder { color: var(--muted); }
    #mainHeader .search-bar button { color: #ffffff; }
    #mainHeader.scrolled .search-bar button { color: var(--secondary); }
    #mainHeader .mobile-toggle { color: #ffffff; }
    #mainHeader.scrolled .mobile-toggle { color: var(--primary); }
    .bottom-nav { background: transparent; border-bottom-color: rgba(255,255,255,0.1); }
    .bottom-nav .nav-menu li a { color: rgba(255,255,255,0.8); }
    .bottom-nav .nav-menu li a:hover { color: #ffffff; }
    .bottom-nav .nav-menu li a::after { background: #ffffff; }

    /* Hero */
    .contact-hero {
        min-height: 72vh;
        background: var(--wasaaz-bg);
        margin-top: -130px;
        padding-top: 210px;
        padding-bottom: 100px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 35%, rgba(122,31,42,0.18) 0%, rgba(0,0,0,0) 60%);
    }
    .contact-hero .hero-inner { position: relative; z-index: 1; padding: 0 20px; }
    .contact-hero .hero-pretitle {
        display: block;
        color: var(--wasaaz-gold);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-bottom: 18px;
    }
    .contact-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(40px, 7vw, 76px);
        color: var(--wasaaz-text);
        font-weight: 600;
        letter-spacing: -1px;
        margin-bottom: 18px;
        line-height: 1.05;
    }
    .contact-hero h1 span { color: var(--wasaaz-accent); font-weight: 700; }
    .contact-hero p {
        font-size: clamp(14px, 2vw, 17px);
        color: var(--wasaaz-muted);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.8;
    }

    /* Contact section */
    .contact-section { padding: 120px 0; background: var(--wasaaz-bg); }
    .contact-grid { display: grid; grid-template-columns: 1fr 1.1fr; gap: 60px; align-items: start; }

    .contact-info .accent-line { width: 60px; height: 2px; background: var(--wasaaz-accent); margin-bottom: 22px; }
    .contact-info span {
        color: var(--wasaaz-gold);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 14px;
    }
    .contact-info h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(30px, 4vw, 44px);
        color: var(--wasaaz-text);
        margin-bottom: 16px;
        font-weight: 600;
    }
    .contact-info .lead { color: var(--wasaaz-muted); font-size: 15px; line-height: 1.8; margin-bottom: 40px; }

    .info-block { display: flex; gap: 18px; margin-bottom: 28px; align-items: flex-start; }
    .info-block i {
        width: 48px; height: 48px;
        border-radius: 50%;
        background: var(--wasaaz-elevated);
        border: 1px solid var(--wasaaz-border);
        color: var(--wasaaz-gold);
        display: grid; place-items: center;
        font-size: 15px; flex-shrink: 0;
    }
    .info-block h5 {
        font-size: 12px; text-transform: uppercase; letter-spacing: 1.5px;
        color: var(--wasaaz-text); margin-bottom: 6px; font-weight: 700;
    }
    .info-block p { color: var(--wasaaz-muted); font-size: 14px; line-height: 1.7; }

    /* Form */
    .contact-form {
        background: var(--wasaaz-card);
        padding: 48px;
        border-radius: 6px;
        border: 1px solid var(--wasaaz-border);
    }
    .contact-form h3 {
        font-family: 'Playfair Display', serif;
        font-size: 26px;
        color: var(--wasaaz-text);
        margin-bottom: 30px;
        font-weight: 600;
    }
    .form-group { margin-bottom: 22px; }
    .form-group label {
        display: block;
        font-size: 11px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 1.5px;
        color: var(--wasaaz-muted);
        margin-bottom: 8px;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 15px 18px;
        border: 1px solid var(--wasaaz-border);
        border-radius: 6px;
        background: var(--wasaaz-elevated);
        color: var(--wasaaz-text);
        font-size: 14px;
        transition: var(--transition-smooth);
        outline: none;
    }
    .form-group input::placeholder,
    .form-group textarea::placeholder { color: var(--wasaaz-muted); }
    .form-group input:focus,
    .form-group textarea:focus {
        background: var(--wasaaz-card);
        border-color: var(--wasaaz-gold);
        box-shadow: 0 0 0 4px rgba(201,168,108,0.1);
    }
    .form-group textarea { resize: vertical; min-height: 140px; }

    .contact-form button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 40px;
        background: var(--wasaaz-text);
        color: var(--wasaaz-bg);
        border: 1px solid var(--wasaaz-text);
        border-radius: 6px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .contact-form button:hover { background: transparent; color: var(--wasaaz-text); }

    .form-flash {
        padding: 14px 18px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 22px;
    }
    .form-flash.success {
        background: rgba(52, 211, 153, 0.1);
        border: 1px solid rgba(52, 211, 153, 0.35);
        color: #34d399;
    }
    .form-flash.error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.35);
        color: #f87171;
    }
    .field-error { color: #f87171; font-size: 12px; margin-top: 6px; display: block; }

    /* Map */
    .map-section { padding: 0 0 110px; background: var(--wasaaz-bg); }
    .map-placeholder {
        width: 100%;
        height: 380px;
        background: var(--wasaaz-card);
        border-radius: 6px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 14px;
        color: var(--wasaaz-muted);
        border: 1px dashed var(--wasaaz-border);
    }
    .map-placeholder i { font-size: 36px; color: var(--wasaaz-accent); }
    .map-placeholder p { font-size: 14px; font-weight: 600; }

    @media (max-width: 991px) {
        .contact-grid { grid-template-columns: 1fr; gap: 50px; }
        .contact-form { padding: 38px; }
    }
    @media (max-width: 768px) {
        .contact-section, .map-section { padding: 80px 0; }
        .map-section { padding-top: 0; }
        .contact-form { padding: 30px 24px; }
        .contact-hero { padding-top: 170px; }
    }
    @media (max-width: 480px) {
        .contact-form { padding: 28px 20px; }
        .contact-form button { width: 100%; justify-content: center; }
    }
</style>

<!-- Hero -->
<section class="contact-hero">
    <div class="hero-inner" data-aos="fade-up">
        <span class="hero-pretitle">Reach Out</span>
        <h1>Contact <span>Wasaaz</span></h1>
        <p>Questions about a drop, your order, or a collaboration? Our team is here — expect a reply within one business day.</p>
    </div>
</section>

<!-- Contact -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info" data-aos="fade-right">
                <div class="accent-line"></div>
                <span>Get in Touch</span>
                <h2>Let's Talk</h2>
                <p class="lead">Whether it's sizing help, order support, or a partnership enquiry — drop us a line and we'll get back to you.</p>

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
                        <p>+92 21 111 222 333<br>Mon – Sat / 9:00 AM – 8:00 PM</p>
                    </div>
                </div>
            </div>

            <form class="contact-form" action="{{ route('contact.submit') }}" method="POST" data-aos="fade-left">
                @csrf
                <h3>Send a Message</h3>

                @if(session('success'))
                    <div class="form-flash success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="form-flash error"><i class="fas fa-exclamation-circle"></i> Please fix the errors below and try again.</div>
                @endif

                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Ali Khan" value="{{ old('name') }}" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="ali@example.com" value="{{ old('email') }}" required>
                    @error('email')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="How can we help?" value="{{ old('subject') }}">
                    @error('subject')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Tell us a little more..." rows="5" required>{{ old('message') }}</textarea>
                    @error('message')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <button type="submit">Send Message <i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</section>

<!-- Map -->
<section class="map-section">
    <div class="container">
        <div class="map-placeholder" data-aos="fade-up">
            <i class="fas fa-map-marked-alt"></i>
            <p>Wasaaz Studio, Business District, Karachi</p>
        </div>
    </div>
</section>

@endsection
