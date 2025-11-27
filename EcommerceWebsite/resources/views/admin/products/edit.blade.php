@extends('layout_admin.app')

@section('title', 'Edit Product | Admin Panel')
@section('page_title', 'Edit Product')

@section('content')
    <div class="product-create-wrapper">
        <div class="page-header">
            <h2>Edit Product</h2>
            <p>Update product details below.</p>
        </div>

        <div class="product-card">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') --}}

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                            required>
                        @error('name')
                            <small style="color:red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="number" step="0.01" name="price" id="price"
                            value="{{ old('price', $product->price) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" value="{{ old('brand', $product->brand) }}">
                    </div>
                </div>

                {{--  Attributes Section --}}
                @foreach ($attributes as $attribute)
                
                    <div class="form-group">
                        <label>{{ $attribute->name }}</label>
                        <select name="attributes[{{ $attribute->id }}][]" class="form-control">
                            <option value="">Select {{ $attribute->name }}</option>
                            @foreach ($attribute->values as $value)
                            <option value="{{ $value->id }}"
                                @if (isset($selectedAttributes[$attribute->id]) && in_array($value->value, $selectedAttributes[$attribute->id])) selected @endif>
                                {{ $value->value }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="available_from">Available From</label>
                        <input type="datetime-local" name="available_from" id="available_from"
                            value="{{ old('available_from', $product->available_from ? $product->available_from->format('Y-m-d\TH:i') : '') }}">
                    </div>
                    <div class="form-group">
                        <label for="available_to">Available To</label>
                        <input type="datetime-local" name="available_to" id="available_to"
                            value="{{ old('available_to', $product->available_to ? $product->available_to->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </div>

                {{--  Image --}}
                <div class="form-group">
                    <label>Product Image</label>
                    @if ($product->image_url)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image" width="120"
                                style="border-radius:8px;">
                        </div>
                    @endif
                    <input type="file" name="image_url" accept="image/*">
                    <small class="file-hint">Leave blank if you don’t want to change image.</small>
                </div>


                {{--  Status --}}
                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>Active
                        </option>
                        <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>Inactive
                        </option>
                    </select>
                    @error('is_active')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>


                {{--  Buttons --}}
                <div class="form-actions">
                    <button type="submit" class="btn save-btn">Update Product</button>
                    <a href="{{ route('products.index') }}" class="btn cancel-btn">Cancel</a>
                </div>

            </form>
        </div>
    </div>
@endsection
