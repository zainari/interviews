@extends('layout_admin.app')

@section('title', 'Products | Wasaaz')
@section('page_title', 'Manage Products')

@section('content')
    <div class="category-container">

        @if (session('success'))
            <div class="alert success" id="flashMessage" style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <strong> Success:</strong> {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert error" id="flashMessage" style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @endif

        <div class="category-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 30px;">
            <h2 style="font-weight: 800;">Products Inventory</h2>

            <div class="action-buttons" style="display:flex; gap:10px;">
                <a href="{{ route('attributes.index') }}" class="btn add-btn" style="background:#5a67d8; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none;">Attributes</a>
                <a href="{{ route('attributes-value.index') }}" class="btn add-btn" style="background:#38b2ac; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none;">Values</a>
                <a href="{{ route('products.create') }}" class="btn add-btn" style="background:#48bb78; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none; font-weight: bold;">+ Add Product</a>
            </div>
        </div>

        {{-- Delete Modal --}}
        <div class="modal" id="deleteModal">
            <div class="modal-content">
                <h3>Delete Product?</h3>
                <p>Are you sure you want to delete this product? This will also remove its gallery images.</p>
                <form id="deleteForm" method="GET">
                    @csrf
                    <div class="modal-actions">
                        <button type="submit" class="btn delete" style="background: #ef4444; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;">Yes, Delete</button>
                        <button type="button" class="btn cancel-btn" id="cancelDelete" style="padding: 8px 15px; border-radius: 4px; cursor: pointer;">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="category-table-wrapper">
            <div class="category-table">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8fafc; text-align: left;">
                            <th>Image</th>
                            <th>Product Info</th>
                            <th>Category</th>
                            <th>Group ID</th>
                            <th>Attributes</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 15px;">
                                    @if ($product->image_url)
                                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                                            width="70" style="border-radius:8px; aspect-ratio: 3/4; object-fit: cover; border: 1px solid #eee;">
                                    @else
                                        <div style="width:70px; height:90px; background:#f1f5f9; border-radius:8px; display:grid; place-items:center; font-size:10px; color:#94a3b8;">No Image</div>
                                    @endif
                                </td>
                                <td>
                                    <strong style="display: block; color: #1e293b;">{{ $product->name }}</strong>
                                    <small style="color: #64748b;">SKU: {{ $product->sku }}</small>
                                </td>
                                <td>{{ $product->category->name ?? '—' }}</td>
                                <td>
                                    @if($product->color_group_id)
                                        <span style="background: #fef3c7; color: #92400e; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;">
                                            {{ $product->color_group_id }}
                                        </span>
                                    @else
                                        <span style="color: #cbd5e1;">None</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->attributes->count())
                                        @foreach ($product->attributes as $attr)
                                            <span class="badge" style="background:#eff6ff; color:#1e40af; padding:2px 8px; border-radius:4px; margin-right:4px; font-size: 11px; display: inline-block; margin-bottom: 4px;">
                                                {{ $attr->name }}: {{ $attr->pivot->value }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span style="color: #cbd5e1;">—</span>
                                    @endif
                                </td>
                                <td style="font-weight: 700; color: #0f172a;">${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    @if ($product->is_active)
                                        <span style="color:#059669; background: #ecfdf5; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 700;">Active</span>
                                    @else
                                        <span style="color:#dc2626; background: #fef2f2; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 700;">Inactive</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        {{-- IMPORTANT: Link ab $product (Slug) use kar raha hai --}}
                                        <a href="{{ route('products.edit', $product->slug ?? $product->id) }}" 
                                            class="btn small-btn edit" 
                                            style="background: #4f46e5; color: white; padding: 5px 12px; border-radius: 4px; text-decoration: none; font-size: 12px;">Edit</a>
                                         
                                         {{-- Delete button mein bhi yahi change karein --}}
                                         <button type="button" class="btn small-btn delete deleteBtn"
                                             data-url="{{ route('products.destroy', $product->slug ?? $product->id) }}"
                                             style="background: #ef4444; color: white; padding: 5px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" style="text-align:center; padding: 50px; color: #94a3b8;">No products found in inventory.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="pagination-container" style="margin-top: 30px;">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

{{-- JS Section --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const deleteModal = document.getElementById('deleteModal');
        const cancelDelete = document.getElementById('cancelDelete');
        const deleteForm = document.getElementById('deleteForm');
        const flashMsg = document.getElementById('flashMessage');

        if (flashMsg) {
            setTimeout(() => flashMsg.style.display = 'none', 3500);
        }

        document.querySelectorAll('.deleteBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                deleteModal.classList.add('show');
                // URL contains slug now
                deleteForm.action = btn.dataset.url;
            });
        });
        
        cancelDelete.addEventListener('click', () => deleteModal.classList.remove('show'));

        window.addEventListener('click', (e) => {
            if (e.target === deleteModal) deleteModal.classList.remove('show');
        });
    });
</script>