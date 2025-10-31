@extends('layout_admin.app')

@section('title', 'Attributes')
@section('page_title', 'Manage Attributes')

@section('content')
<div class="category-container">
  <div class="category-header">
    <h2>Attributes</h2>
    <a href="{{ route('attributes.create') }}" class="add-btn">+ Add Attribute</a>
  </div>

  @if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
  @endif

  <div class="category-table-wrapper">
    <table class="category-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($attributes as $attr)
          <tr>
            <td>{{ $attr->id }}</td>
            <td>{{ $attr->name }}</td>
            <td>
              <a href="{{ route('attributes.edit', $attr->id) }}" class="btn small-btn edit">Edit</a>
              <form action="{{ route('attributes.destroy', $attr->id) }}" method="GET" style="display:inline;">
                @csrf 
                <button class="btn small-btn delete" onclick="return confirm('Delete this attribute?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="pagination-container">
      {{ $attributes->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection
