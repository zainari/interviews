<aside class="sidebar">
  <div class="logo">
    <h2>WASA<span>AZ</span></h2>
  </div>
  <ul>
    <li><a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
    <li><a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'active' : '' }}"><i class="bi bi-bag"></i> Products</a></li>
    <li><a href="{{ route('categories.index') }}" class="{{ request()->is('categories*') ? 'active' : '' }}"><i class="bi bi-tags"></i> Category</a></li>
    <li><a href="{{ route('attributes.index') }}" class="{{ request()->is('attributes*') || request()->is('attribute-value*') ? 'active' : '' }}"><i class="bi bi-sliders"></i> Attributes</a></li>
    <li><a href="{{ route('orders.index') }}" class="{{ request()->is('orders*') ? 'active' : '' }}"><i class="bi bi-cart-check"></i> Orders</a></li>
    <li><a href="{{ route('admin.messages') }}" class="{{ request()->is('messages*') ? 'active' : '' }}"><i class="bi bi-envelope"></i> Messages</a></li>
    <li><a href="{{ route('admin.customers') }}" class="{{ request()->is('customers*') ? 'active' : '' }}"><i class="bi bi-people"></i> Customers</a></li>
    <li><a href="{{ route('admin.subscribers') }}" class="{{ request()->is('subscribers*') ? 'active' : '' }}"><i class="bi bi-megaphone"></i> Subscribers</a></li>
    <li><a href="{{ route('admin.coupons') }}" class="{{ request()->is('coupons*') ? 'active' : '' }}"><i class="bi bi-ticket-perforated"></i> Coupons</a></li>
    <li><a href="{{ url('/') }}" target="_blank"><i class="bi bi-shop"></i> View Store</a></li>
  </ul>
</aside>
