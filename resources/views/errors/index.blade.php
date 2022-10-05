<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title-error')</title>
    <link rel="icon" href="{{ asset('img/error_img/') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap5.css') }}">
</head>
<body>
    
    @yield('content-error')
    
    <script src="{{ asset('js/bootstrap5.js') }}"></script>
</body>
</html>