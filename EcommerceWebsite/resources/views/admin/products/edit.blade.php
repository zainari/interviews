@extends('layout_admin.app')

@section('title', 'Edit Product | Wasaaz')

@section('content')
<!-- Professional Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Professional Form Styling */
    .product-card { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    .form-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 20px; }
    .form-group { margin-bottom: 20px; display: flex; flex-direction: column; }
    .form-group label { font-weight: 600; margin-bottom: 8px; color: #333; font-size: 14px; }
    .form-group input, .form-group select, .form-group textarea { 
        padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; outline: none; transition: 0.3s;
    }
    .form-group input:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }

    /* Select2 Tag Style */
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ddd !important; border-radius: 8px !important; min-height: 45px !important; padding: 5px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #4f46e5 !important; border: none !important; color: white !important; border-radius: 4px !important; padding: 2px 10px !important;
    }

    /* Size-wise Stock Section Style */
    .stock-inventory-box { background: #f9fafb; padding: 20px; border-radius: 10px; border: 1px solid #e5e7eb; margin-top: 20px; }
    .stock-row { display: flex; align-items: center; gap: 20px; margin-bottom: 12px; background: #fff; padding: 10px 15px; border-radius: 8px; border: 1px solid #eee; }
    .stock-label { font-weight: 700; width: 120px; color: #4b5563; text-transform: uppercase; font-size: 12px; }

    /* Gallery Thumbnails Style */
    .gallery-item { position: relative; width: 100px; height: 120px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; background: #f9f9f9; }
    .gallery-item img { width: 100%; height: 100%; object-fit: cover; }
    .delete-overlay {
        position: absolute; top: 5px; right: 5px; background: rgba(239, 68, 68, 0.9);
        color: white; width: 22px; height: 22px; border-radius: 50%; text-align: center;
        line-height: 22px; font-size: 14px; text-decoration: none; font-weight: bold; cursor: pointer;
    }
    
    .file-hint { font-size: 11px; color: #888; margin-top: 5px; }
    .btn { padding: 12px 25px; border-radius: 8px; font-weight: 700; cursor: pointer; border: none; transition: 0.3s; text-decoration: none; display: inline-block; }
    .save-btn { background: #4f46e5; color: white; }
    .cancel-btn { background: #f3f4f6; color: #374151; text-align: center; }
</style>

<div class="product-create-wrapper">
    <div class="page-header" style="margin-bottom: 30px;">
        <h2 style="font-size: 24px; font-weight: 800;">Edit Product</h2>
        <p style="color: #666;">Manage details, variant grouping, and size-specific inventory.</p>
    </div>

    <div class="product-card">
        {{-- Use Slug for Route to avoid 404 --}}
        <form action="{{ route('products.update', $product->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Row 1: Basic Info -->
            <div class="form-row">
                <div class="form-group">
                    <label>Product Name <span style="color:red">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="form-group">
                    <label>Brand</label>
                    <input type="text" name="brand" value="{{ old('brand', $product->brand) }}">
                </div>

                <div class="form-group">
                    <label>Price ($) <span style="color:red">*</span></label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
                </div>
            </div>

            <!-- Row 2: Category, SKU, Stock -->
            <div class="form-row">
                <div class="form-group">
                    <label>Category <span style="color:red">*</span></label>
                    <select name="category_id" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>SKU <span style="color:red">*</span></label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required>
                </div>

                <div class="form-group">
                    <label>Global Stock (Total)</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}">
                </div>
            </div>

            <!-- Row 3: Zilbil Variant Group ID & Status -->
            <div class="form-row" style="grid-template-columns: 2fr 1fr;">
                <div class="form-group">
                    <label>Variant Group ID (Link with other colors)</label>
                    <input type="text" name="color_group_id" value="{{ old('color_group_id', $product->color_group_id) }}" placeholder="e.g. classic-polo-series">
                    <small class="file-hint">Same ID = Color Swatches linked together.</small>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="is_active">
                        <option value="1" {{ $product->is_active == 1 ? 'selected' : '' }}>Active (Live)</option>
                        <option value="0" {{ $product->is_active == 0 ? 'selected' : '' }}>Inactive (Hidden)</option>
                    </select>
                </div>
            </div>

            <!-- Row 4: Dynamic Attributes -->
            <div class="form-row" style="grid-template-columns: 1fr 1fr;">
                @foreach ($attributes as $attribute)
                <div class="form-group">
                    <label>{{ $attribute->name }} (Multiple Selection)</label>
                    <select name="attributes[{{ $attribute->id }}][]" class="select2-multiple" multiple="multiple">
                        @foreach ($attribute->values as $value)
                            <option value="{{ $value->id }}"
                                @if (isset($selectedAttributes[$attribute->id]) && in_array($value->value, $selectedAttributes[$attribute->id])) selected @endif>
                                {{ $value->value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endforeach
            </div>

            <!-- --- NEW LOGIC: SIZE-WISE STOCK MANAGEMENT --- -->
            <div class="stock-inventory-box">
                <h4 style="font-size: 14px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; color: #111;">
                    <i class="fas fa-boxes"></i> Inventory Per Size
                </h4>
                
                @php 
                    $productSizes = $product->attributes->where('name', 'Size');
                @endphp

                @if($productSizes->count() > 0)
                    @foreach($productSizes as $sizeAttr)
                        @php 
                            $sizeVal = $sizeAttr->pivot->value;
                            // Check database for existing stock for this specific size
                            $sRecord = \App\Models\ProductSizeStock::where('product_id', $product->id)
                                        ->where('size', $sizeVal)->first();
                        @endphp
                        <div class="stock-row">
                            <span class="stock-label">Size: {{ $sizeVal }}</span>
                            <input type="number" name="size_stock[{{ $sizeVal }}]" 
                                   value="{{ $sRecord->stock ?? 0 }}" 
                                   placeholder="Qty" min="0">
                            <small style="color: #999;">Units available</small>
                        </div>
                    @endforeach
                @else
                    <p style="font-size: 13px; color: #ef4444; font-weight: 600;">Please select and save "Size" attributes first to enable inventory per size.</p>
                @endif
            </div>

            <div class="form-group" style="margin-top: 30px;">
                <label>Description</label>
                <textarea name="description" rows="4">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Images Section -->
            <div class="form-group" style="border-top: 1px solid #eee; padding-top: 25px;">
                <label>Main Swatch Image</label>
                @if ($product->image_url)
                    <div style="margin-bottom: 15px;">
                        <img src="{{ asset('storage/' . $product->image_url) }}" width="120" style="border-radius:8px; border: 1px solid #ddd; aspect-ratio: 3/4; object-fit: cover;">
                    </div>
                @endif
                <input type="file" name="image_url" accept="image/*">
            </div>

            <div class="form-group" style="border-top: 1px solid #eee; padding-top: 25px;">
                <label>Product Gallery (Thumbnails)</label>
                @if($product->images->count() > 0)
                    <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 20px;">
                        @foreach($product->images as $img)
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $img->image_path) }}">
                                <a href="{{ route('products.image.delete', $img->id) }}" onclick="return confirm('Delete?')" class="delete-overlay">×</a>
                            </div>
                        @endforeach
                    </div>
                @endif
                <input type="file" name="gallery[]" multiple class="form-control">
            </div>

            <div class="form-actions" style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px; border-top: 1px solid #eee; padding-top: 25px;">
                <a href="{{ route('products.index') }}" class="btn cancel-btn">Cancel</a>
                <button type="submit" class="btn save-btn">Update Product & Inventory</button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-multiple').select2({
            placeholder: "  Select options",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection