@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'About Us | Wasaaz Premium')

@section('content')

<style>
    .about-hero {
        position: relative;
        min-height: 55vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('{{ asset('img/bimage.png') }}') center/cover no-repeat;
        text-align: center;
    }
    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(17, 17, 17, 0.45);
    }
    .about-hero .hero-inner {
        position: relative;
        z-index: 1;
        padding: 80px 20px;
    }
    .about-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(36px, 6vw, 64px);
        color: var(--white);
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 14px;
    }
    .about-hero p {
        font-size: clamp(14px, 2vw, 17px);
        color: rgba(255,255,255,0.9);
        max-width: 680px;
        margin: 0 auto;
        font-weight: 400;
        line-height: 1.7;
    }

    .story-section {
        padding: 100px 0;
        background: var(--light);
    }
    .story-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }
    .story-image {
        width: 100%;
        height: 100%;
        max-height: 560px;
        object-fit: cover;
        border-radius: 4px;
    }
    .story-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 3.5vw, 40px);
        color: var(--primary);
        margin-bottom: 24px;
        font-weight: 600;
    }
    .story-content p {
        color: var(--secondary);
        font-size: 15px;
        line-height: 1.9;
        margin-bottom: 18px;
    }
    .story-content .accent-line {
        width: 50px;
        height: 2px;
        background: var(--accent);
        margin-bottom: 24px;
    }

    .mission-section {
        padding: 90px 0;
        background: var(--white);
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }
    .mission-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
    }
    .mission-card {
        background: var(--light);
        padding: 48px 40px;
        border-radius: 4px;
        border: 1px solid var(--border);
        transition: var(--transition-smooth);
    }
    .mission-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-4px);
    }
    .mission-card i {
        font-size: 28px;
        color: var(--accent);
        margin-bottom: 20px;
    }
    .mission-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        color: var(--primary);
        margin-bottom: 14px;
        font-weight: 600;
    }
    .mission-card p {
        color: var(--secondary);
        font-size: 14px;
        line-height: 1.8;
    }

    .team-section {
        padding: 100px 0;
        background: var(--light);
        text-align: center;
    }
    .team-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 3.5vw, 40px);
        color: var(--primary);
        margin-bottom: 16px;
        font-weight: 600;
    }
    .team-section .sub {
        color: var(--secondary);
        font-size: 15px;
        margin-bottom: 60px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .team-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 36px;
    }
    .team-member {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 4px;
        overflow: hidden;
        transition: var(--transition-smooth);
    }
    .team-member:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-4px);
    }
    .team-member img {
        width: 100%;
        height: 320px;
        object-fit: cover;
    }
    .team-member .info {
        padding: 26px 20px;
    }
    .team-member h4 {
        font-size: 17px;
        color: var(--primary);
        margin-bottom: 6px;
        font-weight: 700;
    }
    .team-member span {
        font-size: 13px;
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    @media (max-width: 991px) {
        .story-grid { grid-template-columns: 1fr; gap: 40px; }
        .story-image { max-height: 420px; }
        .team-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .story-section, .mission-section, .team-section { padding: 70px 0; }
        .mission-grid { grid-template-columns: 1fr; }
        .team-grid { grid-template-columns: 1fr; }
        .team-member img { height: 360px; }
    }
    @media (max-width: 480px) {
        .about-hero .hero-inner { padding: 60px 15px; }
        .mission-card { padding: 36px 24px; }
    }
</style>

<section class="about-hero">
    <div class="hero-inner">
        <h1>About Wasaaz</h1>
        <p>Curating timeless style, refined quality, and an effortless shopping experience for the modern individual.</p>
    </div>
</section>

<section class="story-section">
    <div class="container">
        <div class="story-grid">
            <img src="{{ asset('img/aboutimage.png') }}" alt="Wasaaz Story" class="story-image">
            <div class="story-content">
                <div class="accent-line"></div>
                <h2>Our Story</h2>
                <p>Wasaaz was founded with a simple belief: premium fashion and lifestyle essentials should feel accessible, effortless, and distinctly yours. From the very beginning, we set out to build more than a marketplace — we set out to build a destination.</p>
                <p>Every piece in our collection is chosen for its quality, craftsmanship, and enduring style. We partner with trusted makers and independent designers to bring you clothing, accessories, and lifestyle goods that look as good as they feel.</p>
                <p>Whether you are refreshing your wardrobe or searching for the perfect gift, Wasaaz is here to make every purchase feel like a curated experience.</p>
            </div>
        </div>
    </div>
</section>

<section class="mission-section">
    <div class="container">
        <div class="mission-grid">
            <div class="mission-card">
                <i class="fas fa-bullseye"></i>
                <h3>Our Mission</h3>
                <p>To deliver thoughtfully selected products that combine timeless design with everyday practicality, while offering a seamless and memorable customer experience from browse to doorstep.</p>
            </div>
            <div class="mission-card">
                <i class="fas fa-eye"></i>
                <h3>Our Vision</h3>
                <p>To become a trusted destination where modern minimalism meets uncompromising quality — inspiring confidence in every wardrobe, every home, and every lifestyle we touch.</p>
            </div>
        </div>
    </div>
</section>

<section class="team-section">
    <div class="container">
        <h2>Meet Our Team</h2>
        <p class="sub">A small, passionate group dedicated to bringing you a refined shopping experience.</p>
        <div class="team-grid">
            <div class="team-member">
                <img src="{{ asset('img/human.jpeg') }}" alt="Zain Arif">
                <div class="info">
                    <h4>Zain Arif</h4>
                    <span>Founder & CEO</span>
                </div>
            </div>
            <div class="team-member">
                <img src="{{ asset('img/women.jpeg') }}" alt="Sarah Khan">
                <div class="info">
                    <h4>Sarah Khan</h4>
                    <span>Marketing Head</span>
                </div>
            </div>
            <div class="team-member">
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
