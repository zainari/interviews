@extends('layout_admin.app')

@section('title', 'Messages | Wasaaz')
@section('page_title', 'Contact Messages')

@section('content')
<div class="orders-container">
  <div class="orders-header">
    <h2>Contact Messages</h2>
    <span style="color: var(--wa-muted); font-size: 13px;">{{ $messages->total() }} total messages</span>
  </div>

  @if(session('success'))
    <div class="alert success" id="flashMessage"><strong>Success:</strong> {{ session('success') }}</div>
  @endif

  <div class="orders-table-wrapper">
    <div class="orders-table">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Status</th>
            <th>Received</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($messages as $msg)
          <tr style="{{ !$msg->is_read ? 'border-left: 3px solid var(--wa-gold, #c9a86c);' : '' }}">
            <td data-label="ID">{{ $msg->id }}</td>
            <td data-label="Name" style="font-weight:700;">{{ $msg->name }}</td>
            <td data-label="Email"><a href="mailto:{{ $msg->email }}" style="color: var(--wa-gold, #c9a86c);">{{ $msg->email }}</a></td>
            <td data-label="Subject">{{ $msg->subject ?? '—' }}</td>
            <td data-label="Message" style="max-width: 260px;">{{ Str::limit($msg->message, 80) }}</td>
            <td data-label="Status">
              @if($msg->is_read)
                <span class="badge badge-success">Read</span>
              @else
                <span class="badge badge-warning">Unread</span>
              @endif
            </td>
            <td data-label="Received">{{ $msg->created_at->format('M d, Y h:i A') }}</td>
            <td data-label="Actions">
              <div style="display:flex; gap:8px;">
                <form method="POST" action="{{ route('admin.messages.read', $msg->id) }}">
                  @csrf
                  <button type="submit" class="btn small-btn" style="font-size:11px;">{{ $msg->is_read ? 'Unread' : 'Read' }}</button>
                </form>
                <form method="POST" action="{{ route('admin.messages.delete', $msg->id) }}" onsubmit="return confirm('Delete this message?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn small-btn delete" style="font-size:11px;">Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="8" style="text-align:center; padding: 40px;">No messages yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pagination-container">
      {{ $messages->links('pagination::bootstrap-5') }}
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
