@extends('layout_admin.app')

@section('title', 'Dashboard | Zain Store')
@section('page_title', 'Dashboard')

@section('content')

<div class="dashboard-cards">
  <div class="card">
    <h3>Total Sales</h3>
    <p>$12,340</p>
  </div>
  <div class="card">
    <h3>Orders</h3>
    <p>245</p>
  </div>
  <div class="card">
    <h3>New Users</h3>
    <p>87</p>
  </div>
  <div class="card">
    <h3>Products</h3>
    <p>126</p>
  </div>
</div>

<!-- Chart Section -->
<div class="charts-container" style="padding: 0 30px 50px;">
  <div class="chart-card">
    <h3>📈 Sales Overview</h3>
    <canvas id="salesChart"></canvas>
  </div>

  <div class="chart-card">
    <h3>🛍️ Top Categories</h3>
    <canvas id="categoryChart"></canvas>
  </div>
</div>

@endsection

@section('scripts')
<script>
  // 📊 Sales Line Chart
  const ctx1 = document.getElementById('salesChart');
  new Chart(ctx1, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Sales ($)',
        data: [1200, 1500, 1800, 1300, 2200, 2700],
        borderColor: '#007bff',
        tension: 0.4,
        fill: true,
        backgroundColor: 'rgba(0,123,255,0.1)'
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  });

  // 🛍️ Category Bar Chart
  const ctx2 = document.getElementById('categoryChart');
  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['Hoodies', 'T-Shirts', 'Accessories', 'Jackets', 'Shoes'],
      datasets: [{
        label: 'Units Sold',
        data: [120, 90, 70, 60, 50],
        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6610f2']
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  });
</script>
@endsection
