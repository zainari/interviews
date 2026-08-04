<header class="admin-header-new">
    <!-- Left Section -->
    <div class="header-left-box">
        <button class="header-toggle-btn" type="button">
            <i class="bi bi-list"></i>
        </button>
        <h2 class="header-title-text d-none d-sm-block">@yield('page_title', 'Dashboard')</h2>
    </div>

    <!-- Right Section -->
    <div class="header-right-box">
        
        <!-- Icons Group -->
        <div class="header-utility-icons d-none d-md-flex">
            <div class="utility-icon"><i class="bi bi-search"></i></div>
            <div class="utility-icon bell-icon">
                <i class="bi bi-bell"></i>
                <span class="bell-badge">4</span>
            </div>
            <div class="utility-icon"><i class="bi bi-cart3"></i></div>
            <div class="utility-icon"><i class="bi bi-brightness-high"></i></div>
        </div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <div class="user-profile-trigger" id="topAdminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-name-info d-none d-lg-block">
                    <h6>{{ Auth::user()->name ?? 'Sophie Bennett' }}</h6>
                    <span>Web Designer</span>
                </div>
                <div class="user-avatar-circle">
                    <!-- Check if path is correct: public/img/human.jpeg -->
                    <img src="{{ asset('img/human.jpeg') }}" onerror="this.src='https://ui-avatars.com/api/?name=Admin'" alt="User">
                </div>
            </div>

            <!-- Professional Dropdown Card (Image 2 Style) -->
            <ul class="dropdown-menu dropdown-menu-end custom-profile-card shadow" aria-labelledby="topAdminDropdown">
                <li class="dropdown-header-info">
                    <div class="header-user-flex">
                        <img src="{{ asset('img/human.jpeg') }}" onerror="this.src='https://ui-avatars.com/api/?name=Admin'" alt="Avatar">
                        <div class="text-data">
                            <h6>{{ Auth::user()->name ?? 'Sophie Bennett' }}</h6>
                            <p>{{ Auth::user()->email ?? 'sophie@gmail.com' }}</p>
                        </div>
                    </div>
                </li>
                
                <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-question-circle"></i> Help Center</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item logout-red" href="{{ route('user.logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Sign out
                    </a>
                </li>
            </ul>
        </div>

        <form id="logout-form" action="{{ route('user.logout') }}" method="GET" class="d-none">
            @csrf
        </form>
    </div>
</header>