<aside class="sidebar">
  <div class="logo">
    <h2>WASA<span>AZ</span></h2>
  </div>
  <ul>
    <li><a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
    <li><a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'active' : '' }}"><i class="bi bi-bag"></i> Products</a></li>
    <li><a href="{{ route('categories.index') }}" class="{{ request()->is('categories*') ? 'active' : '' }}"><i class="bi bi-tags"></i> Category</a></li>
    <li><a href="{{ route('orders.index') }}" class="{{ request()->is('orders*') ? 'active' : '' }}"><i class="bi bi-cart-check"></i> Orders</a></li>
    <li><a href="#" class="{{ request()->is('users*') ? 'active' : '' }}"><i class="bi bi-people"></i> Users</a></li>
    <li><a href="#" class="{{ request()->is('settings*') ? 'active' : '' }}"><i class="bi bi-gear"></i> Settings</a></li>
  </ul>
</aside>
