@extends('layout_admin.app')

@section('title', 'Add Product | Zain Store')
@section('page_title', '')

@section('content')
<div class="product-create-wrapper">
  <div class="page-header">
    <h2>Add New Product</h2>
    <p>Fill out the form below to add a new product to your store inventory.</p>
  </div>

  <div class="product-card">
    <form action="#" method="POST" enctype="multipart/form-data" class="product-form">
      @csrf

      <h3 class="section-title"> Basic Information</h3>
      <div class="form-row">
        <div class="form-group">
          <label>Product Name</label>
          <input type="text" placeholder="Enter product name">
        </div>

        <div class="form-group">
          <label>SKU</label>
          <input type="text" placeholder="Unique product code">
        </div>

        <div class="form-group">
          <label>Brand</label>
          <input type="text" placeholder="Brand name">
        </div>
      </div>

      <h3 class="section-title"> Pricing & Stock</h3>
      <div class="form-row">
        <div class="form-group">
          <label>Price ($)</label>
          <input type="number" step="0.01" placeholder="0.00">
        </div>

        <div class="form-group">
          <label>Stock Quantity</label>
          <input type="number" min="0" placeholder="Enter stock">
        </div>

        <div class="form-group">
          <label>Category</label>
          <select>
            <option value="">Select Category</option>
            <option>Men’s Fashion</option>
            <option>Women’s Fashion</option>
            <option>Accessories</option>
            <option>Electronics</option>
          </select>
        </div>
      </div>

      <h3 class="section-title"> Availability</h3>
      <div class="form-row">
        <div class="form-group">
          <label>Available From</label>
          <input type="datetime-local">
        </div>
        <div class="form-group">
          <label>Available To</label>
          <input type="datetime-local">
        </div>
        <div class="form-group checkbox">
          <label><input type="checkbox" checked> Active Product</label>
        </div>
      </div>

      <h3 class="section-title"> Product Image</h3>
      <div class="form-group full">
        <input type="file" accept="image/*">
        <p class="file-hint">Supported formats: JPG, PNG, WebP</p>
      </div>

      <h3 class="section-title"> Description</h3>
      <div class="form-group full">
        <textarea rows="4" placeholder="Write a brief description about this product..."></textarea>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn save-btn"> Save Product</button>
        <button type="reset" class="btn cancel-btn"> Cancel</button>
      </div>
    </form>
  </div>
</div>
@endsection
