@extends('layout_admin.app')

@section('title', 'Edit Attribute Value')

@section('content')
<div class="product-create-wrapper">
  <div class="page-header">
    <h2>Edit Attribute Value</h2>
  </div>

  <div class="product-card">
    <form action="{{ route('attribute-value-update', $attributeValue->id) }}" method="POST">
      @csrf
      @method('PUT')
      
      <div class="form-group">
          <label for="attribute_id">Select Attribute</label>
          <select name="attribute_id" id="attribute_id" required>
              @foreach($attributes as $attr)
                  <option value="{{ $attr->id }}" {{ $attributeValue->attribute_id == $attr->id ? 'selected' : '' }}>
                      {{ $attr->name }}
                  </option>
              @endforeach
          </select>
      </div>
  
      <div class="form-group">
          <label for="value">Value</label>
          <input type="text" name="value" id="value" value="{{ $attributeValue->value }}" required>
      </div>
  
      <div class="form-actions">
          <button class="btn save-btn">Update</button>
          <a href="{{ route('attributes-value.index') }}" class="btn cancel-btn">Cancel</a>
      </div>
  </form>
  
  </div>
</div>
@endsection
