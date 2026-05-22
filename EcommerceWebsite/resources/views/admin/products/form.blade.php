@extends('layout_admin.app')

@section('title', 'Add Product | Admin Panel')

@section('content')
<!-- Professional Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Admin Panel Form Styling */
    .product-card { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    .form-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 20px; }
    .form-group { margin-bottom: 20px; display: flex; flex-direction: column; }
    .form-group label { font-weight: 600; margin-bottom: 8px; color: #333; font-size: 14px; }
    .form-group input, .form-group select, .form-group textarea { 
        padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; outline: none; transition: 0.3s;
    }
    .form-group input:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }

    /* Select2 Professional Design */
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ddd !important; border-radius: 8px !important; padding: 5px !important; min-height: 45px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #4f46e5 !important; border: none !important; color: white !important;
        border-radius: 4px !important; padding: 2px 10px !important; font-size: 12px !important;
    }

    /* Dynamic Stock Box Styling */
    .stock-inventory-box { background: #f9fafb; padding: 20px; border-radius: 10px; border: 1px solid #e5e7eb; margin-top: 20px; display: none; }
    .stock-row { display: flex; align-items: center; gap: 20px; margin-bottom: 12px; background: #fff; padding: 10px 15px; border-radius: 8px; border: 1px solid #eee; }
    .stock-label { font-weight: 700; width: 120px; color: #4b5563; text-transform: uppercase; font-size: 12px; }
    
    .file-hint { font-size: 11px; color: #888; margin-top: 5px; }
    .btn { padding: 12px 25px; border-radius: 8px; font-weight: 700; cursor: pointer; border: none; transition: 0.3s; text-decoration: none; display: inline-block; }
    .save-btn { background: #4f46e5; color: white; }
    .cancel-btn { background: #f3f4f6; color: #374151; text-align: center; }
</style>

<div class="product-create-wrapper">
    
    @if(session('success'))
        <div class="alert success" style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-header" style="margin-bottom: 30px;">
        <h2 style="font-size: 24px; font-weight: 800;">Add New Product</h2>
        <p style="color: #666;">Step 1: Fill details -> Step 2: Set stock per size -> Step 3: Save.</p>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-card">
        @csrf

        <!-- Row 1: Basic Info -->
        <div class="form-row">
            <div class="form-group">
                <label>Product Name <span style="color:red">*</span></label>
                <input type="text" name="name" placeholder="e.g. Classic Full Sleeves Polo" required>
            </div>

            <div class="form-group">
                <label>Brand</label>
                <input type="text" name="brand" placeholder="e.g. Zilbil">
            </div>

            <div class="form-group">
                <label>SKU <span style="color:red">*</span></label>
                <input type="text" name="sku" placeholder="SKU-10001" required>
            </div> 
        </div>

        <!-- Row 2: Category & Group ID -->
        <div class="form-row" style="grid-template-columns: 1fr 1fr;">
            <div class="form-group">
                <label>Category <span style="color:red">*</span></label>
                <select name="category_id" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Variant Group ID (Link colors)</label>
                <input type="text" name="color_group_id" placeholder="e.g. classic-polo-series">
                <small class="file-hint">Use SAME ID for different colors of the same item.</small>
            </div>
        </div>

        <!-- Row 3: Price, Stock & Status -->
        <div class="form-row">
            <div class="form-group">
                <label>Price ($) <span style="color:red">*</span></label>
                <input type="number" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label>Global Stock (Total)</label>
                <input type="number" name="stock" value="0">
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="is_active">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Row 4: Attributes (Select2) -->
        <div class="form-row" style="grid-template-columns: 1fr 1fr;">
            @foreach($attributes as $attribute)
            <div class="form-group">
                <label>{{ $attribute->name }} (Multiple Selection)</label>
                <select name="attributes[{{ $attribute->id }}][]" 
                        class="select2-multiple {{ $attribute->name == 'Size' ? 'size-selector' : '' }}" 
                        multiple="multiple">
                    @foreach($attribute->values as $value)
                        <option value="{{ $value->id }}" data-name="{{ $value->value }}">{{ $value->value }}</option>
                    @endforeach
                </select>
            </div>
            @endforeach
        </div>

        <!-- --- DYNAMIC SIZE STOCK SECTION --- -->
        <div class="stock-inventory-box" id="stockInventorySection">
            <h4 style="font-size: 14px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase;">
                <i class="fas fa-boxes"></i> Set Stock Per Selected Size
            </h4>
            <div id="dynamicStockRows">
                <!-- Rows will be added here by JS -->
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Product Description</label>
            <textarea name="description" rows="4" placeholder="Enter product details..."></textarea>
        </div>
      
        <!-- Row 5: Image Uploads -->
        <div class="form-row" style="grid-template-columns: 1fr 1fr;">
            <div class="form-group">
                <label>Main Product Image</label>
                <input type="file" name="image_url" accept="image/*">
            </div>

            <div class="form-group">
                <label>Gallery Images</label>
                <input type="file" name="gallery[]" accept="image/*" multiple>
            </div>
        </div>

        <div class="form-actions" style="display: flex; gap: 15px; justify-content: flex-end; border-top: 1px solid #eee; padding-top: 25px; margin-top: 10px;">
            <a href="{{ route('products.index') }}" class="btn cancel-btn">Cancel</a>
            <button type="submit" class="btn save-btn">Save Product</button>
        </div>
    </form>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // 1. Initialize Select2
        $('.select2-multiple').select2({
            placeholder: "  Select options",
            allowClear: true,
            width: '100%'
        });

        // 2. Dynamic Stock Logic for Sizes
        $('.size-selector').on('change', function() {
            let selectedSizes = $(this).select2('data');
            let stockSection = $('#stockInventorySection');
            let rowsContainer = $('#dynamicStockRows');
            
            rowsContainer.empty(); // Clear existing rows

            if (selectedSizes.length > 0) {
                stockSection.show();
                selectedSizes.forEach(function(size) {
                    let sizeName = size.text;
                    let rowHtml = `
                        <div class="stock-row">
                            <span class="stock-label">Size: ${sizeName}</span>
                            <input type="number" name="size_stock[${sizeName}]" placeholder="Stock Qty" min="0" value="0" required style="width: 150px;">
                            <small style="color: #999;">Units in hand</small>
                        </div>
                    `;
                    rowsContainer.append(rowHtml);
                });
            } else {
                stockSection.hide();
            }
        });
    });
</script>
@endsection