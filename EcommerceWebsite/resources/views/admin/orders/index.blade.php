@extends('layout_admin.app')

@section('title', 'Orders | Wasaaz')
@section('page_title', 'Orders')

@section('content')
<div class="orders-container">
  <div class="orders-header">
    <h2>Orders</h2>
    <span style="color: var(--wa-muted); font-size: 13px;">{{ $orders->total() }} total orders</span>
  </div>

  @if(session('success'))
    <div class="alert success" id="flashMessage"><strong>Success:</strong> {{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert error" id="flashMessage"><strong>Error:</strong> {{ session('error') }}</div>
  @endif

  <div class="orders-table-wrapper">
    <div class="orders-table">
      <table>
        <thead>
          <tr>
            <th>Order</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>City</th>
            <th>Total</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Placed</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($orders as $ord)
          @php
            $badgeMap = [
              'pending' => 'badge-warning', 'paid' => 'badge-success',
              'processing' => 'badge-info', 'shipped' => 'badge-info',
              'delivered' => 'badge-success', 'completed' => 'badge-success',
              'cancelled' => 'badge-danger',
            ];
          @endphp
          <tr>
            <td data-label="Order" style="font-weight:700;">#{{ $ord->id }}</td>
            <td data-label="Customer">{{ $ord->first_name }} {{ $ord->last_name }}<br><span style="color: var(--wa-muted); font-size:12px;">{{ $ord->email }}</span></td>
            <td data-label="Phone">{{ $ord->phone }}</td>
            <td data-label="City">{{ $ord->city }}</td>
            <td data-label="Total" style="font-weight:700;">Rs. {{ number_format($ord->total, 2) }}</td>
            <td data-label="Payment">{{ strtoupper($ord->payment_method) }}</td>
            <td data-label="Status">
              <form method="POST" action="{{ route('orders.status', $ord->id) }}" style="display:flex; gap:6px; align-items:center;">
                @csrf
                <select name="status" onchange="this.form.submit()" style="padding:6px 8px; background:#161616; border:1px solid var(--border); color:#fff; border-radius:6px; font-size:12px;">
                  @foreach(['pending','paid','processing','shipped','delivered','cancelled'] as $s)
                    <option value="{{ $s }}" {{ $ord->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                  @endforeach
                </select>
              </form>
            </td>
            <td data-label="Placed" style="color: var(--wa-muted);">{{ $ord->created_at->format('M d, Y') }}</td>
            <td data-label="Actions">
              <a href="{{ route('orders.show', $ord->id) }}" class="btn small-btn" style="font-size:11px; text-decoration:none;">View</a>
            </td>
          </tr>
          @empty
          <tr><td colspan="9" style="text-align:center; padding:40px;">No orders found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pagination-container">
      {{ $orders->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const flashMsg = document.getElementById('flashMessage');
  if (flashMsg) setTimeout(() => flashMsg.style.display = 'none', 3500);
});
</script>
@endsection
