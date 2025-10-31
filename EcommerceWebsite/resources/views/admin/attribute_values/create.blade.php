@extends('layout_admin.app')

@section('title', 'Add Attribute Value')

@section('content')
<div class="product-create-wrapper">
  <div class="page-header">
    <h2>Add New Attribute Value</h2>
  </div>

  <div class="product-card">
    <form action="{{ route('attribute-value-store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="attribute_id">Select Attribute</label>
        <select name="attribute_id" id="attribute_id" required>
          <option value="">-- Choose Attribute --</option>
          @foreach($attributes as $attr)
            <option value="{{ $attr->id }}">{{ $attr->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="value">Value</label>
        <input type="text" name="value" id="value" placeholder="e.g., Small, Red, Cotton" required>
      </div>

      <div class="form-actions">
        <button class="btn save-btn">Save</button>
        <a href="{{ route('attributes-value.index') }}" class="btn cancel-btn">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
