@extends('layout_admin.app')

@section('title', 'Categories | Admin Panel')
@section('page_title', '')

@section('content')
<div class="category-container">
  <div class="category-header">
    <h2>Categories</h2>
    <button class="btn add-btn" id="addCategoryBtn">+ Add Category</button>
  </div>

  <!-- Flash Messages -->
  @if(session('success'))
    <div class="alert success" id="flashMessage">
      <strong> Success:</strong> {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="alert error" id="flashMessage">
      <strong>⚠️ Error:</strong> {{ session('error') }}
    </div>
  @endif

  <!-- Validation Errors -->
  @if ($errors->any())
    <div class="alert error" id="validationErrors">
      <strong>⚠️ Please fix the following errors:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Add/Edit Modal -->
  <div class="modal" id="categoryModal">
    <div class="modal-content">
      <h3 id="modalTitle">Add Category</h3>
      <form id="categoryForm" method="POST">
        @csrf
        <input type="hidden" name="_method" id="formMethod" value="POST">
        <input type="text" name="name" id="categoryName" placeholder="Enter category name" required>
        <div class="modal-actions">
          <button type="submit" class="btn save-btn">Save</button>
          <button type="button" class="btn cancel-btn" id="closeModal">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal" id="deleteModal">
    <div class="modal-content">
      <h3>Delete Category?</h3>
      <p>Are you sure you want to delete this category? This action cannot be undone.</p>
      <form id="deleteForm" method="get">
        @csrf
        <div class="modal-actions">
          <button type="submit" class="btn delete">Yes, Delete</button>
          <button type="button" class="btn cancel-btn" id="cancelDelete">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Category Table -->
<div class="category-table-wrapper">
  <div class="category-table">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($category as $cat)
        <tr>
          <td data-label="ID">{{ $cat->id }}</td>
          <td data-label="Name">{{ $cat->name }}</td>
          <td data-label="Created">{{ $cat->created_at->format('Y-m-d') }}</td>
          <td data-label="Actions">
            <button 
              type="button" 
              class="btn small-btn edit editBtn"
              data-id="{{ $cat->id }}"
              data-name="{{ $cat->name }}"
              data-url="{{ route('categories.update', $cat->id) }}">
              Edit
            </button>

            <button 
              type="button" 
              class="btn small-btn delete deleteBtn"
              data-url="{{ route('categories.destroy', $cat->id) }}">
              Delete
            </button>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center;">No categories found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- ✅ Pagination Links -->
  <div class="pagination-container">
    {{ $category->links('pagination::bootstrap-5') }}
  </div>
</div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById('categoryModal');
  const deleteModal = document.getElementById('deleteModal');
  const openBtn = document.getElementById('addCategoryBtn');
  const closeBtn = document.getElementById('closeModal');
  const cancelDelete = document.getElementById('cancelDelete');
  const form = document.getElementById('categoryForm');
  const deleteForm = document.getElementById('deleteForm');
  const modalTitle = document.getElementById('modalTitle');
  const formMethod = document.getElementById('formMethod');
  const categoryName = document.getElementById('categoryName');
  const flashMsg = document.getElementById('flashMessage');

  if (flashMsg) {
    setTimeout(() => flashMsg.style.display = 'none', 3500);
  }

    openBtn.addEventListener('click', () => {
    modal.classList.add('show');
    form.action = "{{ route('categories.store') }}";
    formMethod.value = "POST";
    modalTitle.textContent = "Add New Category";
    categoryName.value = "";
  });

  document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', () => {
      modal.classList.add('show');
      modalTitle.textContent = "Edit Category";
      form.action = btn.dataset.url;
      formMethod.value = "PUT";
      categoryName.value = btn.dataset.name;
    });
  });

  document.querySelectorAll('.deleteBtn').forEach(btn => {
    btn.addEventListener('click', () => {
      deleteModal.classList.add('show');
      deleteForm.action = btn.dataset.url;
    });
  });
  if (document.getElementById('validationErrors')) {
  setTimeout(() => document.getElementById('validationErrors').style.display = 'none', 5000);
}

  closeBtn.addEventListener('click', () => modal.classList.remove('show'));
  cancelDelete.addEventListener('click', () => deleteModal.classList.remove('show'));
  window.addEventListener('click', (e) => {
    if (e.target === modal) modal.classList.remove('show');
    if (e.target === deleteModal) deleteModal.classList.remove('show');
  });
});
</script>

