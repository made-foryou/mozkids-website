<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-secondary-500">
<head>
    @yield('head')
</head>
<body class="h-full antialiased">
    @yield('body')
</body>
</html>
