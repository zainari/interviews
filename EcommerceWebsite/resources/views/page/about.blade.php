@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'About Us | Wasaaz')

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
    .about-hero {
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
    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 35%, rgba(122,31,42,0.18) 0%, rgba(0,0,0,0) 60%);
    }
    .about-hero .hero-inner { position: relative; z-index: 1; padding: 0 20px; }
    .about-hero .hero-pretitle {
        display: block;
        color: var(--wasaaz-gold);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-bottom: 18px;
    }
    .about-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(40px, 7vw, 76px);
        color: var(--wasaaz-text);
        font-weight: 600;
        letter-spacing: -1px;
        margin-bottom: 18px;
        line-height: 1.05;
    }
    .about-hero h1 span { color: var(--wasaaz-accent); font-weight: 700; }
    .about-hero p {
        font-size: clamp(14px, 2vw, 17px);
        color: var(--wasaaz-muted);
        max-width: 640px;
        margin: 0 auto;
        line-height: 1.8;
    }

    /* Story */
    .story-section { padding: 120px 0; background: var(--wasaaz-bg); }
    .story-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
    .story-image {
        width: 100%;
        height: 100%;
        max-height: 560px;
        object-fit: contain;
        border-radius: var(--radius-sm, 6px);
        border: 1px solid var(--wasaaz-border);
    }
    .story-content .accent-line { width: 60px; height: 2px; background: var(--wasaaz-accent); margin-bottom: 22px; }
    .story-content span {
        color: var(--wasaaz-gold);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 14px;
    }
    .story-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(30px, 4vw, 46px);
        color: var(--wasaaz-text);
        margin-bottom: 24px;
        font-weight: 600;
        line-height: 1.1;
    }
    .story-content p { color: var(--wasaaz-muted); font-size: 15px; line-height: 1.9; margin-bottom: 18px; }

    /* Mission */
    .mission-section {
        padding: 110px 0;
        background: var(--wasaaz-card);
        border-top: 1px solid var(--wasaaz-border);
        border-bottom: 1px solid var(--wasaaz-border);
    }
    .mission-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; }
    .mission-card {
        background: var(--wasaaz-elevated);
        padding: 48px 42px;
        border-radius: 6px;
        border: 1px solid var(--wasaaz-border);
        transition: var(--transition-smooth);
    }
    .mission-card:hover { transform: translateY(-6px); border-color: var(--wasaaz-accent); box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
    .mission-card i {
        font-size: 28px;
        color: var(--wasaaz-gold);
        margin-bottom: 20px;
        display: inline-block;
        width: 56px; height: 56px;
        background: var(--wasaaz-card);
        border: 1px solid var(--wasaaz-border);
        border-radius: 50%;
        display: grid; place-items: center;
    }
    .mission-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 26px;
        color: var(--wasaaz-text);
        margin-bottom: 14px;
        font-weight: 600;
    }
    .mission-card p { color: var(--wasaaz-muted); font-size: 14px; line-height: 1.8; }

    /* Values strip */
    .values-strip {
        padding: 80px 0;
        background: var(--wasaaz-bg);
        border-bottom: 1px solid var(--wasaaz-border);
    }
    .values-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; }
    .value-card { text-align: center; }
    .value-card i {
        width: 52px; height: 52px;
        border-radius: 50%;
        background: var(--wasaaz-elevated);
        border: 1px solid var(--wasaaz-border);
        display: grid; place-items: center;
        font-size: 18px; color: var(--wasaaz-accent);
        margin: 0 auto 16px;
    }
    .value-card h4 { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--wasaaz-text); margin-bottom: 6px; }
    .value-card p { font-size: 12px; color: var(--wasaaz-muted); }

    /* Team */
    .team-section { padding: 110px 0; background: var(--wasaaz-bg); text-align: center; }
    .team-section .pre {
        color: var(--wasaaz-gold);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 12px;
    }
    .team-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 4vw, 42px);
        color: var(--wasaaz-text);
        margin-bottom: 14px;
        font-weight: 600;
    }
    .team-section .sub { color: var(--wasaaz-muted); font-size: 15px; margin: 0 auto 60px; max-width: 560px; }
    .team-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .team-member {
        background: var(--wasaaz-card);
        border: 1px solid var(--wasaaz-border);
        border-radius: 6px;
        overflow: hidden;
        transition: var(--transition-smooth);
    }
    .team-member:hover { transform: translateY(-6px); border-color: var(--wasaaz-accent); box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
    .team-member img { width: 100%; height: 340px; object-fit: cover; filter: grayscale(20%); }
    .team-member .info { padding: 26px 20px; }
    .team-member h4 { font-size: 17px; color: var(--wasaaz-text); margin-bottom: 6px; font-weight: 700; }
    .team-member span { font-size: 11px; color: var(--wasaaz-gold); text-transform: uppercase; letter-spacing: 2px; font-weight: 700; }

    @media (max-width: 991px) {
        .story-grid { grid-template-columns: 1fr; gap: 45px; }
        .story-image { max-height: 440px; }
        .team-grid { grid-template-columns: repeat(2, 1fr); }
        .values-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .story-section, .mission-section, .team-section, .values-strip { padding: 80px 0; }
        .mission-grid { grid-template-columns: 1fr; }
        .team-grid { grid-template-columns: 1fr; }
        .team-member img { height: 360px; }
        .about-hero { padding-top: 170px; }
    }
    @media (max-width: 480px) {
        .mission-card { padding: 36px 26px; }
        .values-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- Hero -->
<section class="about-hero">
    <div class="hero-inner" data-aos="fade-up">
        <span class="hero-pretitle">Our Story</span>
        <h1>About <span>Wasaaz</span></h1>
        <p>Threaded with meaning. Worn with pride. Wasaaz is where culture, calligraphy, and contemporary streetwear meet.</p>
    </div>
</section>

<!-- Story -->
<section class="story-section">
    <div class="container">
        <div class="story-grid">
            <img src="{{ asset('img/brandimage1.png') }}" alt="Wasaaz Craft" class="story-image" data-aos="fade-right">
            <div class="story-content" data-aos="fade-left">
                <div class="accent-line"></div>
                <span>Rooted in Identity</span>
                <h2>Wear Your Story</h2>
                <p>Wasaaz was founded on a simple belief: clothing should say something before you do. From the very first sketch, we set out to build more than a brand — we set out to build a voice.</p>
                <p>Every piece in our collection carries hand-drawn calligraphy, carefully sourced fabrics, and designs that honour heritage while pushing streetwear forward. We partner with skilled makers to bring you garments that feel as meaningful as they look.</p>
                <p>Whether you're discovering our drops for the first time or you've been with us since day one — Wasaaz is your statement, worn with pride.</p>
            </div>
        </div>
    </div>
</section>

<!-- Mission -->
<section class="mission-section">
    <div class="container">
        <div class="mission-grid">
            <div class="mission-card" data-aos="fade-up">
                <i class="fas fa-bullseye"></i>
                <h3>Our Mission</h3>
                <p>To craft garments that carry meaning — blending cultural calligraphy with modern silhouettes, and delivering an effortless experience from design to doorstep.</p>
            </div>
            <div class="mission-card" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-eye"></i>
                <h3>Our Vision</h3>
                <p>To become the signature of those who wear their identity — a brand where every thread speaks and every drop tells a story worth wearing.</p>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="values-strip">
    <div class="container">
        <div class="values-grid">
            <div class="value-card" data-aos="fade-up">
                <i class="fas fa-pen-nib"></i>
                <h4>Handcrafted Art</h4>
                <p>Calligraphy & design drawn by hand</p>
            </div>
            <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-layer-group"></i>
                <h4>Premium Fabric</h4>
                <p>Sourced materials, built to last</p>
            </div>
            <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-box-open"></i>
                <h4>Limited Drops</h4>
                <p>Small-batch releases, never mass-made</p>
            </div>
            <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                <i class="fas fa-heart"></i>
                <h4>Worn With Pride</h4>
                <p>Made for those who stand for something</p>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="team-section">
    <div class="container">
        <span class="pre">The People</span>
        <h2>Meet Our Team</h2>
        <p class="sub">A small, passionate group dedicated to bringing meaning into every stitch.</p>
        <div class="team-grid">
            <div class="team-member" data-aos="fade-up">
                <img src="{{ asset('img/human.jpeg') }}" alt="Zain Arif">
                <div class="info">
                    <h4>Zain Arif</h4>
                    <span>Founder & CEO</span>
                </div>
            </div>
            <div class="team-member" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('img/women.jpeg') }}" alt="Sarah Khan">
                <div class="info">
                    <h4>Sarah Khan</h4>
                    <span>Marketing Head</span>
                </div>
            </div>
            <div class="team-member" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('img/human1.jpeg') }}" alt="Ahmed Raza">
                <div class="info">
                    <h4>Ahmed Raza</h4>
                    <span>Product Designer</span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
