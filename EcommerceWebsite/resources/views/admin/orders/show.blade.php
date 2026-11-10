@extends('layout_admin.app')

@section('title', 'Order #' . $order->id . ' | Wasaaz')
@section('page_title', 'Order Detail')

@section('content')
<div class="orders-container">
  <div class="orders-header">
    <h2>Order #{{ $order->id }}</h2>
    <a href="{{ route('orders.index') }}" class="btn cancel-btn" style="text-decoration:none;">← Back to Orders</a>
  </div>

  @if(session('success'))
    <div class="alert success" id="flashMessage"><strong>Success:</strong> {{ session('success') }}</div>
  @endif

  <div style="display:grid; grid-template-columns: 2fr 1fr; gap:24px; margin-top:20px;" class="order-detail-grid">

    <!-- Items -->
    <div class="data-card">
      <div class="data-card-header"><h3>Ordered Items</h3></div>
      <div style="overflow-x:auto;">
        <table class="wa-table">
          <thead>
            <tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr>
          </thead>
          <tbody>
            @forelse($order->products as $item)
            <tr>
              <td style="font-weight:600;">{{ $item->name }}</td>
              <td>Rs. {{ number_format($item->pivot->price, 2) }}</td>
              <td>{{ $item->pivot->quantity }}</td>
              <td style="font-weight:700;">Rs. {{ number_format($item->pivot->price * $item->pivot->quantity, 2) }}</td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;">No items.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div style="margin-top:20px; border-top:1px solid var(--border); padding-top:16px; display:flex; flex-direction:column; gap:8px; font-size:14px;">
        <div style="display:flex; justify-content:space-between; color: var(--wa-muted, #888);"><span>Subtotal</span><span>Rs. {{ number_format($order->subtotal, 2) }}</span></div>
        @if($order->discount > 0)
        <div style="display:flex; justify-content:space-between; color:#34d399;"><span>Discount</span><span>- Rs. {{ number_format($order->discount, 2) }}</span></div>
        @endif
        <div style="display:flex; justify-content:space-between; color: var(--wa-muted, #888);"><span>Shipping</span><span>{{ $order->shipping > 0 ? 'Rs. ' . number_format($order->shipping, 2) : 'FREE' }}</span></div>
        <div style="display:flex; justify-content:space-between; font-weight:800; font-size:17px; border-top:1px dashed var(--border); padding-top:12px;"><span>Total</span><span>Rs. {{ number_format($order->total, 2) }}</span></div>
      </div>
    </div>

    <!-- Customer + Status -->
    <div>
      <div class="data-card" style="margin-bottom:20px;">
        <div class="data-card-header"><h3>Customer</h3></div>
        <div style="font-size:14px; line-height:2;">
          <div><strong>{{ $order->first_name }} {{ $order->last_name }}</strong></div>
          <div style="color: var(--wa-muted, #888);">{{ $order->email }}</div>
          <div style="color: var(--wa-muted, #888);">{{ $order->phone }}</div>
          <div style="color: var(--wa-muted, #888); margin-top:10px;">{{ $order->address }}<br>{{ $order->city }}, {{ $order->country }}</div>
          <div style="margin-top:10px;"><span class="badge badge-info">{{ strtoupper($order->payment_method) }}</span></div>
        </div>
      </div>

      <div class="data-card">
        <div class="data-card-header"><h3>Order Status</h3></div>
        <form method="POST" action="{{ route('orders.status', $order->id) }}" style="display:flex; flex-direction:column; gap:12px;">
          @csrf
          <select name="status" style="padding:12px; background: var(--wa-card, #161616); border:1px solid var(--border); color:#fff; border-radius:8px; font-size:14px;">
            @foreach(['pending','paid','processing','shipped','delivered','cancelled'] as $s)
              <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
          <button type="submit" class="btn save-btn" style="width:100%;">Update Status</button>
        </form>
        <div style="margin-top:14px; font-size:12px; color: var(--wa-muted, #888);">
          Placed: {{ $order->created_at->format('M d, Y h:i A') }}
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  @media (max-width: 900px) {
    .order-detail-grid { grid-template-columns: 1fr !important; }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const flash = document.getElementById('flashMessage');
    if (flash) setTimeout(() => flash.style.display = 'none', 3500);
  });
</script>
@endsection
