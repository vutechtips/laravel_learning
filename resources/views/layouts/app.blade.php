<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cozy Estate')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- HEADER PHẢI Ở TRÊN CÙNG -->
    @include('partials.header')
    
    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>
    
    <!-- FOOTER Ở DƯỚI CÙNG -->
    @include('partials.footer')
    
    <!-- JavaScript -->
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>