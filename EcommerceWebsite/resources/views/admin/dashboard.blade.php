@extends('layout_admin.app')

@section('title', 'Admin Dashboard | Wasaaz')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="dashboard-wrapper">

    <!-- Stats Cards -->
    <div class="dashboard-cards">
        <div class="stat-card" data-aos="fade-up" data-aos-delay="0">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h5>Total Revenue</h5>
                    <h2>Rs. 2,450,000</h2>
                    <p class="up"><i class="bi bi-arrow-up"></i> +12% since last month</p>
                </div>
                <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h5>Total Orders</h5>
                    <h2>1,245</h2>
                    <p class="up"><i class="bi bi-arrow-up"></i> +5% from yesterday</p>
                </div>
                <div class="stat-icon"><i class="bi bi-bag-check"></i></div>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h5>New Customers</h5>
                    <h2>387</h2>
                    <p class="muted">Active users right now</p>
                </div>
                <div class="stat-icon"><i class="bi bi-people"></i></div>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h5>Active Products</h5>
                    <h2>126</h2>
                    <p class="down"><i class="bi bi-exclamation-triangle"></i> 3 items out of stock</p>
                </div>
                <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="charts-grid" data-aos="fade-up">
        <div class="chart-card">
            <h3>Sales Performance</h3>
            <canvas id="salesChart" style="max-height: 300px;"></canvas>
        </div>
        <div class="chart-card">
            <h3>Top Selling</h3>
            <canvas id="categoryChart" style="max-height: 300px;"></canvas>
        </div>
    </div>

    <!-- Latest Orders -->
    <div class="data-card" data-aos="fade-up">
        <div class="data-card-header">
            <h3>Latest Orders</h3>
            <a href="{{ route('orders.index') }}" style="font-size: 13px; color: var(--wa-gold); font-weight: 700;">View All Orders</a>
        </div>
        <div style="overflow-x: auto;">
            <table class="wa-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 700;">#ORD-9021</td>
                        <td>Zeeshan Khan</td>
                        <td style="color: var(--wa-muted);">2 mins ago</td>
                        <td><span class="badge badge-success">Completed</span></td>
                        <td style="font-weight: 800;">Rs. 12,000</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 700;">#ORD-9022</td>
                        <td>Sameer Ahmed</td>
                        <td style="color: var(--wa-muted);">1 hour ago</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td style="font-weight: 800;">Rs. 45,000</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 700;">#ORD-9023</td>
                        <td>Bilal Hassan</td>
                        <td style="color: var(--wa-muted);">3 hours ago</td>
                        <td><span class="badge badge-info">Processing</span></td>
                        <td style="font-weight: 800;">Rs. 28,500</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  Chart.defaults.color = '#888888';
  Chart.defaults.borderColor = '#1f1f1f';

  const salesChart = new Chart(document.getElementById('salesChart'), {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Revenue',
        data: [2100, 1800, 3200, 2800, 4500, 3900, 5200],
        borderColor: '#c9a86c',
        borderWidth: 3,
        pointBackgroundColor: '#c9a86c',
        pointBorderColor: '#0a0a0a',
        pointBorderWidth: 2,
        tension: 0.4,
        fill: true,
        backgroundColor: 'rgba(201, 168, 108, 0.08)'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        y: { grid: { display: false }, border: { display: false } },
        x: { grid: { display: false } }
      }
    }
  });

  const categoryChart = new Chart(document.getElementById('categoryChart'), {
    type: 'doughnut',
    data: {
      labels: ['Hoodies', 'Polo', 'Trousers'],
      datasets: [{
        data: [55, 30, 15],
        backgroundColor: ['#c9a86c', '#7a1f2a', '#4f46e5'],
        borderWidth: 0,
        cutout: '70%'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { position: 'bottom' } }
    }
  });
</script>
@endsection
