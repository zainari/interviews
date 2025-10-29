<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Zain Store')</title>

    <!-- Fonts & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    
</head>

<body>
    {{-- Header Include --}}
    @include('partials.header')

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer Include --}}
    @include('partials.footer')

    {{-- Optional JS --}}
    <script src="{{ asset('asset/js/slider.js') }}"></script>
</body>
</html>
