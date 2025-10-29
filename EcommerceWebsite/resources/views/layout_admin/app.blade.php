<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin | Zain Store')</title>

  {{-- CSS --}}
  <link rel="stylesheet" href="{{ asset('asset/css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/css/product.css') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

  <div class="admin-container">
    {{-- Sidebar --}}
    @include('layout_admin. partials.sidebar')

    {{-- Main content --}}
    <div class="main-content">
      @include('layout_admin. partials.header')

      <div class="content-area">
        @yield('content')
      </div>

      @include('layout_admin. partials.footer')
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const toggleBtn = document.querySelector('.toggle-btn');
      const sidebar = document.querySelector('.sidebar');
      const mainContent = document.querySelector('.main-content');
  
      if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', (e) => {
          e.stopPropagation(); 
          sidebar.classList.toggle('active');
        });
  
        document.addEventListener('click', (event) => {
          if (
            sidebar.classList.contains('active') &&
            !sidebar.contains(event.target) &&
            !toggleBtn.contains(event.target)
          ) {
            sidebar.classList.remove('active');
          }
        });
      }
    });
  </script>

</body>
</html>
