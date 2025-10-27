<header class="navbar">
    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('img/zain07.png') }}" alt="Logo">
        </a>
        <ul class="menu">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('product') }}">Products</a></li>
            <li><a href="{{ url('aboutpage') }}">About</a></li>
            <li><a href="{{ url('services') }}">Services</a></li>
            <li><a href="{{ url('contact') }}">Contact</a></li>
        </ul>
    </div>

    <div class="nav-right">
        <div class="search">
            <input type="text" placeholder="Search products..." />
            <button><i class="fa fa-search"></i></button>
        </div>

       

        <div class="cart-icon">
            <a href="{{ url('cart') }}">
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-count">2</span>
            </a>
        </div>
    </div>
</header>
