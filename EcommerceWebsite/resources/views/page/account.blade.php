@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'My Account | Wasaaz')

@section('content')
<div class="account-page">
    <div class="account-hero">
        <p class="account-pretitle">My Account</p>
        <h1 class="account-title">Welcome back, {{ explode(' ', $user->name)[0] }}</h1>
        <p class="account-sub">{{ $user->email }}</p>
    </div>

    <div class="account-grid">
        <!-- Profile card -->
        <div class="account-card">
            <div class="account-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <h3>{{ $user->name }}</h3>
            <p>{{ $user->email }}</p>
            <div class="account-meta">Member since {{ $user->created_at->format('M Y') }}</div>
            <div class="account-links">
                <a href="{{ route('wishlist.index') }}" class="account-link"><i class="fas fa-heart"></i> Wishlist ({{ $wishlistCount }})</a>
                <a href="{{ route('track.form') }}" class="account-link"><i class="fas fa-box"></i> Track Order</a>
                <a href="{{ route('user.logout') }}" class="account-link account-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>

        <!-- Orders -->
        <div class="account-orders">
            <h3 class="account-section-title">Order History</h3>
            @forelse($orders as $order)
                <a href="{{ route('track.form') }}" class="order-row">
                    <div class="order-row-left">
                        <span class="order-id">#{{ $order->id }}</span>
                        <span class="order-items">{{ $order->products->count() }} item(s) · {{ strtoupper($order->payment_method) }}</span>
                    </div>
                    <div class="order-row-right">
                        <span class="order-total">Rs. {{ number_format($order->total) }}</span>
                        @php
                            $statusColors = [
                                'pending' => '#f59e0b', 'paid' => '#34d399', 'processing' => '#60a5fa',
                                'shipped' => '#60a5fa', 'delivered' => '#34d399', 'cancelled' => '#ef4444',
                            ];
                        @endphp
                        <span class="order-status" style="color: {{ $statusColors[$order->status] ?? '#888' }};">{{ ucfirst($order->status) }}</span>
                        <span class="order-date">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                </a>
            @empty
                <div class="no-orders">
                    <i class="fas fa-shopping-bag" style="font-size: 40px; margin-bottom: 16px; opacity: 0.3;"></i>
                    <p>No orders yet.</p>
                    <a href="{{ route('shop.all') }}" class="btn-gold" style="display:inline-block; margin-top:16px; padding:12px 28px; text-decoration:none;">Start Shopping</a>
                </div>
            @endforelse

            @if($orders->hasPages())
                <div class="account-pagination">{{ $orders->links() }}</div>
            @endif
        </div>
    </div>
</div>

<style>
.account-page { padding: 40px 6% 80px; max-width: 1200px; margin: auto; }
.account-hero { text-align: center; padding: 40px 0 48px; }
.account-pretitle { font-size: 12px; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); font-weight: 700; margin-bottom: 12px; }
.account-title { font-family: 'Playfair Display', serif; font-size: clamp(32px, 5vw, 52px); font-weight: 800; margin-bottom: 8px; }
.account-sub { color: var(--secondary); font-size: 15px; }

.account-grid { display: grid; grid-template-columns: 340px 1fr; gap: 32px; align-items: start; }
.account-card { background: var(--white); border: 1px solid var(--border); padding: 36px 28px; text-align: center; position: sticky; top: 120px; }
.account-avatar { width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), #8a6a35); color: #000; font-size: 32px; font-weight: 800; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; }
.account-card h3 { font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 4px; }
.account-card p { color: var(--secondary); font-size: 14px; margin-bottom: 6px; }
.account-meta { font-size: 12px; color: var(--muted); margin-bottom: 24px; }
.account-links { display: flex; flex-direction: column; gap: 10px; }
.account-link { display: flex; align-items: center; justify-content: center; gap: 10px; padding: 13px; border: 1px solid var(--border); color: var(--primary); text-decoration: none; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; transition: all 0.3s; background: transparent; cursor: pointer; width: 100%; font-family: inherit; }
.account-link:hover { border-color: var(--accent); color: var(--accent); }
.account-logout { color: var(--danger); }
.account-logout:hover { border-color: var(--danger); color: var(--danger); }

.account-orders { min-width: 0; }
.account-section-title { font-family: 'Playfair Display', serif; font-size: 26px; margin-bottom: 20px; }
.order-row { display: flex; justify-content: space-between; align-items: center; gap: 16px; background: var(--white); border: 1px solid var(--border); padding: 20px 24px; margin-bottom: 12px; text-decoration: none; color: var(--primary); transition: all 0.3s; }
.order-row:hover { border-color: var(--accent); transform: translateX(4px); }
.order-row-left { display: flex; flex-direction: column; gap: 4px; }
.order-id { font-weight: 800; font-size: 15px; }
.order-items { font-size: 12px; color: var(--muted); }
.order-row-right { display: flex; flex-direction: column; align-items: flex-end; gap: 4px; text-align: right; }
.order-total { font-weight: 800; font-size: 15px; }
.order-status { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
.order-date { font-size: 12px; color: var(--muted); }
.no-orders { background: var(--white); border: 1px solid var(--border); padding: 60px 30px; text-align: center; color: var(--secondary); }
.account-pagination { margin-top: 20px; }

@media (max-width: 900px) {
    .account-grid { grid-template-columns: 1fr; }
    .account-card { position: static; }
}
@media (max-width: 540px) {
    .order-row { flex-direction: column; align-items: flex-start; }
    .order-row-right { align-items: flex-start; text-align: left; }
}
</style>
@endsection
