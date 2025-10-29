@extends('layout_admin.app')

@section('title', 'Add Product | Admin Panel')
@section('page_title', 'Add New Product')

@section('content')
<div class="product-create-wrapper">
    
    {{--  Flash Messages --}}
    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    {{--  Page Header --}}
    <div class="page-header">
        <h2>Add New Product</h2>
        <p>Fill in the details below to add a new product.</p>
    </div>

    {{--  Product Form --}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-card">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="name">Product Name <span style="color:red">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name') <small style="color:red;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" value="{{ old('brand') }}">
                @error('brand') <small style="color:red;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="sku">SKU <span style="color:red">*</span></label>
                <input type="text" name="sku" id="sku" value="{{ old('sku') }}" required>
                @error('sku') <small style="color:red;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Category <span style="color:red">*</span></label>
                <select name="category_id" id="category_id" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <small style="color:red;">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="price">Price ($) <span style="color:red">*</span></label>
                <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}" required>
                @error('price') <small style="color:red;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stock Quantity</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}">
                @error('stock') <small style="color:red;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="is_active">Status</label>
                <select name="is_active" id="is_active">
                    <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('is_active') <small style="color:red;">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="available_from">Available From</label>
                <input type="datetime-local" name="available_from" id="available_from" value="{{ old('available_from') }}">
                @error('available_from') <small style="color:red;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="available_to">Available To</label>
                <input type="datetime-local" name="available_to" id="available_to" value="{{ old('available_to') }}">
                @error('available_to') <small style="color:red;">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea name="description" id="description" rows="4" placeholder="Enter product description...">{{ old('description') }}</textarea>
            @error('description') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="image_url">Product Image</label>
            <input type="file" name="image_url" id="image_url" accept="image/*">
            <small class="file-hint">Allowed: JPG, PNG, GIF (max 2MB)</small>
            @error('image_url') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn save-btn">Save Product</button>
            <a href="{{ route('products.index') }}" class="btn cancel-btn">Cancel</a>
        </div>
    </form>
</div>
@endsection
