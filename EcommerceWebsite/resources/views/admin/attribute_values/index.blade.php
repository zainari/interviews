@extends('layout_admin.app')

@section('title', 'Attribute Values')
@section('page_title', 'Manage Attribute Values')

@section('content')
<div class="category-container">
  <div class="category-header">
    <h2>Attribute Values</h2>
    <a href="{{ route('attribute-value-create') }}" class="add-btn">+ Add Value</a>
  </div>

  @if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
  @endif

  <div class="category-table-wrapper">
    <table class="category-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Attribute</th>
          <th>Value</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($values as $val)
          <tr>
            <td>{{ $val->id }}</td>
            <td>{{ $val->attribute->name ?? '-' }}</td>
            <td>{{ $val->value }}</td>
            <td>
              <a href="{{ route('attribute-value-edit', $val->id) }}" class="btn small-btn edit">Edit</a>
              <form action="{{ route('attribute-value-destroy', $val->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn small-btn delete" onclick="return confirm('Delete this value?')">
                    Delete
                </button>
            </form>
            
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="pagination-container">
      {{ $values->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection
