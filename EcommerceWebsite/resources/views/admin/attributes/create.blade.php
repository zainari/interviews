@extends('layout_admin.app')

@section('title', 'Add Attribute')

@section('content')
<div class="product-create-wrapper">
  <div class="page-header">
    <h2>Add New Attribute</h2>
  </div>

  <div class="product-card">
    <form action="{{ route('attributes.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="name">Attribute Name</label>
        <input type="text" name="name" id="name" placeholder="e.g., Size, Color, Material" required>
      </div>
      <div class="form-actions">
        <button class="btn save-btn">Save</button>
        <a href="{{ route('attributes.index') }}" class="btn cancel-btn">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
