@extends('layout_admin.app')

@section('title', 'Orders | Wasaaz')
@section('page_title', '')

@section('content')
<div class="orders-container">
  <div class="orders-header">
    <h2>Orders</h2>
    {{-- <button class="btn add-btn" id="addordersBtn">+ Add Orders</button> --}}
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
  <div class="modal" id="ordersModal">
    <div class="modal-content">
      <h3 id="modalTitle">Add orders</h3>
      <form id="ordersForm" method="POST">
        @csrf
        <input type="hidden" name="_method" id="formMethod" value="POST">
        <input type="text" name="name" id="ordersName" placeholder="Enter orders name" required>
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
      <h3>Delete orders?</h3>
      <p>Are you sure you want to delete this orders? This action cannot be undone.</p>
      <form id="deleteForm" method="get">
        @csrf
        <div class="modal-actions">
          <button type="submit" class="btn delete">Yes, Delete</button>
          <button type="button" class="btn cancel-btn" id="cancelDelete">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- orders Table -->
<div class="orders-table-wrapper">
  <div class="orders-table">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>User Id</th>
          <th>Email</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Address</th>
          <th>City</th>
          <th>Country</th>
          <th>Phone</th> 
          <th>Sub Total</th>
          <th>Discount</th>
          <th>Shipping Charges</th>
          <th>Total</th>   
          <th>Payment Method</th>
          <th>Status</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $ord)
        <tr>
          <td data-label="ID">{{ $ord->id }}</td>
          <td data-label="USER">{{ $ord->user_id }}</td>
          <td data-label="EMAIL">{{ $ord->email }}</td>
          <td data-label="FIRSTNAME">{{ $ord->first_name }}</td>
          <td data-label="LASTNAME">{{ $ord->last_name }}</td>
          <td data-label="ADDRESS">{{ $ord->address }}</td>
          <td data-label="CITY">{{ $ord->city }}</td>
          <td data-label="COUNTRY">{{ $ord->country }}</td>
          <td data-label="PHONE">{{ $ord->phone }}</td>
          <td data-label="SUBTOTAL">{{ $ord->subtotal }}</td>
          <td data-label="DISCOUNT">{{ $ord->discount }}</td>
          <td data-label="SHIPPING">{{ $ord->shipping }}</td>
          <td data-label="TOTAL">{{ $ord->total }}</td>
          <td data-label="PAYMENTMETHOD">{{ $ord->payment_method }}</td>
          <td data-label="STATUS">{{ $ord->status }}</td>
          <td data-label="Created">{{ $ord->created_at->format('Y-m-d') }}</td>
          
          {{-- <td data-label="Actions">
            <button 
              type="button" 
              class="btn small-btn edit editBtn"
              data-id="{{ $ord->id }}"
              data-name="{{ $ord->name }}"
              data-url="{{ route('categories.update', $ord->id) }}">
              Edit
            </button>

            <button 
              type="button" 
              class="btn small-btn delete deleteBtn"
              data-url="{{ route('categories.destroy', $ord->id) }}">
              Delete
            </button>
          </td> --}}
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center;">No ORDERS found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- ✅ Pagination Links -->
  <div class="pagination-container">
    {{ $orders->links('pagination::bootstrap-5') }}
  </div>
</div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById('ordersModal');
  const deleteModal = document.getElementById('deleteModal');
  const openBtn = document.getElementById('addordersBtn');
  const closeBtn = document.getElementById('closeModal');
  const cancelDelete = document.getElementById('cancelDelete');
  const form = document.getElementById('ordersForm');
  const deleteForm = document.getElementById('deleteForm');
  const modalTitle = document.getElementById('modalTitle');
  const formMethod = document.getElementById('formMethod');
  const ordersName = document.getElementById('ordersName');
  const flashMsg = document.getElementById('flashMessage');

  if (flashMsg) {
    setTimeout(() => flashMsg.style.display = 'none', 3500);
  }

//     openBtn.addEventListener('click', () => {
//     modal.classList.add('show');
//     form.action = "{{ route('categories.store') }}";
//     formMethod.value = "POST";
//     modalTitle.textContent = "Add New orders";
//     ordersName.value = "";
//   });

//   document.querySelectorAll('.editBtn').forEach(btn => {
//     btn.addEventListener('click', () => {
//       modal.classList.add('show');
//       modalTitle.textContent = "Edit orders";
//       form.action = btn.dataset.url;
//       formMethod.value = "PUT";
//       ordersName.value = btn.dataset.name;
//     });
//   });

//   document.querySelectorAll('.deleteBtn').forEach(btn => {
//     btn.addEventListener('click', () => {
//       deleteModal.classList.add('show');
//       deleteForm.action = btn.dataset.url;
//     });
//   });
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

