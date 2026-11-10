@extends('layout_admin.app')

@section('title', 'Subscribers | Wasaaz')
@section('page_title', 'Newsletter Subscribers')

@section('content')
<div class="orders-container">
  <div class="orders-header">
    <h2>Newsletter Subscribers</h2>
    <span style="color: var(--wa-muted); font-size: 13px;">{{ $subscribers->total() }} subscribers</span>
  </div>

  @if(session('success'))
    <div class="alert success" id="flashMessage"><strong>Success:</strong> {{ session('success') }}</div>
  @endif

  <div class="orders-table-wrapper">
    <div class="orders-table">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Subscribed</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($subscribers as $sub)
          <tr>
            <td data-label="ID">{{ $sub->id }}</td>
            <td data-label="Email" style="font-weight:600;"><a href="mailto:{{ $sub->email }}" style="color: var(--wa-gold, #c9a86c);">{{ $sub->email }}</a></td>
            <td data-label="Subscribed">{{ $sub->created_at->format('M d, Y h:i A') }}</td>
            <td data-label="Actions">
              <form method="POST" action="{{ route('admin.subscribers.delete', $sub->id) }}" onsubmit="return confirm('Remove this subscriber?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn small-btn delete" style="font-size:11px;">Remove</button>
              </form>
            </td>
          </tr>
          @empty
          <tr><td colspan="4" style="text-align:center; padding:40px;">No subscribers yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pagination-container">
      {{ $subscribers->links('pagination::bootstrap-5') }}
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
