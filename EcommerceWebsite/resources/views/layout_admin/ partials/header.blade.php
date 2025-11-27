<header class="admin-header d-flex justify-content-between align-items-center p-3 bg-light shadow-sm">
  <div class="left d-flex align-items-center">
    <button class="toggle-btn btn btn-outline-secondary me-3"><i class="bi bi-list"></i></button>
    <h2 class="mb-0">@yield('page_title', 'Dashboard')</h2>
  </div>

  <div class="right d-flex align-items-center position-relative">
    <span class="admin-name me-2">{{ Auth::user()->name ?? 'Admin' }}</span>

    <!-- Profile Image Dropdown -->
    <div class="dropdown">
      <img src="{{ asset('img/human.jpeg') }}" 
           alt="Admin Avatar" 
           class="avatar rounded-circle" 
           width="40" height="40"
           id="profileDropdown"
           data-bs-toggle="dropdown" 
           aria-expanded="false"
           style="cursor:pointer;">

      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
        <li>
          <a class="dropdown-item" href="{{ route('user.logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
          </a>
        </li>
      </ul>
    </div>

    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </div>
</header>
