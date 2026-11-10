@extends('layout_admin.app')

@section('title', 'Coupons | Wasaaz')
@section('page_title', 'Coupons')

@section('content')
<div class="orders-container">
  <div class="orders-header">
    <h2>Coupons</h2>
  </div>

  @if(session('success'))
    <div class="alert success" id="flashMessage"><strong>Success:</strong> {{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="alert error" id="flashMessage"><strong>Error:</strong> {{ $errors->first() }}</div>
  @endif

  <!-- Create Coupon -->
  <div class="data-card" style="margin-bottom:24px;">
    <div class="data-card-header"><h3>Create New Coupon</h3></div>
    <form method="POST" action="{{ route('admin.coupons.store') }}" style="display:grid; grid-template-columns: 1fr 1fr 1fr 1fr auto; gap:12px; align-items:end;">
      @csrf
      <div class="form-group" style="margin:0;">
        <label style="font-size:11px; text-transform:uppercase; letter-spacing:1px; color: var(--wa-muted);">Code</label>
        <input type="text" name="code" placeholder="WASA10" required style="text-transform:uppercase;">
      </div>
      <div class="form-group" style="margin:0;">
        <label style="font-size:11px; text-transform:uppercase; letter-spacing:1px; color: var(--wa-muted);">Type</label>
        <select name="type">
          <option value="percent">Percent (%)</option>
          <option value="fixed">Fixed (Rs.)</option>
        </select>
      </div>
      <div class="form-group" style="margin:0;">
        <label style="font-size:11px; text-transform:uppercase; letter-spacing:1px; color: var(--wa-muted);">Value</label>
        <input type="number" name="value" placeholder="10" min="1" step="0.01" required>
      </div>
      <div class="form-group" style="margin:0;">
        <label style="font-size:11px; text-transform:uppercase; letter-spacing:1px; color: var(--wa-muted);">Min Order (Rs.)</label>
        <input type="number" name="min_order" placeholder="0" min="0" step="1">
      </div>
      <button type="submit" class="btn save-btn">Create</button>
    </form>
  </div>

  <div class="orders-table-wrapper">
    <div class="orders-table">
      <table>
        <thead>
          <tr>
            <th>Code</th>
            <th>Type</th>
            <th>Value</th>
            <th>Min Order</th>
            <th>Status</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($coupons as $coupon)
          <tr>
            <td data-label="Code" style="font-weight:800; letter-spacing:1px;">{{ $coupon->code }}</td>
            <td data-label="Type">{{ ucfirst($coupon->type) }}</td>
            <td data-label="Value">{{ $coupon->type === 'percent' ? $coupon->value . '%' : 'Rs. ' . number_format($coupon->value) }}</td>
            <td data-label="Min Order">{{ $coupon->min_order > 0 ? 'Rs. ' . number_format($coupon->min_order) : '—' }}</td>
            <td data-label="Status">
              @if($coupon->is_active)
                <span class="badge badge-success">Active</span>
              @else
                <span class="badge badge-danger">Inactive</span>
              @endif
            </td>
            <td data-label="Created">{{ $coupon->created_at->format('M d, Y') }}</td>
            <td data-label="Actions">
              <div style="display:flex; gap:8px;">
                <form method="POST" action="{{ route('admin.coupons.toggle', $coupon->id) }}">
                  @csrf
                  <button type="submit" class="btn small-btn" style="font-size:11px;">{{ $coupon->is_active ? 'Disable' : 'Enable' }}</button>
                </form>
                <form method="POST" action="{{ route('admin.coupons.delete', $coupon->id) }}" onsubmit="return confirm('Delete this coupon?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn small-btn delete" style="font-size:11px;">Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="7" style="text-align:center; padding:40px;">No coupons yet. Create one above.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pagination-container">
      {{ $coupons->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const flash = document.getElementById('flashMessage');
    if (flash) setTimeout(() => flash.style.display = 'none', 3500);
  });
</script>
@endsection
