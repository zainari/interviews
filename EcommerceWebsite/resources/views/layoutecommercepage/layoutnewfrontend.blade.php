<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EliteStore | Premium Boutique & Apparel</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- SweetAlert2 (used by wishlist toggle JS) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary: #111111;
            --primary-dark: #000000;
            --secondary: #555555;
            --muted: #8c8c8c;
            --light: #faf9f6; /* Off-white warm background */
            --white: #ffffff;
            --accent: #8c8276; /* Sophisticated muted gold/taupe */
            --danger: #b22222;
            --border: #e8e6e1;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.02);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.04);
            --shadow-lg: 0 20px 40px rgba(140, 130, 118, 0.08);
            --transition-smooth: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* --- Base Styles --- */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--light); color: var(--primary); overflow-x: hidden; -webkit-font-smoothing: antialiased; }
        a { text-decoration: none; color: inherit; transition: var(--transition-smooth); }
        ul { list-style: none; }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 30px; }
        img { max-width: 100%; height: auto; }

        /* --- Custom Scrollbar --- */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--light); }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 0; }

        /* --- Announcement Top Bar --- */
        .top-header { 
            background: var(--primary); 
            color: var(--white); 
            padding: 12px 0; 
            font-size: 11px; 
            text-align: center; 
            font-weight: 700; 
            letter-spacing: 2px; 
            text-transform: uppercase;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* --- Main Navigation Header --- */
        header { 
            background: var(--white); 
            border-bottom: 1px solid var(--border); 
            position: sticky; 
            top: 0; 
            z-index: 1000; 
            transition: var(--transition-smooth); 
        }
        header.scrolled {
            box-shadow: var(--shadow-md);
            border-color: transparent;
        }
        .nav-main { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 20px 0; 
        }
        
        .logo-img { 
            height: 40px; 
            width: auto; 
            object-fit: contain; 
            transition: var(--transition-smooth);
        }

        /* --- Elevated Minimal Search Bar --- */
        .search-bar { 
            flex: 0 0 42%; 
            position: relative; 
        }
        .search-bar form {
            display: flex;
            align-items: center;
            background: var(--light);
            border: 1px solid var(--border);
            border-radius: 4px;
            transition: var(--transition-smooth);
        }
        .search-bar form:focus-within {
            background: var(--white);
            border-color: var(--primary);
            box-shadow: var(--shadow-sm);
        }
        .search-bar input { 
            width: 100%; 
            padding: 14px 20px; 
            border: none;
            background: transparent;
            outline: none; 
            font-size: 13px;
            font-weight: 500;
            color: var(--primary);
        }
        .search-bar input::placeholder {
            color: var(--muted);
            letter-spacing: 0.5px;
        }
        .search-bar button { 
            background: none; 
            border: none; 
            color: var(--secondary); 
            padding: 0 20px;
            cursor: pointer; 
            font-size: 14px;
            transition: var(--transition-smooth);
        }
        .search-bar button:hover {
            color: var(--primary);
        }

        /* --- Icon Actions Group --- */
        .nav-actions { display: flex; gap: 24px; align-items: center; }
        .icon-box { 
            position: relative; 
            font-size: 18px; 
            cursor: pointer; 
            color: var(--primary); 
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: transparent;
        }
        .icon-box:hover { 
            color: var(--accent); 
            background: var(--light);
        }
        .icon-box span.count { 
            position: absolute; 
            top: -4px; 
            right: -4px; 
            background: var(--primary); 
            color: var(--white); 
            font-size: 8px; 
            font-weight: 800;
            width: 16px;
            height: 16px;
            border-radius: 50%; 
            display: grid;
            place-items: center;
        }

        .mobile-toggle { display: none; font-size: 20px; cursor: pointer; color: var(--primary); }

        /* --- Minimalist Bottom Navigation Menu --- */
        .bottom-nav { 
            background: var(--white); 
            border-bottom: 1px solid var(--border); 
            position: relative;
            z-index: 99;
        }
        .nav-menu { 
            display: flex; 
            justify-content: center; 
            gap: 40px; 
            padding: 16px 0; 
        }
        .nav-menu li a { 
            font-weight: 700; 
            font-size: 12px; 
            color: var(--secondary); 
            text-transform: uppercase; 
            letter-spacing: 2px; 
            position: relative;
            padding: 4px 0;
        }
        .nav-menu li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1.5px;
            background: var(--primary);
            transition: var(--transition-smooth);
        }
        .nav-menu li a:hover { 
            color: var(--primary); 
        }
        .nav-menu li a:hover::after {
            width: 100%;
        }

        /* --- Editorial Footer --- */
        footer { 
            background: var(--white); 
            padding: 100px 0 40px; 
            border-top: 1px solid var(--border); 
        }
        .footer-grid { display: grid; grid-template-columns: 1.8fr 1fr 1fr 1.2fr; gap: 60px; }
        .footer-logo { 
            font-size: 24px; 
            font-weight: 900; 
            color: var(--primary); 
            margin-bottom: 25px; 
            display: block; 
            letter-spacing: 1px;
        }
        .footer-logo span {
            font-weight: 300;
            color: var(--accent);
        }
        .footer-col h4 { 
            font-size: 12px; 
            font-weight: 800; 
            margin-bottom: 25px; 
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary);
        }
        .footer-col ul li { margin-bottom: 12px; }
        .footer-col ul li a { color: var(--secondary); font-size: 13px; font-weight: 500; }
        .footer-col ul li a:hover { color: var(--accent); padding-left: 5px; }
        .footer-contact p { 
            display: flex; 
            align-items: flex-start; 
            gap: 15px; 
            color: var(--secondary); 
            margin-bottom: 18px; 
            font-size: 13px; 
            line-height: 1.5;
        }
        .footer-contact i { color: var(--accent); font-size: 14px; margin-top: 3px; }

        .footer-bottom { 
            border-top: 1px solid var(--border); 
            margin-top: 80px; 
            padding-top: 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            flex-wrap: wrap; 
            gap: 20px; 
        }
        .social-links { display: flex; gap: 10px; }
        .social-links a { 
            width: 36px; 
            height: 36px; 
            background: var(--light); 
            border: 1px solid var(--border);
            border-radius: 50%; 
            display: grid; 
            place-items: center; 
            color: var(--primary); 
            transition: var(--transition-smooth); 
        }
        .social-links a:hover { 
            background: var(--primary); 
            color: var(--white); 
            border-color: var(--primary);
            transform: translateY(-2px); 
        }

        /* --- Live Suggestions Dropdown UI --- */
        .search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 4px;
            box-shadow: var(--shadow-lg);
            z-index: 1100;
            margin-top: 8px;
            max-height: 400px;
            overflow-y: auto;
        }
        .suggestion-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 20px;
            border-bottom: 1px solid var(--light);
            transition: var(--transition-smooth);
        }
        .suggestion-item:last-child {
            border-bottom: none;
        }
        .suggestion-item:hover {
            background: var(--light);
        }
        .suggestion-img {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 4px;
            background: var(--light);
        }
        .suggestion-details {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .suggestion-brand {
            font-size: 9px;
            font-weight: 800;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .suggestion-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--primary);
            margin: 2px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .suggestion-price {
            font-size: 12px;
            color: var(--primary-dark);
            font-weight: 700;
        }
        .suggestion-empty {
            padding: 24px;
            text-align: center;
            color: var(--secondary);
            font-size: 13px;
        }

        /* --- Navigation Drawer (Mobile) --- */
        .mobile-drawer { 
            position: fixed; 
            top: 0; 
            left: -100%; 
            width: 320px; 
            height: 100%; 
            background: var(--white); 
            z-index: 2000; 
            transition: var(--transition-smooth); 
            box-shadow: var(--shadow-lg); 
            padding: 40px 30px; 
        }
        .mobile-drawer.active { left: 0; }
        .drawer-overlay { 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background: rgba(0,0,0,0.3); 
            backdrop-filter: blur(2px);
            z-index: 1999; 
            display: none; 
        }
        .drawer-overlay.active { display: block; }
        .mobile-menu li { margin-bottom: 24px; }
        .mobile-menu li a { font-weight: 700; font-size: 16px; letter-spacing: 1.5px; text-transform: uppercase; }

        /* --- RESPONSIVE LAYOUT SCALING --- */
        @media (max-width: 1200px) {
            .footer-grid { gap: 40px; }
        }

        @media (max-width: 991px) {
            .nav-main .search-bar { display: none; }
            .bottom-nav { display: none; }
            .mobile-toggle { display: block; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 40px; }
        }

        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr; gap: 35px; }
            .nav-actions .icon-box:nth-child(1) { display: none; } /* Hide user profile on tiny width */
        }
    </style>
</head>
<body>

    <!-- 1. Announcement Bar -->
    <div class="top-header">
        🔥 MEGA SALE IS LIVE! GET UP TO 60% OFF ON ALL NEW ARRIVALS. FREE SHIPPING ON ORDERS OVER $250.
    </div>

    <!-- 2. Mobile Navigation Drawer -->
    <div class="drawer-overlay" id="overlay"></div>
    <div class="mobile-drawer" id="drawer">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:50px;">
            <a href="/" class="logo" style="font-size:20px; font-weight:900; letter-spacing:1px; text-transform:uppercase;">ELITE<span>STORE</span></a>
            <i class="fas fa-times" id="closeDrawer" style="font-size:20px; cursor:pointer; color: var(--secondary);"></i>
        </div>
        <ul class="mobile-menu">
            <li><a href="{{route('shop.all')}}">SHOP ALL</a></li>
            <li><a href="#">ELECTRONICS</a></li>
            <li><a href="#">FASHION</a></li>
            <li><a href="#">HOME & GARDEN</a></li>
            <li><a href="#">BEAUTY & HEALTH</a></li>
            <li><a href="#" style="color:var(--danger)">MEGA DEALS</a></li>
        </ul>
    </div>

    <!-- 3. Main Sticky Header -->
    <header id="mainHeader">
        <div class="container">
            <div class="nav-main">
                <div class="mobile-toggle" id="openDrawer">
                    <i class="fas fa-bars"></i>
                </div>

                <a href="{{route('home.new')}}" class="logo-box">
                    <img src="{{ asset('img/logo.png') }}" alt="EliteStore Logo" class="logo-img">
                </a>
                
                <!-- Expanded Minimal Search Bar -->
                <div class="search-bar">
                    <form action="{{ route('shop.all') }}" method="GET">
                        <input type="text" name="search" id="searchInput" placeholder="Search for products, brands and more..." autocomplete="off" value="{{ request('search') }}">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <!-- Live Dynamic Suggestions Drops -->
                    <div id="searchSuggestions" class="search-suggestions" style="display: none;"></div>
                </div>

                <!-- Icons Navigation -->
                <div class="nav-actions">
                    <div class="icon-box"><i class="far fa-user"></i></div>

                    <!-- Wishlist -->
                    <a href="{{ route('wishlist.index') }}" class="icon-box" title="My Wishlist">
                        <i class="far fa-heart" id="wishlistHeartIcon"></i>
                        <span class="count" id="wishlist-count">{{ auth()->check() ? auth()->user()->wishlists()->count() : 0 }}</span>
                    </a>
                    
                    <!-- Shopping Basket -->
                    <div class="icon-box cart-icon">
                        <a href="{{ route('cart.index') }}" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                            <i class="fas fa-shopping-basket"></i>
                            <span class="count">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- 4. Categories Navigation (Desktop) -->
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

    <!-- 5. Main Yield Layout View -->
    <main>
        @yield('content')
    </main>

    <!-- 6. Upgraded Editorial Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="/" class="footer-logo">ELITE<span>STORE</span></a>
                    <p style="color:var(--secondary); line-height:1.7; margin-bottom:25px; font-size:13px; font-weight:500;">Premium, curated fashion, technical hardware and lifestyle design staples right at your doorstep.</p>
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
                <p style="color:var(--muted); font-size:12px; font-weight: 500;">&copy; {{ date('Y') }} EliteStore Global Private Ltd. All Rights Reserved.</p>
                <div style="display:flex; gap:15px; opacity:0.5; filter: grayscale(1);">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196070.png" style="height:20px;">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196086.png" style="height:20px;">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196072.png" style="height:20px;">
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts Section -->
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
            if(window.scrollY > 80) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
    
    <!-- Real-time Live Search JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const suggestionsContainer = document.getElementById('searchSuggestions');
            let debounceTimer;

            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                const query = searchInput.value.trim();

                if (query.length < 2) {
                    suggestionsContainer.innerHTML = '';
                    suggestionsContainer.style.display = 'none';
                    return;
                }

                // Debounce requests to minimize database query hits
                debounceTimer = setTimeout(() => {
                    fetch(`/api/search?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(products => {
                            suggestionsContainer.innerHTML = '';
                            
                            if (products.length === 0) {
                                suggestionsContainer.innerHTML = `<div class="suggestion-empty">No products found.</div>`;
                                suggestionsContainer.style.display = 'block';
                                return;
                            }

                            products.forEach(product => {
                                const productUrl = `/products/${product.slug || product.id}`;
                                const imageUrl = product.image_url.startsWith('http') 
                                    ? product.image_url 
                                    : `/storage/${product.image_url}`;

                                const item = document.createElement('a');
                                item.href = productUrl;
                                item.className = 'suggestion-item';
                                item.innerHTML = `
                                    <img class="suggestion-img" src="${imageUrl}" alt="${product.name}">
                                    <div class="suggestion-details">
                                        <span class="suggestion-brand">${product.brand || 'Elite Select'}</span>
                                        <span class="suggestion-name">${product.name}</span>
                                        <span class="suggestion-price">Rs. ${parseFloat(product.price).toLocaleString()}</span>
                                    </div>
                                `;
                                suggestionsContainer.appendChild(item);
                            });

                            suggestionsContainer.style.display = 'block';
                        })
                        .catch(err => console.error('Search query fetch failed:', err));
                }, 250); // 250ms delay
            });

            // Close suggestions overlay when clicking outside
            document.addEventListener('click', (e) => {
                if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                    suggestionsContainer.style.display = 'none';
                }
            });
        });
    </script>

    <!-- Global Wishlist Toggle JS (used by product cards on any page: home, shopall, product show) -->
    <script>
        function toggleWishlist(productId, el) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('wishlist.toggle') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => {
                if (res.status === 401) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Login Required',
                        text: 'Please login to add items to your wishlist.',
                        confirmButtonText: 'Login',
                        showCancelButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('user.login') }}";
                        }
                    });
                    throw new Error('guest');
                }
                return res.json();
            })
            .then(data => {
                if (!data) return;

                // Toggle heart icon fill on the clicked card button
                if (el) {
                    const icon = el.querySelector('i');
                    if (icon) {
                        if (data.status === 'added') {
                            icon.classList.remove('fa-regular', 'far');
                            icon.classList.add('fa-solid', 'fas');
                            el.style.color = 'red';
                        } else {
                            icon.classList.remove('fa-solid', 'fas');
                            icon.classList.add('fa-regular', 'far');
                            el.style.color = '';
                        }
                    }
                }

                // Update navbar wishlist count badge
                const countBadge = document.getElementById('wishlist-count');
                if (countBadge) {
                    countBadge.innerText = data.count;
                }

                Swal.fire({
                    icon: 'success',
                    title: data.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500
                });
            })
            .catch(err => {
                if (err.message !== 'guest') console.error(err);
            });
        }
    </script>
</body>
</html>