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
                    <h2>Rs. {{ number_format($totalRevenue) }}</h2>
                    <p class="up"><i class="bi bi-arrow-up"></i> All-time sales</p>
                </div>
                <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h5>Total Orders</h5>
                    <h2>{{ number_format($totalOrders) }}</h2>
                    <p class="muted">{{ $pendingOrders }} pending</p>
                </div>
                <div class="stat-icon"><i class="bi bi-bag-check"></i></div>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h5>Customers</h5>
                    <h2>{{ number_format($totalCustomers) }}</h2>
                    <p class="muted">{{ $unreadMessages }} unread messages</p>
                </div>
                <div class="stat-icon"><i class="bi bi-people"></i></div>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h5>Active Products</h5>
                    <h2>{{ number_format($totalProducts) }}</h2>
                    <p class="down"><i class="bi bi-exclamation-triangle"></i> {{ $lowStock }} items low stock</p>
                </div>
                <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="charts-grid" data-aos="fade-up">
        <div class="chart-card">
            <h3>Revenue — Last 7 Days</h3>
            <canvas id="salesChart" style="max-height: 300px;"></canvas>
        </div>
        <div class="chart-card">
            <h3>Products by Category</h3>
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
                    @forelse($recentOrders as $ord)
                    @php
                        $badgeMap = [
                            'pending' => 'badge-warning', 'paid' => 'badge-success',
                            'processing' => 'badge-info', 'shipped' => 'badge-info',
                            'delivered' => 'badge-success', 'completed' => 'badge-success',
                            'cancelled' => 'badge-danger',
                        ];
                    @endphp
                    <tr>
                        <td style="font-weight: 700;"><a href="{{ route('orders.show', $ord->id) }}" style="color: var(--wa-gold);">#{{ $ord->id }}</a></td>
                        <td>{{ $ord->first_name }} {{ $ord->last_name }}</td>
                        <td style="color: var(--wa-muted);">{{ $ord->created_at->diffForHumans() }}</td>
                        <td><span class="badge {{ $badgeMap[$ord->status] ?? 'badge-info' }}">{{ ucfirst($ord->status) }}</span></td>
                        <td style="font-weight: 800;">Rs. {{ number_format($ord->total) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center; padding:30px; color: var(--wa-muted);">No orders yet.</td></tr>
                    @endforelse
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

  new Chart(document.getElementById('salesChart'), {
    type: 'line',
    data: {
      labels: {!! json_encode($chartLabels) !!},
      datasets: [{
        label: 'Revenue',
        data: {!! json_encode($chartValues) !!},
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

  new Chart(document.getElementById('categoryChart'), {
    type: 'doughnut',
    data: {
      labels: {!! json_encode($categoryData->pluck('name')) !!},
      datasets: [{
        data: {!! json_encode($categoryData->pluck('total')) !!},
        backgroundColor: ['#c9a86c', '#7a1f2a', '#4f46e5', '#34d399', '#f59e0b'],
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
