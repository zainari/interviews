<header class="navbar">
    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('img/zain07.png') }}" alt="Logo">
        </a>
        <ul class="menu">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{ url('product') }}">Products</a></li>
            <li><a href="{{ url('aboutpage') }}">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="{{ url('contact') }}">Contact</a></li>
        </ul>
    </div>

    <div class="nav-right">
        <div class="search">
            <input type="text" placeholder="Search products..." />
            <button><i class="fa fa-search"></i></button>
        </div>

       

        <div class="cart-icon" onclick="openCart()"
        style="cursor:pointer; position:relative;">
       <i class="fa fa-shopping-cart" style="font-size:22px;"></i>
   
       <span id="cartCount" 
             style="background:red; color:#fff; font-size:12px; 
                    padding:2px 7px; border-radius:50%; position:absolute; 
                    top:-6px; right:-8px;">
           {{ session('cart') ? count(session('cart')) : 0 }}
       </span>
   </div>
    </div>
</header>
