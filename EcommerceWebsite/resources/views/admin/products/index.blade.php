@extends('layout_admin.app')

@section('title', 'Products | Admin Panel')
@section('page_title', 'Manage Products')

@section('content')
<div class="category-container">
  {{-- Flash Messages --}}
  @if(session('success'))
    <div class="alert success" id="flashMessage">
      <strong>✅ Success:</strong> {{ session('success') }}
    </div>
  @elseif(session('error'))
    <div class="alert error" id="flashMessage">
      <strong>⚠️ Error:</strong> {{ session('error') }}
    </div>
  @endif

  {{-- Header --}}
  <div class="category-header">
    <h2>Products</h2>
    <a href="{{ route('products.create') }}" class="btn add-btn">+ Add Product</a>
  </div>

  <div class="modal" id="deleteModal">
    <div class="modal-content">
      <h3>Delete Product?</h3>
      <p>Are you sure you want to delete this product? This action cannot be undone.</p>
      <form id="deleteForm" method="GET">
        @csrf
        <div class="modal-actions">
          <button type="submit" class="btn delete">Yes, Delete</button>
          <button type="button" class="btn cancel-btn" id="cancelDelete">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Products Table --}}
  <div class="category-table-wrapper">
    <div class="category-table">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Price ($)</th>
            <th>Stock</th>
            <th>SKU</th>
            <th>Status</th>
            <th>Available From</th>
            <th>Available To</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
          <tr>
            <td>{{ $product->id }}</td>
            <td>
              @if($product->image_url)
                <img src="{{ asset('storage/products/' . basename($product->image_url)) }}" alt="{{ $product->name }}" width="80" style="border-radius:8px;">
              @else
                <span>No Image</span>
              @endif
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->brand ?? '—' }}</td>
            <td>{{ $product->category->name ?? '—' }}</td>
            <td>${{ number_format($product->price, 2) }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->sku }}</td>
            <td>
              @if($product->is_active)
                <span style="color:green; font-weight:600;">Active</span>
              @else
                <span style="color:red; font-weight:600;">Inactive</span>
              @endif
            </td>
            <td>{{ $product->available_from ? $product->available_from->format('Y-m-d') : '—' }}</td>
            <td>{{ $product->available_to ? $product->available_to->format('Y-m-d') : '—' }}</td>
            <td>
              <a href="{{ route('products.edit', $product) }}" class="btn small-btn edit">Edit</a>
              <button 
                type="button" 
                class="btn small-btn delete deleteBtn" 
                data-url="{{ route('products.destroy', $product->id) }}">
                Delete
              </button>
            </td>
          </tr>
          @empty
          <tr><td colspan="12" style="text-align:center;">No products found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Pagination --}}
  <div class="pagination-container">
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
      deleteForm.action = btn.dataset.url;
    });
  });
  cancelDelete.addEventListener('click', () => deleteModal.classList.remove('show'));

  window.addEventListener('click', (e) => {
    if (e.target === deleteModal) deleteModal.classList.remove('show');
  });
});
</script>
