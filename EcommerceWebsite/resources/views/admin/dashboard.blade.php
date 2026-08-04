@extends('layout_admin.app')

@section('title', 'Admin Dashboard | Zain Store')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="dashboard-wrapper" style="padding: 20px;">
    
    <!-- 1. Top Stats Cards -->
    <div class="dashboard-cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card" style="background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 5px solid #4f46e5;">
            <div style="display:flex; justify-content: space-between;">
                <div>
                    <h5 style="color: #64748b; font-size: 14px; text-transform: uppercase; margin-bottom: 10px;">Total Revenue</h5>
                    <h2 style="font-size: 28px; font-weight: 800;">$12,340</h2>
                    <p style="color: #10b981; font-size: 12px; font-weight: 700; margin-top: 10px;"><i class="bi bi-arrow-up"></i> +12% since last month</p>
                </div>
                <div style="background: #eef2ff; width: 50px; height: 50px; border-radius: 12px; display: grid; place-items: center;">
                    <i class="bi bi-currency-dollar" style="font-size: 24px; color: #4f46e5;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 5px solid #10b981;">
            <div style="display:flex; justify-content: space-between;">
                <div>
                    <h5 style="color: #64748b; font-size: 14px; text-transform: uppercase; margin-bottom: 10px;">Total Orders</h5>
                    <h2 style="font-size: 28px; font-weight: 800;">245</h2>
                    <p style="color: #10b981; font-size: 12px; font-weight: 700; margin-top: 10px;"><i class="bi bi-arrow-up"></i> +5% from yesterday</p>
                </div>
                <div style="background: #ecfdf5; width: 50px; height: 50px; border-radius: 12px; display: grid; place-items: center;">
                    <i class="bi bi-bag-check" style="font-size: 24px; color: #10b981;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 5px solid #f59e0b;">
            <div style="display:flex; justify-content: space-between;">
                <div>
                    <h5 style="color: #64748b; font-size: 14px; text-transform: uppercase; margin-bottom: 10px;">New Customers</h5>
                    <h2 style="font-size: 28px; font-weight: 800;">87</h2>
                    <p style="color: #64748b; font-size: 12px; margin-top: 10px;">Active users right now</p>
                </div>
                <div style="background: #fffbeb; width: 50px; height: 50px; border-radius: 12px; display: grid; place-items: center;">
                    <i class="bi bi-people" style="font-size: 24px; color: #f59e0b;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 5px solid #ef4444;">
            <div style="display:flex; justify-content: space-between;">
                <div>
                    <h5 style="color: #64748b; font-size: 14px; text-transform: uppercase; margin-bottom: 10px;">Active Products</h5>
                    <h2 style="font-size: 28px; font-weight: 800;">126</h2>
                    <p style="color: #ef4444; font-size: 12px; font-weight: 700; margin-top: 10px;"><i class="bi bi-exclamation-triangle"></i> 3 items out of stock</p>
                </div>
                <div style="background: #fef2f2; width: 50px; height: 50px; border-radius: 12px; display: grid; place-items: center;">
                    <i class="bi bi-box-seam" style="font-size: 24px; color: #ef4444;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Charts Section -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 30px;">
        <div style="background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 20px;">📈 Sales Performance</h3>
            <canvas id="salesChart" style="max-height: 300px;"></canvas>
        </div>
        <div style="background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 20px;">🛍️ Top Selling</h3>
            <canvas id="categoryChart" style="max-height: 300px;"></canvas>
        </div>
    </div>

    <!-- 3. Recent Activity Table -->
    <div style="background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <div style="display:flex; justify-content: space-between; align-items:center; margin-bottom: 20px;">
            <h3 style="font-size: 18px; font-weight: 700;">Latest Orders</h3>
            <a href="#" style="font-size: 13px; color: #4f46e5; text-decoration: none; font-weight: 700;">View All Orders</a>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; background: #f8fafc;">
                        <th style="padding: 15px; font-size: 13px; color: #64748b;">Order ID</th>
                        <th style="padding: 15px; font-size: 13px; color: #64748b;">Customer</th>
                        <th style="padding: 15px; font-size: 13px; color: #64748b;">Date</th>
                        <th style="padding: 15px; font-size: 13px; color: #64748b;">Status</th>
                        <th style="padding: 15px; font-size: 13px; color: #64748b;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; font-weight: 600;">#ORD-9021</td>
                        <td style="padding: 15px;">Zeeshan Khan</td>
                        <td style="padding: 15px; color: #64748b;">2 mins ago</td>
                        <td style="padding: 15px;"><span style="background: #ecfdf5; color: #10b981; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;">  </span></td>
                        <td style="padding: 15px; font-weight: 800;">$120.00</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; font-weight: 600;">#ORD-9022</td>
                        <td style="padding: 15px;">Sameer Ahmed</td>
                        <td style="padding: 15px; color: #64748b;">1 hour ago</td>
                        <td style="padding: 15px;"><span style="background: #fffbeb; color: #f59e0b; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;">Pending</span></td>
                        <td style="padding: 15px; font-weight: 800;">$450.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
  // 📊 Sales Line Chart (Updated Professional look)
  const ctx1 = document.getElementById('salesChart');
  new Chart(ctx1, {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Revenue',
        data: [2100, 1800, 3200, 2800, 4500, 3900, 5200],
        borderColor: '#4f46e5',
        borderWidth: 3,
        pointBackgroundColor: '#4f46e5',
        tension: 0.4,
        fill: true,
        backgroundColor: 'rgba(79, 70, 229, 0.05)'
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

  // 🛍️ Category Bar Chart
  const ctx2 = document.getElementById('categoryChart');
  new Chart(ctx2, {
    type: 'doughnut', // Changed to Doughnut for better look
    data: {
      labels: ['Hoodies', 'Polo', 'Trousers'],
      datasets: [{
        data: [55, 30, 15],
        backgroundColor: ['#4f46e5', '#10b981', '#f59e0b'],
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