<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->currentLocale()) }}" data-theme="{{session('theme')}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.7/b-3.0.2/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.7/b-3.0.2/datatables.min.js"></script>


    <title>Laravel.Kejvin | @yield('title')</title>
</head>
<body class="mt-16 min-h-screen">
<x-navbar/>
<x-sidebar/>
@yield('content')
<footer class="footer footer-center p-2 bg-transparent text-base-content">
    <aside>
        <p>Laravel.Kejvin | Kejvin Braka - Laravel Intern @ ATIS Tirana</p>
    </aside>
</footer>
</body>
</html>
