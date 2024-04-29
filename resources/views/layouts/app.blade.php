<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->currentLocale()) }}" data-theme="{{session('theme')}}">
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel.Kejvin | @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="overflow-y-auto">
<x-navbar></x-navbar>
<x-sidebar>
</x-sidebar>
@yield('content')

</body>
</html>
