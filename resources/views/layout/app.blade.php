<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('img/logo4.png') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
</head>
<body>  
    
    @yield('content-auth')

    <script src="{{ asset('js/bootstrap5.js') }}"></script>
    @include('layout.popup')
</body>
</html>