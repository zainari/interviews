@extends('layout_admin.app')

@section('title', 'Customers | Wasaaz')
@section('page_title', 'Customers')

@section('content')
<div class="orders-container">
  <div class="orders-header">
    <h2>Customers</h2>
    <span style="color: var(--wa-muted); font-size: 13px;">{{ $customers->total() }} registered users</span>
  </div>

  <div class="orders-table-wrapper">
    <div class="orders-table">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Orders</th>
            <th>Joined</th>
          </tr>
        </thead>
        <tbody>
          @forelse($customers as $customer)
          <tr>
            <td data-label="ID">{{ $customer->id }}</td>
            <td data-label="Name" style="font-weight:700;">
              <div style="display:flex; align-items:center; gap:10px;">
                <div class="user-avatar-circle" style="width:34px; height:34px; font-size:13px;">{{ strtoupper(substr($customer->name, 0, 1)) }}</div>
                {{ $customer->name }}
              </div>
            </td>
            <td data-label="Email">{{ $customer->email }}</td>
            <td data-label="Orders"><span class="badge badge-info">{{ $customer->orders_count }}</span></td>
            <td data-label="Joined">{{ $customer->created_at->format('M d, Y') }}</td>
          </tr>
          @empty
          <tr><td colspan="5" style="text-align:center; padding:40px;">No customers yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pagination-container">
      {{ $customers->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection
