<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliteStore | Professional Mega Store</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --dark: #0f172a;
            --light: #f8fafc;
            --white: #ffffff;
            --accent: #f59e0b;
            --danger: #ef4444;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        }

        /* --- Base Styles --- */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #fcfcfc; color: var(--dark); overflow-x: hidden; -webkit-font-smoothing: antialiased; }
        a { text-decoration: none; color: inherit; transition: 0.3s; }
        ul { list-style: none; }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 20px; }
        img { max-width: 100%; height: auto; }

        /* --- Custom Scrollbar --- */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--light); }
        ::-webkit-scrollbar-thumb { background: var(--secondary); border-radius: 10px; }

        /* --- Top Bar --- */
        .top-header { background: var(--dark); color: white; padding: 10px 0; font-size: 12px; text-align: center; font-weight: 500; letter-spacing: 0.5px; }

        /* --- Main Navigation --- */
        header { background: var(--white); border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 1000; transition: 0.3s; }
        .nav-main { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; }
        
        .logo-img { height: 45px; width: auto; object-fit: contain; }

        .search-bar { flex: 0 0 45%; position: relative; }
        .search-bar input { width: 100%; padding: 12px 25px; border-radius: 12px; border: 1px solid var(--border); background: var(--light); outline: none; transition: 0.3s; }
        .search-bar input:focus { border-color: var(--primary); background: white; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }
        .search-bar button { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--secondary); cursor: pointer; }

        .nav-actions { display: flex; gap: 20px; align-items: center; }
        .icon-box { position: relative; font-size: 22px; cursor: pointer; color: var(--dark); transition: 0.3s; }
        .icon-box:hover { color: var(--primary); transform: translateY(-2px); }
        .icon-box span { position: absolute; top: -8px; right: -10px; background: var(--danger); color: white; font-size: 10px; padding: 2px 6px; border-radius: 50%; font-weight: 700; }

        .mobile-toggle { display: none; font-size: 24px; cursor: pointer; }

        /* --- Categories Navbar --- */
        .bottom-nav { background: var(--white); border-bottom: 1px solid var(--border); overflow-x: auto; white-space: nowrap; }
        .nav-menu { display: flex; justify-content: center; gap: 35px; padding: 12px 0; }
        .nav-menu li a { font-weight: 600; font-size: 14px; color: var(--secondary); text-transform: uppercase; letter-spacing: 0.5px; }
        .nav-menu li a:hover { color: var(--primary); }

        /* --- Hero Slider --- */
        .hero { background: linear-gradient(135deg, #eef2ff 0%, #f5f3ff 100%); padding: 80px 0; position: relative; overflow: hidden; }
        .hero-flex { display: flex; align-items: center; gap: 50px; flex-wrap: wrap; }
        .hero-text { flex: 1; min-width: 300px; }
        .hero-text h1 { font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 800; line-height: 1.1; margin-bottom: 25px; color: var(--dark); }
        .hero-text h1 span { color: var(--primary); }
        .hero-text p { font-size: 18px; color: var(--secondary); margin-bottom: 40px; max-width: 550px; }
        .hero-img { flex: 1; min-width: 300px; text-align: center; }
        .hero-img img { max-width: 100%; filter: drop-shadow(20px 40px 60px rgba(0,0,0,0.15)); animation: float 5s infinite ease-in-out; }
        
        @keyframes float { 0%, 100% { transform: translateY(0) rotate(0); } 50% { transform: translateY(-20px) rotate(2deg); } }

        /* --- Section Header --- */
        .section-header { text-align: center; margin-bottom: 50px; }
        .section-header h2 { font-size: 32px; font-weight: 800; position: relative; display: inline-block; padding-bottom: 15px; }
        .section-header h2::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 60px; height: 4px; background: var(--primary); border-radius: 10px; }

        /* --- Features --- */
        .features-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; margin-top: 40px; z-index: 10; position: relative; }
        .feature-card { background: white; padding: 25px; border-radius: 20px; box-shadow: var(--shadow-lg); display: flex; align-items: center; gap: 20px; transition: 0.3s; }
        .feature-card:hover { transform: translateY(-5px); }
        .feature-card i { font-size: 35px; color: var(--primary); background: #eff6ff; padding: 15px; border-radius: 15px; }
        .feature-card h4 { font-size: 16px; font-weight: 700; }
        .feature-card p { font-size: 13px; color: var(--secondary); }

        /* --- Product Card UI --- */
        .product-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; }
        .product-card { background: white; border-radius: 20px; padding: 15px; border: 1px solid var(--border); transition: 0.4s; position: relative; display: flex; flex-direction: column; }
        .product-card:hover { border-color: var(--primary); box-shadow: var(--shadow-lg); transform: translateY(-10px); }
        
        .p-img-box { height: 260px; background: #f8fafc; border-radius: 15px; overflow: hidden; position: relative; display: flex; align-items: center; justify-content: center; }
        .p-img-box img { width: 85%; object-fit: contain; transition: 0.5s; }
        .product-card:hover .p-img-box img { transform: scale(1.1); }
        
        .badge-sale { position: absolute; top: 15px; left: 15px; background: var(--danger); color: white; padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 800; z-index: 10; }
        
        .p-actions { position: absolute; right: 15px; top: 15px; display: flex; flex-direction: column; gap: 8px; transform: translateX(20px); opacity: 0; transition: 0.3s; }
        .product-card:hover .p-actions { transform: translateX(0); opacity: 1; }
        .p-btn { width: 40px; height: 40px; background: white; border-radius: 10px; display: grid; place-items: center; box-shadow: var(--shadow-md); color: var(--dark); cursor: pointer; }
        .p-btn:hover { background: var(--primary); color: white; }

        .p-info { padding-top: 20px; flex-grow: 1; }
        .p-info h3 { font-size: 16px; font-weight: 700; margin-bottom: 10px; line-height: 1.4; height: 45px; overflow: hidden; }
        .p-price-row { display: flex; justify-content: space-between; align-items: center; margin-top: auto; }
        .p-price { font-size: 20px; font-weight: 800; color: var(--primary); }
        .p-old-price { font-size: 14px; color: var(--secondary); text-decoration: line-through; margin-left: 8px; }

        .add-cart-btn { width: 100%; margin-top: 20px; padding: 12px; background: var(--dark); color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .add-cart-btn:hover { background: var(--primary); box-shadow: 0 10px 15px rgba(37, 99, 235, 0.2); }

        /* --- Newsletter Section --- */
        .newsletter-section { padding: 100px 0; }
        .newsletter-card { background: var(--primary); border-radius: 30px; padding: 60px; color: white; text-align: center; position: relative; overflow: hidden; }
        .newsletter-card::before { content: ''; position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; }
        .newsletter-card h2 { font-size: 35px; font-weight: 800; margin-bottom: 15px; }
        .newsletter-form { max-width: 550px; margin: 35px auto 0; position: relative; }
        .newsletter-form input { width: 100%; padding: 18px 30px; border-radius: 15px; border: none; outline: none; font-size: 16px; }
        .newsletter-form button { position: absolute; right: 8px; top: 8px; bottom: 8px; background: var(--dark); color: white; border: none; padding: 0 30px; border-radius: 10px; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .newsletter-form button:hover { background: var(--primary-dark); }

        /* --- Footer --- */
        footer { background: white; padding: 80px 0 30px; border-top: 1px solid var(--border); }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 50px; }
        .footer-logo { font-size: 28px; font-weight: 900; color: var(--primary); margin-bottom: 25px; display: block; }
        .footer-col h4 { font-size: 18px; font-weight: 700; margin-bottom: 25px; }
        .footer-col ul li { margin-bottom: 15px; }
        .footer-col ul li a { color: var(--secondary); font-size: 15px; }
        .footer-col ul li a:hover { color: var(--primary); padding-left: 8px; }
        .footer-contact p { display: flex; align-items: center; gap: 15px; color: var(--secondary); margin-bottom: 15px; font-size: 15px; }
        .footer-contact i { color: var(--primary); font-size: 18px; }

        .footer-bottom { border-top: 1px solid var(--border); margin-top: 60px; padding-top: 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; }
        .social-links { display: flex; gap: 15px; }
        .social-links a { width: 40px; height: 40px; background: #f1f5f9; border-radius: 50%; display: grid; place-items: center; color: var(--dark); transition: 0.3s; }
        .social-links a:hover { background: var(--primary); color: white; transform: translateY(-3px); }

        /* --- Mobile Navigation Drawer --- */
        .mobile-drawer { position: fixed; top: 0; left: -100%; width: 300px; height: 100%; background: white; z-index: 2000; transition: 0.4s; box-shadow: 20px 0 50px rgba(0,0,0,0.1); padding: 40px 20px; }
        .mobile-drawer.active { left: 0; }
        .drawer-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1999; display: none; }
        .drawer-overlay.active { display: block; }
        .mobile-menu li { margin-bottom: 20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; }
        .mobile-menu li a { font-weight: 700; font-size: 18px; }

        /* --- RESPONSIVE MEDIA QUERIES --- */
        @media (max-width: 1200px) {
            .product-grid { grid-template-columns: repeat(3, 1fr); }
            .features-grid { grid-template-columns: repeat(2, 1fr); margin-top: 20px; }
        }

        @media (max-width: 991px) {
            .nav-main .search-bar { display: none; }
            .bottom-nav { display: none; }
            .mobile-toggle { display: block; }
            .hero-text { text-align: center; }
            .hero-flex { justify-content: center; }
            .hero-text p { margin-left: auto; margin-right: auto; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            .product-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
            .hero-text h1 { font-size: 35px; }
            .newsletter-card { padding: 40px 20px; }
            .newsletter-form button { position: static; width: 100%; margin-top: 15px; padding: 15px; }
            .feature-card { padding: 15px; }
            .p-img-box { height: 180px; }
        }

        @media (max-width: 480px) {
            .product-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .features-grid { grid-template-columns: 1fr; }
            .nav-actions .icon-box:nth-child(2) { display: none; }
        }
    </style>
</head>
<body>

    <!-- Announcement -->
    <div class="top-header">
        🔥 MEGA SALE IS LIVE! GET UP TO 60% OFF ON ALL NEW ARRIVALS. FREE SHIPPING ON ORDERS OVER $250.
    </div>

    <!-- Mobile Drawer -->
    <div class="drawer-overlay" id="overlay"></div>
    <div class="mobile-drawer" id="drawer">
        <div style="display:flex; justify-content:space-between; margin-bottom:40px;">
            <a href="/" class="logo" style="font-size:24px; font-weight:900;">ELITE<span>STORE</span></a>
            <i class="fas fa-times" id="closeDrawer" style="font-size:24px; cursor:pointer;"></i>
        </div>
        <ul class="mobile-menu">
            <li><a href="#">SHOP ALL</a></li>
            <li><a href="#">ELECTRONICS</a></li>
            <li><a href="#">FASHION</a></li>
            <li><a href="#">HOME & GARDEN</a></li>
            <li><a href="#">BEAUTY & HEALTH</a></li>
            <li><a href="#" style="color:var(--danger)">MEGA DEALS</a></li>
        </ul>
    </div>

    <!-- Main Header -->
    <header id="mainHeader">
        <div class="container">
            <div class="nav-main">
                <div class="mobile-toggle" id="openDrawer">
                    <i class="fas fa-bars"></i>
                </div>

                <a href="{{route('home.new')}}" class="logo-box">
                    <img src="{{ asset('img/logo.png') }}" alt="EliteStore Logo" class="logo-img">
                </a>
                
                <div class="search-bar">
                    <form action="#">
                        <input type="text" placeholder="Search for products, brands and more...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                <div class="nav-actions">
                    <div class="icon-box"><i class="far fa-user"></i></div>
                    <div class="icon-box"><i class="far fa-heart"></i><span>0</span></div>
                    <div class="icon-box"><i class="fas fa-shopping-basket"></i><span>0</span></div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation Menu (Desktop) -->
    <nav class="bottom-nav">
        <div class="container">
            <ul class="nav-menu">
                <li><a href="{{route('shop.all')}}">SHOP ALL</a></li>
                <li><a href="#">ELECTRONICS</a></li>
                <li><a href="#">FASHION</a></li>
                <li><a href="#">HOME & GARDEN</a></li>
                <li><a href="#">BEAUTY & HEALTH</a></li>
                <li><a href="#">FLASH DEALS</a></li>
                <li style="color: var(--danger);"><a href="#">MEGA SALE</a></li>
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>



      <!-- Footer -->
      <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="/" class="footer-logo">ELITE<span>STORE</span></a>
                    <p style="color:var(--secondary); line-height:1.8; margin-bottom:25px;">The world's leading premium e-commerce destination. We bring the best of fashion, tech, and lifestyle to your doorstep.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Shop Categories</h4>
                    <ul>
                        <li><a href="#">Men's Fashion</a></li>
                        <li><a href="#">Women's Clothing</a></li>
                        <li><a href="#">Consumer Tech</a></li>
                        <li><a href="#">Home Essentials</a></li>
                        <li><a href="#">Luxury Watches</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Customer Care</h4>
                    <ul>
                        <li><a href="#">Track My Order</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Returns & Refunds</a></li>
                        <li><a href="#">Shipping Rates</a></li>
                        <li><a href="#">Contact Support</a></li>
                    </ul>
                </div>
                <div class="footer-col footer-contact">
                    <h4>Get In Touch</h4>
                    <p><i class="fas fa-map-marker-alt"></i> 455 Elite Tower, Business District, Karachi</p>
                    <p><i class="fas fa-phone-alt"></i> +92 21 111 222 333</p>
                    <p><i class="fas fa-envelope"></i> help@elitestore.com</p>
                    <p><i class="fas fa-clock"></i> Mon - Sat / 9:00 AM - 8:00 PM</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p style="color:var(--secondary); font-size:13px;">&copy; {{ date('Y') }} EliteStore Global Private Ltd. All Rights Reserved.</p>
                <div style="display:flex; gap:15px; opacity:0.6;">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196070.png" style="height:25px;">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196086.png" style="height:25px;">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196072.png" style="height:25px;">
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });

        // Mobile Drawer Logic
        const drawer = document.getElementById('drawer');
        const overlay = document.getElementById('overlay');
        const openBtn = document.getElementById('openDrawer');
        const closeBtn = document.getElementById('closeDrawer');

        openBtn.addEventListener('click', () => {
            drawer.classList.add('active');
            overlay.classList.add('active');
        });

        closeBtn.addEventListener('click', () => {
            drawer.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            drawer.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Header Scroll Effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('mainHeader');
            if(window.scrollY > 100) {
                header.classList.add('scrolled');
                header.style.boxShadow = '0 10px 30px rgba(0,0,0,0.08)';
            } else {
                header.classList.remove('scrolled');
                header.style.boxShadow = 'none';
            }
        });
    </script>
</body>
</html>