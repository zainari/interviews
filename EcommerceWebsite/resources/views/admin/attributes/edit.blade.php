@extends('layout_admin.app')

@section('title', 'Edit Attribute')

@section('content')
<div class="product-create-wrapper">
  <div class="page-header">
    <h2>Edit Attribute</h2>
  </div>

  <div class="product-card">
    <form action="{{ route('attributes.update', $attribute->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="name">Attribute Name</label>
        <input type="text" name="name" id="name" value="{{ $attribute->name }}" required>
      </div>
      <div class="form-actions">
        <button class="btn save-btn">Update</button>
        <a href="{{ route('attributes.index') }}" class="btn cancel-btn">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
